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
        $primary_model = Phone::with('compatibilities')->find($model_id);
        $models = Phone::orderBy('id', 'desc')->get()->groupBy("brand_id");
        $brands = Brand::all();
        return view('compatibility.create', compact('brand_name', 'primary_model', 'brands', 'models'));
    }

    public function store($brand_name, $primary_model, Request $request)
    {
        $request->merge(['primary_model' => $primary_model]);
        $request->validate([
            'brand' => 'integer|required|exists:brands,id',
            'model' => 'integer|required|exists:phones,id',
            'primary_model' => 'integer|exists:phones,id|required'
        ]);

        $phone = Phone::find($primary_model);
        $phone_to_link = Phone::find($request->model);

        $phone->addCompatibility($phone_to_link);
        return redirect(route('model', [$brand_name, $primary_model]));
    }
}
