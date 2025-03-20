<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('image_thumbnail')->after('image')->nullable();
        });

        // Sao chép dữ liệu từ 'image' sang 'image_thumbnail'
        DB::statement('UPDATE rooms SET image_thumbnail = image');

        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }

    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('image')->after('image_thumbnail')->nullable();
        });

        // Sao chép dữ liệu từ 'image_thumbnail' sang 'image'
        DB::statement('UPDATE rooms SET image = image_thumbnail');

        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('image_thumbnail');
        });
    }
};
