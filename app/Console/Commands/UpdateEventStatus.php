<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class UpdateEventStatus extends Command
{
    protected $signature = 'events:update-status';
    protected $description = 'Update the status of events based on their end time';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get all tenants
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            // Initialize tenancy
            tenancy()->initialize($tenant);

            // Fetch all events for the tenant
            $events = Event::where('end_time', '<=', now())
                ->where('status', '!=', 'completed')
                // ->where('in_calendar', true)
                ->get();

            foreach ($events as $event) {
                $event->status = 'completed';
                $event->save();
            }

            $this->info('Event statuses updated successfully for tenant ID: ' . $tenant->id);

            // End tenancy for the current tenant
            tenancy()->end();
        }
    }
}
