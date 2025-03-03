<?php

namespace ThovexLtd\LaravelPostgis\Geometries;

interface GeometryInterface
{
    public function toWKT();

    public static function fromWKT($wkt);

    public function __toString();

    public static function fromString($wktArgument);
}
