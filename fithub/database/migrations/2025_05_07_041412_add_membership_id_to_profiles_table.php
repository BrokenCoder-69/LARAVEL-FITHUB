<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('profiles', function (Blueprint $table) {
        $table->unsignedBigInteger('membership_id')->nullable()->after('user_id');
        $table->foreign('membership_id')->references('id')->on('memberships')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('profiles', function (Blueprint $table) {
        $table->dropForeign(['membership_id']);
        $table->dropColumn('membership_id');
    });
}

};
