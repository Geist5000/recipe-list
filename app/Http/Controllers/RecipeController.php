<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\Picture;
use App\Recipe;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        "ingredient.*.unit" => ["required_with:ingredient.*.name", "nullable", "integer", "exists:units,id"],
        "toRemovePictures" => ["array"],
        "toRemovePictures.*" => ["integer", "min:1"],
        "pictures" => ["array"],
        "pictures.*" => ["image"]
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {
        $validated = $request->validate(self::$recipeValidationArray);

        $recipe = DB::transaction(function () use ($validated) {

            $recipe = Recipe::create($validated);

            $this->saveNewPictures($validated, $recipe);

            $ingredients = [];
            foreach ($validated["ingredient"] as $rawIngredient) {
                if (!is_null($rawIngredient["name"])) {
                    $ingredient = new Ingredient($rawIngredient);
                    $ingredient->unit_id = $rawIngredient["unit"];
                    $ingredients[] = $ingredient;
                }
            }
            $recipe->ingredients()->saveMany($ingredients);
            $recipe->refresh();
            return $recipe;
        });

        return redirect(route("recipes.show", ["recipe" => $recipe]));

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function update(Request $request, Recipe $recipe)
    {
        $validated = $request->validate(self::$recipeValidationArray);


        if (array_key_exists("toRemovePictures", $validated)) {

            foreach ($recipe->pictures as $picture) {
                if (in_array($picture->id, $validated["toRemovePictures"])) {
                    DB::transaction(function () use ($picture, $validated) {
                        Storage::delete($picture["path-to-picture"]);
                        $picture->delete();
                    });
                }
            }
        }

        $recipe = DB::transaction(function () use ($validated, $recipe) {

            $this->saveNewPictures($validated, $recipe);


            $recipe->fill($validated);
            $ingrediens = $recipe->ingredients;

            foreach ($validated["ingredient"] as $rawIngredient) {
                if (!is_null($rawIngredient["name"])) {
                    if (isset($rawIngredient["id"]) && !is_null($rawIngredient["id"])) {
                        $foundIngredient = $ingrediens->where("id", "=", $rawIngredient["id"])->first();
                        if (!is_null($foundIngredient)) {
                            $foundIngredient->fill($rawIngredient);
                            $foundIngredient->save();
                        }
                    } else {
                        $ingredient = $recipe->ingredients()->make($rawIngredient);
                        $ingredient->unit_id = $rawIngredient["unit"];
                        $ingredient->save();
                    }
                }
            }


            $recipe->save();
            $recipe->refresh();
            return $recipe;
        });

        return redirect(route("recipes.show", ["recipe" => $recipe]));
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

    /**
     * @param array $validated
     * @param Recipe $recipe
     * @return void
     */
    private function saveNewPictures(array $validated, Recipe $recipe): void
    {
        if (array_key_exists("pictures", $validated)) {
            $pictures = [];
            foreach ($validated["pictures"] as $pictureFile) {
                $path = $pictureFile->store("recipePictures");
                $picture = new Picture();
                $picture["path-to-picture"] = $path;
                $pictures[] = $picture;
            }
            $recipe->pictures()->saveMany($pictures);
        }
    }
}
