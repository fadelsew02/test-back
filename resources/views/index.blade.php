@extends('template')

@section('title')
    E-commerce
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Marché</h1>
        <div>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="bi bi-cart4 mx-2"></i>Panier</a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        @foreach ($products as $key => $product)
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <img class="card-img-top" src=" {{ asset('storage/' . $product->image) }}" alt="Card image cap"
                            width="200px" height="200px" style="object-fit: cover">
                        <div class="card-body">
                            <h5 class="card-title">Nomination : {{ $product->title }} </h5>
                            <p class="card-text">Description : {{ $product->description }}</p>
                            <p class="card-text">Prix : {{ $product->prix }} xof</p>
                            <p class="card-text">Vendeur : {{ $product->user->first_name . ' ' . $product->user->last_name }}
                            </p>
                            <button data-kkipay_key="{{ $product->user->kkipay_key }}" data-prix="{{ $product->prix }}"
                                data-id="{{ $product->id }}" class="btn btn-primary buy">Acheter</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div id="payment-widget"></div>

    <script src="https://cdn.kkiapay.me/k.js">
        < script >
            document.querySelectorAll(".buy").forEach(function(button) {
                button.addEventListener("click", function() {
                    const kkipay_key = button.getAttribute("data-kkipay_key");
                    const product_id = button.getAttribute("data-id");
                    const prix = button.getAttribute("data-prix");
                    const kkiapayWidget = document.createElement("kkiapay-widget");
                    kkiapayWidget.setAttribute("amount", prix);
                    kkiapayWidget.setAttribute("key", kkipay_key);
                    kkiapayWidget.setAttribute("callback", "https://kkiapay-redirect.com");
                    kkiapayWidget.setAttribute("standbox", "true");

                    // Ajouter le widget à la page (par exemple, dans un div avec l'id "payment-widget")
                    document.getElementById("payment-widget").appendChild(kkiapayWidget);
                })
            })
    </script>
@endsection
