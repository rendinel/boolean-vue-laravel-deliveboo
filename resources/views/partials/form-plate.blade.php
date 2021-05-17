@php
if (isset($edit) && !empty($edit)) {
    $title='Modifica questo piatto';
    $method='PUT';
    $submit='Modifica';
    $url=route('plates.update', ['plate' => $plate]);
}else {
    $title='Crea un nuovo piatto';
    $method='POST';
    $submit='Crea';
    $url=route('plates.store');
}
@endphp



@extends('layouts.admin-app')
@section('title', 'plate')
@section('main-content')

{{-- @php
    $idJs='app'
@endphp --}}

    {{-- <div class="container-form container-1200"> --}}
        <div class="container-form container">
        <h2 class="text-center">{{$title}}</h2>
 <form action="{{$url}}" method="post">

     @csrf
     @method($method)

     @if (empty($edit))
     <div class="form-group" style="display: none">
        <label for="thisRestaurant">Ristorante n</label>
        <input type="text"
            class="form-control"
            id="thisRestaurant"
            placeholder="{{$thisRestaurant}}"
            name="restaurant_id"
            value= "{{$thisRestaurant}}"
        >
    </div>
     @endif

     <div class="form-group">
         <label for="name">Nome piatto</label>
         <input type="text"
             class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}"
             id="name"
             placeholder="Inserisci il nome del tuo piatto"
             name="name"
             value="{{$edit ? $plate->name : '' }}"
             required
         >
         <div class="invalid-feedback">
             {{$errors->first('name')}}
         </div>
     </div>

     <div class="form-group border-select">
         <label for="typology">Tipologia piatto</label><br>

         <select class="form-select " aria-label="Default select example" name="typology">
            <option selected value="antipasti">Antipasti</option>
            <option value="primi">Primi piatti</option>
            <option value="secondi">Secondi piatti</option>
            <option value="pizza">Pizza</option>
            <option value="bevanda">Bevanda</option>
            <option value="dolce">Dolce</option>
          </select>

     </div>

     <div class="form-group">
         <label for="description">Descrizione piatto</label>
         <input type="text"
             class="form-control {{ $errors->has('description') ? 'is-invalid' : ''}}"
             id="description"
             placeholder="Inserisci la descrizione"
             name="description"
             value="{{$edit ? $plate->description : '' }}"
             required
         >
         <div class="invalid-feedback">
             {{$errors->first('description')}}
         </div>
     </div>

     <div class="form-group">
         <label for="price">Prezzo piatto</label>
         <input type="number"
            class="form-control {{ $errors->has('price') ? 'is-invalid' : ''}}"
            id="price"
            placeholder="Inserisci il prezzo"
            name="price"
            value="{{$edit ? $plate->price : '' }}"
            required
            step="0.01"
         >
         <div class="invalid-feedback">
            {{$errors->first('price')}}
         </div>
     </div>

     <div class="form-group">

        <label for="visible">Il piatto è disponibile?</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="visible" id="exampleRadios1" value="1" checked>
            <label  for="exampleRadios1">Si</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="visible" id="exampleRadios2" value="0">
            <label  for="exampleRadios2">No</label>
        </div>

     </div>

     {{-- <button type="submit" class="btn btn-primary">{{$submit}}</button> --}}

     <button type="submit" class="create-button">
        <div >{{$submit}}</div>
    </button>

 </form>
    </div>


@endsection
