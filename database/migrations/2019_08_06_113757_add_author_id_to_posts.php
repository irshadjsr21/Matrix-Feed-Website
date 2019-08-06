<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthorIdToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('posts')) {
            if (!Schema::hasColumn('posts', 'author_id')) {
                Schema::table('posts', function (Blueprint $table) {
                    $table->unsignedBigInteger('author_id')->nullable();
                });
            }
            if (Schema::hasColumn('posts', 'author')) {
                Schema::table('posts', function (Blueprint $table) {
                    $table->string('author')->nullable()->change();
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
            if (Schema::hasColumn('posts', 'author_id')) {
                Schema::table('posts', function (Blueprint $table) {
                    $table->dropColumn('author_id');
                });
            }
            if (Schema::hasColumn('posts', 'author')) {
                Schema::table('posts', function (Blueprint $table) {
                    $table->string('author')->change();
                });
            }
        }
    }
}
