<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Role;
use App\User;

class Initial extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inisialisasi User Admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //create admin
        $adminRole = new Role;
        $adminRole->name = 'admin';
        $adminRole->display_name = 'Admin';
        $adminRole->save();

        // create pic role
        $picRole = new Role();
        $picRole->name = 'pic';
        $picRole->display_name = 'PIC';
        $picRole->save();

        // create admin
        $admin = new User;
        $admin->name = 'Admin';
        $admin->email = 'a@a.com';
        $admin->password = bcrypt('123456');
        $admin->save();
        $admin->attachRole($adminRole);

        if ($admin) {
             $this->info('Sukses inisialisasi admin');
        }
        else{
            $this->error('Gagal inisialisasi admin');
        }
    }
}
