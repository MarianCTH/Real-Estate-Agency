<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('property_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Example: "vanzare", "inchiriere"
            $table->timestamps();
        });

        // Add status_id column in properties table
        Schema::table('properties', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable()->after('featured');
            $table->foreign('status_id')->references('id')->on('property_statuses')->onDelete('SET NULL');
        });
    }

    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });

        Schema::dropIfExists('property_statuses');
    }
};
