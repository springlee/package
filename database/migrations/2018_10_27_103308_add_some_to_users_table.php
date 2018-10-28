<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('enterprise_company_id')->after('remember_token');
            $table->date('expiry_date')->after('enterprise_company_id');
            $table->string('user_type')->after('expiry_date');
            $table->string('status')->after('user_type');
            $table->index('enterprise_company_id');
            $table->index('status');
            $table->foreign('enterprise_company_id')->references('id')->on('enterprise_companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('enterprise_company_id');
            $table->dropColumn('expiry_date');
            $table->dropColumn('user_type');
            $table->dropColumn('status');
        });
    }
}
