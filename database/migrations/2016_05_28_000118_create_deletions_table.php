<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeletionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deletions', function (Blueprint $table) {
			$table->increments('id');
			$table->char('paste_id', 6)->unique();
			$table->text('reason');
			$table->string('deleted_by');
			$table->timestamp('deleted_at');

			$table->foreign('paste_id')->references('id')->on('pastes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('deletions');
    }
}
