<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\User;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('guest.search', compact('categories'));
    }

    public function update(Request $request)
    {
        $categories = Category::all();      

        $choosenCategory = $request->categories;

        $users = User::all();
        $usersArray = [];

        foreach ($users as $user) {
            foreach ($user->categories as $category) {
                if ($category->id == $choosenCategory) {
                    array_push($usersArray, $user);       
                }
            }
        }
        
        return view('guest.search-alt', compact('usersArray', 'categories', 'choosenCategory'));
    }
}