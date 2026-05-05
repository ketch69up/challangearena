<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Challenge;
use App\Models\CommunityChallenge;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return response()->json([
            'users' => User::count(),
            'official_challenges' => Challenge::count(),
            'community_challenges' => CommunityChallenge::count(),
            'pending_community_challenges' => CommunityChallenge::where('status', 'pending')->count(),
            'approved_community_challenges' => CommunityChallenge::where('status', 'approved')->count(),
        ]);
    }

    public function users()
    {
        return response()->json(
            User::select('id', 'name', 'email', 'xp', 'level', 'energy', 'is_admin', 'created_at')
                ->orderBy('created_at', 'desc')
                ->get()
        );
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        if ($user->is_admin) {
            return response()->json(['message' => 'You cannot delete an admin user.'], 403);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully.']);
    }

    public function challenges()
    {
        return response()->json(
            Challenge::orderBy('created_at', 'desc')->get()
        );
    }

    public function createChallenge(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:5',
            'difficulty' => 'required|string|in:easy,medium,hard',
            'xp_reward' => 'required|integer|min:1|max:500',
        ]);

        $challenge = Challenge::create($data);

        return response()->json([
            'message' => 'Official challenge created.',
            'challenge' => $challenge,
        ]);
    }

    public function updateChallenge(Request $request, $id)
    {
        $challenge = Challenge::find($id);

        if (!$challenge) {
            return response()->json(['message' => 'Challenge not found.'], 404);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:5',
            'difficulty' => 'required|string|in:easy,medium,hard',
            'xp_reward' => 'required|integer|min:1|max:500',
        ]);

        $challenge->update($data);

        return response()->json([
            'message' => 'Challenge updated.',
            'challenge' => $challenge,
        ]);
    }

    public function deleteChallenge($id)
    {
        $challenge = Challenge::find($id);

        if (!$challenge) {
            return response()->json(['message' => 'Challenge not found.'], 404);
        }

        $challenge->delete();

        return response()->json(['message' => 'Challenge deleted.']);
    }

    public function communityChallenges()
    {
        return response()->json(
            CommunityChallenge::orderBy('likes', 'desc')
                ->orderBy('created_at', 'desc')
                ->get()
        );
    }

    public function approveCommunityChallenge($id)
    {
        $community = CommunityChallenge::find($id);

        if (!$community) {
            return response()->json(['message' => 'Community challenge not found.'], 404);
        }

        $creator = User::find($community->user_id);
        $creatorName = $creator ? $creator->name : 'Unknown Player';

        $officialTitle = $community->title . ' by ' . $creatorName;

        $community->status = 'approved';
        $community->save();

        $challenge = Challenge::updateOrCreate(
            ['title' => $officialTitle],
            [
                'description' => $community->description,
                'difficulty' => $community->difficulty,
                'xp_reward' => $community->xp_reward ?? 10,
            ]
        );

        return response()->json([
            'message' => 'Community challenge approved and added as official.',
            'challenge' => $challenge,
        ]);
    }

    public function deleteCommunityChallenge($id)
    {
        $community = CommunityChallenge::find($id);

        if (!$community) {
            return response()->json(['message' => 'Community challenge not found.'], 404);
        }

        $community->delete();

        return response()->json(['message' => 'Community challenge deleted.']);
    }
}