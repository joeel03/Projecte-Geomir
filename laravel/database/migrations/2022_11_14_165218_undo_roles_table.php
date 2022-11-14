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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });

        Schema::dropIfExists('roles');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Create roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Call seeder
        Artisan::call('db:seed', [
            '--class' => 'RoleSeeder',
            '--force' => true // <--- add this line
        ]);

        // Update users table
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')
                  ->nullable()
                  ->default(Role::AUTHOR);
            $table->foreign('role_id')
                  ->references('id')->on('roles')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });

        // Update old users with default role
        DB::update(
            "UPDATE users
             SET role_id = " . Role::AUTHOR . "
             WHERE role_id IS NULL",
        );
    }
};
