<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testUser = User::where('email', 'test@test.com')->firstOrFail();
        $jobIds = Job::pluck('id')->toArray();
        $randomJobIds = array_rand($jobIds, 3);
        foreach ($randomJobIds as $jobId) {
            $testUser->bookMarkedJobs()->attach($jobId);
        }
    }
}
