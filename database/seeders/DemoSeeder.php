<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{GuestbookEntry, Submitter, User};
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'user-a@example.com',
            'password' => Hash::make('user-a'),
        ]);

        User::create([
            'email' => 'user-b@example.com',
            'password' => Hash::make('user-b'),
        ]);

        $submitter1 = Submitter::create([
                'email' => 'user-a@example.com',
                'display_name' => 'TheBez', 'real_name' => 'Beff Jezos']
        );

        $submitter2 = Submitter::create([
                'email' => 'user-b@example.com',
                'display_name' => 'RocketMan', 'real_name' => 'Melon Dusk']
        );

        GuestbookEntry::create([
            'title' => 'This is really amazing',
            'content' => 'Much better than Amazon',
            'submitter_id' => $submitter1->id,
        ]);

        GuestbookEntry::create([
            'title' => 'Wow.',
            'content' => 'This is so great that it sends me to space',
            'submitter_id' => $submitter2->id,
        ]);


    }
}
