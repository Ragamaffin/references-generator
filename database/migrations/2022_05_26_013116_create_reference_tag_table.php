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
        Schema::create('reference_tag', function (Blueprint $table) {
            $table->foreignId('reference_id')->references('reference_id')->on('references')->onDelete('cascade');
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
        Schema::table('reference_tag', function (Blueprint $table) {
            $table->dropForeign('reference_tag_reference_id_foreign');
            $table->dropForeign('reference_tag_tag_id_foreign');
        });
        Schema::dropIfExists('reference_tag');
    }
};
