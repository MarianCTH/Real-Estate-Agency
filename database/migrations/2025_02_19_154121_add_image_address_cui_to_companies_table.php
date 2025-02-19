<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageAddressCuiToCompaniesTable extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('image')->nullable()->after('name'); // Add image column
            $table->string('address')->nullable()->after('image'); // Add address column
            $table->string('cui')->nullable()->after('address'); // Add cui column
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['image', 'address', 'cui']); // Drop the columns if rollback is needed
        });
    }
}
