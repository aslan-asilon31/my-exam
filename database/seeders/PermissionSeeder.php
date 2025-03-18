<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // reset cahced roles and permission
                app()[PermissionRegistrar::class]->forgetCachedPermissions();

                // create permissions
                Permission::create(['name' => 'view posts']);
                Permission::create(['name' => 'create posts']);
                Permission::create(['name' => 'edit posts']);
                Permission::create(['name' => 'delete posts']);
                Permission::create(['name' => 'publish posts']);
                Permission::create(['name' => 'unpublish posts']);

                //create roles and assign existing permissions
                $visitorRole = Role::create(['name' => 'visitor']);
                $visitorRole->givePermissionTo('view posts');
                $visitorRole->givePermissionTo('create posts');
                $visitorRole->givePermissionTo('edit posts');
                $visitorRole->givePermissionTo('delete posts');
        
                $salesRole = Role::create(['name' => 'sales']);
                $salesRole->givePermissionTo('view posts');
                $salesRole->givePermissionTo('create posts');
                $salesRole->givePermissionTo('edit posts');
                $salesRole->givePermissionTo('delete posts');
                $salesRole->givePermissionTo('publish posts');
                $salesRole->givePermissionTo('unpublish posts');
        
                $developerRole = Role::create(['name' => 'developer']);
                // gets all permissions via Gate::before rule
        
                // create demo users
                $user = User::factory()->create([
                    'name' => 'Example user',
                    'email' => 'writer@qadrlabs.com',
                    'password' => bcrypt('12345678')
                ]);
                $user->assignRole($visitorRole);
        
                $user = User::factory()->create([
                    'name' => 'Example admin user',
                    'email' => 'sales@qadrlabs.com',
                    'password' => bcrypt('12345678')
                ]);
                $user->assignRole($salesRole);
        
                $user = User::factory()->create([
                    'name' => 'Example developer user',
                    'email' => 'developer@qadrlabs.com',
                    'password' => bcrypt('12345678')
                ]);
                $user->assignRole($developerRole);
    }
}
