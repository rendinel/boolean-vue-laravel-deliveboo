<div class="container">

        <h3>Inserisci i tuoi dati</h3>

        {{-- <div class="spacer"></div> --}}

        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>

        @endif

        @if(count($errors) > 0)

        @endif


            <form action="{{ url('/checkout')}}" method="POST" id="payment-form" name='formUno'>
            @csrf
            <div class="form-group">
                <label for="email">Indirizzo Email</label>
                <input type="email" class="form-control" id="email" name="mail" v-model='formData.email'>

            </div>

            <div class="form-group">
                <label for="customer_name">Nome destinatario</label>
                <input type="text"
                    class="form-control"
                    id="customer_name"
                    name="customer_name"
                    v-model='formData.name'
                >
            </div>

            <div class="form-group">
                <label for="address">Indirizzo di consegna</label>
                <input type="text"
                    class="form-control"
                    id="address"
                    name="address"
                    v-model='formData.address'
                >
            </div>

            <div class="form-group">
                <input type="text"
                    class="form-control hide"
                    id="restaurant_id"
                    name="restaurant_id"
                    value='{{$restaurant->id}}'
                    readonly
                >
            </div>

            <div class="form-group">
                <select class="select hide" multiple name="plates[]">
                        <option readonly selected v-for='id in cartItemIds' :value="id">@{{id}}</option>
                </select>
            </div>


            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="amount">Totale</label>
                        <input type="text"
                            class="form-control"
                            id="amount"
                            name="amount"
                            readonly="readonly"
                            :value="total"
                        >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="cc_number">Numero carta di credito</label>

                    <div class="form-group" id="card-number">

                    </div>
                </div>

                <div class="col-md-6">
                    <label for="expiry">Data di scadenza</label>

                    <div class="form-group" id="expiration-date">

                    </div>
                </div>

                <div class="col-md-6">
                    <label for="cvv">CVV</label>

                    <div class="form-group" id="cvv">

                    </div>
                </div>

            </div>

            <input id="nonce" name="payment_method_nonce" type="hidden"/>

            <button type="submit" class="btn btn-success"
                v-on:click="backToCart('paymentsContainer', 'overlay-container', 'items-container', 'payment-button')"
            >
                Torna al carrello
            </button>

            <button type="submit" class="btn btn-success">
                Procedi all'ordine
            </button>

        </form>
    </div>
</div>
