<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\KotaModel;

class KotaSeeder extends Seeder
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
        ])->get('https://api.rajaongkir.com/starter/city');

        $kota = $response['rajaongkir']['results'];

        foreach ($kota as $data) {
            $data_kota[] = [
                'id' => $data['city_id'],
                'province_id' => $data['province_id'],
                'province' => $data['province'],
                'type' => $data['type'],
                'city_name' => $data['city_name'],
                'postal_code' => $data['postal_code'],
            ];
        }
        KotaModel::insert($data_kota);
    
    }
}
