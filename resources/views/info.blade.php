@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <h1 class="py-5 text-uppercase display-4 fw-bold">{{ $model->name }}</h1>
            </div>
        </div>
        <div class="row row-cols-1 gy-5">
            <div class="col">
                <a href="{{ route('create_compatibility', [$brand_name, $model->id]) }}" class="btn btn-warning">
                    <h3>Aggiungi compatibilità</h3>
                </a>
            </div>
            <div class="col">
                <h3>Compatibilità</h3>
                @foreach ($model->compatibilities as $compatibility)
                    @if ($compatibility->pivot->possible)
                        @if ($compatibility->pivot->verified)
                            <h5 class="text-success fw-bold">&checkmark; {{ $compatibility->name }}</h5>
                        @else
                            <h5>&quest; {{ $compatibility->name }}</h5>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
