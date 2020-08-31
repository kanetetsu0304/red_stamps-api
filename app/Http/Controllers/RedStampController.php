<?php

namespace App\Http\Controllers;

use App\RedStamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedStampController extends Controller
{
    public function store(Request $request)
    {
        if (request()->file) {
            $file_name =  request()->file->getClientOriginalName();
            request()->file->storeAs('public', $file_name);

            $redstamp = new RedStamp();
            $redstamp->user_id = $request->user_id;
            $redstamp->sanctuary_id = $request->sanctuary_id;
            $redstamp->date = $request->date;
            $redstamp->comment = $request->comment;
            $redstamp->image_url = 'storage/' . $file_name;
            $redstamp->save();
            return response()->json($redstamp);
        }
    }

    public function index()
    {
        return RedStamp::with('user', 'sanctuary')->where('user_id', Auth::id())->orderBy('date', 'desc')->get();
    }

    public function show(string $id)
    {
        $redstamp = RedStamp::where('id', $id)->with('user', 'sanctuary')->where('user_id', Auth::id())->first();

        return $redstamp ?? abort(404);
    }

    public function destroy($id)
    {
        $redstamp = RedStamp::find($id);
        $redstamp->delete();
    }
}
