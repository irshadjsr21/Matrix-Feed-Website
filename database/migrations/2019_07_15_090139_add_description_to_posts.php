<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('posts')) {
            if (!Schema::hasColumn('posts','description')) {
                Schema::table('posts', function (Blueprint $table) {
                    $table->text('description');
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
            if (Schema::hasColumn('posts','description')) {
                Schema::table('posts', function (Blueprint $table) {
                    $table->dropColumn('description');
                });
            }
        }
    }
}
