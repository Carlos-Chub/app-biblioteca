<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('book_readers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reader_id');
            $table->foreign('reader_id')->references('id')->on('readers');
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books');
            $table->string('status');
            $table->boolean('sms')->default(false);
            $table->boolean('whatsapp')->default(false);
            $table->boolean('email')->default(false);
            $table->date('return_date');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_readers', function (Blueprint $table) {
            $table->dropForeign(['reader_id']);
            $table->dropForeign(['book_id']);
        });
        Schema::dropIfExists('book_readers');
    }
};
