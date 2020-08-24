<?php

namespace App\Http\Controllers;

use App\RedStamp;
use Illuminate\Http\Request;

class RedStampController extends Controller
{
    public function store(Request $request)
    {
        $redstamp = new RedStamp();
        $redstamp->user_id = $request->user_id;
        $redstamp->sanctuary_id = $request->sanctuary_id;
        $redstamp->date = $request->date;
        $redstamp->comment = $request->comment;
        $redstamp->image_url = $request->image_url;
        $redstamp->save();
        return response()->json($redstamp);
    }

    public function index()
    {
        return RedStamp::with('user', 'sanctuary')->orderBy('created_at', 'asc')->get();
    }

    public function show(string $id)
    {
        $redstamp = RedStamp::where('id', $id)->with('user', 'sanctuary')->first();

        return $redstamp ?? abort(404);
    }

    public function destroy($id)
    {
        $redstamp = RedStamp::find($id);
        $redstamp->delete();
    }
}
