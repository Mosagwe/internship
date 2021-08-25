<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('fullname');
            $table->string('gender')->nullable()->default(null);
            $table->date('period');
            $table->integer('daysworked')->nullable();
            $table->integer('monthcode')->nullable();
            $table->string('paycode')->default(null);
            $table->integer('status')->default(0);
            $table->integer('approved_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('station_id')->default(null);
            $table->foreignId('employee_type_id')->default(null);
            $table->foreignId('category_id')->default(null);
            $table->integer('bank_id')->nullable()->default(null);
            $table->string('bank_branch')->nullable()->default(null);
            $table->string('bank_code')->nullable()->default(null);
            $table->string('bank_account')->nullable()->default(null);
            $table->string('idno')->nullable()->default(null);
            $table->string('krapin')->nullable();
            $table->double('entitledsalary');
            $table->double('grossincome');
            $table->double('taxableincome');
            $table->double('grosstax');
            $table->double('personal_relief');
            $table->double('paye');
            $table->double('net_income');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payrolls');
    }
}
