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
        Schema::create('resources', function (Blueprint $table) {
            $table->id('resource_id');
            $table->string('resource_name');
            $table->string('resource_type', 20);
            $table->longText('description')->nullable();
            $table->smallInteger('year')->nullable();
            $table->longText('resource_url')->nullable();
            $table->string('file_path')->nullable();
            $table->foreignId('created_by')->nullable()->references('user_id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->dropForeign('resources_created_by_foreign');
        });
        Schema::dropIfExists('resources');
    }
};
