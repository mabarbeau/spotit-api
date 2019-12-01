<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Map;
use Faker\Generator as Faker;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;

$factory->define(Map::class, function (Faker $faker) {
    // saving a polygon
    $area = new Polygon([new LineString([
        new Point(40.74894149554006, -73.98615270853043),
        new Point(40.74848633046773, -73.98648262023926),
        new Point(40.747925497790725, -73.9851602911949),
        new Point(40.74837050671544, -73.98482501506805),
        new Point(40.74894149554006, -73.98615270853043)
    ])]);

    return [
        'geometry' => $area,
    ];
});
