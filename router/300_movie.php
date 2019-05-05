<?php

namespace Soln\Movie;

/**
 * Create routes for dice game 100.
 */
//var_dump(array_keys(get_defined_vars()));


/**
 * Show all movies.
 */
$app->router->get("test", function () use ($app) {
    $title = "Movie database | oophp";

    $app->db->connect();
    $sql = "SELECT * FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    $app->page->add("movie/index", [
        "resultset" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});
