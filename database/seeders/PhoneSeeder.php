<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Phone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = Brand::all();

        foreach ($brands as $brand) {
            $phones = config('cellphones.' . $brand->name);
            if ($phones == null) {
                echo ("Non sono stati trovati dati per i callulari " . $brand->name . "\n");
            } else {
                foreach ($phones as $phone) {
                    Phone::create(['brand_id' => $brand->id, 'name' => $phone]);
                }
            }
        }
    }
}
