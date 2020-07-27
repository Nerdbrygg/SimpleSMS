<?php

namespace Nerdbrygg\SimpleSMS\Tests;

use Orchestra\Testbench\TestCase as TestBench;

abstract class TestCase extends TestBench
{
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * Tell Testbench to use this package.
     *
     * @param $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Nerdbrygg\SimpleSMS\SimpleSMSServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.  In a normal app environment these would be added to
     * the 'aliases' array in the config/app.php file.  If your package exposes an
     * aliased facade, you should add the alias here, along with aliases for
     * facades upon which your package depends, e.g. Cartalyst/Sentry.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'SimpleSMS' => \Nerdbrygg\SimpleSMS\Facades\SimpleSMS::class,
        ];
    }
}
