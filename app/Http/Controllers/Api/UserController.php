<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Dish;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @param Request
     */
    public function index()
    {
        $users = User::with('categories')->get();
        foreach ($users as $user) {
            if ($user->image) {
                $user->image = url('storage/' . $user->image);
            }
        }
        return response()->json([
            'success' => true,
            'results' => $users
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::where('slug', '=', $slug)->with(['categories', 'dishes'])->first();
        $dishes = Dish::where('user_id', '=', $user['id'])->get();
        if ($user) {
            if ($user->image) {
                $user->image = url('storage/' . $user->image);
            }

            foreach ($dishes as $dish) {
                if ($dish->image) {
                    $dish->image = url('storage/' . $dish->image);
                }
            }

            return response()->json([
                'success' => true,
                "results" => [
                    "user" => $user,
                    "dishes" => $dishes
                ]
            ]);
        }
    }

    // funzione di filtraggio lato server 

    public function ricerca(Request $request)
    {

        $str = json_decode($request->str);
        sort($str);

        // dd( 'variabile interna', $str);

        // $ristoranti = User::with('categories');
        if (count($str) == 0) {
            $ristoranti = User::with('categories')->get();
            foreach ($ristoranti as $user) {
                if ($user->image) {
                    $user->image = url('storage/' . $user->image);
                }
            }
            return response()->json([
                'success' => true,
                'results' => $ristoranti,
                'controllo' => 1
            ]);
        }
        $ristoranti = User::whereHas('categories', function ($q) use ($str) {
            $q->whereIn('id', $str);
        })->get();
        foreach ($ristoranti as $user) {
            if ($user->image) {
                $user->image = url('storage/' . $user->image);
            }
        }

        return response()->json([
            'success' => true,
            'results' => $ristoranti,
            'controllo2' => 2
        ]);
    }
}
