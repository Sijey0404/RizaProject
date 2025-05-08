<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_role_and_status_to_user_accounts.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleAndStatusToUserAccounts extends Migration
{
    public function up()
    {
        Schema::table('user_accounts', function (Blueprint $table) {
            // Add the 'role' column with default 'student'
            $table->enum('role', ['admin', 'student'])->default('student');

            // Add the 'status' column with default 'active'
            $table->enum('status', ['active', 'inactive'])->default('active');
        });
    }

    public function down()
    {
        Schema::table('user_accounts', function (Blueprint $table) {
            // Drop the 'role' and 'status' columns if we roll back
            $table->dropColumn('role');
            $table->dropColumn('status');
        });
    }
}
