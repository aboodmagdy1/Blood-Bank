<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Governorate;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     
     $g1=Governorate::create(['name'=>'Dakahliya']);
     $g2=Governorate::create(['name'=>'Cairo']);
     $g3=Governorate::create(['name'=>'Tanta']);
     $g4=Governorate::create(['name'=>'Alexandria']);
       

    //  g1
        City::create([
            'name' => 'Mansoura',
            'governorate_id'=>$g1->id
        ]);
        City::create([
            'name' => 'Talkha',
            'governorate_id'=>$g1->id
        ]);
        City::create([
            'name' => 'Mitt Ghamr',
            'governorate_id'=>$g1->id
        ]);
        City::create([
            'name' => 'Aga',
            'governorate_id'=>$g1->id
        ]);




        // g2
        City::create([
            'name' => 'Helwan',
            'governorate_id'=>$g2->id
        ]);
        City::create([
            'name' => 'Shubra El Kheima',
            'governorate_id'=>$g2->id
        ]);
        City::create([
            'name' => 'El Salam City',
            'governorate_id'=>$g2->id
        ]);
        City::create([
            'name' => 'El Marg',
            'governorate_id'=>$g2->id
        ]);

        // g3
        City::create([
            'name' => 'Tanta',
            'governorate_id'=>$g3->id
        ]);
        City::create([
            'name' => 'Kafr El-Zayat',
            'governorate_id'=>$g3->id
        ]);
        City::create([
            'name' => 'El-Mahalla El-Kubra',
            'governorate_id'=>$g3->id
        ]);
        City::create([
            'name' => 'Zefta',
            'governorate_id'=>$g3->id
        ]);

        // g4
        City::create([
            'name' => 'Alexandria',
            'governorate_id'=>$g4->id
        ]);
        City::create([
            'name' => 'Borg El Arab',
            'governorate_id'=>$g4->id
        ]);
        City::create([
            'name' => 'Abu Qir',
            'governorate_id'=>$g4->id
        ]);
        City::create([
            'name' => 'Dekhela',
            'governorate_id'=>$g4->id
        ]);



    }
}
