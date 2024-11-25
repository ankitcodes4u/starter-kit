<?php

namespace Database\Seeders;

use BezhanSalleh\FilamentShield\Support\Utils;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_attribute","view_any_attribute","create_attribute","update_attribute","restore_attribute","restore_any_attribute","replicate_attribute","reorder_attribute","delete_attribute","delete_any_attribute","force_delete_attribute","force_delete_any_attribute","view_brand","view_any_brand","create_brand","update_brand","restore_brand","restore_any_brand","replicate_brand","reorder_brand","delete_brand","delete_any_brand","force_delete_brand","force_delete_any_brand","view_category","view_any_category","create_category","update_category","restore_category","restore_any_category","replicate_category","reorder_category","delete_category","delete_any_category","force_delete_category","force_delete_any_category","view_order","view_any_order","create_order","update_order","restore_order","restore_any_order","replicate_order","reorder_order","delete_order","delete_any_order","force_delete_order","force_delete_any_order","view_page","view_any_page","create_page","update_page","restore_page","restore_any_page","replicate_page","reorder_page","delete_page","delete_any_page","force_delete_page","force_delete_any_page","view_product","view_any_product","create_product","update_product","restore_product","restore_any_product","replicate_product","reorder_product","delete_product","delete_any_product","force_delete_product","force_delete_any_product","view_rating::review","view_any_rating::review","create_rating::review","update_rating::review","restore_rating::review","restore_any_rating::review","replicate_rating::review","reorder_rating::review","delete_rating::review","delete_any_rating::review","force_delete_rating::review","force_delete_any_rating::review","view_request","view_any_request","create_request","update_request","restore_request","restore_any_request","replicate_request","reorder_request","delete_request","delete_any_request","force_delete_request","force_delete_any_request","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_shipping::rule","view_any_shipping::rule","create_shipping::rule","update_shipping::rule","restore_shipping::rule","restore_any_shipping::rule","replicate_shipping::rule","reorder_shipping::rule","delete_shipping::rule","delete_any_shipping::rule","force_delete_shipping::rule","force_delete_any_shipping::rule","view_tariff","view_any_tariff","create_tariff","update_tariff","restore_tariff","restore_any_tariff","replicate_tariff","reorder_tariff","delete_tariff","delete_any_tariff","force_delete_tariff","force_delete_any_tariff","view_unit","view_any_unit","create_unit","update_unit","restore_unit","restore_any_unit","replicate_unit","reorder_unit","delete_unit","delete_any_unit","force_delete_unit","force_delete_any_unit","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","view_valuation","view_any_valuation","create_valuation","update_valuation","restore_valuation","restore_any_valuation","replicate_valuation","reorder_valuation","delete_valuation","delete_any_valuation","force_delete_valuation","force_delete_any_valuation"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
