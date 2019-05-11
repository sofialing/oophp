<?php
namespace Soln\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class BlogController implements AppInjectableInterface
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
     * Display all blog posts
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Visar alla blogginlägg";

        $sql = getAllBlogPosts();
        $res = $this->app->db->executeFetchAll($sql, ["post"]);
        $data["res"] = $res;

        // Add and render page to logout
        $this->app->page->add("content/blog", $data);
        return $this->app->page->render(["title" => $title,]);
    }

    /**
     * Display selected blog post
     *
     * @return object
     */
    public function showPostAction($slug = null) : object
    {
        if (!$slug) {
            return $this->app->response->redirect("blog");
        }

        $sql = getBlogPost();
        $content = $this->app->db->executeFetch($sql, [$slug, "post"]);

        if (!$content) {
            $title = "404";
            $this->app->page->add("content/404");
            return $this->app->page->render(["title" => $title,]);
        }

        $title = $content->title;
        $data["content"] = $content;

        // Add and render page to display page
        $this->app->page->add("content/blogpost", $data);
        return $this->app->page->render(["title" => $title,]);
    }
}
