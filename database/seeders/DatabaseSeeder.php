<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceOption;
use App\Models\ServiceKeyword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Lettura del file json...');
        $json = database_path('data/services.json');

        if (file_exists($json)) {
            $jsonData = file_get_contents($json);
            $data = json_decode($jsonData, true);
            $this->command->info('File interpretato correttamente.');

            DB::beginTransaction();
            try {

                // Service
                foreach ($data['services'] as $service) {
                    $serviceModel = Service::firstOrCreate([
                        'name' => $service['name']
                    ], [
                        'short_description' => $service['short_description'],
                        'description' => $service['description'],
                        'base_price' => $service['base_price'],
                        'is_active' => $service['is_active']
                    ]);

                    // ServiceKeyword
                    foreach ($service['keywords'] as $keyword) {
                        ServiceKeyword::firstOrCreate([
                            'service_id' => $serviceModel->id,
                            'name' => $keyword['name']
                        ], [
                            'priority' => $keyword['priority'],
                            'is_exclusive' => $keyword['is_exclusive']
                        ]);
                    }

                    // ServiceOption
                    foreach ($service['options'] as $option) {
                        ServiceOption::firstOrCreate([
                            'service_id' => $serviceModel->id,
                            'name' => $option['name']
                        ], [
                            'description' => $option['description'],
                            'price' => $option['price'],
                            'keywords' => $option['keywords'],
                            'is_active' => $option['is_active']
                        ]);
                    }
                }

                DB::commit();
                $this->command->info('Seeding completato con successo.');

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Errore durante il seeding del database => ' . $e->getMessage());
            }
        } else {
            Log::error('File json non trovato');
        }
    }
}
