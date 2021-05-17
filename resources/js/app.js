/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';

window.Vue = Vue;
require('./bootstrap');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('carousel',require('./components/Carousel.vue').default);

import VueCarousel from 'vue-carousel';
Vue.use(VueCarousel);

const app = new Vue({
    el: '#app',
    data: {
        results:[],
        categories: [],
        allRestaurants: [],
        userSearch: '',
        titleSearch:'',
        orders:'',
    },
    mounted() {
        axios
            .get('http://127.0.0.1:8000/api/categories')
            .then((result) => {
            console.log(result.data)
            this.categories = result.data;
        });
        axios
            .get('http://127.0.0.1:8000/api/restaurants')
            .then((result) => {
                console.log(result.data)
                this.allRestaurants = result.data.slice(0, 10);
            });
    },
    methods:{
        search() {
            this.results = [];
            this.searchrestaurant();
        },
        searchrestaurant() {
        const self = this;
            axios
            .get('http://127.0.0.1:8000/api/restaurants/search?str=' + self.userSearch)
            .then(function(result) {
                console.log(result.data)
                self.results = result.data;
                self.userSearch = '';
            });
        },
        searchCategory(category){
            this.userSearch = category;
            this.titleSearch = category;
            console.log(category);
            const self = this;
            axios
            .get('http://127.0.0.1:8000/api/restaurants/search?str=' + self.userSearch)
            .then(function(result) {
                console.log(result.data)
                self.results = result.data;
                self.userSearch = '';
            });

        },
        singleRestaurant(restaurant){
            return window.location.href='http://127.0.0.1:8000/single-restaurant/' + restaurant.id
        },
        returnAllListRestaurant(){
            this.results = [];
            this.userSearch = '';
            this.titleSearch = '';
        },
        setImg(name){
            var src;
            console.log(name);
            switch (name) {
                    case name = 'Cucina Italiana':
                     src='https://www.exportiamo.it/thumb/1200x800/public/settori/942/anno-italiano-cibo.jpg'
                    break;
                    case name = 'Cucina Cinese':
                     src='https://blog.stageincina.it/wp-content/uploads/2016/10/shutterstock_204336901-min.jpg'
                     break;
                    case name = 'Cucina Giapponese':
                        src='https://www.visionareagenzia.it/wp-content/uploads/2019/03/Cucina-giapponese-CB-min.jpg'
                    break;
                    case name = 'Cucina Americana':
                        src='https://idc.edu/wp-content/uploads/2018/07/Traditional-American-Food-You-Must-Try-While-Studying-in-Washington-DC.jpg'
                    break;
                    case name = 'Cucina Indiana':
                        src='https://images.vanityfair.it/wp-content/uploads/2019/03/24183015/Cucina-indiana-L.jpg'
                    break;
                    case name = 'Cucina Greca':
                        src='https://images.lacucinaitaliana.it/wp-content/uploads/2015/07/07174731/cucina-greca-1600x800.jpg'
                    break;
                    case name = 'Cucina Asiatica':
                        src='https://img.ev.mu/images/attractions/5627/960x640/2443.jpg'
                    break;
                    case name = 'Cucina Messicana':
                        src='https://mangiarebene.s3.amazonaws.com/uploads/blog_item/image/980/mb_asset.jpg'
                    break;
                    case name = 'Cucina Sudamericana':
                        src='https://www.fulltravel.it/wp-content/uploads/2016/03/Sancocho-cucina-dominicana-1.jpg'
                    break;
                    case name = 'Pizzeria':
                        src='https://dpv87w1mllzh1.cloudfront.net/alitalia_discover/attachments/data/000/002/615/original/la-ricetta-della-pizza-con-gli-ingredienti-per-l-impasto-tradizionale-1920x1080.jpg?1567151944'
                    break;
                    case name = 'Paninoteca':
                        src='https://www.agrodolce.it/app/uploads/2019/04/panino-ricotta-pecora-b-448.jpg'
                    break;

                default:
                    src='https://cdn.vox-cdn.com/thumbor/9qN-DmdwZE__GqwuoJIinjUXzmk=/0x0:960x646/1200x900/filters:focal(404x247:556x399)/cdn.vox-cdn.com/uploads/chorus_image/image/63084260/foodlife_2.0.jpg'
                    break;
            }
            return src;
        },

    }
  })

  const root = new Vue({
    el: '#root',
    data: {
        // array contenente il nome ed il prezzo del piatto
        cartItem: [],

        cartItemIds: [],

        // variabile totale iniziale impostata a zero
        total: 0,

        // array contenente i prezzi dei piatti selezionati
        totalPlatesPrices: [],

        index: 0,

        storage:[],

        // (dati form)
        formData:{
            address:'',
            email:'',
            name:'',
        }

    },
    mounted() {
        this.storage = JSON.parse(window.sessionStorage.getItem('carrello'));
        this.ids = JSON.parse(window.sessionStorage.getItem('ids'));
        this.storagePrices = JSON.parse(window.sessionStorage.getItem('prezzi'));
        if(this.storage.length > 0 && this.storagePrices.length > 0){

            console.log('Storage:'+ this.storage);
            console.log('Prices:'+ this.storagePrices);
            for (let i = 0; i < this.storage.length; i++) {
                this.cartItem.push(this.storage[i]);
            }
            for (let i = 0; i < this.ids.length; i++) {
                this.cartItemIds.push(this.ids[i]);
                console.log('Elenco Ids:'+ this.cartItemIds);
            }
            for (let i = 0; i < this.storagePrices.length; i++) {
                this.totalPlatesPrices.push(this.storagePrices[i]);
            }
            this.totalOrderPrice();
        }
        window.sessionStorage.removeItem("ids", JSON.stringify(this.cartItem));
        window.sessionStorage.removeItem("carrello", JSON.stringify(this.cartItem));
        window.sessionStorage.removeItem("prezzi", JSON.stringify(this.cartItem));
    },

    methods: {
        newItem(item){
            window.sessionStorage.removeItem("carrello", JSON.stringify(this.cartItem));
            window.sessionStorage.removeItem("prezzi", JSON.stringify(this.totalPlatesPrices));
            window.sessionStorage.removeItem("ids", JSON.stringify(this.cartItemIds));
            console.log(item)
            this.cartItem.push(item.name);
            this.cartItemIds.push(item.id);
            console.log('Elenco Ids:'+ this.cartItemIds);
            console.log('Questo è il carrello:' + this.cartItem);
            this.totalPlatesPrices.push(item.price);
            this.totalOrderPrice();
            window.sessionStorage.setItem('ids', JSON.stringify(this.cartItemIds));
            window.sessionStorage.setItem('prezzi', JSON.stringify(this.totalPlatesPrices));
            window.sessionStorage.setItem('carrello', JSON.stringify(this.cartItem));
        },
        totalOrderPrice(){
            this.total=0;
            for(var x=0; x<this.totalPlatesPrices.length; x++){
                this.total+=parseFloat(this.totalPlatesPrices[x]);
            }
            console.log(this.total)
        },
        deletePlate(index){
            this.index=index;
            console.log(this.index);
            this.totalPlatesPrices.splice(this.index, 1);
            this.cartItem.splice(this.index, 1);
            this.cartItemIds.splice(this.index, 1);
            this.totalOrderPrice()
        },
        proceedToBraintree(idName1, idName2, idName3, idName4){
            let paymentsForm=document.getElementById(idName1);
            paymentsForm.classList.remove('hide');

            let paymentButton=document.getElementById(idName2);
            paymentButton.classList.add('hide');

            let itemsContainer=document.getElementById(idName3);
            itemsContainer.classList.add('hide');

            let overlayDiv=document.getElementById(idName4);
            overlayDiv.classList.remove('hide');
        },
        backToCart(idName1, idName2, idName3, idName4){
            let paymentsForm=document.getElementById(idName1);
            paymentsForm.classList.add('hide');

            let overlayDiv=document.getElementById(idName2);
            overlayDiv.classList.add('hide');

            let cartItems=document.getElementById(idName3);
            cartItems.classList.remove('hide');

            let proceedToPayment=document.getElementById(idName4);
            proceedToPayment.classList.remove('hide');
        }
    }
})

// for nav white background
$(window).on("scroll", function() {
    if($(window).scrollTop() > 35) {
        $(".scroll").addClass("white-background");
        $(".your-page").addClass("black-font");
        $(".your-page").removeClass("white-font");
        $("#pink-logo").removeClass("hide");
        $("#white-logo").addClass("hide");
    }else {
        $('.scroll').removeClass("white-background");
        $("#pink-logo").addClass("hide");
        $("#white-logo").removeClass("hide");
        $(".your-page").removeClass("black-font");
        $(".your-page").addClass("white-font");
    }
});


