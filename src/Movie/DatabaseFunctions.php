<?php
namespace Soln\Movie;

class DatabaseFunctions
{
    /**
     * Calculate number of hits per page and prepare sql-statement
     *
     * @param array $route as the get parameters
     * @param int $max as max number of pages
     *
     * @return string sql-statement to execute
     */
    public function paginateHits($route, $max, $table)
    {
        $hits = $route["hits"];
        $page = $route["page"];
        $orderBy = $route["orderBy"];
        $order = $route["order"];

        // Get number of hits per page
        if (!(is_numeric($hits) && $hits > 0 && $hits <= 8)) {
            throw new MovieException("Not valid for hits.");
        }

        // Get current page
        if (!(is_numeric($hits) && $page > 0 && $page <= $max)) {
            throw new MovieException("Not valid for page.");
        }
        $offset = $hits * ($page - 1);

        // Only these values are valid
        $columns = ["id", "title", "year", "image"];
        $orders = ["asc", "desc"];

        // Incoming matches valid value sets
        if (!(in_array($orderBy, $columns) && in_array($order, $orders))) {
            throw new MovieException("Not valid input for sorting.");
        }

        $sql = "SELECT * FROM $table ORDER BY $orderBy $order LIMIT $hits OFFSET $offset;";
        return $sql;
    }

    /**
     * Prepare sql-statement based on get parameters
     *
     * @param array $route as the get parameters
     * @param int $max as max number of pages
     *
     * @return string sql-statement to execute
     */
    public function getAll($route, $max, $table)
    {
        $hits = $route["hits"];
        $page = $route["page"];
        $orderBy = $route["orderBy"];
        $order = $route["order"];

        if (!(is_numeric($hits) && $page > 0 && $page <= $max)) {
            throw new MovieException("Not valid for page.");
        }
        $offset = $hits * ($page - 1);

        // Only these values are valid
        $columns = ["id", "title", "year", "image"];
        $orders = ["asc", "desc"];

        // Incoming matches valid value sets
        if (!(in_array($orderBy, $columns) && in_array($order, $orders))) {
            throw new MovieException("Not valid input for sorting.");
        }

        $sql = "SELECT * FROM $table ORDER BY $orderBy $order LIMIT $hits OFFSET $offset;";
        return $sql;
    }
}
