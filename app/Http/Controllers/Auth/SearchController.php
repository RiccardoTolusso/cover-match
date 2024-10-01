<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Phone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view("search", compact('brands'));
    }

    public function show($brand_name)
    {
        $brand = Brand::where('name', $brand_name)->first();
        if ($brand == null) {
            return redirect(route('search'))->with("error_message", "La marca selezionata non è presente nel nostro sito. Se si tratta di un errore contattare l'amministrazione.");
        }
        $models = Phone::where('brand_id', $brand->id)->get();
        return view("select", compact('models', 'brand_name'));
    }

    public function info($brand_name, $model_id)
    {
        $model = Phone::find($model_id);
        if ($model == null) {
            return redirect(route('models', $brand_name))->with("error_message", "Modello di telefono inesistente perfavore selezionane un'altro.");
        }
        $model->compatibilities;
        return view("info", compact('model', 'brand_name'));
    }
}
