<?php

namespace Soln\Movie;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DatabaseFunctions.
 */
class DatabaseFunctionsTest extends TestCase
{

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGetAll()
    {
        $route  = [
            "orderBy" => "id",
            "order"   => "asc",
            "hits"    => 4,
            "page"    => 1
        ];
        $obj = new \Soln\Movie\DatabaseFunctions();
        $res = $obj->getAll($route, 2, "movie");

        $exp = "SELECT * FROM movie ORDER BY id asc LIMIT 4 OFFSET 0;";
        $this->assertEquals($exp, $res);
    }

    /**
    * @expectedException \Soln\Movie\MovieException
    * @expectedExceptionMessage Not valid for hits.
     */
    public function testNotValidHits()
    {
        $route  = [
            "orderBy" => "id",
            "order"   => "asc",
            "hits"    => 10,
            "page"    => 1
        ];
        $obj = new \Soln\Movie\DatabaseFunctions();
        $obj->getAll($route, 2, "movie");
    }

    /**
    * @expectedException \Soln\Movie\MovieException
    * @expectedExceptionMessage Not valid for page.
     */
    public function testNotValidPage()
    {
        $route  = [
            "orderBy" => "id",
            "order"   => "asc",
            "hits"    => 4,
            "page"    => 3
        ];
        $obj = new \Soln\Movie\DatabaseFunctions();
        $obj->getAll($route, 2, "movie");
    }

    /**
    * @expectedException \Soln\Movie\MovieException
    * @expectedExceptionMessage Not valid input for sorting.
     */
    public function testNotValidInput()
    {
        $route  = [
            "orderBy" => "number",
            "order"   => "asc",
            "hits"    => 4,
            "page"    => 1
        ];
        $obj = new \Soln\Movie\DatabaseFunctions();
        $obj->getAll($route, 2, "movie");
    }
}
