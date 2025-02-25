<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Backup data yang ada
        $tasks = DB::table('tasks')->get();
        
        // Drop kolom status yang lama
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Buat kolom status baru dengan enum yang diupdate
        Schema::table('tasks', function (Blueprint $table) {
            $table->enum('status', ['pending', 'in_progress', 'completed', 'overdue'])->default('pending');
        });

        // Restore data yang di-backup
        foreach ($tasks as $task) {
            DB::table('tasks')
                ->where('id', $task->id)
                ->update(['status' => $task->status]);
        }
    }

    public function down(): void
    {
        // Backup data yang ada
        $tasks = DB::table('tasks')->get();
        
        // Drop kolom status yang baru
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Kembalikan ke kolom status yang lama
        Schema::table('tasks', function (Blueprint $table) {
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
        });

        // Restore data yang di-backup (ubah 'overdue' menjadi 'pending')
        foreach ($tasks as $task) {
            DB::table('tasks')
                ->where('id', $task->id)
                ->update([
                    'status' => $task->status === 'overdue' ? 'pending' : $task->status
                ]);
        }
    }
}; 