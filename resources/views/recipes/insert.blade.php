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
        @if($errors->any())
            <div class="alert alert-danger">
                <p><strong>Opps Something went wrong</strong></p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>


    <div class="container">
        <form method="post" action="{{isset($recipe)?route('recipes.update',[$recipe]):route('recipes.store')}}">
            @isset($recipe) @method('put') @endisset


            <div class="form-group">
                <label for="inputName">Name:</label>
                <input type="text" class="form-control" id="inputName" name="name"
                       value="@isset($recipe){{$recipe->name}}@endisset">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="inputTime">Benötigte Zeit (Minuten):</label>
                <input type="number" class="form-control" id="inputTime" name="time"
                       value="@isset($recipe){{$recipe->time}}@endisset"/>
                @error('time')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputDescription">Beschreibung:</label>
                <input type="text" class="form-control" id="inputDescription" name="description"
                       value="@isset($recipe){{$recipe->description}}@endisset">
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
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
                            <th scope="col"><label id="ingredient-label">Zutat</label></th>
                            <th scope="col">Menge</th>
                        </tr>
                        </thead>
                        <tbody>
                        @isset($recipe)
                            @foreach($recipe->ingredients as $ingredient)
                                <tr>
                                    <input type="hidden" label" name="ingredient[{{$loop->index}}][id]" value="{{$ingredient->id}}"/>
                                    <td><input class="form-control ing-input" name="ingredient[{{$loop->index}}][name]" type="text" value="{{$ingredient->name}}"></td>
                                    <td class="input-container">

                                        <input class="form-control ing-input w-25" name="ingredient[{{$loop->index}}][amount]" type="number" value="{{$ingredient->amount}}">
                                        <select class="form-control ing-input w-75" name="ingredient[{{$loop->index}}][unit]">
                                            @foreach($units as $unit)
                                                <option value="{{$unit->id}}" selected="{{$unit->id === $ingredient->unit->id}}">
                                                    {{$unit->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                        <?php $lastIngrediendCount = isset($recipe)?$recipe->ingredients->count():0 ?>
                        <tr>
                            <td><input class="form-control ing-input" name="ingredient[{{$lastIngrediendCount}}][name]" type="text"/></td>
                            <td class="input-container">
                                <input class="form-control ing-input w-25" name="ingredient[{{$lastIngrediendCount}}][amount]" type="number"/>
                                    <select class="form-control ing-input w-75" name="ingredient[{{$lastIngrediendCount}}][unit]">
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}">
                                            {{$unit->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                @error('ingredient')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>


            <div class="form-group">
                <label for="inputTasks">Arbeitsschritte:</label>
                <textarea type="text" class="form-control" id="inputTasks" name="tasks">@isset($recipe){{$recipe->tasks}}@endisset</textarea>
            </div>

                <div class="form-group">
                    <label for="pictures" class="form-label">Bilder</label>
                    <input class="form-control" type="file" id="pictures">
                </div>

                {{csrf_field()}}


            <button type="submit" class="btn btn-success">Speichern</button>
        </form>
    </div>


@endsection
