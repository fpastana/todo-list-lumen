<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_notes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->biginteger('user_id');
            $table->string('content');
            $table->timestamp('completion_time')->nullable();
            $table->softDeletesTz($column = 'deleted_at', $precision = 0);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todo_notes');
    }
}
