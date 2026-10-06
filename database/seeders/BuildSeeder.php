<?php

namespace Database\Seeders;

use App\Models\Build;
use App\Models\BuildPhoto;
use App\Models\CarModel;
use App\Models\User;
use App\Models\Wheel;
use Illuminate\Database\Seeder;

class BuildSeeder extends Seeder
{
    /**
     * Crée quelques builds de démo pour avoir des données à afficher.
     */
    public function run(): void
    {
        $user = User::first();

        if (! $user) {
            $this->command->warn('Aucun user en base, lance AdminUserSeeder avant.');

            return;
        }

        // Nombre de builds à générer (assez pour tester la pagination : 15/page).
        $count = 18;

        // On récupère des car_models et wheels réellement présents en base.
        $carModelIds = CarModel::query()->inRandomOrder()->take($count)->pluck('id')->all();
        $wheelIds    = Wheel::query()->inRandomOrder()->take($count)->pluck('id')->all();

        if (empty($carModelIds) || empty($wheelIds)) {
            $this->command->warn('Pas de car_models / wheels en base (lance les seeders correspondants).');

            return;
        }

        for ($b = 0; $b < $count; $b++) {
            $build = Build::create([
                'user_id'      => $user->id,
                'car_model_id' => $carModelIds[$b % count($carModelIds)],
                'wheel_id'     => $wheelIds[$b % count($wheelIds)],
                'car_year'     => rand(2005, 2024),
                'diameter'     => rand(16, 22),
                'width'        => round(rand(70, 105) / 10, 1),
            ]);

            $photoCount = rand(1, 4);

            for ($i = 0; $i < $photoCount; $i++) {
                // photo_url est un chemin relatif ; combiné à R2_URL ça donne
                // https://picsum.photos/seed/build-<id>-<i>/800/600 -> une vraie image.
                BuildPhoto::create([
                    'build_id'      => $build->id,
                    'photo_url'     => "build-{$build->id}-{$i}/800/600",
                    'display_order' => $i,
                ]);
            }
        }

        $this->command->info("{$count} builds de démo créés.");
    }
}
