<?php

namespace App\Http\Controllers;

use App\RedStampBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedStampBookController extends Controller
{
    public function store(Request $request)
    {
        $redstampBook = new RedStampBook();
        if ($request->hasFile('front_image')) {
            $image = $request->file('front_image');
            $fileName = time() . '_redstampbook_' . $image->getClientOriginalName();
            $image->storeAs('/public', $fileName);
            $redstampBook->front_image_url = 'storage/' . $fileName;
        }
        if ($request->hasFile('back_image')) {
            $image = $request->file('back_image');
            $fileName = time() . '_redstampbook_' . $image->getClientOriginalName();
            $image->storeAs('/public', $fileName);
            $redstampBook->back_image_url = 'storage/' . $fileName;
        }
        $redstampBook->introduce = $request->introduce;
        $redstampBook->user_id = Auth::id();
        $redstampBook->sanctuary_id = $request->sanctuary_id;
        $redstampBook->save();
        return $redstampBook;
    }

    public function update(Request $request, $id)
    {
        $redstampBook = RedStampBook::find($id);
        if ($request->hasFile('front_image')) {
            $image = $request->file('front_image');
            $fileName = time() . '_redstampbook_' . $image->getClientOriginalName();
            $image->storeAs('/public', $fileName);
            $redstampBook->front_image_url = 'storage/' . $fileName;
        }
        if ($request->hasFile('back_image')) {
            $image = $request->file('back_image');
            $fileName = time() . '_redstampbook_' . $image->getClientOriginalName();
            $image->storeAs('/public', $fileName);
            $redstampBook->back_image_url = 'storage/' . $fileName;
        }
        $redstampBook->introduce = $request->introduce;
        $redstampBook->user_id = Auth::id();
        $redstampBook->sanctuary_id = $request->sanctuary_id;
        $redstampBook->save();
        return $redstampBook;
    }

    public function index()
    {
        return RedStampBook::with('user', 'sanctuary.prefecture')->where('user_id', Auth::id())->get();
    }

    public function usersIndex($id)
    {
        return RedStampBook::with('user', 'sanctuary.prefecture')->where('user_id', $id)->get();
    }
}
