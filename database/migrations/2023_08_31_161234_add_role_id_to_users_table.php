<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('roles_id')->nullable(); // Assuming the role_id can be nullable

            // Define the foreign key relationship
            $table->foreign('roles_id')->references('id')->on('roles');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the foreign key first to avoid issues
            $table->dropForeign(['roles_id']);

            // Then drop the column
            $table->dropColumn('roles_id');
        });
    }
}
