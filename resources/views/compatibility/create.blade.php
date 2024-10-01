@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col mb-3">
                <h1 class="py-4 text-uppercase display-4 fw-bold">Aggiungi compatibilità per:</h1>
                <h2>{{ $brand_name }}</h2>
                <h2>{{ $primary_model->name }}</h2>
            </div>
        </div>
        <form action="{{ route('store_compatibility') }}" method="POST">
            @csrf
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col">
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
                <div class="col">
                    <div class="form-group">
                        <label class="form-label" for="brand">Seleziona la marca</label>
                        <select class="form-select text-center" name="brand" id="brand">
                            @foreach ($models as $model_group)
                                <optgroup data-brand-id="{{ $model_group[1]->brand_id }}" label="MODELLI">
                                    @foreach ($model_group as $model)
                                        <option value="{{ $model->id }}"> {{ $model->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
