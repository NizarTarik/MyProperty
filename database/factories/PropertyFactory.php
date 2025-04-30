<?php

namespace Database\Factories;

use App\Models\Bookmark;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition()
    {
        $imagePath = public_path('frontend/img/properties');
        $imageFiles = array_diff(scandir($imagePath), ['.', '..']);

        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'numberOfRooms' => $this->faker->numberBetween(1, 10),
            'floor' => $this->faker->numberBetween(0, 7),
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'postalCode' => $this->faker->postcode,
            'country' => $this->faker->country,
            'price' => $this->faker->randomFloat(2, 100, 10000),
            'type' => $this->faker->randomElement(['Apartment', 'House', 'Villa']),
            'img' => 'frontend/img/properties/' . $imageFiles[array_rand($imageFiles)], // Store relative path
            'owner_id' => function () {
                return User::factory()->create()->id;
            },
        ];
    }

    public function bookmarks()
    {
        return $this->belongsToMany(Bookmark::class);
    }
}
