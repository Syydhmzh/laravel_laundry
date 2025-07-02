<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeOfServices;

class TypeOfServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // insert
        TypeOfServices::insert([
            [
                'service_name' => 'Hanya cuci',
                'price' => 5000,
                'description' => 'Service hanya cuci reguler'
            ],
            [
                'service_name' => 'Hanya gosok',
                'price' => 4000,
                'description' => 'Service hanya gosok reguler'
            ],
            [
                'service_name' => 'Cuci & Gosok',
                'price' => 8000,
                'description' => 'Service cuci dan gosok reguler'
            ],
            [
                'service_name' => 'Cuci Besar',
                'price' => 8000,
                'description' => 'Service cuci kain tebal seperti karpet dan selimut'
            ],
            [
                'service_name' => 'Cuci & Gosok Express',
                'price' => 12000,
                'description' => 'Service cuci dan gosok cepat, dapat diambil setelah 4 jam'
            ]
        ]);
    }
}
