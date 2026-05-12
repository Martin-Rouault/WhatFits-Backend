<?php

namespace Database\Seeders;

use App\Models\CarModel;
use App\Models\Make;
use Illuminate\Database\Seeder;

class CarModelSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Honda' => [
                'Civic', 'Civic Type R', 'Civic Si',
                'Accord', 'Accord Type R',
                'Integra', 'Integra Type R',
                'NSX', 'S2000', 'CR-X', 'CR-X Del Sol',
                'Prelude', 'Jazz', 'Fit', 'City',
                'HR-V', 'CR-V', 'FR-V', 'Stream',
                'Odyssey', 'Legend', 'Insight',
                'Logo', 'Shuttle', 'Freed', 'Element',
            ],
            'Toyota' => [
                'Yaris', 'Yaris GR', 'Aygo',
                'Corolla', 'Corolla AE86',
                'Camry', 'Avensis', 'Auris',
                'Supra', 'GR86',
                'Celica', 'MR2',
                'Prius', 'Verso',
                'Land Cruiser', 'RAV4',
                'Chaser', 'Mark II', 'Crown',
                'Soarer', 'Aristo',
                'Alphard', 'Vellfire',
                'Hilux', 'Proace',
            ],
            'Nissan' => [
                'Micra', 'Note', 'Juke',
                'Qashqai', 'X-Trail',
                'Primera', 'Almera', 'Tiida',
                'Bluebird', 'Sentra', 'Maxima',
                'Silvia S13', 'Silvia S14', 'Silvia S15',
                '180SX', '240SX',
                'Skyline R32', 'Skyline R33', 'Skyline R34',
                'GT-R R35',
                '350Z', '370Z', 'Fairlady Z',
                'Stagea', 'Patrol', 'Navara',
            ],
            'Mazda' => [
                'Mazda2', 'Mazda3', 'Mazda6',
                'CX-3', 'CX-30', 'CX-5',
                '121', '323', '626',
                'MX-5 NA', 'MX-5 NB', 'MX-5 NC', 'MX-5 ND',
                'RX-7 FC', 'RX-7 FD', 'RX-8',
                'Speed3', 'Atenza', 'Axela',
                'Premacy', 'BT-50',
            ],
            'Subaru' => [
                'Justy', 'Impreza', 'Impreza WRX', 'WRX STI',
                'Legacy', 'Outback', 'Forester',
                'BRZ', 'Levorg', 'XV',
                'SVX', 'Liberty', 'Tribeca',
            ],
            'Mitsubishi' => [
                'Colt', 'Space Star', 'Mirage',
                'Carisma', 'Galant', 'Sigma',
                'Lancer', 'Lancer Evolution I', 'Lancer Evolution II',
                'Lancer Evolution III', 'Lancer Evolution IV', 'Lancer Evolution V',
                'Lancer Evolution VI', 'Lancer Evolution VII', 'Lancer Evolution VIII',
                'Lancer Evolution IX', 'Lancer Evolution X',
                'Eclipse', '3000GT', 'GTO',
                'FTO', 'Outlander', 'Pajero', 'L200',
            ],
            'BMW' => [
                '1 Series', '2 Series', '3 Series', '4 Series',
                '5 Series', '6 Series', '7 Series', '8 Series',
                'X1', 'X2', 'X3', 'X4', 'X5', 'X6',
                'Z3', 'Z4',
                'M2', 'M3', 'M4', 'M5', 'M6', 'M8',
                'X5M', 'X6M', 'M135i', 'M235i',
                'i3', 'i4', 'i8',
                '2002', 'E30', 'E36', 'E46', 'E90',
            ],
            'Audi' => [
                'A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8',
                'Q3', 'Q5', 'Q7', 'Q8',
                'TT', 'TT RS', 'R8',
                'S1', 'S3', 'S4', 'S5', 'S6', 'S7', 'S8',
                'RS3', 'RS4', 'RS5', 'RS6', 'RS7',
                '80', '90', '100', 'Quattro',
                'e-tron',
            ],
            'Volkswagen' => [
                'Up!', 'Lupo', 'Polo', 'Polo GTI',
                'Golf', 'Golf GTI', 'Golf R', 'Golf R32',
                'Scirocco', 'Corrado',
                'Jetta', 'Passat', 'Arteon', 'Phaeton',
                'Beetle', 'New Beetle',
                'T-Roc', 'Tiguan', 'Touareg',
                'ID.3', 'ID.4',
                'Caddy', 'Transporter',
            ],
            'Porsche' => [
                '911 (930)', '911 (964)', '911 (993)', '911 (996)',
                '911 (997)', '911 (991)', '911 (992)',
                '911 Turbo', '911 GT3', '911 GT3 RS', '911 R',
                'Boxster', 'Cayman', '718 Cayman', '718 Boxster',
                '944', '928', '914', '968',
                'Panamera', 'Cayenne', 'Macan',
            ],
            'Mercedes' => [
                'A 180', 'A 200', 'A 250', 'A 45 AMG', 'A 45 S AMG',
                'B-Class',
                'C 180', 'C 200', 'C 220', 'C 250', 'C 300',
                'C 43 AMG', 'C 63 AMG', 'C 63 S AMG',
                'E-Class', 'E 63 AMG',
                'S-Class', 'CLA', 'CLS',
                'GLA', 'GLB', 'GLC', 'GLE', 'GLS',
                'G-Class', 'AMG GT', 'AMG GT R', 'SL', 'SLK', 'SLC',
                'CLK', '190E', 'Vito',
            ],
            'Renault' => [
                'Twingo', 'Clio I', 'Clio II', 'Clio III', 'Clio IV', 'Clio V',
                'Clio RS', 'Clio RS Trophy',
                'Mégane I', 'Mégane II', 'Mégane III', 'Mégane IV',
                'Mégane RS', 'Mégane RS Trophy',
                'Laguna', 'Espace', 'Scenic', 'Kangoo',
                'Captur', 'Kadjar', 'Koleos',
                'Fluence', 'Modus', 'Zoe',
                '5', '19', '21', 'Logan',
                'Alpine A110', 'Alpine A110 S',
            ],
            'Peugeot' => [
                '106', '106 Rallye',
                '205', '205 GTi', '205 T16',
                '206', '206 RC', '206 CC',
                '207', '207 RC',
                '208', '208 GTi', '208 Rally4',
                '306', '306 S16', '306 Rallye',
                '307', '307 CC',
                '308', '308 GTi', '308 SW',
                '405 Mi 16',
                '406', '406 Coupé',
                '407', 'RCZ', 'RCZ R',
                '2008', '3008', '5008',
                '504', '505',
            ],
            'Ford' => [
                'Ka', 'Fiesta', 'Fiesta ST',
                'Focus', 'Focus ST', 'Focus RS',
                'Escort', 'Escort RS Cosworth',
                'Sierra', 'Sierra RS Cosworth',
                'Mondeo', 'Puma', 'S-Max', 'Galaxy',
                'Mustang', 'Mustang GT', 'Mustang Shelby GT350', 'Mustang Shelby GT500',
                'Probe', 'Explorer', 'Ranger',
                'F-150', 'F-150 Raptor',
                'GT', 'Maverick', 'Transit',
            ],
            'Chevrolet' => [
                'Spark', 'Cruze', 'Malibu', 'Impala',
                'Camaro', 'Camaro SS', 'Camaro ZL1',
                'Corvette C1', 'Corvette C2', 'Corvette C3',
                'Corvette C4', 'Corvette C5', 'Corvette C6',
                'Corvette C7', 'Corvette C8',
                'Silverado', 'Blazer', 'Equinox',
                'El Camino', 'Bel Air', 'Nova', 'Monte Carlo',
            ],
            'Dodge' => [
                'Neon', 'Neon SRT-4',
                'Dart', 'Caliber',
                'Charger', 'Charger Hellcat', 'Charger SRT8',
                'Challenger', 'Challenger Hellcat', 'Challenger Demon',
                'Challenger Super Bee',
                'Viper', 'Viper ACR',
                'Durango',
            ],
            'Hyundai' => [
                'i10', 'i20', 'i20N', 'i20N Rally1',
                'i30', 'i30N', 'i30 Fastback N',
                'Getz', 'Accent', 'Elantra',
                'Sonata', 'Tucson', 'Santa Fe', 'Kona',
                'Veloster', 'Veloster N', 'Veloster Turbo',
                'Tiburon', 'Genesis Coupe',
                'Ioniq 5', 'Ioniq 6',
            ],
            'Kia' => [
                'Picanto', 'Rio', 'Soul',
                'Ceed', 'ProCeed', 'Xceed', 'Ceed GT',
                'Cerato', 'Optima', 'Stinger', 'Stinger GT',
                'Sportage', 'Sorento', 'Carnival',
                'EV6', 'EV6 GT',
            ],
            'Alfa Romeo' => [
                '33', '75', '145', '146', '147', '147 GTA',
                '155', '155 Q4', '156', '156 GTA', '159',
                'GTV', 'Spider', 'Brera',
                'MiTo', '4C', '4C Spider',
                'Giulia', 'Giulia Quadrifoglio',
                'Stelvio', 'Stelvio Quadrifoglio',
                'Tonale',
            ],
            'Seat' => [
                'Mii', 'Ibiza', 'Ibiza Cupra',
                'Leon', 'Leon FR', 'Leon Cupra',
                'Toledo', 'Cordoba', 'Altea', 'Exeo',
                'Arona', 'Alhambra',
                'Cupra Leon', 'Cupra Born', 'Cupra Formentor', 'Cupra Ateca',
            ],
            'Volvo' => [
                '240', '340', '440', '480', '740', '850', '940', '960',
                'S40', 'S60', 'S60R', 'S70', 'S80', 'S90',
                'V40', 'V50', 'V60', 'V60 Polestar', 'V70', 'V70R', 'V90',
                'C30', 'C70',
                'XC40', 'XC60', 'XC70', 'XC90',
            ],
            'Polestar' => [
                'Polestar 1', 'Polestar 2', 'Polestar 3', 'Polestar 4',
            ],
            'Lexus' => [
                'CT 200h',
                'IS 200', 'IS 220d', 'IS 250', 'IS 300h', 'IS 350', 'IS 500',
                'IS F',
                'ES 250', 'ES 300h', 'ES 350',
                'GS 300', 'GS 350', 'GS 430', 'GS F',
                'LS 400', 'LS 430', 'LS 460', 'LS 500h',
                'RC 200t', 'RC 300h', 'RC 350', 'RC F',
                'LC 500', 'LC 500h',
                'UX 200', 'UX 250h',
                'NX 200t', 'NX 300h', 'NX 350h',
                'RX 300', 'RX 350', 'RX 400h', 'RX 450h',
                'LFA',
            ],
        ];

        foreach ($data as $makeName => $models) {
            $make = Make::where('name', $makeName)->first();

            if (! $make) {
                continue;
            }

            foreach ($models as $model) {
                CarModel::create([
                    'name'    => $model,
                    'make_id' => $make->id,
                ]);
            }
        }
    }
}
