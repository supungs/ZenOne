<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->smallInteger('capacity');
            $table->softDeletes();
        });

        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('code', 8);
            $table->string('name', 64);
            $table->softDeletes();
        });

        Schema::create('hall_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hall_id');
            $table->date('date');
            $table->time('from');
            $table->time('to');
            $table->enum('type', ['lecture', 'tutorial', 'exam', 'event', 'other']);
            $table->string('description', 256);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('module_id')->nullable();
            $table->smallInteger('batch')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('halls');
    }
};
