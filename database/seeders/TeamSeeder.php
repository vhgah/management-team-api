<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = Team::factory(3)
            ->has(User::factory(3), 'members')
            ->create();

        // set the team creators.
        $teams[0]->members()->attach($userFirst = User::where('email', 'admin_first@gmail.com')->first(), ['is_creator' => true]);
        $teams[1]->members()->attach($userSecond = User::where('email', 'admim_second@gmail.com')->first(), ['is_creator' => true]);
        $teams[2]->members()->attach($userThird = User::factory()->create(), ['is_creator' => true]);

        // Creating additional teams for main users.
        $userFirst->teams()->save(Team::factory()->make());
        $userSecond->teams()->save(Team::factory()->make());

        // Creating common team for main users.
        Team::factory()
            ->hasAttached([$userFirst, $userSecond], [], 'members')
            ->create();
    }
}
