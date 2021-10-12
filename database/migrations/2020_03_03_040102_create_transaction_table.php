<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('stakeholder_id')->nullable();
            $table->boolean('is_purchased')->default(0);
            $table->integer('type')->default(0);
            $table->string('creditcard_number')->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('invoice_number')->unique();
            $table->integer('total_items')->default(0);
            $table->double('subtotal', 19, 2)->default(0);
            $table->decimal('tax')->default(0);
            $table->decimal('discount')->default(0);
            $table->double('grandtotal', 19, 2)->default(0);
            $table->double('cash', 19, 2)->default(0);
            $table->double('change', 19, 2)->default(0);
            $table->text('notes')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index("bank_id");
            $table->index("user_id");
            $table->index("customer_id");
            $table->index("supplier_id");
            $table->index("stakeholder_id");
            $table->engine = 'InnoDB';
        });

        Schema::create('transactions_details', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('product_id');
            $table->double('price', 19, 2)->default(0);
            $table->integer('qty')->default(0);
            $table->double('total', 19, 2)->default(0);
            $table->timestamps();
            $table->index("transaction_id");
            $table->index("product_id");
            $table->primary(['transaction_id','product_id']);
            $table->engine = 'InnoDB';
        });

       

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('transactions_details');
    }
}
