<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProvinsiModel;
use App\Models\KotaModel;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        

       
       
        return view('index',[
            'getdataprovinsi' => ProvinsiModel::all(),
            'cekongkir' => false,
            'getdatakota' => KotaModel::where('province_id','=',5)->get(),
           
        ]);

    }

    public function cekongkir(Request $request){
         if ($request->origin && $request->destination && $request->weight && $request->courier) {
            $origin = $request->origin;
            $destination = $request->destination;
            $weight = $request->weight;
            $courier = $request->courier;
        }
        else{
            $origin = '';
            $destination = '';
            $weight = '';
            $courier = '';
        }
         $response = Http::asForm()->withHeaders([
            'key' => '1abf8e8ee1e8bdbc7fcef92391603dea'
        ])->post('https://api.rajaongkir.com/starter/cost',[
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        ]);
       $cekongkir = $response['rajaongkir']['results'][0]['costs'];
       return view('index',[
            'getdataprovinsi' => ProvinsiModel::all(),
            'getdataongkir' => $cekongkir,
            'cekongkir' => true,
            'getdatakota' => KotaModel::where('province_id','=',5)->get(),
           
        ]);
    }


    public function ajax($id){
        $kota = KotaModel::where('province_id','=',$id)->pluck('city_name','id');
        return json_encode($kota);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
