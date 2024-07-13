<?php

namespace App\Listeners;

use App\Events\NewTenantCreated;
use Database\Seeders\RoleSeeder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

class TenantDatabaseSeeder
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewTenantCreated $event): void
    {
        $tenant = $event->tenant;

        // add logic to seed tenant database
        $connection = $tenant->getConnectionName();

        config(['database.default' => $connection]);

        $this->seedRoleSeeder($tenant);
    }

    /**
     * Seed the role seeder.
     */
    protected function seedRoleSeeder($tenant)
    {
        Artisan::call('db:seed', [
            '--class' => RoleSeeder::class,
            '--database' => $tenant->tenancy_db_name,
        ]);
    }
}
