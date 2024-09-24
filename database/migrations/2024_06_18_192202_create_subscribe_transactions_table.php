<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribeTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('subscribe_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('total_amount');
            $table->boolean('is_paid')->default(false); // Consider default value
            $table->date('subscription_start_date')->nullable();
            $table->string('proof');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscribe_transactions');
    }
}
