<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\NewsAPIService;
use App\Models\Publication;
use Illuminate\Support\Facades\Log;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(NewsAPIService $api): void
    {
        //
        $data = $api->sources();

        if($data['status'] == "ok") {
            foreach($data['sources'] as $source) {

                Publication::factory()->create([
                    'name' => $source['name'],
                    'country' => $source['country']
                ]);
            }
        }

        else {
            Log::notice("error with API");
        }
        

    }
}
