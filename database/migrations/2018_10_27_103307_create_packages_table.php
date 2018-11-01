<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logistics_tracking_number');
            $table->unsignedInteger('logistics_company_id');
            $table->unsignedInteger('enterprise_company_id');
            $table->unsignedInteger('package_quantity');
            $table->unsignedInteger('receive_quantity');
            $table->string('type');
            $table->string('status');
            $table->unsignedInteger('create_user_id');
            $table->unsignedInteger('receive_user_id');
            $table->timestamp('received_at');
            $table->string('mark_sure');
            $table->text('remark');
            $table->foreign('logistics_company_id')->references('id')->on('logistics_companies')->onDelete('cascade');
            $table->foreign('enterprise_company_id')->references('id')->on('enterprise_companies')->onDelete('cascade');
            $table->unique(['logistics_tracking_number','enterprise_company_id'],'logistics_enterprise');
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
        Schema::dropIfExists('packages');
    }
}
