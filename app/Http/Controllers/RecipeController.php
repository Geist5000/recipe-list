<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{

    private static $recipeValidationArray = [
        "name" => ["required", "string"],
        "time" => ["required", "integer", "min:1"],
        "description" => ["required", "string"],
        "ingredient" => ["required", "array"],
        "tasks" => ["nullable", "string"],
        "ingredient.*.id" => ["nullable", "integer"],
        "ingredient.*.name" => ["required_with:ingredient.*.id", "nullable", "string"],
        "ingredient.*.amount" => ["required_with:ingredient.*.name", "nullable", "integer", "min:1"],
        "ingredient.*.unit" => ["required_with:ingredient.*.name", "nullable", "integer", "exists:units,id"]
    ];

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
        return view('recipes.insert', ['create' => true, 'units' => Unit::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate(self::$recipeValidationArray);

        $recipe = DB::transaction(function () use ($validated) {

            $recipe = Recipe::query()->create($validated);

            foreach ($validated["ingredient"] as $rawIngredient) {
                if (!is_null($rawIngredient["name"])) {
                    $ingredient = $recipe->ingredients()->make($rawIngredient);
                    $ingredient->unit_id = $rawIngredient["unit"];
                    $ingredient->save();
                }
            }
            $recipe->refresh();
            return $recipe;
        });

        return response()->redirectToRoute("recipes.show", ["recipe" => $recipe->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Recipe $recipe
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Recipe $recipe)
    {
        return view('recipes.show', ['recipe' => $recipe]);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Recipe $recipe)
    {
        $validated = $request->validate(self::$recipeValidationArray);

        $recipe = DB::transaction(function () use ($validated, $recipe) {

            $recipe->fill($validated);
            $ingrediens = $recipe->ingredients;

            foreach ($validated["ingredient"] as $rawIngredient) {
                if (!is_null($rawIngredient["name"])) {
                    $foundIngredient = $ingrediens->where("id", "=", $rawIngredient["id"])->first();
                    if (!is_null($rawIngredient["id"]) && !is_null($foundIngredient)) {
                        $foundIngredient->fill($rawIngredient);
                        $foundIngredient->save();
                    } else {
                        $ingredient = $recipe->ingredients()->make($rawIngredient);
                        $ingredient->unit_id = $rawIngredient["unit"];
                        $ingredient->save();
                    }
                }
            }


            return $recipe;
        });

        return response()->redirectToRoute("recipes.show", ["recipies" => $recipe->id]);
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
