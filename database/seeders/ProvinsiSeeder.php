<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\ProvinsiModel;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::withHeaders([
            'key' => '1abf8e8ee1e8bdbc7fcef92391603dea'
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinsi = $response['rajaongkir']['results'];

        foreach ($provinsi as $data) {
            $data_provinsi[] = [
                'id' => $data['province_id'],
                'province' => $data['province'],
            ];
        }
        ProvinsiModel::insert($data_provinsi);
    }
}
