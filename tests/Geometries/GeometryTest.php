<?php

namespace ThovexLtd\LaravelPostgis\Tests\Geometries;

use ThovexLtd\LaravelPostgis\Geometries\Geometry;
use ThovexLtd\LaravelPostgis\Geometries\GeometryCollection;
use ThovexLtd\LaravelPostgis\Geometries\LineString;
use ThovexLtd\LaravelPostgis\Geometries\MultiLineString;
use ThovexLtd\LaravelPostgis\Geometries\MultiPoint;
use ThovexLtd\LaravelPostgis\Geometries\MultiPolygon;
use ThovexLtd\LaravelPostgis\Geometries\Point;
use ThovexLtd\LaravelPostgis\Geometries\Polygon;
use ThovexLtd\LaravelPostgis\Tests\BaseTestCase;

class GeometryTest extends BaseTestCase
{
    public function testGetWKTArgument()
    {
        $this->assertEquals(
            '1 1',
            Geometry::getWKTArgument('POINT(1 1)')
        );
        $this->assertEquals(
            '1 1,1 2,2 2',
            Geometry::getWKTArgument('LINESTRING(1 1,1 2,2 2)')
        );
        $this->assertEquals(
            '(1 1,4 1,4 4,1 4,1 1),(1 1, 2 1, 2 2, 1 2,1 1)',
            Geometry::getWKTArgument('POLYGON((1 1,4 1,4 4,1 4,1 1),(1 1, 2 1, 2 2, 1 2,1 1))')
        );
        $this->assertEquals(
            '(1 1),(1 2)',
            Geometry::getWKTArgument('MULTIPOINT((1 1),(1 2))')
        );
        $this->assertEquals(
            '(1 1,1 2,2 2),(2 3,3 2,5 4)',
            Geometry::getWKTArgument('MULTILINESTRING((1 1,1 2,2 2),(2 3,3 2,5 4))')
        );
        $this->assertEquals(
            '((1 1,4 1,4 4,1 4,1 1),(1 1,2 1,2 2,1 2,1 1)), ((-1 -1,-1 -2,-2 -2,-2 -1,-1 -1))',
            Geometry::getWKTArgument('MULTIPOLYGON(((1 1,4 1,4 4,1 4,1 1),(1 1,2 1,2 2,1 2,1 1)), ((-1 -1,-1 -2,-2 -2,-2 -1,-1 -1)))')
        );
        $this->assertEquals(
            'POINT(2 3),LINESTRING(2 3,3 4)',
            Geometry::getWKTArgument('GEOMETRYCOLLECTION(POINT(2 3),LINESTRING(2 3,3 4))')
        );
    }

    public function testGetWKTArgument3d()
    {
        $this->assertEquals(
            '1 1 1',
            Geometry::getWKTArgument('POINT Z(1 1 1)')
        );
        $this->assertEquals(
            '1 1 1,1 2 2,2 2 3',
            Geometry::getWKTArgument('LINESTRING Z(1 1 1,1 2 2,2 2 3)')
        );
        $this->assertEquals(
            '(1 1 1,4 1 1,4 4 1,1 4 1,1 1 1),(1 1 2, 2 1 2, 2 2 2, 1 2 2,1 1 2)',
            Geometry::getWKTArgument('POLYGON Z((1 1 1,4 1 1,4 4 1,1 4 1,1 1 1),(1 1 2, 2 1 2, 2 2 2, 1 2 2,1 1 2))')
        );
        $this->assertEquals(
            '(1 1 1),(1 2 2)',
            Geometry::getWKTArgument('MULTIPOINT Z((1 1 1),(1 2 2))')
        );
        $this->assertEquals(
            '(1 1 1,1 2 1,2 2 1),(2 3 2,3 2 2,5 4 2)',
            Geometry::getWKTArgument('MULTILINESTRING Z((1 1 1,1 2 1,2 2 1),(2 3 2,3 2 2,5 4 2))')
        );
        $this->assertEquals(
            '((1 1 1,4 1 1,4 4 1,1 4 1,1 1 1),(1 1 2,2 1 2,2 2 2,1 2 2,1 1 2)), ((-1 -1 -1,-1 -2 -1,-2 -2 -1,-2 -1 -1,-1 -1 -1))',
            Geometry::getWKTArgument('MULTIPOLYGON Z(((1 1 1,4 1 1,4 4 1,1 4 1,1 1 1),(1 1 2,2 1 2,2 2 2,1 2 2,1 1 2)), ((-1 -1 -1,-1 -2 -1,-2 -2 -1,-2 -1 -1,-1 -1 -1)))')
        );
        $this->assertEquals(
            'POINT Z(2 3 4),LINESTRING Z(2 3 4,3 4 5)',
            Geometry::getWKTArgument('GEOMETRYCOLLECTION(POINT Z(2 3 4),LINESTRING Z(2 3 4,3 4 5))')
        );
    }

    public function testGetWKTClass()
    {
        $this->assertEquals(
            Point::class,
            Geometry::getWKTClass('POINT(0 0)')
        );
        $this->assertEquals(
            LineString::class,
            Geometry::getWKTClass('LINESTRING(0 0,1 1,1 2)')
        );
        $this->assertEquals(
            Polygon::class,
            Geometry::getWKTClass('POLYGON((0 0,4 0,4 4,0 4,0 0),(1 1, 2 1, 2 2, 1 2,1 1))')
        );
        $this->assertEquals(
            MultiPoint::class,
            Geometry::getWKTClass('MULTIPOINT((0 0),(1 2))')
        );
        $this->assertEquals(
            MultiLineString::class,
            Geometry::getWKTClass('MULTILINESTRING((0 0,1 1,1 2),(2 3,3 2,5 4))')
        );
        $this->assertEquals(
            MultiPolygon::class,
            Geometry::getWKTClass('MULTIPOLYGON(((0 0,4 0,4 4,0 4,0 0),(1 1,2 1,2 2,1 2,1 1)), ((-1 -1,-1 -2,-2 -2,-2 -1,-1 -1)))')
        );
        $this->assertEquals(
            GeometryCollection::class,
            Geometry::getWKTClass('GEOMETRYCOLLECTION(POINT(2 3),LINESTRING(2 3,3 4))')
        );
    }

    public function testGetWKTClass3d()
    {
        $this->assertEquals(
            Point::class,
            Geometry::getWKTClass('POINT Z(0 0 0)')
        );
        $this->assertEquals(
            LineString::class,
            Geometry::getWKTClass('LINESTRING Z(0 0 0,1 1 1,1 2 3)')
        );
        $this->assertEquals(
            Polygon::class,
            Geometry::getWKTClass('POLYGON Z((0 0 0 ,4 0 3,4 4 4,0 4 0,0 0 0),(1 1 1, 2 1 2, 2 2 2, 1 2 2,1 1 1))')
        );
        $this->assertEquals(
            MultiPoint::class,
            Geometry::getWKTClass('MULTIPOINT Z((0 00),(1 2 3))')
        );
        $this->assertEquals(
            MultiLineString::class,
            Geometry::getWKTClass('MULTILINESTRING Z((0 0 0 ,1 1 1,1 2 3),(2 3 4,3 2 1,5 4 3))')
        );
        $this->assertEquals(
            MultiPolygon::class,
            Geometry::getWKTClass('MULTIPOLYGON Z(((0 0 0,4 0 4,4 4 4,0 4 0,0 0 0),(1 1 1,2 1 2,2 2 2,1 2 2,1 1 1)), ((-1 -1 -1,-1 -2 -1,-2 -2 -1,-2 -1 -1,-1 -1 -1)))')
        );
        $this->assertEquals(
            GeometryCollection::class,
            Geometry::getWKTClass('GEOMETRYCOLLECTION(POINT Z(2 3 4),LINESTRING Z(2 3 4,3 4 5))')
        );
    }

    public function testGetWKBClass()
    {
        $this->assertInstanceOf(
            Point::class,
            Geometry::fromWKB('0101000000000000000000f03f0000000000000040')
        );
        $this->assertInstanceOf(
            LineString::class,
            Geometry::fromWKB('010200000002000000000000000000f03f000000000000004000000000000008400000000000001040')
        );
        $this->assertInstanceOf(
            Polygon::class,
            Geometry::fromWKB('01030000000100000004000000000000000000f03f00000000000000400000000000000840000000000000104000000000000014400000000000001840000000000000f03f0000000000000040')
        );
        $this->assertInstanceOf(
            MultiPoint::class,
            Geometry::fromWKB('0104000000020000000101000000000000000000f03f0000000000000040010100000000000000000008400000000000001040')
        );
        $this->assertInstanceOf(
            MultiLineString::class,
            Geometry::fromWKB('010500000001000000010200000002000000000000000000f03f000000000000004000000000000008400000000000001040')
        );
        $this->assertInstanceOf(
            MultiLineString::class,
            Geometry::fromWKB('010500000002000000010200000002000000000000000000f03f000000000000004000000000000008400000000000001040010200000002000000000000000000144000000000000018400000000000001c400000000000002040')
        );
        $this->assertInstanceOf(
            MultiPolygon::class,
            Geometry::fromWKB('01060000000200000001030000000100000004000000000000000000f03f00000000000000400000000000000840000000000000104000000000000014400000000000001840000000000000f03f000000000000004001030000000300000004000000000000000000f03f00000000000000400000000000000840000000000000104000000000000014400000000000001840000000000000f03f000000000000004004000000000000000000264000000000000028400000000000002a400000000000002c400000000000002e4000000000000030400000000000002640000000000000284004000000000000000000354000000000000036400000000000003740000000000000384000000000000039400000000000003a4000000000000035400000000000003640')
        );
        $this->assertInstanceOf(
            GeometryCollection::class,
            Geometry::fromWKB('0107000000010000000101000000000000000000f03f0000000000000040')
        );
        $this->assertInstanceOf(
            GeometryCollection::class,
            Geometry::fromWKB('0107000000020000000101000000000000000000f03f0000000000000040010200000002000000000000000000f03f000000000000004000000000000008400000000000001040')
        );
    }
}
