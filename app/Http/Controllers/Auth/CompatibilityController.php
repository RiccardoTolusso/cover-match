<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Phone;
use Illuminate\Http\Request;

class CompatibilityController extends Controller
{
    public function create($brand_name, $model_id)
    {
        $primary_model = Phone::find($model_id);
        $models = Phone::all()->groupBy("brand_id");
        $brands = Brand::all();
        return view('compatibility.create', compact('brand_name', 'primary_model', 'brands', 'models'));
    }

    public function store()
    {

        return redirect();
    }
}
