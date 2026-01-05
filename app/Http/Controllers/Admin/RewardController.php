<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyChallenge;

class RewardController extends Controller
{
   
public function dailyChallenges()
{
    $challenges = DailyChallenge::latest()->paginate(10);
    return view('admin.daily_challenge', compact('challenges'));
}

public function createDailyChallenge()
{
    return view('admin.create-challenge');
}

public function storeDailyChallenge(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'reward_points' => 'required|integer',
        'active_date' => 'required|date',
        'status' => 'required',
    ]);

    DailyChallenge::create($request->all());

    return redirect()
        ->route('admin.daily-challenges') 
        ->with('success', 'Daily challenge created successfully');
}

public function deleteDailyChallenge($id)
{
    DailyChallenge::findOrFail($id)->delete();

    return redirect()
        ->route('admin.daily_challenges')
        ->with('success', 'Daily challenge deleted');
}
    public function spinWin() 
    { 
        return view('admin.spin_win');
     } public function scratchCards() 
     { 
        return view('admin.scratch_card'); 
    } 
    public function rewardRules() 
    {
         return view('admin.reward'); 
        } }