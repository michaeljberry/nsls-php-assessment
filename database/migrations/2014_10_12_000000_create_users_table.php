<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token', 80)
                ->unique()
                ->nullable()
                ->default(null);
            $table->integer('usage_count')->nullable();
            $table->dateTime('last_used_on')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Michael Berry',
                'email' => 'michael@michaeljberry.com',
                'password' => bcrypt('awesome'),
                'api_token' => 'QkgAVGXuebE9beJEV6iaMKRWf4eDAtALwi9FibuXvR37HYqEJuQKmVdv9eUEyx88',
                'usage_count' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'name' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'password' => bcrypt('awesome'),
                'api_token' => '3o2fQgpAfxmQhPDsvhDThhyDMZZ7bRh7VcUGAn24UYJWnjVFDtnfZk77Go6NxB62',
                'usage_count' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
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
