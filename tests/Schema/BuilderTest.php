<?php

namespace ThovexLtd\LaravelPostgis\Tests\Schema;

use Mockery;
use ThovexLtd\LaravelPostgis\PostgisConnection;
use ThovexLtd\LaravelPostgis\Schema\Blueprint;
use ThovexLtd\LaravelPostgis\Schema\Builder;
use ThovexLtd\LaravelPostgis\Tests\BaseTestCase;

class BuilderTest extends BaseTestCase
{
    public function testReturnsCorrectBlueprint()
    {
        $connection = Mockery::mock(PostgisConnection::class);
        $connection->shouldReceive('getSchemaGrammar')->once()->andReturn(null);

        $mock = Mockery::mock(Builder::class, [$connection]);
        $mock->makePartial()->shouldAllowMockingProtectedMethods();
        $blueprint = $mock->createBlueprint('test', function () {
        });

        $this->assertInstanceOf(Blueprint::class, $blueprint);
    }
}
