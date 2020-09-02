<?php

namespace App\Http\Controllers;


use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function store(Request $request)
    {
        $follow = new Follow();
        $follow->user_id = $request->user_id;
        $follow->follow_user_id = $request->follow_user_id;
        $follow->save();
        return response()->json($follow);
    }

    public function destroy($id)
    {
        $redstamp = Follow::find($id);
        $redstamp->delete();
    }

    public function followings(string $id)
    {
       return Follow::where('user_id', $id)->get();

    }
    
    public function followers(string $id)
    {
       return Follow::where('follow_user_id', $id)->get();
    }


}