<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\SubCategory;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    /**
     * The Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Create a new seeder instance.
     *
     * @param  \Faker\Generator  $faker
     * @return void
     */
    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }
    public function run()
    {

        $subcategorias = [
            'Laptops' => [
                'Dell XPS 13',
                'HP Spectre x360',
                'Lenovo ThinkPad X1 Carbon',
                'Apple MacBook Pro',
                'Asus ZenBook 14',
            ],
            'PC de escritorio' => [
                'Dell OptiPlex 3070',
                'HP Pavilion Desktop',
                'Lenovo ThinkCentre M920',
                'Acer Aspire TC',
                'Apple iMac',
            ],
            'Tablets' => [
                'Apple iPad Pro',
                'Samsung Galaxy Tab S7',
                'Microsoft Surface Pro 7',
                'Huawei MatePad Pro',
                'Lenovo Tab P11 Pro',
            ],
            'Monitores LED' => [
                'Dell UltraSharp U2415',
                'LG 27UK850-W',
                'BenQ PD3200U',
                'Asus ProArt PA329Q',
                'HP EliteDisplay E273',
            ],
            'Monitores LCD' => [
                'AOC CQ32G1',
                'Samsung CF791',
                'ViewSonic VX2457-MHD',
                'Philips 328E9QJAB',
                'Dell P2419H',
            ],
            'Monitores Gaming' => [
                'Alienware AW3418DW',
                'ASUS ROG Swift PG279Q',
                'MSI Optix MAG271CQR',
                'LG 34GN850-B',
                'Acer Predator X27',
            ],
            'Teclados' => [
                'Logitech G Pro Mechanical Gaming Keyboard',
                'Razer Huntsman Elite',
                'Corsair K95 RGB Platinum XT',
                'HyperX Alloy Origins',
                'SteelSeries Apex Pro',
            ],
            'Mouse' => [
                'Logitech G Pro Wireless',
                'Razer DeathAdder V2',
                'Corsair Harpoon RGB Wireless',
                'SteelSeries Rival 650',
                'Glorious Model O',
            ],
            'Altavoces' => [
                'Sonos One',
                'Bose SoundLink Revolve+',
                'JBL Charge 4',
                'Sony SRS-XB43',
                'UE Boom 3',
            ],
            'Fundas' => [
                'Spigen Rugged Armor',
                'OtterBox Defender Series',
                'Supcase Unicorn Beetle Pro',
                'UAG Plasma Series',
                'RhinoShield SolidSuit',
            ],
            'Cámaras DSLR' => [
                'Canon EOS 5D Mark IV',
                'Nikon D850',
                'Sony Alpha a7 III',
                'Fujifilm X-T4',
                'Pentax K-1 Mark II',
            ],
            'Cámaras sin espejo' => [
                'Sony Alpha a7R IV',
                'Fujifilm X-T30',
                'Canon EOS R5',
                'Nikon Z6',
                'Panasonic Lumix GH5',
            ],
            'Cámaras de acción' => [
                'GoPro Hero9 Black',
                'DJI Osmo Action',
                'Sony RX0 II',
                'Insta360 ONE R',
                'Akaso Brave 7 LE',
            ],
            'Cámaras de seguridad' => [
                'Arlo Pro 4',
                'Ring Stick Up Cam',
                'Wyze Cam v3',
                'Google Nest Cam IQ',
                'Blink Outdoor',
            ],
            'Impresoras láser' => [
                'HP LaserJet Pro M404dn',
                'Brother HL-L2380DW',
                'Canon imageCLASS MF743Cdw',
                'Epson EcoTank ET-3760',
                'Xerox Phaser 6510',
            ],
            'Impresoras de inyección de tinta' => [
                'Epson EcoTank ET-2720',
                'Canon PIXMA TR8520',
                'HP OfficeJet Pro 6968',
                'Brother MFC-J995DW',
                'Lexmark MB2236adwe',
            ],
            'Impresoras multifuncionales' => [
                'Epson WorkForce Pro WF-4740',
                'Canon PIXMA TS9120',
                'HP ENVY Photo 7155',
                'Brother MFC-L3770CDW',
                'Xerox WorkCentre 6515',
            ],
            'Procesadores' => [
                'Intel Core i9-11900K',
                'AMD Ryzen 9 5950X',
                'Intel Core i7-11700K',
                'AMD Ryzen 7 5800X',
                'Intel Core i5-11600K',
            ],
            'Tarjetas gráficas' => [
                'NVIDIA GeForce RTX 3080',
                'AMD Radeon RX 6900 XT',
                'NVIDIA GeForce RTX 3060 Ti',
                'AMD Radeon RX 6800',
                'NVIDIA GeForce RTX 3090',
            ],
            'Memorias RAM' => [
                'Corsair Vengeance RGB Pro',
                'G.Skill Trident Z RGB',
                'Crucial Ballistix RGB',
                'Kingston HyperX Fury RGB',
                'ADATA XPG Spectrix D50 RGB',
            ],
            'Discos duros' => [
                'Samsung 980 PRO NVMe SSD',
                'Seagate BarraCuda 4TB',
                'Western Digital Blue 1TB',
                'Crucial MX500 500GB',
                'Toshiba X300 6TB',
            ],
            'Placas base' => [
                'Asus ROG Strix X570-E Gaming',
                'MSI MEG Z590 ACE',
                'Gigabyte X570 Aorus Ultra',
                'ASRock B550 Steel Legend',
                'EVGA Z590 FTW WiFi',
            ],
        ];

        $description = [
            'Innovador y elegante diseño',
            'Potencia y rendimiento excepcionales',
            'Calidad de imagen superior',
            'Funcionalidad versátil y práctica',
            'Alta seguridad y confiabilidad'
        ];
        $presentation = [
            '4G',
            '5G',
            'XG MAX',
            'XSM PRO',
            '4K 1670',
        ];

        foreach ($subcategorias as $subcategoria => $productos) {
            foreach ($productos as $producto) {
                $subcategory = SubCategory::where('name', $subcategoria)->first();
                if ($subcategory) {
                    Product::factory()->create([
                        'name' => $producto,
                        'description' => $this->faker->randomElement($description),
                        'status' => $this->faker->boolean,
                        'image' => 'images/default_product.png',
                        'slug' => Str::slug($this->faker->unique()->name,'-'),
                        'brand_id' => Brand::inRandomOrder()->first()->id,
                        'price' => $this->faker->randomFloat(2, 50, 500),
                        'presentation' =>$this->faker->randomElement($presentation),
                        'subcategory_id' => $subcategory->id
                    ]);
                }
            }
        }
    }
}







