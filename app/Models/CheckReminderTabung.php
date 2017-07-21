<?php 

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

trait CheckReminderTabung {

	public function checkTabung() {
        $table = $this->table;
        $tanggalSekarang = date('d-m-Y');
        $tabungs = $this->table->get();

        foreach ($tabungs as $tabung) {
            $tanggalCheck = $tabung->terakhir_hydrostatic->addYears(5)->format('d-m-Y');

            if ($tanggalCheck === $tanggalSekarang) {
                Mail::send('reminder.hydro', compact('tabung'), function ($m) use ($tabung) {
                    $m->to($tabung->customer->email, $tabung->customer->nama)->subject('Reminder NDT Dive');
                });
            }
        }
        Log::info('Berhasil dieksekusi hydro');
    }

    public function checkTabungVisual() {
        $table = $this->table;
        $tanggalSekarang = date('d-m-Y');
        $tabungs = $this->table->get();

        foreach ($tabungs as $tabung) {
            $tanggalCheck = $tabung->terakhir_visualstatic->addYears(1)->format('d-m-Y');

            if ($tanggalCheck === $tanggalSekarang) {
                Mail::send('reminder.visual', compact('tabung'), function ($m) use ($tabung) {
                    $m->to($tabung->customer->email, $tabung->customer->nama)->subject('Reminder NDT Dive');
                });
            }
        }
        Log::info('Berhasil dieksekusi visual');
    }

    public function checkAlat($table) {
        $tanggalSekarang = date('d-m-Y');
        $alats = $table;
        foreach ($alats as $alat) { 
            $tanggalCheck = $alat->terakhir_service->addYears(1)->format('d-m-Y');
            if ($tanggalCheck === $tanggalSekarang) { 
                // dd($alat->customer->nama);
                Mail::send('reminder.alat', compact('alat'), function ($m) use ($alat) {
                    $m->to($alat->customer->email, $alat->customer->nama)->subject('Reminder NDT Dive');
                });
            }
        }
        Log::info('Berhasil dieksekusi alat');
    }
}

