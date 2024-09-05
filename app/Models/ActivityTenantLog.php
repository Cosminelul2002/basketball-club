<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityTenantLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'user_id',
        'activity',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Log an activity for a tenant.
     *
     * @param  \App\Models\Tenant  $tenant
     * @param  \App\Models\User  $user
     * @param  string  $activity
     * @return void
     */
    public static function log($tenant, $user, $activity)
    {
        self::create([
            'tenant_id' => $tenant->id,
            'user_id' => $user->id,
            'activity' => $activity,
        ]);
    }
}
