<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinistryUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministry_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ministry_id');
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->string('path')->nullable();
            $table->string('ext')->nullable();
            $table->string('type')->nullable();
            $table->string('size')->nullable();
            $table->string('disk')->default('public');
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
        Schema::dropIfExists('ministry_uploads');
    }
}
