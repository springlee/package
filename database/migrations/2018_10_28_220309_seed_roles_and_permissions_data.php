<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeedRolesAndPermissionsData extends Migration
{
    public function up()
    {
        // 清除缓存
        app()['cache']->forget('spatie.permission.cache');

        // 先创建权限
        Permission::create(['name' => 'package_info_input']);
        Permission::create(['name' => 'package_receive']);
        Permission::create(['name' => 'report']);
        Permission::create(['name' => 'finance']);

        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo('package_info_input');
        $admin->givePermissionTo('package_receive');
        $admin->givePermissionTo('report');
        $admin->givePermissionTo('finance');


        $merchandiser = Role::create(['name' => 'Merchandiser']);
        $merchandiser->givePermissionTo('package_info_input');


        $warehouseman = Role::create(['name' => 'Warehouseman']);
        $warehouseman->givePermissionTo('package_receive');


        $financial_staff = Role::create(['name' => 'Financial staff']);
        $financial_staff->givePermissionTo('finance');


        $supplier = Role::create(['name' => 'Supplier']);
        $supplier->givePermissionTo('package_info_input');

        $package_mange = Role::create(['name' => 'Package Manger']);
        $package_mange->givePermissionTo('package_info_input');
        $package_mange->givePermissionTo('package_receive');
        $package_mange->givePermissionTo('report');








    }


    public function down()
    {
        // 清除缓存
        app()['cache']->forget('spatie.permission.cache');

        // 清空所有数据表数据
        $tableNames = config('permission.table_names');

        Model::unguard();
        DB::table($tableNames['role_has_permissions'])->delete();
        DB::table($tableNames['model_has_roles'])->delete();
        DB::table($tableNames['model_has_permissions'])->delete();
        DB::table($tableNames['roles'])->delete();
        DB::table($tableNames['permissions'])->delete();
        Model::reguard();
    }
}
