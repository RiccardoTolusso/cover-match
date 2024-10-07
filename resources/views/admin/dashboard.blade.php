@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-warning my-3 text-center" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="row g-5">
            <div class="col-12 col-lg-4 text-center">
                <h2 class="py-4">Inserisci un nuovo modello</h2>
                {{-- INSERISCI UN NUOVO BRAND --}}
                <form action="{{ route('store_model') }}" method="POST">
                    @csrf
                    <label for="name" class="form-label">Nome del modello</label>
                    <input type="text" id="name" name="name" class="form-control mb-3 text-center " required>

                    <label for="brand">Marca del dispositivo</label>
                    <select name="brand_id" id="brand" class="form-select mb-4 text-center" required>
                        <option>Seleziona una marca per il tuo dispositivo</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-warning">Aggiungi il modello</button>
                </form>
            </div>
            <div class="col-12 col-lg-8">
                <table class="table text-center" id="compatibility-table">
                    <thead>
                        <tr>
                            <th scope="col">TELEFONO</th>
                            <th scope="col">COVER COMPATIBILE</th>
                            <th scope="col" class="col-1">VERIFICATO</th>
                            <th scope="col" class="col-1">POSSIBILE</th>
                            <th scope="col" class="col-1">MODIFICA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compatibilities as $compatibility)
                            <tr>
                                <td>{{ $compatibility->phone1_name }}</td>
                                <td>{{ $compatibility->phone2_name }}</td>
                                <td>
                                    @if ($compatibility->verified)
                                        <b class="text-success"> &check; </b>
                                    @else
                                        <b class="text-danger"> &cross; </b>
                                    @endif

                                </td>
                                <td>
                                    @if ($compatibility->possible)
                                        <b class="text-success"> &check; </b>
                                    @else
                                        <b class="text-danger"> &cross; </b>
                                    @endif
                                </td>
                                <td><button class="btn btn-warning" data-model1="{{ $compatibility->phone1_name }}"
                                        data-model2="{{ $compatibility->phone2_name }}" data-id="{{ $compatibility->id }}"
                                        data-verified="{{ $compatibility->verified }}"
                                        data-possible="{{ $compatibility->possible }}">✏️</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @foreach ($compatibilities as $compatibility)
                @endforeach
            </div>
        </div>
    </div>

    <div id="edit-modal" class="position-fixed d-none start-0 end-0 top-0 bottom-0 ric-bg-semi-dark">
        <div class="container text-dark fw-bold">
            <div class="row pt-5">
                <div class="col-12 col-md-8 m-auto mt-5">
                    <div class="bg-white rounded-4 py-2 px-5">
                        <h2 class="text-center mb-2">MODIFICA COMPATIBILIT&Aacute;</h2>
                        <p class="mb-4 text-center">Possono le cover del modello: <u id="show-model-2"></u> essere
                            utilizzate sul
                            telefono: <u id="show-model-1"></u> ?</p>
                        <form action="{{ route('edit_compatibility') }}" method="POST" class="m-auto w-75">
                            @method('PATCH')
                            @csrf
                            <input type="hidden" name="compatibility-id" id="compatibility-id">
                            <div class="form-check form-switch mb-3">
                                <label for="verified" class="form-check-label">Compatibilità verificata</label>
                                <input class="form-check-input" name="verified" type="checkbox" role="switch"
                                    id="verified">
                            </div>
                            <div class="form-check form-switch mb-5">
                                <label for="possible" class="form-check-label">Compatibilità possibile (se disattivato
                                    rende
                                    nulla la compatibilità)</label>
                                <input class="form-check-input" name="possible" type="checkbox" role="switch"
                                    id="possible">
                            </div>
                            <div class="d-flex justify-content-between">

                                <div class="btn btn-secondary" id="close-modal">Annulla</div>
                                <button class="btn btn-warning ms-1">Salva le Modifiche</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    @vite('resources/js/edit.js')
@endsection
