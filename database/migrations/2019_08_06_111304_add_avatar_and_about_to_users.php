<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvatarAndAboutToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            if (!Schema::hasColumn('users', 'about')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('about')->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('avatar')->nullable();
                });
            }
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
            if (Schema::hasColumn('users', 'about')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('about');
                });
            }
            if (Schema::hasColumn('users', 'avatar')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('avatar');
                });
            }
        }
    }
}
