<?php

namespace Database\Factories;

use App\Models\Agence;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agence::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Liste potentielle de services
        $allServices = ['wifi', 'parking', 'piscine', 'restaurant', 'spa', 'bar', 'salle de gym', 'service en location'];

        return [
            'nom_agence'         => $this->faker->company . ' Agence',
            'description_agence' => $this->faker->paragraph(),
            'logo'              => 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' . $this->faker->unique()->numberBetween(1, 1000),
            'ville'             => $this->faker->city(),
            'localisation'      => $this->faker->address(),
            'bannier1'          => 'https://source.unsplash.com/random/1200x300?agence&sig=' . $this->faker->unique()->numberBetween(1001, 2000),
            'bannier2'          => 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' . $this->faker->unique()->numberBetween(2001, 3000),
            'bannier3'          => null,
            'date_at'           => $this->faker->dateTimeBetween('-1 years', 'now'),
            'mat_user'          => User::factory(),
            'telephone'         => $this->faker->phoneNumber(),
            'email'             => $this->faker->unique()->companyEmail(),
            'services'          => $this->faker->randomElements(
                $allServices,
                $this->faker->numberBetween(2, 5)
            ),
        ];
    }
}
