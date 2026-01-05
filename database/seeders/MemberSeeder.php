<?php

namespace Database\Seeders;

use Botble\Member\Database\Seeders\MemberSeeder as BaseMemberSeeder;
use Botble\Member\Models\Member;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends BaseMemberSeeder
{
    public function run(): void
    {
        parent::run();

        $files = $this->uploadFiles('members');

        $faker = $this->fake();
        $now = $this->now();

        Member::query()->create([
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'john.smith@botble.com',
            'password' => Hash::make('12345678'),
            'dob' => $faker->dateTime(),
            'phone' => $faker->phoneNumber(),
            'avatar_id' => ! $files[0]['error'] ? $files[0]['data']->id : 0,
            'description' => $faker->realText(30),
            'confirmed_at' => $now,
        ]);

        foreach (Member::query()->get() as $index => $member) {
            if (! isset($files[$index + 1])) {
                continue;
            }

            $file = $files[$index + 1];

            $member->avatar_id = ! $file['error'] ? $file['data']->id : 0;
            $member->save();
        }
    }
}
