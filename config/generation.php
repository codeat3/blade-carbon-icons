<?php

use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;
use Codeat3\BladeIconGeneration\IconProcessor;

$svgNormalization = static function (string $tempFilepath, array $iconSet, SplFileInfo $file) {

    // perform generic optimizations
    $iconProcessor = new IconProcessor($tempFilepath, $iconSet, $file);
    $iconProcessor
        ->convertStyleToInline()
        ->optimize()
        ->postOptimizationAsString(function ($svgLine) {
            return str_replace('fill:#000000', 'fill:currentColor', $svgLine);
        })
        ->save();
};

return [
    [
        // Define a source directory for the sets like a node_modules/ or vendor/ directory...
        'source' => __DIR__.'/../dist/packages/icons/src/svg/32',

        // Define a destination directory for your icons. The below is a good default...
        'destination' => __DIR__.'/../resources/svg',

        // Enable "safe" mode which will prevent deletion of old icons...
        'safe' => false,

        // Call an optional callback to manipulate the icon
        // with the pathname of the icon and the settings from above...
        'after' => $svgNormalization,

        'is-solid' => true,
    ],
];
