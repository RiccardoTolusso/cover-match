@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <h1 class="py-4 text-uppercase display-4 fw-bold">Seleziona la marca</h1>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-3" id="search">
            @foreach ($brands as $brand)
                <div class="col">
                    <a href="{{ route('models', $brand->name) }}" class="btn btn-warning w-100 h-100 py-4 text-capitalize">
                        <h2>
                            {{ str_replace('_', ': ', $brand->name) }}
                        </h2>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
