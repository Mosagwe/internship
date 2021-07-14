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
            $table->string('gender');
            $table->string('period');
            $table->string('paycode');
            $table->integer('status');
            $table->integer('station_id');
            $table->foreignId('employee_type_id');
            $table->foreignId('category_id');
            $table->integer('bank_id');
            $table->string('bank_branch')->default(null);
            $table->string('bank_code')->default(null);
            $table->string('bank_account')->default(null);
            $table->string('idno');
            $table->string('krapin')->nullable();
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
