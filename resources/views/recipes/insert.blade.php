@extends('layout/app')

@section('title',isset($recipe)?'Edit':'Create')

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
                <label for="">Zutaten:</label>
                <div id="ingredients">
                    <table class="table" id="ing-table">
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
                                    <td><input class="form-control" name="name" type="text" value="{{$ingredient->name}}"></td>
                                    <td>{{$ingredient->pivot->amount . ' ' . $ingredient->unit->name}}</td>
                                </tr>
                            @endforeach
                        @endisset
                        <tr>
                            <td><input class="form-control" name="ingredient-name" type="text"></td>
                             <td><input class="form-control" name="ingredient-amount" type="number"><input class="form-control" name="ingredient-unit" type="text"></td>
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
