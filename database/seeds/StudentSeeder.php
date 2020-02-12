<?php

use Illuminate\Database\Seeder;
use App\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Student::create(
        	[
        		'nama' => 'Gina',
        		'jk'   => 'P'
        	]);

        Student::create(
        	[
        		'nama' => 'Fahmi',
        		'jk'   => 'L'
        	]);

        for ($i=0; $i < 20; $i++){
            $jk = 'P';
            if ($i > 10){
                $jk = 'L';
            }
            Student::create([
                'nama' => 'Gina-' . $i,
                'jk'   => $jk
            ]);
        }

    }
}
