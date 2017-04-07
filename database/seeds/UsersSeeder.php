<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create management
        $managementRole = new Role();
        $managementRole->name = 'management';
        $managementRole->display_name = 'Management';
        $managementRole->save();

        //create role admin

        $adminRole = new Role();
        $adminRole->name = 'admin';
        $adminRole->display_name = 'Admin';
        $adminRole->save();

        //create role pic
        $picRole = new Role();
        $picRole->name = 'pic';
        $picRole->display_name = 'Person In Charge';
        $picRole->save();

        //create sample management
        $management = new User();
        $management->name = 'Fahmi Management';
        $management->email = 'm@m.com';
        $management->password= bcrypt('123456');
        $management->save();
        $management->attachRole($managementRole);

        //create sample admin
        $admin = new User();
        $admin->name = 'Fahmi Admin';
        $admin->email = 'f@f.com';
        $admin->password= bcrypt('123456');
        $admin->save();
        $admin->attachRole($adminRole);

        $pic = new User();
        $pic->name = 'Fahmi PIC';
        $pic->email = 'p@p.com';
        $pic->password= bcrypt('123456');
        $pic->save();
        $pic->attachRole($picRole);
    }
}
