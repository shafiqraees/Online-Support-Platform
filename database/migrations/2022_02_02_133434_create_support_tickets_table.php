<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SupportTicket;

class CreateSupportTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->comment('user_id of customer');
            $table->unsignedBigInteger('user_id')->nullable()->comment('Support agent Id');
            $table->string('ticket_number')->unique();
            $table->text('problem_description');
            $table->enum('status', [SupportTicket::STATUS_PENDING, SupportTicket::STATUS_PROCESSING, SupportTicket::STATUS_COMPLETED, SupportTicket::STATUS_CANCELLED])->default(SupportTicket::STATUS_PENDING);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support_tickets');
    }
}
