<?php

namespace Database\Seeders;

use App\Models\Challenge;
use Illuminate\Database\Seeder;

class ChallengeSeeder extends Seeder
{
    public function run(): void
    {
        $challenges = [
            // EASY
            [
                'title' => 'Drink Water',
                'description' => 'Drink a full glass of water and write how you feel after.',
                'difficulty' => 'easy',
                'xp_reward' => 10,
            ],
            [
                'title' => 'Clean Your Desk',
                'description' => 'Clean your desk or study space and describe what you organized.',
                'difficulty' => 'easy',
                'xp_reward' => 10,
            ],
            [
                'title' => 'No Phone for 15 Minutes',
                'description' => 'Put your phone away for 15 minutes and focus on one task.',
                'difficulty' => 'easy',
                'xp_reward' => 10,
            ],
            [
                'title' => 'Read 3 Pages',
                'description' => 'Read at least 3 pages from a book, course, or article.',
                'difficulty' => 'easy',
                'xp_reward' => 10,
            ],
            [
                'title' => 'Write Today’s Goal',
                'description' => 'Write one clear goal you want to complete today.',
                'difficulty' => 'easy',
                'xp_reward' => 10,
            ],

            // MEDIUM
            [
                'title' => '25-Minute Study Sprint',
                'description' => 'Study for 25 minutes without distractions and write what you learned.',
                'difficulty' => 'medium',
                'xp_reward' => 20,
            ],
            [
                'title' => '10 Push-ups or Squats',
                'description' => 'Do 10 push-ups or 10 squats and submit a short proof.',
                'difficulty' => 'medium',
                'xp_reward' => 20,
            ],
            [
                'title' => 'Fix One Small Problem',
                'description' => 'Fix one small problem in your room, code, homework, or daily routine.',
                'difficulty' => 'medium',
                'xp_reward' => 20,
            ],
            [
                'title' => 'Learn 5 New Words',
                'description' => 'Learn 5 new words in English or French and write them down.',
                'difficulty' => 'medium',
                'xp_reward' => 20,
            ],
            [
                'title' => 'Plan Tomorrow',
                'description' => 'Write a simple plan for tomorrow with at least 3 tasks.',
                'difficulty' => 'medium',
                'xp_reward' => 20,
            ],

            // HARD
            [
                'title' => '60-Minute Deep Work',
                'description' => 'Work for 60 minutes on an important task with no distraction.',
                'difficulty' => 'hard',
                'xp_reward' => 35,
            ],
            [
                'title' => 'Workout Challenge',
                'description' => 'Do a 20-minute workout and write what exercises you completed.',
                'difficulty' => 'hard',
                'xp_reward' => 35,
            ],
            [
                'title' => 'Complete a Homework Task',
                'description' => 'Finish one real homework task or project task and explain what you did.',
                'difficulty' => 'hard',
                'xp_reward' => 35,
            ],
            [
                'title' => 'No Social Media for 2 Hours',
                'description' => 'Avoid social media for 2 hours and write what you did instead.',
                'difficulty' => 'hard',
                'xp_reward' => 35,
            ],
            [
                'title' => 'Build Something Small',
                'description' => 'Create or improve something small: code, design, notes, or a useful document.',
                'difficulty' => 'hard',
                'xp_reward' => 35,
            ],
        ];

        foreach ($challenges as $challenge) {
            Challenge::updateOrCreate(
                ['title' => $challenge['title']],
                $challenge
            );
        }
    }
}