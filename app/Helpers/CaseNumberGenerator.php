<?php

namespace App\Helpers;

use App\Models\Task;

class CaseNumberGenerator
{
    public static function generate()
    {
        $prefix = 'TASK';
        $year = date('Y');
        $month = date('m');
        
        // Get count of tasks for current month
        $count = Task::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->count();
        
        // Increment count
        $count++;
        
        // Generate number with padding (e.g., 001, 002, etc)
        $number = str_pad($count, 3, '0', STR_PAD_LEFT);
        
        // Final format: TASK-YYYYMM-001
        return "{$prefix}-{$year}{$month}-{$number}";
    }
} 