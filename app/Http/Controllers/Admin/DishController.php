<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Model\Course;
use App\Model\Dish;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::orderBy("updated_at", "desc")->get();

        return view("admin.dishlist", compact("dishes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();

        return view('admin.create', compact("courses"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data  = $request->all();
        $data["user_id"] = Auth::user()->id;
        

        $validation = $request->validate([
            "name" => "required|max:255",
            "description" => "required|",
            "price" => "required", //validazione virgola?
            "visible" => "nullable",
            "image" => "nullable|image",
            "course_id" => "exists:App\Model\Course,id"
        ]);

        if (!empty($data['image'])) {
            $img_path = Storage::put('uploads', $data['image']);
            $data['image'] = $img_path;
        }

        $newDish = new Dish();
        $newDish->slug = $newDish->createSlug($data["name"]);
        $newDish->fill($data);
        $newDish->save();

        $dishes = Dish::all();

        return redirect()->route("admin.dishes.index", compact("dishes"));
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
    public function edit(Dish $dish)
    {
        $courses = Course::all();
        return view("admin.edit", ["dish" => $dish, "courses" => $courses]);
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
    public function destroy(Dish $dish)
    {
        if(Auth::user()->id != $dish->user_id) {
            abort("403");
        }
        // $dish->orders()->detach();

        $dish->delete();

        return redirect()->route("admin.dishes.index")->with("status", "Piatto '$dish->name' cancellato");
    }
}
