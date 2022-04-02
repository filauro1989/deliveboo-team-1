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
        $dishes = Dish::where('user_id', Auth::user()->id)->orderBy("updated_at", "desc")->get();

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


        $validation = $request->validate(
            [
                "name" => "required|max:255|profane:it",
                "description" => "required|max:4000|profane:it",
                "price" => "required|numeric|gt:0",
                "visible" => "nullable",
                "image" => "nullable|image",
                "course_id" => "exists:App\Model\Course,id"
            ],
            [
                'profane' => "Volgarità rilevata nel testo inserito",
                'required' => "Questo campo è obbligatorio"
            ]
        );

        if (!empty($data['image'])) {
            $img_path = Storage::put('uploads', $data['image']);
            $data['image'] = $img_path;
        }

        $newDish = new Dish();
        $newDish->slug = $newDish->createSlug($data["name"]);
        // $data->price = number_format($data['price'], 2);
        $data['price'] = number_format($data['price'], 2);
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
    public function show(Dish $dish)
    {
        return view('admin.show', compact('dish'));
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
    public function update(Request $request, Dish $dish)
    {
        $data  = $request->all();
        $data["user_id"] = Auth::user()->id;


        $validation = $request->validate(
            [
                "name" => "required|max:255|profane:it",
                "description" => "required|max:4000|profane:it",
                "price" => "required|numeric|gt:0", //validazione virgola?
                "visible" => "nullable",
                "image" => "nullable|image",
                "course_id" => "exists:App\Model\Course,id"
            ],
            [
                'profane' => "Volgarità rilevata nel testo inserito",
                'required' => "Questo campo è obbligatorio"
            ]
        );

        if (!empty($data['image'])) {
            Storage::delete($dish->image);
            $img_path = Storage::put('uploads', $data['image']);
            $data['image'] = $img_path;
        }
        if ($data['name'] != $dish->name) {
            $dish->name = $data['name'];
            $dish->slug = $dish->createSlug($data['name']);
        }
        if ($data['description'] != $dish->description) {
            $dish->description = $data['description'];
        }
        if ($data['price'] != $dish->price) {
            $data['price'] = number_format($data['price'], 2);
            $dish->price = $data['price'];
        }
        if ($data['visible'] != $dish->visible) {
            $dish->visible = $data['visible'];
        }
        if ($data['course_id'] != $dish->course_id) {
            $dish->course_id = $data['course_id'];
        }

        $dish->update($data);

        return redirect()->route('admin.dishes.show', ['dish' => $dish]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        if (Auth::user()->id != $dish->user_id) {
            abort("403");
        }
        // $dish->orders()->detach();

        $dish->delete();

        return redirect()->route("admin.dishes.index")->with("status", "Piatto '$dish->name' cancellato");
    }
}
