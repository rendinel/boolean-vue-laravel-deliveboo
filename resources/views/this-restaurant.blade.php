@extends('layouts.admin-app')
@section('title', 'plates-set')
@section('main-content')
@php
    $idJs='app'
@endphp
    <div class="main-background"></div>


    <div  class="container social-distancing">

        <div class="plate-center">

            <h2 class="business-name">I piatti del ristorante: {{$restaurant->business_name}}</h2>

            @foreach ($restaurant->plates as $plate)

            <div class="card-plate-container">

                <div class="card-plate-container-left">

                    <div class="text-container">
                        <p class="space-card-plate-container-right size-font weight">{{$plate->name}}</p>
                        <p class="space-card-plate-container-right size-font">{{$plate->typology}}</p>
                        <p class="space-card-plate-container-right size-font"> {{$plate->description}}</p>
                        <p class="space-card-plate-container-right size-font">{{$plate->price}}€</p>
                    </div>

                </div>

                <div class="card-plate-container-right">

                        <a href="{{route('plates.edit', ['plate' => $plate->id])}}" class="text-decoration-none">
                            <div class="utility-button-edit"><span>Modifica </span></div>
                        </a>

                        <form action="{{route('plates.destroy', ['plate' => $plate->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="utility-button-danger border-none" data-toggle="modal" data-target="#exampleModal{{$plate->id}}">
                                <div class="red">Elimina </div>
                            </button>

                            @include('partials.delete-modal-plate', ['plate'=> $plate->id])
                        </form>

                </div>
            </div>
           @endforeach

             <div class="footer">
                <div class="footer-container">

                    <a class="text-decoration-none" href="{{ route('plates.create', ['restaurant' => $restaurant])}}">
                        <div class="utility-button-edit"><span>Inserisci</span></div>
                    </a>

                    <a class="text-decoration-none" href="{{route('restaurants.index')}}">
                        <div class="utility-button-home"><span>Dashboard</span></div>
                    </a>

                </div>
             </div>
        </div>
    </div>
@endsection
