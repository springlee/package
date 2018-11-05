<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_sn');
            $table->unsignedInteger('enterprise_company_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('product_rule_id');
            $table->decimal('money',10,2);
            $table->string('status');
            $table->date('paid_at');
            $table->string('transaction_id');
            $table->string('remark');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('enterprise_company_id')->references('id')->on('enterprise_companies')->onDelete('cascade');
            $table->index('product_id');
            $table->index('enterprise_company_id');
            $table->index('status');
            $table->index('transaction_id');
            $table->unique('order_sn');
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
        Schema::dropIfExists('orders');
    }
}
