<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\MyHelper\Fam;

class CreateMinistriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('url');
            $table->string('email', 100)->nullable();
            $table->string('page', 50)->unique()->nullable();
            $table->unsignedInteger('visits')->default(1);
            $table->tinyInteger('verified')->default(0);
            $table->tinyInteger('hq')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_branch')->default(0);
            $table->string('code', 20)->unique();
            $table->longText('description');
            $table->string('address');
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('website')->nullable();
            $table->string('fb')->nullable();
            $table->string('yt')->nullable();
            $table->string('tw')->nullable();
            $table->string('inst')->nullable();
            $table->string('photo')->default(Fam::getDefaultImage());
            $table->string('founder')->nullable();
            $table->string('keywords')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('min_cat_id')->nullable();
            $table->string('country');
            $table->string('country_code');
            $table->string('state');
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
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
        Schema::dropIfExists('ministries');
    }
}
