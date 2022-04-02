<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Unit;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('recipes.index', ['recipes' => Recipe::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('recipes.insert', ['create' => true, 'units'=>Unit::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->input();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Recipe $recipe
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Recipe $recipe)
    {
        return view('recipes.show',['recipe' => $recipe]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Recipe $recipe
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Recipe $recipe)
    {
        return view('recipes.insert', ['create' => false, 'recipe' => $recipe, 'units' => Unit::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Recipe $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Recipe $recipe
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return $this->index();
    }
}
