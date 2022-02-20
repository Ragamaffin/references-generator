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
        Schema::create('resource_tag', function (Blueprint $table) {
            $table->foreignId('resource_id')->references('resource_id')->on('resources')->onDelete('cascade');
            $table->foreignId('tag_id')->references('tag_id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resource_tag', function (Blueprint $table) {
            $table->dropForeign('resource_tag_resource_id_foreign');
            $table->dropForeign('resource_tag_tag_id_foreign');
        });
        Schema::dropIfExists('resource_tag');
    }
};
