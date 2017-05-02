<?php

use Illuminate\Database\Seeder;

class SeederTableHari extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $hari = array('Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu');
        for ($i=0; $i < count($hari) ; $i++) { 
            DB::table('hari')->insert([
            'nama' => $hari[$i]
            ]);
        }
    }
}
