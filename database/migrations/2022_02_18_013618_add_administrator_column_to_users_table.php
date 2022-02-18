<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdministratorColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            
            if (!Schema::hasColumn('users', 'administrador')) {
                $table->boolean('administrador')->default(0);
            }  

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'administrador')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('administrador');
                });
            }
        });
    
    }
}
