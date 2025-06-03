<?php

use App\Enums\TaskPriorityType;
use App\Enums\TaskTypes;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', TaskTypes::getValues())->default(TaskTypes::PENDING);
            $table->enum('priority', TaskPriorityType::getValues())
            ->default(TaskPriorityType::LOW);
            $table->foreignId('assigned_to')->nullable()
                ->constrained('users');
            $table->foreignId('created_by')->nullable()
                ->constrained('users');
            $table->date('due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
