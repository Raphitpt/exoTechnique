<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Race;
use App\Models\Animal;
use App\Models\Tax;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $taxes = [
            ['name' => 'TVA sur les animaux d\'élevage', 'value' => 10],
            ['name' => 'TVA sur les chevaux de sport ou loisirs', 'value' => 20],
            ['name' => 'TVA sur les animaux de compagnie', 'value' => 20]
        ];

        foreach ($taxes as $tax) {
            Tax::factory()->create($tax);
        }
        $types = [
            ['name' => 'chien', 'tax_id' => 3],
            ['name' => 'cheval', 'tax_id' => 2],
            ['name' => 'brebis', 'tax_id' => 1],
            ['name' => 'cochon', 'tax_id' => 1]
        ];

        foreach ($types as $type) {
            Type::factory()->create($type);
        }

        $races = [
            ['name' => 'labrador', 'type_id' => 1],
            ['name' => 'frison', 'type_id' => 2],
            ['name' => 'pottok', 'type_id' => 2],
            ['name' => 'irish cob', 'type_id' => 2],
            ['name' => 'merinos', 'type_id' => 3],
            ['name' => 'solognotes', 'type_id' => 3]
        ];

        foreach ($races as $race) {
            Race::factory()->create($race);
        }

        $animals = [
            ['name' => 'rex', 'type_id' => 1, 'age' => 16, 'description' => 'chien très gentil', 'state' => 'en vente', 'pictures' => json_encode(['https://www.goodbro.fr/wp-content/uploads/labrador.jpg']), 'race_id' => 1, 'price' => 100],
            ['name' => 'bobby', 'type_id' => 1, 'age' => 10, 'description' => 'chien très gentil', 'state' => 'en vente', 'pictures' => json_encode(['https://www.vetocanis.com/cdn/shop/articles/labrador-retriever-1210559_960_720.jpg?v=1671700675']), 'race_id' => 1, 'price' => 100],
            ['name' => 'bella', 'type_id' => 2, 'age' => 5, 'description' => 'cheval très gentil', 'state' => 'en vente', 'pictures' => json_encode(['https://www.classequine.com/wp-content/uploads/2021/03/cheval-frison.jpg']), 'race_id' => 2, 'price' => 1000],
            ['name' => 'bello', 'type_id' => 3, 'age' => 5, 'description' => 'brebis très gentil', 'state' => 'en vente', 'pictures' => json_encode(['https://www.ferme-mohair.com/web/image/37087-07a4d452/Mouton-m%C3%A9rinos.jpg']), 'race_id' => 5, 'price' => 100]
        ];

        foreach ($animals as $animal) {
            Animal::factory()->create($animal);
        }
    }
}
