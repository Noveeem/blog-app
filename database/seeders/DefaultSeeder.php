<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = ['create-blog', 'update-blog', 'delete-blog', 'view-blog', 'manage-user'];

        $defaultAccount = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@blog.app',
        ]);


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $defaultAccount->givePermissionTo($permission);

    }
}
