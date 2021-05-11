@extends('layout/app')

@section('title',isset($recipe)?'Edit':'Create')

@push('style')
    <link rel="stylesheet" href="{{asset('css/insertRecipe.css')}}">
@endpush

@push('scripts')
    <script src="{{asset('js/ingredients.js')}}"></script>
@endpush


@section('main')
    <div class="container">

    </div>


    <div class="container">
        <form method="post" action="{{isset($recipe)?route('recipes.update',[$recipe]):route('recipes.store')}}">
            @isset($recipe) @method('put') @endisset


            <div class="form-group">
                <label for="inputName">Name:</label>
                <input type="text" class="form-control" id="inputName" name="recipe-name"
                       value="@isset($recipe){{$recipe->name}}@endisset">
            </div>


            <div class="form-group">
                <label for="inputTime">Benötigte Zeit (Minuten):</label>
                <input type="number" class="form-control" id="inputTime" name="time"
                       value="@isset($recipe){{$recipe->time}} @endisset"/>
            </div>

            <div class="form-group">
                <label for="inputDescription">Beschreibung:</label>
                <input type="text" class="form-control" id="inputDescription" name="description"
                       value="@isset($recipe){{$recipe->description}}@endisset">
            </div>

            <div class="form-group">
                <div id="ingredients">
                    <table class="table" id="ing-table">

                        <colgroup>
                            <col span="1" class="w-65">
                            <col span="1" class="w-35">
                        </colgroup>
                        <thead>
                        <tr>
                            <th scope="col">Zutat</th>
                            <th scope="col">Menge</th>
                        </tr>
                        </thead>
                        <tbody>
                        @isset($recipe)
                            @foreach($recipe->ingredients as $ingredient)
                                <tr>
                                    <td><input class="form-control ing-input" name="ingredient-name" type="text" value="{{$ingredient->name}}"></td>
                                    <td class="input-container">
                                        <input class="form-control ing-input w-25" name="ingredient-amount" type="number" value="{{$ingredient->pivot->amount}}">
                                        <input class="form-control ing-input w-75" name="ingredient-unit" type="text" value="{{$ingredient->pivot->name}}">
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                        <tr>
                            <td><input class="form-control ing-input" name="ingredient-name" type="text"></td>
                             <td class="input-container">
                                 <input class="form-control ing-input w-25" name="ingredient-amount" type="number">
                                 <input class="form-control ing-input w-75" name="ingredient-unit" type="text">
                             </td>
                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>


            <div class="form-group">
                <label for="inputTasks">Arbeitsschritte:</label>
                <textarea type="text" class="form-control" id="inputTasks" name="tasks">@isset($recipe){{$recipe->tasks}}@endisset</textarea>
            </div>


            <button type="submit" class="btn btn-success">Speichern</button>
        </form>
    </div>


@endsection
