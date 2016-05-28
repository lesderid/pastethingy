<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('pastes', function (Blueprint $table) {
			$table->char('id', 6);
			$table->string('language');
			$table->timestamp('created_at');
			$table->timestamp('expires_at')->nullable();

			$table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pastes');
    }
}
