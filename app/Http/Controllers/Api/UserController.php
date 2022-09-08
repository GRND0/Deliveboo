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
            }}

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

        public function ricerca(Request $request) {
            $str = $request->str;
            dd($str);

            $users = User::with('categories');
            if (!$str) $users->get();
            return response()->json([
                'success' => true,
                'results' => $users                      
            ]);  
                $users->whereHas('categories', function($q) use($str)
                {
                    $q->where('category_id', $str);
                });
            $users->get();
            return response()->json([
                'success' => true,
                'results' => $users                      
            ]);                     
        }








    //   public function ricerca(Request $request) {
        
    //       $data = User::with('categories')->wherePivot('category_id','='.$request->input('id'))->get();
        
    //       return response()->json([
    //           'success' => true,
    //          'results' => $data
    //       ]);
    //   }

    // public function ricerca(Request $request) { 
    //     $users = [];
    //     $categories_id = $request->id;
    //     dd('dati', $request);
    //     if ($categories_id == 'null') {
    //         $users = User::all();
    //     } else {
    //         $categories_as_array = explode(',', $categories_id);
    //         $counter = count($categories_as_array);
    //         $users = DB::table('users')
    //         ->select('id', 'restaurant_name')
    //         ->join('category_user', 'users.id', '=', 'category_user.user_id')
    //         ->whereIn('category_id', $categories_as_array)
    //         ->groupBy('id')
    //         ->having(DB::raw('count(id)'), '=', $counter)
    //         ->get();
    //     }
        
    //     $categories = Category::all();
    //     return response()->json([
    //         'success' => true,
    //         'results' =>  [
    //             'users' => $users,
    //             'categories' => $categories,
    //         ]
    //     ]);


        
        
    // }


}