<?php

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) { // Use 'teams' instead of 'team'
            $table->id();
            $table->string('name');
            $table->string('captain');
            $table->foreignIdFor(Event::class)
                ->constrainted()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
