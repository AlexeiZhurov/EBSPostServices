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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->char('title',255);
            $table->char('preview',255)->nullable($value = true);
            $table->longText('tags')->nullable($value = true);
            $table->longText('text');
            $table->integer('user_id');
            $table->softDeletesTz($column = 'deleted_at', $precision = 0);
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
