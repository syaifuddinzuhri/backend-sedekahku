<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaction')->nullable();
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('payment_account_id')->nullable();
            $table->float('nominal', 16, 0)->nullable()->default(0);
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('payments');
    }
}
