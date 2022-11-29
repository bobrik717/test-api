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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->integer('period');
            $table->integer('pages_count');
            $table->smallInteger('idealist');
            $table->string('idealist_url')->nullable();
            $table->smallInteger('olx');
            $table->string('olx_url')->nullable();
            $table->smallInteger('fb');
            $table->string('fb_url')->nullable();
            $table->string('telegram_settings');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
