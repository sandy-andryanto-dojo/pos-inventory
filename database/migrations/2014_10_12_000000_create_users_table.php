<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('gender')->default(0);
            $table->string('postal_code')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->string('session_id')->nullable();
            $table->boolean('is_confirm')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->index("session_id");
            $table->engine = 'InnoDB';
        });

        Schema::create('users_confirm', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('token');
            $table->timestamps();
            $table->primary('user_id');
            $table->index("user_id");
            $table->engine = 'InnoDB';
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
        Schema::dropIfExists('users_confirm');
    }
}
