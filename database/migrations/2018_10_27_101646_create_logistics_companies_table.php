<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogisticsCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistics_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logistics_company_name');
            $table->string('logistics_company_code');
            $table->unsignedInteger('enterprise_company_id');
            $table->unsignedInteger('create_user_id');
            $table->string('status');

            $table->index('status');
            $table->unique(['enterprise_company_id','logistics_company_name'],'enterprise_logistics');
            $table->foreign('enterprise_company_id')->references('id')->on('enterprise_companies')->onDelete('cascade');
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
        Schema::dropIfExists('logistics_companies');
    }
}
