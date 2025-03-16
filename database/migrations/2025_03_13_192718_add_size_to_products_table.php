<?php
    /**
     * Run the migrations.
     */
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    return new class extends Migration {
        public function up()
        {
            Schema::table('products', function (Blueprint $table) {
                $table->string('size')->nullable()->after('category_id'); // Adjust position if needed
            });
        }
    
        public function down()
        {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('size');
            });
        }
    };
    
