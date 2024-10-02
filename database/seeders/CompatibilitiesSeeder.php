<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Phone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\type;

class CompatibilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $compatibilities = config('cellphones.compatibilities');

        foreach ($compatibilities as $compatibility) {

            // cerco il brand e il modello del primo modello segnato come compatibile
            $brand_1 = Brand::where('name', $compatibility["model_1"]["brand"])->first();
            $model_1 = Phone::where('name', $compatibility["model_1"]["model"])->where('brand_id', $brand_1->id)->first();

            // cerco il brand e il modello del secondo modello segnato come compatibile
            $brand_2 = Brand::where('name', $compatibility["model_2"]["brand"])->first();
            $model_2 = Phone::where('name', $compatibility["model_2"]["model"])->where('brand_id', $brand_2->id)->first();

            if ($brand_1 != null && $model_1 != null && $brand_2 != null && $model_2 != null) {
                $model_1->addCompatibility($model_2);
            } else {
                echo ("errore dato non valido\n");
            }
        }
    }
}
