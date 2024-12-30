<?php

namespace Database\Seeders;

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
        DB::table('users')->truncate();
        DB::table('job_listings')->truncate();
        DB::table('job_user_bookmarks')->truncate();
        DB::table('applicants')->truncate();
        // order matters! (because we need user to be created first so that we can assign user's id to the job)
        $this->call(TestUserSeeder::class);
        $this->call(RandomUserSeeder::class);
        $this->call(Jobseeder::class);
        $this->call(BookmarkSeeder::class);
    }
}
