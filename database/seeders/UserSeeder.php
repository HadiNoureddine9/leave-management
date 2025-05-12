<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Check if the admin already exists, if not create it
        if (!User::where('email', 'admin@example.com')->exists()) {
            $admin = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);
            $admin->assignRole('admin');
        }

        // Check if the employee already exists, if not create it
        if (!User::where('email', 'employee@example.com')->exists()) {
            $employee = User::create([
                'name' => 'Employee User',
                'email' => 'employee@example.com',
                'password' => bcrypt('password'),
            ]);
            $employee->assignRole('employee');
        }
    }
}
