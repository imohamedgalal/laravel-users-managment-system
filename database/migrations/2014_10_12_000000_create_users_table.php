<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile', 30)->nullable();
            $table->json('product')->nullable();
            $table->string('status', 10)->nullable();
            $table->dateTime('active_for')->nullable();
            $table->string('agent', 200)->nullable();
            $table->string('reseller', 200)->nullable();
            $table->json('pay_method', 200)->nullable();
            $table->string('amount', 10)->nullable();
            $table->text('notes')->nullable();
            $table->string('userSession')->nullable();
            $table->json('roles_name')->nullable();
            $table->string('eaemail', 100 )->nullable();
            $table->string('eapassword',50)->nullable();
            $table->string('eacode1', 20)->nullable();
            $table->string('eacode2', 20)->nullable();
            $table->string('eacode3', 20)->nullable();
            $table->string('cash_number', 30)->nullable();
            $table->string('paypal_email', 100)->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
