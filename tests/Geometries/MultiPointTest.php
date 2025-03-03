<?php

namespace ThovexLtd\LaravelPostgis\Tests\Geometries;

use ThovexLtd\LaravelPostgis\Geometries\MultiPoint;
use ThovexLtd\LaravelPostgis\Geometries\Point;
use ThovexLtd\LaravelPostgis\Tests\BaseTestCase;

class MultiPointTest extends BaseTestCase
{
    public function testFromWKT()
    {
        $multipoint = MultiPoint::fromWKT('MULTIPOINT((1 1),(2 1),(2 2))');
        $this->assertInstanceOf(MultiPoint::class, $multipoint);

        $this->assertEquals(3, $multipoint->count());
    }

    public function testFromWKTWithFloatingPoint()
    {
        $multipoint = MultiPoint::fromWKT('MULTIPOINT((1.0 1.0),(2.0 1.0),(2.0 2.0))');
        $this->assertInstanceOf(MultiPoint::class, $multipoint);

        $this->assertEquals(3, $multipoint->count());
    }

    public function testFromWKTWithoutNestedParentesis()
    {
        $multipoint = MultiPoint::fromWKT('MULTIPOINT(1 1, 2 1, 2 2)');
        $this->assertInstanceOf(MultiPoint::class, $multipoint);

        $this->assertEquals(3, $multipoint->count());
    }

    public function testFromWKT3d()
    {
        $multipoint = MultiPoint::fromWKT('MULTIPOINT Z((1 1 1),(2 1 3),(2 2 2))');
        $this->assertInstanceOf(MultiPoint::class, $multipoint);

        $this->assertEquals(3, $multipoint->count());
    }

    public function testFromWKT3dWithoutNestedParentesis()
    {
        $multipoint = MultiPoint::fromWKT('MULTIPOINT Z(1 1 1, 2 1 3, 2 2 2)');
        $this->assertInstanceOf(MultiPoint::class, $multipoint);

        $this->assertEquals(3, $multipoint->count());
    }

    public function testToWKT()
    {
        $collection = [new Point(1, 1), new Point(1, 2), new Point(2, 2)];

        $multipoint = new MultiPoint($collection);

        $this->assertEquals('MULTIPOINT((1 1),(2 1),(2 2))', $multipoint->toWKT());
    }

    public function testToWKT3d()
    {
        $collection = [new Point(1, 1, 1), new Point(1, 2, 3), new Point(2, 2, 2)];

        $multipoint = new MultiPoint($collection);

        $this->assertEquals('MULTIPOINT Z((1 1 1),(2 1 3),(2 2 2))', $multipoint->toWKT());
    }

    public function testJsonSerialize()
    {
        $collection = [new Point(1, 1), new Point(1, 2), new Point(2, 2)];

        $multipoint = new MultiPoint($collection);

        $this->assertInstanceOf(\GeoJson\Geometry\MultiPoint::class, $multipoint->jsonSerialize());
        $this->assertSame('{"type":"MultiPoint","coordinates":[[1,1],[2,1],[2,2]]}', json_encode($multipoint));
    }

    public function testJsonSerialize3d()
    {
        $collection = [new Point(1, 1, 1), new Point(1, 2, 3), new Point(2, 2, 2)];

        $multipoint = new MultiPoint($collection);

        $this->assertInstanceOf(\GeoJson\Geometry\MultiPoint::class, $multipoint->jsonSerialize());
        $this->assertSame('{"type":"MultiPoint","coordinates":[[1,1,1],[2,1,3],[2,2,2]]}', json_encode($multipoint));
    }
}
