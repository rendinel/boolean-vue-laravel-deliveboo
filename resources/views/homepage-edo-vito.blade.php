@extends('partials/public-head')
@section('main-content')
@php
    $idJs='app'
@endphp

            <div class="jumbotron-delivery">

                <div class="container-1200 flex-between">

                    <div class="jumbotron-content-left">

                        <p id="slogan">Il cibo che preferisci, <br> comodamente a casa tua</p>

                        <img id="logo-deliveboo" width="" src="../img/whitelogotype.svg" alt="">

                        {{-- <div class="input-group">
                            <input v-model='userSearch'
                                v-on:keyup.enter="search()"
                                class="form-control"
                                type="search"
                                placeholder="Cerca un ristorante"
                            >
                        </div> --}}

                        <div class="form__group field">

                            <input v-model='userSearch'
                                v-on:keyup.enter="search()"
                                type="text"
                                class="form__field"
                                placeholder="Name"
                                name="name"
                                id='name'
                            >

                            <label for="name" class="form__label">Tipologia o nome ristorante</label>

                        </div>

                    </div>

                    <div class="jumbotron-content-right">

                        <img id="sushi-img" src="img/sushi-pizza.svg">

                    </div>

                </div>

            </div>

            <div class="main-background"></div>

            <main class="main-content-delivery">


                <div class="carousel-container">
                    <h2 class="slider-title">Cosa ti va da mangiare? Scegli quello che vuoi!</h2>

                    <div class="category-cards-container">

                        <carousel :per-page="4"
                          :mouse-drag="true"
                           :resistance-coef='60'
                           :navigation-enabled='true'
                           :pagination-enabled='false'
                           >

                            <slide
                                v-for="(category,index) in categories"
                                :key='index'
                            >
                            <div class="single-card-category" v-on:click="searchCategory(category.name)" >
                                <!--
                                    da implementare tramite chiamata API a tabella img
                                    fatta in DB (come sfondo o come img normale)
                                -->
                                <img :src="setImg(category.name)" alt="">
                                <h3 class="category-name">@{{category.name}}</h3>
                                {{-- <img :src="setImg(category.name)" alt=""> --}}
                            </div>
                            </slide>
                        </carousel>

                        </div>

                        <h2 class="title-search" v-if="results.length > 0">
                            Risultati per: @{{titleSearch}}
                            <i class="fas fa-times-circle" v-on:click="returnAllListRestaurant()"></i>
                        </h2>

                        {{-- <h2 class="title-search"
                            v-if="!results.includes(titleSearch)"
                        >Nessun risultato per: @{{titleSearch}}
                        </h2> --}}

                    <div class="restaurant-container">

                            <div class="single-card-restaurant grow"
                                v-for='(restaurant, index) in results'
                                v-on:click="singleRestaurant(restaurant)"
                            >

                                <div class="single-card-restaurant-top">
                                    <img v-if="restaurant.pic_url.length > 20"
                                        class="single-restaurant-img"
                                        :src="restaurant.pic_url"
                                    >

                                    <img v-else
                                        class="single-restaurant-img"
                                        src="https://www.associazioneostetriche.it/wp-content/uploads/2018/05/immagine-non-disponibile.png"
                                    >
                                </div>

                                <div class="single-card-restaurant-bottom">

                                    <div class="single-restaurant-misc">

                                        <h5 class="restaurant-name">@{{ restaurant.business_name }}</h5>

                                        <div>
                                            <span class="restaurant-category"
                                                v-for="category in restaurant.categories">
                                                @{{category.name}}<span class="comma">,</span>
                                            </span>
                                        </div>

                                        <p class="restaurant-description">@{{ restaurant.description }}</p>

                                    </div>

                                </div>

                            </div>

                        </div>


                            <h2 class="slider-title" v-if=" !results.length && titleSearch === '' ">
                                Consigliati per te
                            </h2>

                            <h2 class="slider-title"
                                v-if="titleSearch !== '' && !results.length"
                            >
                                Nessun risultato per: @{{titleSearch}}
                                <i class="fas fa-times-circle" v-on:click="returnAllListRestaurant()"></i>
                            </h2>

                            <div class="restaurant-container">

                            <div class="single-card-restaurant grow"
                                v-for='(restaurant, index) in allRestaurants'
                                v-if=" !results.length && titleSearch === '' "
                                v-on:click="singleRestaurant(restaurant)"
                            >

                                <div class="single-card-restaurant-top">
                                    <img v-if="restaurant.pic_url.length > 20"
                                        class="single-restaurant-img"
                                        :src="restaurant.pic_url"
                                    >

                                    <img v-else
                                        class="single-restaurant-img"
                                        src="https://www.associazioneostetriche.it/wp-content/uploads/2018/05/immagine-non-disponibile.png"
                                    >
                                </div>

                                <div class="single-card-restaurant-bottom">

                                    <div class="single-restaurant-misc">

                                        <h5 class="restaurant-name">@{{ restaurant.business_name }}</h5>

                                        <div>
                                            <span class="restaurant-category"
                                                v-for="category in restaurant.categories">
                                                @{{category.name}}<span class="comma">,</span>
                                            </span>
                                        </div>

                                        <span class="restaurant-description">@{{ restaurant.description }}</span>

                                        <span class="restaurant-address">
                                            <i class="fas fa-map-marker-alt"></i>
                                            @{{ restaurant.address }}
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- ristoranti iniziali --}}
                </div>


                </div>

            </main>
@endsection
