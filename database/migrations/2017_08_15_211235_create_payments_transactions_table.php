<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePaymentsTransactionsTable
 */
class CreatePaymentsTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('driver');
            $table->string('client');
            $table->unsignedTinyInteger('status');
            $table->unsignedTinyInteger('type');
            $table->unsignedInteger('card_id')->nullable()->index('payments_transactions_card_id_foreign');
            $table->unsignedInteger('parent_id')->nullable()->index('payments_transactions_parent_id_foreign');
            $table->string("order_type");
            $table->unsignedInteger("order_id");
            $table->index(["order_id", "order_type"]);
            $table->decimal('amount', 16, 8);
            $table->string('invoice')->nullable();
            $table->timestamp('processed_at')->nullable();
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
        Schema::dropIfExists('payments_transactions');
    }
}
