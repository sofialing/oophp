<?php
namespace Soln\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class ContentController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * Initialize connection to database
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->app->db->connect();
    }

    /**
     * Handle route and display page to show content database-
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Visar allt innehåll i databasen";

        $sql = "SELECT * FROM content;";
        $res = $this->app->db->executeFetchAll($sql);

        $data["res"] = $res;
        $data["heading"] = $title;

        // Add and render page to display database
        $this->app->page->add("content/index", $data);
        return $this->app->page->render(["title" => $title,]);
    }

    /**
     * Display page to add new content to database-
     *
     * @return object
     */
    public function createAction() : object
    {
        $title = "Skapa nytt innehåll";

        // Check if not logged in, redirect to login page
        if (!$this->app->session->get('user')) {
            return $this->app->response->redirect("content/login");
        }

        if (hasKeyPost("doSave")) {
            $title = getPost("contentTitle");

            $sql = "INSERT INTO content (title) VALUES (?);";
            $this->app->db->execute($sql, [$title]);

            return $this->app->response->redirect("content");
        }

        // Add and render page to add content
        $this->app->page->add("content/create");
        return $this->app->page->render(["title" => $title,]);
    }

    /**
     * Display page to edit content in database.
     *
     * @param int $id as the id of selected content.
     * @return object
     */
    public function editActionGet($id) : object
    {
        $title = "Uppdatera innehåll";

        // Check if not logged in, redirect to login page
        if (!$this->app->session->get('user')) {
            return $this->app->response->redirect("content/login");
        }

        // Prepare and execute sql-statement
        $sql = "SELECT * FROM content WHERE id = ?;";
        $res = $this->app->db->executeFetchAll($sql, [$id]);

        // Save resultset
        $data["res"] = $res[0];

        // Add and render page to edit content
        $this->app->page->add("content/edit", $data);
        return $this->app->page->render(["title" => $title,]);
    }

    /**
     * Update content in database.
     *
     * @param int $id as the id of selected content.
     * @return object
     */
    public function editActionPost($id) : object
    {
        if (hasKeyPost("doDelete")) {
            return $this->app->response->redirect("content/delete/$id");
        }

        if (hasKeyPost("undoDelete")) {
            $sql = "UPDATE content SET deleted=null WHERE id=?;";
            $this->app->db->execute($sql, [$id]);
            return $this->app->response->redirect("content");
        }

        if (hasKeyPost("doSave")) {
            $params = getPost([
                "contentTitle",
                "contentPath",
                "contentSlug",
                "contentData",
                "contentType",
                "contentFilter",
                "contentPublish"
            ]);
            $params["contentId"] = $id;
        }

        if (!$params["contentSlug"]) {
            $params["contentSlug"] = slugify($params["contentTitle"]);
        }

        if (!$params["contentPath"]) {
            $params["contentPath"] = null;
        }

        $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?,
               filter=?, published=? WHERE id = ?;";
        $this->app->db->execute($sql, array_values($params));

        // Redirect to display content database
        return $this->app->response->redirect("content");
    }

    /**
     * Display page to delete content from database.
     *
     * @param int $id as the id of selected content.
     * @return object
     */
    public function deleteAction($id) : object
    {
        $title = "Radera innehåll";

        // Check if not logged in, redirect to login page
        if (!$this->app->session->get('user')) {
            return $this->app->response->redirect("content/login");
        }

        if (hasKeyPost("doDelete")) {
            $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
            $this->app->db->execute($sql, [$id]);
            return $this->app->response->redirect("content");
        }

        // Prepare and execute sql-statement
        $sql = "SELECT * FROM content WHERE id = ?;";
        $res = $this->app->db->executeFetchAll($sql, [$id]);

        // Save resultset
        $data["content"] = $res[0];

        // Add and render page to delete content
        $this->app->page->add("content/delete", $data);
        return $this->app->page->render(["title" => $title,]);
    }

    /**
     * Display page to login
     *
     * @return object
     */
    public function loginAction() : object
    {
        $title = "Logga in";

        // Deal with incoming variables
        $user = getPost('user');
        $pass = getPost('pass');
        $pass = MD5($pass);

        if (hasKeyPost("login")) {
            $sql = loginCheck();
            $res = $this->app->db->executeFetchAll($sql, [$user, $pass]);
            if ($res != null) {
                $this->app->session->set('user', $user);
                return $this->app->response->redirect("content");
            }
        }

        // Add and render page to login
        $this->app->page->add("content/login");
        return $this->app->page->render(["title" => $title,]);
    }

    /**
     * Display page to logout
     *
     * @return object
     */
    public function logoutAction() : object
    {
        $title = "Logga ut";

        if (hasKeyPost("logout")) {
            $this->app->session->delete('user');
            return $this->app->response->redirect("content");
        }

        // Add and render page to logout
        $this->app->page->add("content/logout");
        return $this->app->page->render(["title" => $title,]);
    }

    /**
     * Display all pages
     *
     * @return object
     */
    public function pagesAction() : object
    {
        $title = "Visar alla sidor";

        $sql = getAllPages();
        $res = $this->app->db->executeFetchAll($sql, ["page"]);
        $data["res"] = $res;

        // Add and render page to logout
        $this->app->page->add("content/pages", $data);
        return $this->app->page->render(["title" => $title,]);
    }

    /**
     * Display all pages
     *
     * @return object
     */
    public function pageAction($path = null) : object
    {
        if (!$path) {
            return $this->app->response->redirect("content");
        }

        $sql = getSelectedPage();
        $content = $this->app->db->executeFetch($sql, [$path, "page"]);
        $title = "titel";
        $data["content"] = $content;

        // Add and render page to logout
        $this->app->page->add("content/page", $data);
        return $this->app->page->render(["title" => $title,]);
    }

    /**
     * Display all blog posts
     *
     * @return object
     */
    public function blogAction($slug = null) : object
    {
        $title = "Visar alla blogginlägg";

        if ($slug) {
            $sql = getBlogPost();
            $res = $this->app->db->executeFetch($sql, [$slug, "post"]);
            $title = $res->title;
        } else {
            $sql = getAllBlogPosts();
            $res = $this->app->db->executeFetchAll($sql, ["post"]);
        }

        $data["res"] = $res;

        // Add and render page to logout
        $this->app->page->add("content/blog", $data);
        return $this->app->page->render(["title" => $title,]);
    }
}
