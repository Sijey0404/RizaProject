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
    DB::statement("ALTER TABLE user_accounts MODIFY COLUMN status ENUM('active', 'inactive', 'suspended') NOT NULL");
}

public function down()
{
    DB::statement("ALTER TABLE user_accounts MODIFY COLUMN status ENUM('active', 'inactive', 'suspended') NOT NULL");
}

};
