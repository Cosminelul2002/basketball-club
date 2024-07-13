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

        // Initialize tenant's database connection
        tenancy()->initialize($tenant);

        // Run the seeder in the tenant context
        Artisan::call('db:seed', [
            '--class' => RoleSeeder::class,
        ]);
    }
}
