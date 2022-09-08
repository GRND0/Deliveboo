<?php

namespace App\Http\Controllers\Admin;

use App\Dish;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::where('user_id', Auth::user()->id)->orderBy('name', 'ASC')->get();
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
        $data['user_id'] = Auth::user()->id;
        
        if (isset($data['image'])) {
            $image_path = Storage::put('uploads', $data['image']);
            $data['image'] = $image_path;
        }

        $dish = new Dish();
        $dish->fill($data);
        $dish->slug = $this->generateSlugFromName($dish->name);
        $dish->save();

        return redirect()->route('admin.dishes.index')->with('message', 'Piatto creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $dish = Dish::where('slug', '=', $slug)->first();
        $this->authorize('show', $dish);

        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)

    {        
        $dish = Dish::where('slug', '=', $slug)->first();
        $this->authorize('edit', $dish);
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
        $this->authorize('update', $dish);
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
        return redirect()->route('admin.dishes.index')->with('message', 'Piatto modificato con successo');
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
        $this->authorize('destroy', $dish);
        $dish->delete();
        return redirect()->route('admin.dishes.index')->with('message', 'Piatto eliminato');
    }

    private function generateSlugFromName($name) {
        $base_slug = Str::slug($name, '-');
        $slug = $base_slug;
        $i = 1;
        $dish_same_name = Dish::where('slug', '=', $slug)->first();
        while ($dish_same_name) {
            $slug = $base_slug . '-' . $i;
            $dish_same_name = Dish::where('slug', '=', $slug)->first();
            $i++;
        }
        return $slug;
    }

    private function getValidationRules()
    {
        return [
            'name' => 'required | max:255',
            'description' => 'nullable |max:10000',
            'ingredients' => 'nullable |max:10000',
            'price' => 'numeric|required',
            'available' => 'boolean | required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }
}
