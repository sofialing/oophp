<?php
namespace Soln\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class PageController implements AppInjectableInterface
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
     * Display all pages
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Visar alla sidor";

        $sql = getAllPages();
        $content = $this->app->db->executeFetchAll($sql, ["page"]);
        $data["content"] = $content;

        // Add and render page to display all pages in database
        $this->app->page->add("content/pages", $data);
        return $this->app->page->render(["title" => $title,]);
    }

    /**
     * Display selected page
     *
     * @return object
     */
    public function showPageAction($path = null) : object
    {
        if (!$path) {
            return $this->app->response->redirect("page");
        }

        $sql = getSelectedPage();
        $content = $this->app->db->executeFetch($sql, [$path, "page"]);

        if (!$content) {
            $title = "404";
            $this->app->page->add("content/404");
            return $this->app->page->render(["title" => $title,]);
        }

        $title = $content->title;
        $data["content"] = $content;

        // Add and render page to display page
        $this->app->page->add("content/page", $data);
        return $this->app->page->render(["title" => $title,]);
    }
}
