<?php
//
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Domicilio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DomicilioController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domicilio = DB::table('alumno_domicilio as ad')->join('alumno as a', 'ad.alu_dni', '=', 'a.alu_dni')->join('ubigeo_peru_departments as ud', 'ad.department_id', '=', 'ud.id')->join('ubigeo_peru_provinces as up', 'ad.province_id', '=', 'up.id')->join('ubigeo_peru_districts as ut', 'ad.district_id', '=', 'ut.id')
        ->select('ad.alu_dni','ad.ald_direccion','ad.ald_telefono', 'ud.name as Departamento', 'up.name as Provincia', 'ut.name as Distrito')->get();
        return response()->json($domicilio);
    }

    public function store(Request $request)
    {
        try{
            $domicilio = new Domicilio();
            
            $domicilio->alu_dni = $request->alu_dni;
            $domicilio->ald_direccion = $request->ald_direccion;
            $domicilio->ald_telefono = $request->ald_telefono;
            $domicilio->department_id = $request->department_id;
            $domicilio->province_id = $request->province_id;
            $domicilio->district_id = $request->district_id;
            $domicilio->save();
            $result = ['alu_dni' => $domicilio->alu_dni,
                    'created' => true];
        }catch(Throwable $e){
            return "Error - " . $e->getMessage();
        }
    }

    
    public function show($id)
    {
        return Domicilio::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $domicilio = Domicilio::findOrFail($id);
       
        $domicilio->ald_direccion = $request->ald_direccion;
        $domicilio->ald_telefono = $request->ald_telefono;
        $domicilio->department_id = $request->department_id;
        $domicilio->province_id = $request->province_id;
        $domicilio->district_id = $request->district_id;
        $domicilio->update();
        return $domicilio;
    }

    
    public function destroy($id)
    {
        $domicilio=Domicilio::findOrFail($id);
        $domicilio->delete();
        return 204;
    }
}
