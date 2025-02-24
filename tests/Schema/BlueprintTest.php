<?php

namespace ThovexLtd\LaravelPostgis\Tests\Schema;

use Mockery;
use ThovexLtd\LaravelPostgis\Schema\Blueprint;
use ThovexLtd\LaravelPostgis\Tests\BaseTestCase;

class BlueprintTest extends BaseTestCase
{
    protected $blueprint;

    public function setUp(): void
    {
        parent::setUp();

        $this->blueprint = Mockery::mock(Blueprint::class)
            ->makePartial()->shouldAllowMockingProtectedMethods();
    }

    public function testMultiPoint()
    {
        $this->blueprint
            ->shouldReceive('addCommand')
            ->with('multipoint', ['col', null, 2, true]);

        $this->blueprint->multipoint('col');
        $this->assertTrue(true);
    }

    public function testPolygon()
    {
        $this->blueprint
            ->shouldReceive('addCommand')
            ->with('polygon', ['col', null, 2, true]);

        $this->blueprint->polygon('col');
        $this->assertTrue(true);
    }

    public function testMulltiPolygon()
    {
        $this->blueprint
            ->shouldReceive('addCommand')
            ->with('multipolygon', ['col', null, 2, true]);

        $this->blueprint->multipolygon('col');
        $this->assertTrue(true);
    }

    public function testLineString()
    {
        $this->blueprint
            ->shouldReceive('addCommand')
            ->with('linestring', ['col', null, 2, true]);

        $this->blueprint->linestring('col');
        $this->assertTrue(true);
    }

    public function testMultiLineString()
    {
        $this->blueprint
            ->shouldReceive('addCommand')
            ->with('multilinestring', ['col', null, 2, true]);

        $this->blueprint->multilinestring('col');
        $this->assertTrue(true);
    }

    public function testGeography()
    {
        $this->blueprint
            ->shouldReceive('addCommand')
            ->with('geography', ['col', null, 2, true]);

        $this->blueprint->geography('col');
        $this->assertTrue(true);
    }

    public function testGeometryCollection()
    {
        $this->blueprint
            ->shouldReceive('addCommand')
            ->with('geometrycollection', ['col', null, 2, true]);

        $this->blueprint->geometrycollection('col');
        $this->assertTrue(true);
    }

    public function testEnablePostgis()
    {
        $this->blueprint
            ->shouldReceive('addCommand')
            ->with('enablePostgis', []);

        $this->blueprint->enablePostgis();
        $this->assertTrue(true);
    }

    public function testEnablePostgisIfNotExists()
    {
        $this->blueprint
            ->shouldReceive('addCommand')
            ->with('enablePostgis', []);

        $this->blueprint->enablePostgisIfNotExists();
        $this->assertTrue(true);
    }

    public function testDisablePostgis()
    {
        $this->blueprint
            ->shouldReceive('addCommand')
            ->with('disablePostgis', []);

        $this->blueprint->disablePostgis();
        $this->assertTrue(true);
    }

    public function testDisablePostgisIfExists()
    {
        $this->blueprint
            ->shouldReceive('addCommand')
            ->with('disablePostgis', []);

        $this->blueprint->disablePostgisIfExists();
        $this->assertTrue(true);
    }
}
