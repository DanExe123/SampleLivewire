<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('customer_purchases', function (Blueprint $table) {
            $table->decimal('total_price', 10, 2)->after('carts_id')->default(0);
        });
    }

    public function down()
    {
        Schema::table('customer_purchases', function (Blueprint $table) {
            $table->dropColumn('total_price');
        });
    }
};

