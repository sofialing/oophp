<?php
namespace Soln\Movie;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * @var object $obj
     */
    private $obj;

    /**
     * Connect to database and create new object
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->app->db->connect();
        $this->obj = new \Soln\Movie\DatabaseFunctions();
    }

    /**
     * Handle route and display page to show movie database-
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Visar alla filmer | Filmdatabas";
        $request = $this->app->request;

        // Deal with incoming variables
        $route = [
            "orderBy" => esc($request->getGet("orderBy", "id")),
            "order"   => esc($request->getGet("order", "asc")),
            "hits"    => esc($request->getGet("hits", 4)),
            "page"    => esc($request->getGet("page", 1))
        ];

        // Check if search and redirect to show search result
        if ($request->getGet("search")) {
            $search = esc(($request->getGet("search")));
            return $this->app->response->redirect("movie/search/$search");
        }

        // Get max number of pages
        $sql = "SELECT COUNT(id) AS max FROM movie;";
        $max = $this->app->db->executeFetchAll($sql);
        $max = ceil($max[0]->max / $route["hits"]);

        // Prepare and execute sql-statement
        $sql = ($request->getGet("hits") ? $this->obj->paginateHits($route, $max, "movie") :
        $this->obj->getAll($route, $max, "movie"));
        $resultset = $this->app->db->executeFetchAll($sql);

        // Save data
        $data = [
            "resultset" => $resultset,
            "max" => $max
        ];

        // Add and render page to display database
        $this->app->page->add("movie/index", $data);
        return $this->app->page->render(["title" => $title,]);
    }

    /**
     * Display page to show search result
     *
     * @param string $search as the search string
     * @return object
     */
    public function searchAction($search) : object
    {
        $title = "Visar sökresultat för $search | Filmdatabas";

        // Check if a new search has been made and redirect
        if ($this->app->request->getGet("search")) {
            $search = esc($this->app->request->getGet("search"));
            return $this->app->response->redirect("movie/search/$search");
        }

        // Prepare and execute sql-statement
        $sql = "SELECT * FROM movie WHERE title LIKE ? OR year LIKE ?;";
        $resultset = $this->app->db->executeFetchAll($sql, ["%" . $search . "%", $search]);

        // Save data
        $data = [
            "resultset" => $resultset,
            "search" => $search
        ];

        // Add and render page to display search result
        $this->app->page->add("movie/search-result", $data);
        return $this->app->page->render(["title" => $title,]);
    }

    /**
     * Display page to edit movie in database.
     *
     * @param int $id as the id of selected movie.
     * @return object
     */
    public function editActionGet($id) : object
    {
        $title = "Uppdatera film | Filmdatabas";

        // Check if logged in
        if (!$this->app->session->get('user')) {
            // Redirect to login page
            return $this->app->response->redirect("movie/login");
        }

        // Prepare and execute sql-statement
        $sql = "SELECT * FROM movie WHERE id = ?;";
        $resultset = $this->app->db->executeFetchAll($sql, [$id]);

        // Save data
        $data = [
            "resultset" => $resultset[0]
        ];

        // Add and render page to edit movie
        $this->app->page->add("movie/edit", $data);
        return $this->app->page->render(["title" => $title,]);
    }

    /**
     * Update movie in database.
     *
     * @param int $id as the id of selected movie.
     * @return object
     */
    public function editActionPost($id) : object
    {
        $request = $this->app->request;

        // Deal with incoming variables
        $movieId    = esc($id);
        $movieTitle = esc($request->getPost("movieTitle"));
        $movieYear  = esc($request->getPost("movieYear"));
        $movieImage = esc($request->getPost("movieImage"));

        // Prepare and execute sql-statement to update selected movie
        if ($request->getPost("doSave")) {
            $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
            $this->app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
        }

        // Redirect to display movie database
        return $this->app->response->redirect("movie/");
    }

    /**
     * Display page to delete movie from database.
     *
     * @param int $id as the id of selected movie.
     * @return object
     */
    public function deleteActionGet($id) : object
    {
        $title = "Radera film | Filmdatabas";

        // Check if logged in
        if (!$this->app->session->get('user')) {
            // Redirect to login page
            return $this->app->response->redirect("movie/login");
        }

        // Prepare and execute sql-statement
        $sql = "SELECT * FROM movie WHERE id = ?;";
        $resultset = $this->app->db->executeFetchAll($sql, [$id]);

        // Save data
        $data = ["resultset" => $resultset[0]];

        // Add and render page to delete movie
        $this->app->page->add("movie/delete", $data);
        return $this->app->page->render(["title" => $title]);
    }

    /**
     * Delete movie from database.
     *
     * @param int $id as the id of selected movie.
     * @return object
     */
    public function deleteActionPost($id) : object
    {
        // Prepare and execute sql-statement to delete selected movie
        if ($this->app->request->getPost("doDelete")) {
            $sql = "DELETE FROM movie WHERE id = ?;";
            $this->app->db->execute($sql, [$id]);
        }

        // Redirect to display movie database
        return $this->app->response->redirect("movie/");
    }

    /**
     * Display page to add new movie to database-
     *
     * @return object
     */
    public function addAction() : object
    {
        $title = "Lägg till film | Filmdatabas";

        // Check if logged in
        if (!$this->app->session->get('user')) {
            // Redirect to login page
            return $this->app->response->redirect("movie/login");
        }

        // Add and render page to add movie to database
        $this->app->page->add("movie/add");
        return $this->app->page->render(["title" => $title,]);
    }

    /**
     * Add new movie to database.
     *
     * @return object
     */
    public function addActionPost() : object
    {
        $request = $this->app->request;

        // Deal with incoming variables
        $movieTitle = esc($request->getPost("movieTitle"));
        $movieYear  = esc($request->getPost("movieYear"));
        $movieImage = esc($request->getPost("movieImage"));

        // Prepare and execute sql-statement to add new movie
        if ($request->getPost("doSave")) {
            $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
            $this->app->db->execute($sql, [$movieTitle, $movieYear, $movieImage]);
        }

        // Redirect to display movie database
        return $this->app->response->redirect("movie/");
    }

    /**
     * Display page to login
     *
     * @return object
     */
    public function loginAction() : object
    {
        $title = "Logga in | Filmdatabas";
        
        // Deal with incoming variables
        $user = $this->app->request->getPost('user');
        $pass = $this->app->request->getPost('pass');
        $pass = MD5($pass);

        if ($this->app->request->getPost('login')) {
            $sql = "SELECT user FROM login WHERE user LIKE ? AND pass = ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$user, $pass]);
            if ($resultset != null) {
                $this->app->session->set('user', $user);
                return $this->app->response->redirect("movie/");
            }
        }

        // Add and render page to login
        $this->app->page->add("movie/login");
        return $this->app->page->render(["title" => $title,]);
    }

    /**
     * Display page to logout
     *
     * @return object
     */
    public function logoutAction() : object
    {
        $title = "Logga ut | Filmdatabas";

        if ($this->app->request->getPost('logout')) {
            $this->app->session->delete('user');
            return $this->app->response->redirect("movie/");
        }

        // Add and render page to logout
        $this->app->page->add("movie/logout");
        return $this->app->page->render(["title" => $title,]);
    }
}
