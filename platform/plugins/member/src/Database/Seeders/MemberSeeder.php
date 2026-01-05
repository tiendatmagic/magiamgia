<?php

namespace Botble\Member\Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Member\Models\Member;
use Botble\Member\Models\MemberActivityLog;

class MemberSeeder extends BaseSeeder
{
    public function run(): void
    {
        Member::query()->truncate();
        MemberActivityLog::query()->truncate();

        $faker = $this->fake();
        $now = $this->now();

        Member::query()->create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'email' => 'member@gmail.com',
            'password' => 12345678,
            'dob' => $faker->dateTime(),
            'phone' => $faker->phoneNumber(),
            'description' => $faker->realText(30),
            'confirmed_at' => $now,
        ]);

        for ($i = 0; $i < 9; $i++) {
            Member::query()->create([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => $faker->email(),
                'password' => 12345678,
                'dob' => $faker->dateTime(),
                'phone' => $faker->phoneNumber(),
                'description' => $faker->realText(30),
                'confirmed_at' => $now,
            ]);
        }
    }
}
