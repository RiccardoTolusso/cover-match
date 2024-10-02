@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col mb-5 text-uppercase">
                <h3 class="pt-4">Aggiungi compatibilità per:</h3>
                <h2 class=" display-6 fw-bold">{{ $brand_name }} - {{ $primary_model->name }}</h2>
            </div>
        </div>
        <form action="{{ route('store_compatibility', [$brand_name, $primary_model->id]) }}" method="POST">
            @csrf
            <div class="row g-5">
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label" for="brand">Seleziona la marca</label>
                        <select class="form-select text-center" name="brand" id="brand">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" @if ($brand->name === $brand_name) selected @endif>
                                    {{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label" for="brand">Seleziona il modello</label>
                        <select class="form-select text-center" name="model" id="model">
                            @foreach ($models as $model_group)
                                <optgroup data-brand-id="{{ $model_group[1]->brand_id }}" label="MODELLI">
                                    @foreach ($model_group as $model)
                                        @if (
                                            $model->id !== $primary_model->id &&
                                                !$primary_model->compatibilities->contains(function ($compatibility) use ($model) {
                                                    return $compatibility->pivot->phone_id_2 === $model->id;
                                                }))
                                            <option value="{{ $model->id }}"> {{ $model->name }}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-warning w-100">CONFERMA LA COMPATIBILITÀ</button>
                </div>
            </div>
        </form>
    </div>
@endsection


@section('custom_js')
    @vite('resources/js/create.js')
@endsection
