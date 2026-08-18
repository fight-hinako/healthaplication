<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            // ユーザー作成日時からの目標設定
            $table->unsignedSmallInteger('total_goals')->nullable();
            $table->unsignedSmallInteger('daily_tasks')->nullable();
            $table->unsignedSmallInteger('completed_tasks')->default(0);
            $table->date('last_reset_date')->nullable();
            $table->string('reward')->nullable();
            $table->unsignedSmallInteger('countdown_minutes')->default(60);
            // ストレッチタスクの定義は config/stretchtasks.php を参照
            $table->json('completed_stretch_task_ids')->nullable();
            $table->timestamps();
            $table->json('daily_chart_data')->nullable();

        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
