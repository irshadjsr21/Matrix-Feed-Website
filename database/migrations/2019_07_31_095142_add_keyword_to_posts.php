<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeywordToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('posts')) {
            if (!Schema::hasColumn('posts', 'keywords')) {
                Schema::table('posts', function (Blueprint $table) {
                    $table->string('keywords')->nullable();
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
        if (Schema::hasTable('posts')) {
            if (Schema::hasColumn('posts', 'keywords')) {
                Schema::table('posts', function (Blueprint $table) {
                    $table->dropColumn('keywords');
                });
            }
        }
    }
}
