<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Jobseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobListings = include database_path('seeders/data/job_listings.php');
        $testUserId = User::where('email', 'test@test.com')->value('id');
        $userIds = User::where('email', '!=', 'test@test.com')->pluck('id')->toArray();
        // it has to be "&$job" in the foreach, if you ignore the "&" then the $jobListings array will remain unchanged
        foreach ($jobListings as $index => &$job) {
            if ($index < 2) {
                $job['user_id'] = $testUserId;
            } else {
                $job['user_id'] = $userIds[array_rand($userIds)];
            }
            $job['created_at'] = now();
            $job['updated_at'] = now();
        }
        DB::table('job_listings')->insert($jobListings);
        echo 'Jobs created';
    }
}
