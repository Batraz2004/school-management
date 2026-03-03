<?php

namespace Database\Seeders;

use App\Enums\PermissionsEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        
        $this->clearRolesAndPermissions();
        
        $this->createRoles();
        
        $this->createAdminPermissions();
    }

    private function clearRolesAndPermissions()
    {
        //удалим старые права и роли :
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // DB::statement('SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        //проверка на то что была ли отклюаена проверка внешиних ключей
        // DB::statement('SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;');
    }

    private function createRoles()
    {
        $adminRole = App(Role::class)->findOrCreate(RoleEnum::admin->value, 'web');
        $supplierRole = App(Role::class)->findOrCreate(RoleEnum::teacher->value, 'web');
        $userRole = App(Role::class)->findOrCreate(RoleEnum::student->value, 'web');
    }

    private function createAdminPermissions()
    {
        $adminRole = Role::query()->firstWhere(['name' => RoleEnum::admin->value]);
        $permissions = PermissionsEnum::cases() ?? [];

        foreach($permissions as $permissionName){
            $permision = app(Permission::class)->findOrCreate($permissionName->value, 'web');
            $adminRole->givePermissionTo($permision);
        }
    }
}
