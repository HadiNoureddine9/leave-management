<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LeaveRequest;
use App\Models\User;

class LeaveRequestSeeder extends Seeder
{
    public function run()
    {
        // Get the employee user
        $employee = User::where('email', 'employee@example.com')->first();

        // Create some leave requests for the employee
        LeaveRequest::create([
            'user_id' => $employee->id,
            'start_date' => '2025-06-01',
            'end_date' => '2025-06-05',
            'reason' => 'Vacation',
            'status' => 'Pending',
        ]);

        LeaveRequest::create([
            'user_id' => $employee->id,
            'start_date' => '2025-07-10',
            'end_date' => '2025-07-12',
            'reason' => 'Personal',
            'status' => 'Pending',
        ]);
    }
}
