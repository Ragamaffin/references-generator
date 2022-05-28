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
        Schema::create('reference_resource', function (Blueprint $table) {
            $table->foreignId('reference_id')->references('reference_id')->on('references')->onDelete('cascade');
            $table->foreignId('resource_id')->references('resource_id')->on('resources')->onDelete('cascade');
            $table->integer('order_number')->nullable();
            $table->string('pages')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reference_resource', function (Blueprint $table) {
            $table->dropForeign('reference_resource_reference_id_foreign');
            $table->dropForeign('reference_resource_resource_id_foreign');
        });
        Schema::dropIfExists('reference_resource');
    }
};
