<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ストレッチタスクの定義は config/stretchtasks.php を参照。
     * ユーザーごとの完了状態が必要になった場合は users テーブルへ JSON カラムを追加する。
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('completed_stretch_task_ids')->nullable()->after('countdown_minutes');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('completed_stretch_task_ids');
        });
    }
};
