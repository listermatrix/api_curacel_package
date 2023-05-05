<?php

namespace Jetstream\Curacel\Tests;

use Jetstream\Curacel\CuracelServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Illuminate\Contracts\Config\Repository;

class TestCase extends OrchestraTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->basUrl = config('curacel.base_url');
        $this->key = config('curacel.api_key');
    }

    protected function getPackageProviders($app): array
    {
        return [
            CuracelServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $config = app(Repository::class);
        $config->set('database.default', 'testbench');
        $config->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        $config->set('queue.batching.database', 'testbench');
        $config->set('queue.failed.database', 'testbench');
    }

}
