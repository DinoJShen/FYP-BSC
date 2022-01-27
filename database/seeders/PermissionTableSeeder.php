<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'group-list',
           'group-create',
           'group-edit',
           'group-delete',
           'assignment-list',
           'assignment-create',
           'assignment-edit',
           'assignment-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}