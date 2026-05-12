<?php

namespace Database\Seeders;

use App\Models\Wheel;
use App\Models\WheelBrand;
use Illuminate\Database\Seeder;

class WheelBrandSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'BBS' => [
                'RS', 'RS-GT', 'CH-R', 'FI', 'LM', 'RE', 'RI', 'RK', 'RF', 'RG-R',
                'CI-R', 'XR', 'E88', 'E70', 'Super RS',
            ],
            'Enkei' => [
                'NT03+M', 'RPF1', 'GTC01', 'PF01', 'RS05RR', 'RP01',
                'RC-G4', 'GTC02', 'TSP6', 'EKM3', 'EVO5', 'RSA',
            ],
            'Rays' => [
                'TE37', 'TE37 Ultra', 'TE37 Saga', 'TE37 SL', 'TE37 RT',
                'CE28N', 'CE28SL', 'G25 Edge', 'ZE40', 'ZE40 Time Attack',
                '57CR', '57DR', 'A-Lap F', 'Nismo LMGT4', 'Nismo GT-R LM',
                'Volk Racing 57FXZ', 'Gram Lights 57CR-X',
            ],
            'OZ Racing' => [
                'Ultraleggera', 'Ultraleggera HLT', 'Superturismo GT',
                'Superturismo WRC', 'Alleggerita HLT', 'Leggera HLT',
                'Rally Racing', 'Crono HT3', 'Atelier Forged', 'HLT 5F',
            ],
            'HRE' => [
                'P101', 'P201', 'P204H', 'FF01', 'R101', 'S104',
                'C104', 'P40SC', 'FF21', 'FF15S', 'S201', 'R200',
                'P40', 'P103', 'Classic 300',
            ],
            'Work' => [
                'Emotion CR Kiwami', 'Emotion M8R', 'Meister S1 3P',
                'Meister L1 3P', 'T7R 2P', 'T7R', 'CR2P', 'Equip 40',
                'Varianza T2S', 'XD9', 'VS ZZ', 'VS XV', 'Brombacher',
            ],
            'Rotiform' => [
                'BLQ', 'LSR', 'LAS', 'BIT', 'IND', 'NUE', 'OZR',
                'SPF', 'TMB', 'HUR', 'MGP', 'WGR', 'QLB', 'CVT',
                'SIX', 'LO-D', 'ZMO',
            ],
            'SSR' => [
                'Professor SP4', 'Professor SP1', 'Formula Mesh',
                'GT-X', 'Vienna Mesh', 'Executor CV01', 'Executor CV04S',
                'Type F', 'MS3', 'Werfen',
            ],
            'Advan' => [
                'Racing RSII', 'Racing GT', 'Racing TC-4', 'Racing RC-III',
                'A9A', 'GT Premium Version', 'GT Beyond', 'RS-DF',
            ],
            'Speedline' => [
                'SL2 Marmora', 'Turini', 'SL810 Vincitore',
                'SL5 Settantuno', 'Corse SL380', 'SL356', 'SL369',
            ],
            'Fifteen52' => [
                'Outlaw', 'Turbomac HD', 'Turbomac', 'Impostor',
                'Analog HD', 'Magnum', 'Range HD', 'Snowdrift',
            ],
            'Apex' => [
                'SM-10', 'EC-7', 'Arc-8', 'SM-10RS', 'EC-7RS',
                'FL-5', 'VS-5RS',
            ],
            'Konig' => [
                'Hypergram', 'Dekagram', 'Ampliform', 'Ultraform',
                'Impression', 'Hexaform', 'Skidmark', 'Countergram',
            ],
            '3SDM' => [
                '0.01', '0.02', '0.06', '0.08', '0.09', '0.50',
                '0.66', '0.73', '0.74', '0.10', '0.12', '0.06 D',
            ],
            'AVID.1' => [
                'AV06', 'AV20', 'AV32', 'AV38', 'AV12',
            ],
            'Aodhan' => [
                'DS07', 'DS02', 'DS08', 'AH01', 'AH07', 'LS001',
            ],
            'Rota' => [
                'Grid', 'Grid V', 'Torque', 'Boost', 'Combat',
                'Titan', 'DS2', 'GP', 'Sub Zero', 'GLR',
            ],
            'Motegi Racing' => [
                'MR116', 'MR146', 'FF7', 'CS5', 'CS6', 'Racing FF7',
                'MR118', 'MR139',
            ],
            'TSW' => [
                'Nurburgring', 'Bathurst', 'Snowdon', 'Interlagos',
                'Sebring', 'Spa', 'Watkins Glen', 'Hockenheim R',
            ],
            'Vossen' => [
                'CVT', 'HF-2', 'HF-3', 'HC-1', 'M-X1',
                'VFS-2', 'VFS-6', 'VFS-10', 'LC-109', 'S21-01',
            ],
            'Forgeline' => [
                'GA3', 'GS1', 'RL3', 'SE1', 'DE3P',
                'GE1', 'GE3C',
            ],
            'Sparco' => [
                'Assetto Gara', 'Podio', 'LM 5',
                'Lagunaseca', 'Terra', 'Gravel',
            ],
            'Team Dynamics' => [
                'Pro Race 1.2', 'Pro Race 2', 'Pro Race 3', 'Imola',
            ],
            'Compomotive' => [
                'TH', 'CXR', 'CT', 'ML', 'MO',
            ],
            'Gram Lights' => [
                '57FXZ', '57DR', '57CR', '57CR-X', '57JX',
                '57Xtreme', '57NX',
            ],
            'Prodrive' => [
                'GC-010G', 'GC-012G', 'PFF-01C', 'GC-05K',
            ],
        ];

        foreach ($data as $brandName => $models) {
            $brand = WheelBrand::firstOrCreate(['name' => $brandName]);

            foreach ($models as $model) {
                Wheel::create([
                    'name'           => $model,
                    'wheel_brand_id' => $brand->id,
                ]);
            }
        }
    }
}
