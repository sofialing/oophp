<?php
/**
 * General functions.
 */

/**
 * Sanitize value for output in view.
 *
 * @param string $value to sanitize
 *
 * @return string beeing sanitized
 */
function esc($value)
{
    return htmlentities($value);
}

/**
 * Function to create links for sorting and keeping the original querystring.
 *
 * @param string $column the name of the database column to sort by
 * @param string $route  prepend this to the anchor href
 *
 * @return string with links to order by column.
 */
function orderby($column, $route)
{
    $asc = mergeQueryString(["orderby" => $column, "order" => "asc"], $route);
    $desc = mergeQueryString(["orderby" => $column, "order" => "desc"], $route);

    return <<<EOD
<span class="orderby">
<a href="$asc">&darr;</a>
<a href="$desc">&uarr;</a>
</span>
EOD;
}


/**
 * Use current querystring as base, extract it to an array, merge it
 * with incoming $options and recreate the querystring using the
 * resulting array.
 *
 * @param array  $options to merge into exitins querystring
 * @param string $prepend to the resulting query string
 *
 * @return string as an url with the updated query string.
 */
function mergeQueryString($options, $prepend = "?")
{
    // Parse querystring into array
    $query = [];
    parse_str($_SERVER["QUERY_STRING"], $query);

    // Merge query string with new options
    $query = array_merge($query, $options);

    // Build and return the modified querystring as url
    return $prepend . http_build_query($query);
}

/**
 * Check if key is set in POST.
 *
 * @param mixed $key     to look for
 *
 * @return boolean true if key is set, otherwise false
 */
function hasKeyPost($key)
{
    return array_key_exists($key, $_POST);
}

/**
 * Get value from POST variable or return default value.
 *
 * @param mixed $key     to look for, or value array
 * @param mixed $default value to set if key does not exists
 *
 * @return mixed value from POST or the default value
 */
function getPost($key, $default = null)
{
    if (is_array($key)) {
        foreach ($key as $val) {
            $post[$val] = getPost($val);
        }
        return $post;
    }

    return isset($_POST[$key])
        ? $_POST[$key]
        : $default;
}

/**
 * Get value from GET variable or return default value.
 *
 * @param string $key     to look for
 * @param mixed  $default value to set if key does not exists
 *
 * @return mixed value from GET or the default value
 */
function getGet($key, $default = null)
{
    return isset($_GET[$key])
        ? $_GET[$key]
        : $default;
}

/**
 * Create a slug of a string, to be used as url.
 *
 * @param string $str the string to format as slug.
 *
 * @return str the formatted slug.
 */
function slugify($str)
{
    $str = mb_strtolower(trim($str));
    $str = str_replace(['å','ä'], 'a', $str);
    $str = str_replace('ö', 'o', $str);
    $str = preg_replace('/[^a-z0-9-]/', '-', $str);
    $str = trim(preg_replace('/-+/', '-', $str), '-');
    return $str;
}


/**
 * Get value from POST variable or return default value.
 *
 * @param mixed $key     to look for, or value array
 * @param mixed $default value to set if key does not exists
 *
 * @return mixed value from POST or the default value
 */
function getMax($db, $table)
{
    $sql = "SELECT COUNT(id) AS max FROM $table;";
    $max = $db->executeFetch($sql);
    return $max;
}

/**
 * Prepare sql-statement based on get parameters
 *
 * @param array $route as the get parameters
 * @param int $max as max number of pages
 *
 * @return array sql-statement to execute
 */
function getAll($db, $route, $max, $table)
{
    $hits = $route["hits"];
    $page = $route["page"];
    $orderBy = $route["orderBy"];
    $order = $route["order"];

    // Incoming matches valid value sets
    if (!(is_numeric($hits) && $hits > 0 && $hits <= 10)) {
        throw new MovieException("Not valid for hits.");
    }

    // Incoming matches valid value sets
    if (!(is_numeric($hits) && $page > 0 && $page <= $max)) {
        throw new MovieException("Not valid for page.");
    }
    $offset = $hits * ($page - 1);

    // Only these values are valid
    $columns = [
        "id",
        "title",
        "type",
        "path",
        "slug",
        "published",
        "created",
        "updated",
        "deleted"
    ];
    $orders = ["asc", "desc"];

    // Incoming matches valid value sets
    if (!(in_array($orderBy, $columns) && in_array($order, $orders))) {
        throw new MovieException("Not valid input for sorting.");
    }

    $sql = "SELECT * FROM $table ORDER BY $orderBy $order LIMIT $hits OFFSET $offset;";
    $res = $db->executeFetchAll($sql);
    return $res;
}

/**
 * Create sql-statement to get all pages
 *
 * @return str the sql-statement
 */
function getAllPages()
{
    $sql = "SELECT
            *,
            CASE
                WHEN (deleted <= NOW()) THEN 'isDeleted'
                WHEN (published <= NOW()) THEN 'isPublished'
                ELSE 'notPublished'
            END AS status
        FROM content
        WHERE type = ?;";
    return $sql;
}

/**
 * Create sql-statement to get selected page
 *
 * @return str the sql-statement
 */
function getSelectedPage()
{
    $sql = "SELECT
            *,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
            FROM content
            WHERE
            path = ?
            AND type = ?
            AND (deleted IS NULL OR deleted > NOW())
            AND published <= NOW();";
    return $sql;
}

/**
 * Create sql-statement to get all blog posts
 *
 * @return str the sql-statement
 */
function getAllBlogPosts()
{
    $sql = "SELECT
            *,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
            FROM content
            WHERE type=?
            AND (deleted IS NULL OR deleted > NOW())
            AND published <= NOW()
            ORDER BY published DESC;";
    return $sql;
}

/**
 * Create sql-statement to get selected blog posts
 *
 * @return str the sql-statement
 */
function getBlogPost()
{
    $sql = "SELECT
            *,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
            FROM content
            WHERE
            slug = ?
            AND type = ?
            AND (deleted IS NULL OR deleted > NOW())
            AND published <= NOW()
            ORDER BY published DESC;";
    return $sql;
}

/**
 * Create sql-statement to get all blog posts
 *
 * @return str the sql-statement
 */
function loginCheck()
{
    $sql = "SELECT user FROM login WHERE user LIKE ? AND pass = ?;";
    return $sql;
}
