<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminToggleToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_admin')->default(0);
            });
        }
        if(!Schema::hasColumn('accounts', 'admin_panel')) {
            Schema::table('accounts', function (Blueprint $table) {
                $table->boolean('admin_panel')->default(0)->after('legacy_free_plan_unlimited_contacts');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('is_admin');
            });
        }
        if(Schema::hasColumn('accounts', 'admin_panel')) {
            Schema::table('accounts', function (Blueprint $table) {
                $table->dropColumn('admin_panel');
            });
        }
    }
}
