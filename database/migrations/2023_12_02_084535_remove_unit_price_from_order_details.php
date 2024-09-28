<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Trong file migration
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn('unit_price');
        });
    }

    public function down()
    {
        // Nếu bạn muốn rollback, bạn có thể thêm cột lại ở đây
    }
};
