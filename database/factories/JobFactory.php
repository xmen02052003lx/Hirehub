<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(2, true),
            'salary' => fake()->numberBetween(40000, 120000),
            'tags' => implode(',', fake()->words(3)),
            'remote' => fake()->boolean(),
            'requirements' => fake()->sentences(3, true),
            'benefits' => fake()->sentences(2, true),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'zipcode' => fake()->postcode(),
            'contact_email' => fake()->safeEmail(),
            'contact_phone' => fake()->phoneNumber(),
            'company_name' => fake()->company(),
            'company_description' => fake()->paragraphs(2, true),
            'company_logo' => fake()->imageUrl(100, 100, 'business', true, 'logo'),
            'company_website' => fake()->url()
        ];
    }
}
