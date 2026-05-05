<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Challenge;

class ChallengeSeeder extends Seeder
{
    public function run(): void
    {
        $challenges = [
            // EASY - 10 XP
            [
                'title' => 'Send a random emoji',
                'description' => 'Send a random emoji to 3 contacts and see their reaction.',
                'difficulty' => 'easy',
                'xp_reward' => 10,
                'is_verified' => true,
            ],
            [
                'title' => 'Drink water',
                'description' => 'Drink a full glass of water right now.',
                'difficulty' => 'easy',
                'xp_reward' => 10,
                'is_verified' => true,
            ],
            [
                'title' => 'Clean your desk',
                'description' => 'Clean or organize your desk for 5 minutes.',
                'difficulty' => 'easy',
                'xp_reward' => 10,
                'is_verified' => true,
            ],
            [
                'title' => 'Compliment someone',
                'description' => 'Give a genuine compliment to someone today.',
                'difficulty' => 'easy',
                'xp_reward' => 10,
                'is_verified' => true,
            ],
            [
                'title' => 'Mirror confidence',
                'description' => 'Look in the mirror and say: I can do this.',
                'difficulty' => 'easy',
                'xp_reward' => 10,
                'is_verified' => true,
            ],
            [
                'title' => 'One minute stretch',
                'description' => 'Stand up and stretch your body for one minute.',
                'difficulty' => 'easy',
                'xp_reward' => 10,
                'is_verified' => true,
            ],
            [
                'title' => 'Write 3 goals',
                'description' => 'Write down 3 small goals you want to complete this week.',
                'difficulty' => 'easy',
                'xp_reward' => 10,
                'is_verified' => true,
            ],
            [
                'title' => 'No phone for 5 minutes',
                'description' => 'Put your phone away for 5 minutes.',
                'difficulty' => 'easy',
                'xp_reward' => 10,
                'is_verified' => true,
            ],
            [
                'title' => 'Thank someone',
                'description' => 'Send a thank-you message to someone who helped you.',
                'difficulty' => 'easy',
                'xp_reward' => 10,
                'is_verified' => true,
            ],
            [
                'title' => 'Funny wallpaper',
                'description' => 'Change your phone wallpaper to something funny for 30 minutes.',
                'difficulty' => 'easy',
                'xp_reward' => 10,
                'is_verified' => true,
            ],

            // MEDIUM - 20 XP
            [
                'title' => 'Talk to someone new',
                'description' => 'Start a short conversation with someone you do not usually talk to.',
                'difficulty' => 'medium',
                'xp_reward' => 20,
                'is_verified' => true,
            ],
            [
                'title' => 'Do 15 squats',
                'description' => 'Do 15 squats or 10 push-ups.',
                'difficulty' => 'medium',
                'xp_reward' => 20,
                'is_verified' => true,
            ],
            [
                'title' => 'Learn for 15 minutes',
                'description' => 'Spend 15 minutes learning something useful.',
                'difficulty' => 'medium',
                'xp_reward' => 20,
                'is_verified' => true,
            ],
            [
                'title' => 'Walk without phone',
                'description' => 'Walk for 10 minutes without using your phone.',
                'difficulty' => 'medium',
                'xp_reward' => 20,
                'is_verified' => true,
            ],
            [
                'title' => 'Voice message',
                'description' => 'Send a voice message instead of a normal text.',
                'difficulty' => 'medium',
                'xp_reward' => 20,
                'is_verified' => true,
            ],
            [
                'title' => 'Speak another language',
                'description' => 'Try speaking only English or French for 10 minutes.',
                'difficulty' => 'medium',
                'xp_reward' => 20,
                'is_verified' => true,
            ],
            [
                'title' => 'Clean one area',
                'description' => 'Clean one small area of your room.',
                'difficulty' => 'medium',
                'xp_reward' => 20,
                'is_verified' => true,
            ],
            [
                'title' => 'Post positivity',
                'description' => 'Post or send something positive today.',
                'difficulty' => 'medium',
                'xp_reward' => 20,
                'is_verified' => true,
            ],
            [
                'title' => 'Ask about someone’s day',
                'description' => 'Ask someone how their day is and actually listen.',
                'difficulty' => 'medium',
                'xp_reward' => 20,
                'is_verified' => true,
            ],
            [
                'title' => 'Plan tomorrow',
                'description' => 'Write a simple plan for tomorrow.',
                'difficulty' => 'medium',
                'xp_reward' => 20,
                'is_verified' => true,
            ],

            // HARD - 40 XP
            [
                'title' => 'One hour without social media',
                'description' => 'Avoid Instagram, TikTok, Facebook, and X for one full hour.',
                'difficulty' => 'hard',
                'xp_reward' => 40,
                'is_verified' => true,
            ],
            [
                'title' => 'Wake up earlier',
                'description' => 'Wake up 1 hour earlier than usual tomorrow.',
                'difficulty' => 'hard',
                'xp_reward' => 40,
                'is_verified' => true,
            ],
            [
                'title' => 'Ask for feedback',
                'description' => 'Ask someone for honest feedback about something you do.',
                'difficulty' => 'hard',
                'xp_reward' => 40,
                'is_verified' => true,
            ],
            [
                'title' => 'Random act of kindness',
                'description' => 'Help someone today without expecting anything back.',
                'difficulty' => 'hard',
                'xp_reward' => 40,
                'is_verified' => true,
            ],
            [
                'title' => 'Record a short video',
                'description' => 'Record a short video talking about your day or your goal.',
                'difficulty' => 'hard',
                'xp_reward' => 40,
                'is_verified' => true,
            ],
            [
                'title' => 'Walk 25 minutes',
                'description' => 'Go outside and walk for 25 minutes.',
                'difficulty' => 'hard',
                'xp_reward' => 40,
                'is_verified' => true,
            ],
            [
                'title' => 'No complaining challenge',
                'description' => 'Do not complain for 1 full hour.',
                'difficulty' => 'hard',
                'xp_reward' => 40,
                'is_verified' => true,
            ],
            [
                'title' => 'Try something new',
                'description' => 'Do one safe thing you usually avoid because it feels uncomfortable.',
                'difficulty' => 'hard',
                'xp_reward' => 40,
                'is_verified' => true,
            ],
            [
                'title' => 'Deep reflection',
                'description' => 'Write one mistake you made and what you learned from it.',
                'difficulty' => 'hard',
                'xp_reward' => 40,
                'is_verified' => true,
            ],
            [
                'title' => 'Full weekly plan',
                'description' => 'Write a full plan for your next 7 days.',
                'difficulty' => 'hard',
                'xp_reward' => 40,
                'is_verified' => true,
            ],
        ];

        foreach ($challenges as $challenge) {
            Challenge::create($challenge);
        }
    }
}