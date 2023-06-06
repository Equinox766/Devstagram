<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id'            => $this->faker->uuid(),
            'titulo'        => $this->faker->sentence(5),
            'descripcion'   => $this->faker->sentence(20),
            'imagen'        => $this->faker->randomElement([
                '1a3bb76b-80b8-4900-a5ce-c14d216f7437.jpg',
                '3a6dbf07-4390-4e81-8e8e-2d395953416a.jpg',
                '134b550f-73dd-460e-a187-6bbe3dabc66e.jpg',
                '825aa844-61ec-4a1c-a831-bb81c2e93db9.jpg',
                '98448b7e-391f-427e-b3c6-e542027e83f9.jpg',
                'a571a22c-9011-4f5c-bd3e-25966daa0029.jpg',
            ]),
            'user_id'       => $this->faker->randomElement([
                '9956d71b-6215-4d2a-9980-445e2dc39e9a',
                '9956d645-bb8c-4adb-b54d-03312de7d875',
                '99570751-c03d-4119-8090-29572fb32af0',
            ]),
        ];
    }
}
