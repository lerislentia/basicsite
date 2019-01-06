<?php

use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {/**
         * admin user
         */
        $admin = User::create(array(
            User::FIRSTNAME     => 'administrador',
            User::LASTNAME      => 'admin@santillana.com',
            User::PASS          => bcrypt('admin'),
            User::EMAIL         => 'admin@genco.com',
            User::RMTOKEN       => null,
            User::CREATED_AT    => now(),
            User::UPDATED_AT    => null
        ));

        /**
         * roles
         */
        $adminrole = Role::create(array(
            Role::NAME          => 'Administrator',
        ));

        /** user_roles */

        $adminrole = UserRole::create(array(
            UserRole::USER      => $admin->id,
            UserRole::ROLE      => $adminrole->id,
        ));

    }
}
