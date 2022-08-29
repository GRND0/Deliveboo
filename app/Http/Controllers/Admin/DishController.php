<?php

namespace App\Http\Controllers\Admin;

use App\Dish;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::all();
        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());
        $data = $request->all();

        $dish = new Dish();
        $dish->fill($data);
        $dish->save();

        return redirect()->route('admin.dishes.index')->with('message', 'Piatto creato con successo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getValidationRules()
    {
        return [
            'name' => 'required | max:255',
            'description' => 'nullable |max:10000',
            'ingredients' => 'nullable |max:10000',
            'price' => 'numeric|required',
            'available' => 'boolean | required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
