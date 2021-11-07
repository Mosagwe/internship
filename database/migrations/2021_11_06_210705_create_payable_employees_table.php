<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayableEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payable_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('othername')->nullable();
            $table->string('gender')->nullable()->default(null);
            $table->date('period');
            $table->integer('daysworked')->nullable();
            $table->integer('monthcode')->nullable();
            $table->integer('payable')->nullable();
            $table->integer('station_id');
            $table->integer('department_id')->nullable();
            $table->foreignId('employee_type_id')->default(null);
            $table->foreignId('category_id')->default(null);
            $table->string('idno')->nullable()->default(null);
            $table->string('krapin')->nullable();
            $table->double('entitledsalary')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('payable_employees');
    }
}
