<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->string('code');
            $table->string('contact');
            $table->string('email');
            $table->string('phone');
            $table->string('cell_phone')->nullable();
            $table->string('contract_type');
            $table->string('position');
            $table->string('broad_field');
            $table->string('specific_field');
            $table->string('training_hours')->nullable();
            $table->string('experience_time')->nullable();
            $table->string('remuneration')->nullable();
            $table->string('working_day')->nullable();
            $table->string('number_jobs')->nullable();
            $table->date('start_date');
            $table->date('finish_date');
            $table->text('activities');
            $table->text('aditional_information')->nullable();
            $table->text('city');
            $table->text('province');
            $table->string('state')->default('ACTIVE');
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
        Schema::table('offers', function (Blueprint $table) {
            Schema::dropIfExists('offers');
        });
    }
}