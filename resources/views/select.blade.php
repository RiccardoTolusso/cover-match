@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <h1 class="py-4 text-uppercase display-4 fw-bold">Seleziona il modello</h1>
            </div>
        </div>
        <div class="row row-cols-4 g-3">
            @foreach ($models as $model)
                <div class="col">
                    <a href="{{ route('model', [$brand_name, $model->id]) }}"
                        class="btn btn-warning w-100 py-4 text-capitalize">
                        <h2>
                            {{ str_replace('_', ': ', $model->name) }}
                        </h2>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
