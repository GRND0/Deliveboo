<?php

namespace App\Http\Controllers\Admin;

use App\Dish;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
        
        if (isset($data['image'])) {
            $image_path = Storage::put('uploads', $data['image']);
            $data['image'] = $image_path;
        }

        $dish = new Dish();
        $dish->fill($data);
        $dish->save();

        return redirect()->route('admin.dishes.index');
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
        $dish = Dish::findOrFail($id);
        return view('admin.dishes.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $request->validate($this->getValidationRules());
        $data = $request->all();

        $dish = Dish::findOrFail($dish->id);
        if (isset($data['image'])) {
            if ($dish->image) {
                Storage::delete($dish->image);
            }
            $image_path = Storage::put('uploads', $data['image']);
            $data['image'] = $image_path;
        }


        $dish->fill($data);
        $dish->save();
        return redirect()->route('admin.dishes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dish = Dish::findOrFail($id);
        $dish->delete();
        return redirect()->route('admin.dishes.index');
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
