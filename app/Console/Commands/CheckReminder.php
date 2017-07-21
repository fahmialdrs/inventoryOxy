<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CheckReminderTabung;
use App\Models\Tube;
use App\Models\Alat;
class CheckReminder extends Command
{

    use CheckReminderTabung;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Reminder Tabung & Alat';

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
        $this->table = new Tube;
        $this->checkTabung();

        $this->checkTabungVisual();

        $table = Alat::with('jenisalat', 'customer')
        ->whereHas('jenisalat', function($q) {
           // Query the name field in status table
           $q->where('reminder', '=', 1); // '=' is optional
        })->get();

        $this->checkAlat($table);  
    }
}
