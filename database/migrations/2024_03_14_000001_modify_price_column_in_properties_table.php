<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPriceColumnInPropertiesTable extends Migration
{
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->float('price', 10, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->decimal('price', 10, 3)->change();
        });
    }
} 