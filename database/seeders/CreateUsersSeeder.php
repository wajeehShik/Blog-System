<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'wajeeh',
            'email' => 'snuora2019@gmail.com',
            'password' => bcrypt('123123123'),
            'role' => ["admin"],
            'status' => '1',
            'mobile' => '0597880649',
            'online' => '1',
        ]);
        $role = Role::create(['name' => 'admin', 'guard_name' => 'admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $admin->assignRole([$role->id]);
    }
}
