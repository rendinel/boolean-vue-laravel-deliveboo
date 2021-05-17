@php

   if (isset($edit) && !empty($edit)) {
    $title='Modifica questo ristorante';
    $method='PUT';
    $submit='Modifica';
    $url=route('restaurants.update', ['restaurant' => $restaurant]);
   }else {
    $title='Crea un nuovo ristorante';
    $method='POST';
    $submit='Crea';
    $url=route('restaurants.store');
}
@endphp

@extends('layouts.admin-app')
@section('title', 'restaurant')
@section('main-content')

<div class="container-form container">

    <h2 class="text-center">{{$title}}</h2>

    <form action="{{$url}}" method="post">

        @csrf
        @method($method)

        <div class="form-group">

            <label for="business_name">Nome ristorante</label>

            <input type="text"
                class="form-control {{ $errors->has('business_name') ? 'is-invalid' : ''}}"
                id="business_name"
                placeholder="Inserisci il nome del tuo ristorante"
                name="business_name"
                value="{{$edit ? $restaurant->business_name : '' }}"
                required
            >

            <div class="invalid-feedback">
                {{$errors->first('business_name')}}
            </div>

        </div>

        <div class="form-group">

            <label for="categories[]">Tipologia ristorante</label>

            <div>

                <select class="select select-container" multiple name="categories[]">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>

            </div>

        </div>

        <div class="form-group">

            <label for="description">Descrizione ristorante</label>

            <input type="text"
                class="form-control {{ $errors->has('description') ? 'is-invalid' : ''}}"
                id="description"
                placeholder="Inserisci la descrizione"
                name="description"
                value="{{$edit ? $restaurant->description : '' }}"
                required
            >

            <div class="invalid-feedback">
                {{$errors->first('description')}}
            </div>

        </div>

        <div class="form-group">

            <label for="opening_hours">Orari ristorante</label>

            <input type="text"
                class="form-control {{ $errors->has('opening_hours') ? 'is-invalid' : ''}}"
                id="opening_hours"
                placeholder="Inserisci gli orari"
                name="opening_hours"
                value="{{$edit ? $restaurant->opening_hours : '' }}"
                required
            >

            <div class="invalid-feedback">
                {{$errors->first('opening_hours')}}
            </div>

        </div>

        <div class="form-group">

            <label for="address">Indirizzo ristorante</label>

            <input type="text"
                class="form-control {{ $errors->has('address') ? 'is-invalid' : ''}}"
                id="address"
                placeholder="Inserisci l'indirizzo"
                name="address"
                value="{{$edit ? $restaurant->address : '' }}"
                required
            >

            <div class="invalid-feedback">
                {{$errors->first('address')}}
            </div>

        </div>



        <div class="form-group">

            <label for="pic_url">Immagine ristorante</label>

            <input type="text"
                class="form-control {{ $errors->has('pic_url') ? 'is-invalid' : ''}}"
                id="pic_url"
                placeholder="Inserisci l'immagine"
                name="pic_url"
                value="{{$edit ? $restaurant->pic_url : '' }}"
                required
            >

            <div class="invalid-feedback">
                {{$errors->first('pic_url')}}
            </div>

        </div>

        {{-- <button type="submit" class="btn btn-primary">{{$submit}}</button> --}}

        <button type="submit" class="create-button">
            <div >{{$submit}}</div>
        </button>

    </form>

</div>

@endsection
