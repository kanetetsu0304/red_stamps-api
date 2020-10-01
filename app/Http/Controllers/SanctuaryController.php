<?php

namespace App\Http\Controllers;

use App\Sanctuary;
use Illuminate\Http\Request;

class SanctuaryController extends Controller
{
    public function indexAsc()
    {
        return Sanctuary::with('prefecture')->orderBy('prefecture_id', 'asc')->orderBy('city', 'asc')->get();
    }

    public function indexDesc()
    {
        return Sanctuary::with('prefecture')->orderBy('prefecture_id', 'desc')->orderBy('city', 'desc')->get();
    }

    public function indexTokyo()
    {
        return Sanctuary::with('prefecture')->where('prefecture_id', 13)->orderBy('city', 'asc')->get();
    }

    public function indexKyoto()
    {
        return Sanctuary::with('prefecture')->where('prefecture_id', 26)->orderBy('city', 'asc')->get();
    }


    // public function usersIndexAsc($id)
    // {
    //     $sanctuary = Sanctuary::whereHas('red_stamps', function ($query) use($id){
    //         $query->where('user_id',$id)->with('user', 'sanctuary.prefecture');
    //     })->orderBy('prefecture_id', 'asc')->orderBy('city', 'asc')->get();
    //     return $sanctuary;
    // }

    // public function usersIndexDesc($id)
    // {
    //     $sanctuary = Sanctuary::whereHas('red_stamps', function ($query) use($id){
    //         $query->where('user_id',$id);
    //     })->orderBy('prefecture_id', 'desc')->orderBy('city', 'asc')->get();
    //     return $sanctuary;
    // }
    // public function indexUsersAsc()
    // {
    //     return Sanctuary::whereHas('redstamps', function ($query) {
    //         $query->where('user_id',3);
    //     })->get();
    // }
    //     public function indexUsersAsc($id)
    //     {
    //         return Sanctuary::with('prefecture')->where('user_id',$id)->orderBy('prefecture_id', 'asc')->orderBy('city', 'asc')->get();
    //     }

    public function usersIndexAsc($id)
    {
        Sanctuary::join('red_stamps', 'sanctuaries.id', 'red_stamps.sanctuary_id')
        ->where('red_stamps.user_id', '=', $id)
        ->select('sanctuaries.*')
        ->distinct()
        ->get();
    }
}
