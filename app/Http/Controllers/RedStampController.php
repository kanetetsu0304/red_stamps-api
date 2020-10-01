<?php

namespace App\Http\Controllers;

use App\RedStamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Sanctuary;
// use Illuminate\Support\Facades\Log as FacadesLog;
// use Log;

class RedStampController extends Controller
{
    public function store(Request $request)
    {
        $redstamp = new RedStamp();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_redstamp_' . $image->getClientOriginalName();
            $image->storeAs('/public', $fileName);
            $redstamp->image_url = 'storage/' . $fileName;
        }
        $redstamp->comment = $request->comment;
        $redstamp->date = $request->date;
        $redstamp->user_id = Auth::id();
        $redstamp->sanctuary_id = $request->sanctuary_id;
        $redstamp->save();
        return $redstamp;
    }

    public function index()
    {
        return RedStamp::with('user', 'sanctuary.prefecture')->where('user_id', Auth::id())->orderBy('date', 'desc')->get();
    }
    public function indexAsc()
    {
        return RedStamp::with('user', 'sanctuary.prefecture')->where('user_id', Auth::id())->orderBy('date', 'asc')->get();
    }

    // $posts = Post::with(['user'])
    // ->whereHas('user', function ($query) use ($user) {
    //     $query->where('name', $user->name);
    // })
    // ->get();

    // public function indexAreaAsc()
    // {
    //    return RedStamp::with(['user','sanctuary.prefecture'])
    //    ->whereHas('sanctuary', function($query) {
    //     $query->orderBy('city', 'asc')->orderBy('prefecture_id', 'asc');
    //    })
    //   ->get();
    // }
    public function indexTokyo($id)
    {
        return RedStamp::with('user', 'sanctuary.prefecture')->where('user_id', $id)->whereHas('sanctuary.prefecture', function($query){
            $query->where('prefecture_id',13)->orderBy('city','asc');
        })->get();
    }

    public function indexKyoto($id)
    {
        return RedStamp::with('user', 'sanctuary.prefecture')->where('user_id', $id)->whereHas('sanctuary.prefecture', function($query){
            $query->where('prefecture_id',26)->orderBy('city','asc');
        })->get();
    }
    // public function indexAreaAsc()
    // {
    //     RedStamp::join('sanctuaries', 'red_stamps.sanctuary_id', 'sanctuaries.id')
    //     ->where('sanctuaries.id', '=', 1)
    //     ->select('sanctuaries.*')
    //     ->distinct()
    //     ->get();
    // }
//     // }
//     $employees = \DB::table('employees')
//   ->join('depts','employees.dept_id','=','depts.dept_id')
//   ->get();

    // public function indexUsersAsc($id)
    // {
    //     $sanctuary = Sanctuary::whereHas('red_stamps', function ($query) use($id){
    //         $query->where('user_id',$id);
    //     })->orderBy('prefecture_id', 'asc')->orderBy('city', 'asc')->get();
    //     return $sanctuary;
    // }

    public function indexAreaDesc()
    {
        return RedStamp::with('user', 'sanctuary.prefecture')->where('user_id', Auth::id())->orderBy('prefecture_id', 'desc')->get();
    }

    public function usersIndex($id)
    {
        return RedStamp::with('user', 'sanctuary.prefecture')->where('user_id', $id)->orderBy('date', 'desc')->get();
    }

    public function usersIndexAsc($id)
    {
        return RedStamp::with('user', 'sanctuary.prefecture')->where('user_id', $id)->orderBy('date', 'asc')->get();
    }

    public function show(string $id)
    {
        $redstamp = RedStamp::with('user', 'sanctuary.prefecture')->where('user_id', Auth::id())->where('id', $id)->first();

        return $redstamp ?? abort(404);
    }

    public function usersShow(string $userId, string $id)
    {
        $redstamp = RedStamp::with('user', 'sanctuary.prefecture')->where('user_id', $userId)->where('id', $id)->first();

        return $redstamp ?? abort(404);
    }


    public function update(Request $request, $id)
    {
        $redstamp = RedStamp::find($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_redstamp_' . $image->getClientOriginalName();
            $image->storeAs('/public', $fileName);
            $redstamp->image_url = 'storage/' . $fileName;
        }
        $redstamp->comment = $request->comment;
        $redstamp->date = $request->date;
        $redstamp->user_id = Auth::id();
        $redstamp->sanctuary_id = $request->sanctuary_id;
        $redstamp->save();
        return $redstamp;
    }

    public function destroy($id)
    {
        $redstamp = RedStamp::find($id);
        $redstamp->delete();
    }
}
