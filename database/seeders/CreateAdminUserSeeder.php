<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed --class=CreateAdminUserSeeder
        // $user = User::create([
        //     'name' => 'Admin', 
        //     'email' => 'admin@gmail.com',
        //     'username' => 'Admin',
        //     'password' => Hash::make('admin1122')
        // ]);

        $userObj = new User();
        $user = $userObj->find(1);
    
        $role = Role::create(['name' => 'Admin']);


        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);


        // $userObj = new User();
        // $user = $userObj->find(1);
        // $role = Role::create(['name' => 'Admin']);
        // $permissions = Permission::pluck('id','id')->all();
        // $role->syncPermissions($permissions);    
        // $user->assignRole([$role->id]);

    }
}