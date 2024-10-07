<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Phone;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaseAdminController extends Controller
{
    public function index()
    {

        $brands = Brand::all();
        $compatibilities = DB::table('phone_compatibilities')
            ->join('phones as phone1', 'phone_compatibilities.phone_id_1', '=', 'phone1.id')  // Join per phone_id_1
            ->join('phones as phone2', 'phone_compatibilities.phone_id_2', '=', 'phone2.id')  // Join per phone_id_2
            ->select(
                'phone_compatibilities.id',
                'phone_compatibilities.verified',
                'phone_compatibilities.possible',
                'phone1.name as phone1_name',
                'phone1.id as phone1_id',
                'phone2.name as phone2_name',
                'phone2.id as phone2_id'
            ) // Seleziona i dati e i nomi dei telefoni
            ->orderByRaw('possible = true DESC, verified = false DESC, id DESC') // Ordina per verified e possible
            ->get();

        // for ($i = 0; $i < count($compatibilities); $i++) {
        //     $phone_id_1 = $compatibilities[$i]->phone1_id;
        //     $phone_id_2 = $compatibilities[$i]->phone2_id;
        //     if ($compatibilities->contains('phone2_id', $phone_id_1) && $compatibilities->contains('phone1_id', $phone_id_2)) {
        //         $compatibilities->splice($i, 1);
        //     }
        // }
        return view('admin.dashboard', compact('brands', 'compatibilities'));
    }

    public function store_model(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'brand_id' => 'required|exists:brands,id'
        ]);

        Phone::create($request->all());

        return redirect()->back()->with("message", "modello $request->name aggiunto correttamente");
    }

    public function edit_compatibility(Request $request)
    {
        $request->validate([
            'compatibility-id' => 'required|exists:phone_compatibilities,id'
        ]);

        DB::update('update phone_compatibilities set verified = ?, possible = ? where id = ?', [
            $request->verified != null ? '1' : '0',
            $request->possible != null ? '1' : '0',
            $request['compatibility-id']
        ]);

        return redirect()->back()->with('message', 'compatibilità aggiornata');
    }
}
