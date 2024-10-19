<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeIdToPropertiesTable extends Migration
{
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable()->after('status'); // Add after 'status' column or any appropriate position

            // Add foreign key constraint
            $table->foreign('type_id')->references('id')->on('property_types')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            // Drop foreign key constraint and column
            $table->dropForeign(['type_id']);
            $table->dropColumn('type_id');
        });
    }
}
