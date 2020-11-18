<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('api_token', 80)
                ->unique()
                ->nullable()
                ->default(null);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile_number')->default(0);
            $table->text('profile_url')->nullable();
            $table->integer('city')->default(0);
            $table->string('timezone')->nullable();
            $table->string('language')->nullable();
            $table->string('device_system')->nullable();
            $table->boolean('notification')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
