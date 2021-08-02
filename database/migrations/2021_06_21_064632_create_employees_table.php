<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('phonenumber')->unique()->nullable();
            $table->foreignId('employee_type_id')->constrained();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('bank_id')->nullable()->constrained();
            $table->string('bank_branch')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('bank_account')->nullable();
            $table->foreignId('qualification_id')->nullable();
            $table->string('coursename')->nullable();
            $table->string('idno')->unique();
            $table->string('krapin')->unique()->nullable();
            $table->string('email')->unique();
            $table->date('date_hired')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('next_of_kin')->nullable();
            $table->string('next_of_kin_phone')->nullable();
            $table->string('next_of_kin_relation')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('pwd')->nullable();
            $table->string('pwd_no')->nullable();
            $table->string('pwd_category')->nullable();
            $table->string('ref1_name')->nullable();
            $table->string('ref1_email')->nullable();
            $table->string('ref1_phone')->nullable();
            $table->string('ref1_occupation')->nullable();
            $table->string('ref1_period')->nullable();
            $table->string('ref2_name')->nullable();
            $table->string('ref2_email')->nullable();
            $table->string('ref2_phone')->nullable();
            $table->string('ref2_occupation')->nullable();
            $table->string('ref2_period')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
