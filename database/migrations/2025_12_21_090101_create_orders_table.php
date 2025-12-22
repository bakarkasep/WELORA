<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary Key Utama
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_number');
            $table->string('customer_name');
            $table->text('address');
            $table->string('courier');
            $table->string('payment_method');
            
            // Perbaikan: Pakai decimal, JANGAN id()
            $table->decimal('total_price', 15, 2); 
            
            // Perbaikan: Menambahkan kolom status
            $table->string('status')->default('Paid'); 

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};