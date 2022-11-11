<?php

namespace Database\Factories;

use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersFactory extends Factory
{
    protected $model = Users::class;

    public function definition(): array
    {
    	return [
            'id' => null,
    	    'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '1234'
    	];
    }
}
