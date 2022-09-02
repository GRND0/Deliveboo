<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('categories')->get();
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
        dd($slug);
        $user = User::with('categories', 'dishes')->findOrFail($slug);
        return response()->json($user);

        $user = User::where('slug', '=', $slug)->with(['category'])->first();
        if ($user) {
            return response()->json([
                'success' => true,
                'results' => $user 
            ]);
        }
        return response()->json([
            'success' => false,
            'error' => 'nessun user corrispondente'                      
        ]);
    }
}