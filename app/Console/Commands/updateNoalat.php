<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;
use App\Models\Alat;
use App\Models\Jenisalat;
use App\Models\Merk;
use App\Models\Tipe;

class updateNoalat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:noalat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update No Alat';

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
        // $alat = Alat::with('jenisalat', 'merk', 'tipe', 'customer')->get();
        $customer = Customer::with('alat.jenisalat','alat.merk','alat.tipe')->get();
        foreach ($customer as $c) {
            $numb=1;
            foreach ($c->alat as $a ) {                
                $jenis= Jenisalat::find($a->jenisalat_id);
                $merk= Merk::find($a->merk_id);
                $tipe= Tipe::find($a->tipe_id);
                $ukuran= $a->ukuran;
                $counter= $numb;
                $noalat = $jenis->slugjenis . '-' . $merk->slugmerk . '-' . $tipe->slugtipe . '-' . $ukuran . '-' . $counter;
                
                $a->no_alat = $noalat;
                $a->save();

                if ($a) {
                 $this->info('Sukses Update No Alat');
                }
                else{
                    $this->error('Gagal Update No Alat');
                }

                $numb++;
            }
        }
        
    }
}
