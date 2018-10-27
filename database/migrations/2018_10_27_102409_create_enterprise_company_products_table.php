<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterpriseCompanyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise_company_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('enterprise_company_id');
            $table->unsignedInteger('product_id');
            $table->date('expiry_date');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('enterprise_company_id')->references('id')->on('enterprise_companies')->onDelete('cascade');
            $table->index('product_id');
            $table->index('enterprise_company_id');
            $table->unique(['enterprise_company_id','product_id'],'enterprise_product');
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
        Schema::dropIfExists('enterprise_company_products');
    }
}
