<?php

namespace App\Http\Controllers;

use App\RedStamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log as FacadesLog;
use Log;

class RedStampController extends Controller
{
    public function store(Request $request)
    {
        // if (request()->file) {
        //     $file_name =  request()->file->getClientOriginalName();
        //     request()->file->storeAs('public', $file_name);

        $redstamp = new RedStamp();
        // $redstamp->user_id = $request->user_id;
        // $redstamp->sanctuary_id = $request->sanctuary_id;
        // $redstamp->date = $request->date;
        // $redstamp->comment = $request->comment;
        // $redstamp->image_url = $request->image_url;
        // $redstamp->save();
        // return response()->json($redstamp);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_redstamp_' . $image->getClientOriginalName();
            $image->storeAs('/public', $fileName);
            $redstamp->image_url = 'storage/' . $fileName;
        }

        // 付帯情報の設定
        $redstamp->comment = $request->comment;
        $redstamp->date = $request->date;
        $redstamp->user_id = Auth::id();
        $redstamp->sanctuary_id = $request->sanctuary_id;

        // 保存の実行
        $redstamp->save();

        return $redstamp;
        // }
    }

    public function index()
    {
        return RedStamp::with('user', 'sanctuary')->where('user_id', Auth::id())->orderBy('date', 'desc')->get();
    }

    public function usersIndex($id)
    {
        return RedStamp::with('user', 'sanctuary')->where('user_id', $id)->orderBy('date', 'desc')->get();
    }

    public function show(string $id)
    {
        $redstamp = RedStamp::with('user', 'sanctuary')->where('user_id', Auth::id())->where('id', $id)->with('user', 'sanctuary')->first();

        return $redstamp ?? abort(404);
    }

    public function usersShow(string $userId,string $id)
    {
        $redstamp = RedStamp::with('user', 'sanctuary')->where('user_id', $userId)->where('id', $id)->with('user', 'sanctuary')->first();

        return $redstamp ?? abort(404);
    }

    
    public function update(Request $request, $id)
    {
        // Log::debug($request);
        // $h = "こんにちは";
        // Log::debug($h);
        $redstamp = RedStamp::find($id);
        $redstamp->user_id = $request->user_id;
        $redstamp->sanctuary_id = $request->sanctuary_id;
        $redstamp->date = $request->date;
        $redstamp->comment = $request->comment;
        $redstamp->image_url = $request->image_url;
        $redstamp->save();
        return $redstamp;
    }

    public function destroy($id)
    {
        $redstamp = RedStamp::find($id);
        $redstamp->delete();
    }
}
