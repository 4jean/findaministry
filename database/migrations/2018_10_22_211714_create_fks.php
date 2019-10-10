<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFks extends Migration
{

    public function up()
    {
        Schema::table('ministries', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('min_cat_id')->references('id')->on('min_cats')->onDelete('set null');
        });

        Schema::table('ministry_uploads', function (Blueprint $table) {
            $table->foreign('ministry_id')->references('id')->on('ministries')->onDelete('cascade');
        });

        Schema::table('featured_ministries', function (Blueprint $table) {
            $table->foreign('ministry_id')->references('id')->on('ministries')->onDelete('cascade');
        });

        Schema::table('ministry_news', function (Blueprint $table) {
            $table->foreign('ministry_id')->references('id')->on('ministries')->onDelete('cascade');
        });

        Schema::table('min_branches', function (Blueprint $table) {
            $table->foreign('hq')->references('id')->on('ministries')->onDelete('cascade');
            $table->foreign('ministry_id')->references('id')->on('ministries')->onDelete('cascade');
        });

        Schema::table('min_bookmarks', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ministry_id')->references('id')->on('ministries')->onDelete('cascade');
        });

        Schema::table('claims', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ministry_id')->references('id')->on('ministries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
