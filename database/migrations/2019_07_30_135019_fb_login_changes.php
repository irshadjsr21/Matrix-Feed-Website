<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FbLoginChanges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            if (!Schema::hasColumn('users', 'facebook_id')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('facebook_id')->nullable();
                });
            }
            Schema::table('users', function (Blueprint $table) {
                $table->string('password')->nullable()->change();
                $table->string('lastName')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('users')) {
            if (Schema::hasColumn('users', 'facebook_id')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('facebook_id');
                });
            }
            Schema::table('users', function (Blueprint $table) {
                $table->string('password')->change();
                $table->string('lastName')->change();
            });
        }
    }
}
