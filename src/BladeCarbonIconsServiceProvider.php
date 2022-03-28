<?php

declare(strict_types=1);

namespace Codeat3\BladeCarbonIcons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class BladeCarbonIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-carbon-icons', []);

            $factory->add('carbon-icons', array_merge(['path' => __DIR__ . '/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/blade-carbon-icons.php', 'blade-carbon-icons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/svg' => public_path('vendor/blade-carbon-icons'),
            ], 'blade-carbon-icons');

            $this->publishes([
                __DIR__ . '/../config/blade-carbon-icons.php' => $this->app->configPath('blade-carbon-icons.php'),
            ], 'blade-carbon-icons-config');
        }
    }
}
