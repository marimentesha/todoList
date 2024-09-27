<?php

namespace Database\Seeders;

use App\Models\ListSessions;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();
        DB::table('list_sessions')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::factory(20)->create();
        ListSessions::factory(40)->create();
    }
}
