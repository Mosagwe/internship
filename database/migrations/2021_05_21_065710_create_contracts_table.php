<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->string('employee_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('comments')->nullable();
            $table->foreignId('station_id')->nullable();
            $table->foreignId('unit_id')->nullable();
            $table->string('salary')->nullable()->default(0);
            $table->foreignId('bank_id')->nullable()->constrained();
            $table->string('bank_branch')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('bank_account')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('contracts');
    }
}
