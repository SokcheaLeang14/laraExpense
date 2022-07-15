<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();

            $table->string('name', 220);

            $table->unsignedBigInteger('category_id')->nullable();

            $table->decimal('amount', 15, 2)->nullable();

            $table->longText('description')->nullable();

            $table->unsignedBigInteger('wallet_id')->nullable();

            $table->date('income_date');

            $table->timestamps();

            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('income_categories');

            $table->foreign('wallet_id')->references('id')->on('wallets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incomes');
    }
}
