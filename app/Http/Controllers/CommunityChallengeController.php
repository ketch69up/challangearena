<?php

namespace App\Http\Controllers;

use App\Models\CommunityChallenge;
use App\Models\CommunityChallengeVote;
use Illuminate\Http\Request;

class CommunityChallengeController extends Controller
{
    public function index()
    {
        $challenges = CommunityChallenge::orderBy('likes', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($challenges);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'difficulty' => 'required|string|in:easy,medium,hard',
        ]);

        $xpReward = match ($data['difficulty']) {
            'easy' => 10,
            'medium' => 20,
            'hard' => 35,
            default => 10,
        };

        $challenge = CommunityChallenge::create([
            'user_id' => $user->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'difficulty' => $data['difficulty'],
            'xp_reward' => $xpReward,
            'likes' => 0,
            'dislikes' => 0,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Community challenge submitted!',
            'challenge' => $challenge,
        ]);
    }

    public function vote(Request $request, $id)
    {
        $user = $request->user();

        $data = $request->validate([
            'vote' => 'required|string|in:like,dislike',
        ]);

        $challenge = CommunityChallenge::find($id);

        if (!$challenge) {
            return response()->json([
                'message' => 'Community challenge not found.',
            ], 404);
        }

        if ((int) $challenge->user_id === (int) $user->id) {
            return response()->json([
                'message' => 'You cannot vote on your own challenge.',
            ], 403);
        }

        $existingVote = CommunityChallengeVote::where('user_id', $user->id)
            ->where('community_challenge_id', $challenge->id)
            ->first();

        if (!$existingVote) {
            CommunityChallengeVote::create([
                'user_id' => $user->id,
                'community_challenge_id' => $challenge->id,
                'vote' => $data['vote'],
            ]);

            if ($data['vote'] === 'like') {
                $challenge->likes += 1;
            } else {
                $challenge->dislikes += 1;
            }

            $challenge->save();

            return response()->json([
                'message' => 'Vote saved!',
                'challenge' => $challenge,
            ]);
        }

        if ($existingVote->vote === $data['vote']) {
            return response()->json([
                'message' => 'You already voted this.',
                'challenge' => $challenge,
            ]);
        }

        if ($existingVote->vote === 'like' && $data['vote'] === 'dislike') {
            $challenge->likes = max(0, $challenge->likes - 1);
            $challenge->dislikes += 1;
        }

        if ($existingVote->vote === 'dislike' && $data['vote'] === 'like') {
            $challenge->dislikes = max(0, $challenge->dislikes - 1);
            $challenge->likes += 1;
        }

        $existingVote->vote = $data['vote'];
        $existingVote->save();

        $challenge->save();

        return response()->json([
            'message' => 'Vote changed!',
            'challenge' => $challenge,
        ]);
    }
}