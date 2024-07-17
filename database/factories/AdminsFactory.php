<?php

namespace Database\Factories;

use App\Models\Admins;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    /**
     * 
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Admins::class;

    private static $avatars = [
        'images/admins/1.jpg',
        'images/admins/2.jpg',
    ];

    public function definition(): array
    {


        // $files = File::files(public_path('images/admins'));

        // if (empty($files)) {
        //     $imagePath = 'images/admins/avatar.jpg';
        // } else {
        //     $randomFile = $files[array_rand($files)];

        //     $imagePath = 'images/admins/' . $randomFile->getFilename();
        // }

        $admins = [
            [
                'username' => 'tamhuynh',
                'email' => 'tamhuynh@coza.com',
                'fullname' => 'Tâm Huỳnh'
            ],

            [
                'username' => 'truongnguyen',
                'email' => 'truongnguyen@coza.com',
                'fullname' => 'Trường Nguyễn'
            ],

        ];

        $index = $this->faker->unique()->numberBetween(0, 1);

        $avatar = array_splice(self::$avatars, array_rand(self::$avatars), 1)[0];

        return [
            'fullname' => $admins[$index]['fullname'],
            'email' => $admins[$index]['email'],

            'address' => $this->faker->address,
            'phone_number' => '09' . $this->faker->numerify('########'),

            'username' => $admins[$index]['username'],
            'password' => Hash::make('123456'),

            'birth_date' => $this->faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'avatar' => $avatar,

            'login_at' => $this->faker->dateTimeThisYear(),

            'genders_id' => 1,
            'roles_id' => 1,

            'status_id' => 1,
            // 'status_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
