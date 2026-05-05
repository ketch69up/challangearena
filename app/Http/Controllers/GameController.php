<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Challenge;
use App\Models\UserChallenge;
use App\Models\CommunityChallenge;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GameController extends Controller
{
    private function refreshEnergy(User $user)
    {
        if (!$user->last_energy_update) {
            $user->last_energy_update = now();
            $user->save();
            return $user;
        }

        if ($user->energy >= 5) {
            return $user;
        }

        $lastUpdate = Carbon::parse($user->last_energy_update);
        $minutesPassed = $lastUpdate->diffInMinutes(now());

        $energyToAdd = floor($minutesPassed / 20);

        if ($energyToAdd > 0) {
            $user->energy = min(5, $user->energy + $energyToAdd);
            $user->last_energy_update = $lastUpdate->addMinutes($energyToAdd * 20);
            $user->save();
        }

        return $user;
    }

    public function profile($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user = $this->refreshEnergy($user);

        return response()->json($user);
    }

    public function skipChallenge($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user = $this->refreshEnergy($user);

        if (!$user->first_skip_used) {
            $user->first_skip_used = true;
            $user->save();

            return response()->json([
                'message' => 'First skip is free',
                'energy' => $user->energy
            ]);
        }

        if ($user->energy <= 0) {
            return response()->json([
                'message' => 'No energy left'
            ], 403);
        }

        $user->energy -= 1;
        $user->last_energy_update = now();
        $user->save();

        return response()->json([
            'message' => 'Challenge skipped',
            'energy' => $user->energy
        ]);
    }

    public function submitProof(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'challenge_id' => 'required|exists:challenges,id',
            'proof_text' => 'required|string|min:5',
        ]);

        $user = User::find($validated['user_id']);
        $challenge = Challenge::find($validated['challenge_id']);

        $submission = UserChallenge::create([
            'user_id' => $user->id,
            'challenge_id' => $challenge->id,
            'status' => 'done',
            'proof_text' => $validated['proof_text'],
            'proof_image' => null,
            'is_validated' => true,
        ]);

        $user->xp += $challenge->xp_reward;
        $user->level = floor($user->xp / 100) + 1;
        $user->save();

        return response()->json([
            'message' => 'Proof submitted. Challenge completed!',
            'submission' => $submission,
            'xp' => $user->xp,
            'level' => $user->level,
            'reward' => $challenge->xp_reward,
        ]);
    }

    public function completeChallenge($challengeId, $userId)
    {
        $user = User::find($userId);
        $challenge = Challenge::find($challengeId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (!$challenge) {
            return response()->json(['message' => 'Challenge not found'], 404);
        }

        $user->xp += $challenge->xp_reward;
        $user->level = floor($user->xp / 100) + 1;
        $user->save();

        return response()->json([
            'message' => 'Challenge completed',
            'xp' => $user->xp,
            'level' => $user->level
        ]);
    }

    public function leaderboard()
    {
        $users = User::orderBy('xp', 'desc')
            ->select('id', 'name', 'xp', 'level', 'avatar', 'avatar_color')
            ->get();

        return response()->json($users);
    }

    public function suggestCommunityChallenge(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'difficulty' => 'required|in:easy,medium,hard',
        ]);

        $xpReward = match ($validated['difficulty']) {
            'easy' => 10,
            'medium' => 20,
            'hard' => 40,
            default => 10,
        };

        $communityChallenge = CommunityChallenge::create([
            'user_id' => $validated['user_id'] ?? null,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'difficulty' => $validated['difficulty'],
            'xp_reward' => $xpReward,
            'likes' => 0,
            'dislikes' => 0,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Community challenge submitted',
            'challenge' => $communityChallenge
        ]);
    }

    public function communityChallenges()
    {
        $challenges = CommunityChallenge::orderBy('likes', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($challenges);
    }

    public function voteCommunityChallenge($id, $vote)
    {
        $communityChallenge = CommunityChallenge::find($id);

        if (!$communityChallenge) {
            return response()->json(['message' => 'Community challenge not found'], 404);
        }

        if ($vote === 'like') {
            $communityChallenge->likes += 1;
        } elseif ($vote === 'dislike') {
            $communityChallenge->dislikes += 1;
        } else {
            return response()->json(['message' => 'Invalid vote'], 400);
        }

        if ($communityChallenge->likes >= 40 && $communityChallenge->status !== 'approved') {
            Challenge::create([
                'title' => $communityChallenge->title,
                'description' => $communityChallenge->description,
                'difficulty' => $communityChallenge->difficulty,
                'xp_reward' => $communityChallenge->xp_reward,
                'is_verified' => true,
            ]);

            $communityChallenge->status = 'approved';
        }

        $communityChallenge->save();

        return response()->json([
            'message' => 'Vote saved',
            'challenge' => $communityChallenge
        ]);
    }
}