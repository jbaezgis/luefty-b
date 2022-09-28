@extends('layouts.app2')

@section('content')
<div class="container-fluid bg-primary text-center p-5">
  <div class="row justify-content-md-center">
    <div class="col-md-12">
      <h1 class="display-4">{{ __('How to?') }}</h1>
      <p></p>
      {{-- <p class="lead">
        Follow along with one of our <strong>{{ $instructions->count() }}</strong><br>
        instructions to use Luefty.
      </p> --}}
    </div>
    <div class="col-md-6">
      <input class="form-control form-control-lg" type="text" placeholder="{{ __('Search Instruction') }}">
    </div>
    <div class="col-md-1">
      <button type="submit" class="btn btn-light btn-lg"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
  </div>
</div>
<br>
<div class="container">
    <div class="list-group">
      @foreach ($instructions as $item)
        <a href="{{ url('/instructions/' . $item->id) }}" class="list-group-item list-group-item-action">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ $item->title_en }}</h5>
            {{-- <small>{{ __('Published') }} {{ $item->created_at->diffForHumans() }}</small> --}}
            <small><i class="fa fa-eye" aria-hidden="true"></i> {{ $item->views }} {{ __('Views')}}</small>
          </div>
          {{-- <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p> --}}
        </a>
      @endforeach
      <p></p>
      <div class="row">
        <div class="col-md-12">
            {{-- <div class="pagination">{!! $auctions->appends(['search' => Request::get('search')])->render() !!} </div> --}}
            <div class="pagination">{!! $instructions->links() !!}</div>
        </div>
    </div>
    </div>

  {{-- <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="text-primary">{{ __('Under Construction')}}</h1>
</div> --}}
{{-- <hr> --}}
{{-- <div class="pricing-header px-3 py-3 pb-md-4 mx-auto text-center">
    <h1>{{ __('Under Construction')}}</h1>

<h1 class="display-4">{{ __('How to?') }}</h1>
</div>
<hr>
<div class="row">
    <div class="col-3">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">{{ __('How to create a Private Transfer Auction') }}</a>
        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">{{ __('How to create a Shared Shuttle Auction') }}</a>
        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">{{ __('How to search and Auction en make a bid') }}</a>
        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">{{ __('How to see all my bids')}}</a>
      </div>
    </div>
    <div class="col-9">
      <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
          <p>
            1. Go to <strong>Private Tranfers.</strong> <br>
            <img src="{{ asset('images/instructions/private-menu.png') }}" height="50" alt="">
          </p>
          <p>
            2. Click on <strong>Add new.</strong> <br>
            <img src="{{ asset('images/instructions/private-addnew.png') }}" height="50" alt="">
          </p>
          <p>
            3. Complete all fields and Save.<br>
            <img src="{{ asset('images/instructions/private-addnew.png') }}" height="50" alt="">
          </p>
        </div>
        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">{{ __('How to create a Shared Shuttle Auction') }}</div>
        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">{{ __('How to search and Auction en make a bid') }}</div>
        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">{{ __('How to see all my bids')}}</div>
      </div>
    </div>
  </div> --}}


{{-- @if (App::isLocale('en'))
<p><a href="#">PorSubasta.com</a> is an Auction Platform that supports Reverse Auctions where the offer decreases, as well as Standard Auctions where the offer Increases.
You can post Transfers from any Location or Airport to any other Location or Airport
You can post Tours beginning at the Tour starting point or from any Location to the Tour starting point including the return to the pickup location.
If you are a Transfer, Tour or Travel Agency, Hotel or Entity that needs a Transfer or Tour Offer then you are The Auctioneer.
If you are a Transfer Company wanting to fill an empty leg or get a transfer job or if you are a Tour Operator, then you are The Bidder.</p>
<br>
<h4>AUCTIONEER</h4>
<strong>Transfer or Tour Auction (you have passengers needing a transfer or tour)</strong>
<ul>
  <li>Enter the Opening date of your Auction</li>
  <li>Enter the Ending date of your Auction </li>
  <li>Enter the From or pick up location</li>
  <li>Enter the To or drop off location or the tour name</li>
  <li>Enter the Service date</li>
  <li>Enter the Number of People</li>
  <li>Enter the Number of Seats in the vehicle the Passengers prefer or the Maximum number of available Spaces for your tour</li>
  <li>Click Send and your Auction will now be available for all Bidders to make a Bid</li>
</ul>

<h4>BIDDER</h4>
<strong>TRANSFER COMPANY OR TOUR OPERATOR</strong>
<ul>
  <li>Review all transfer or tours</li>
  <li>Bid on the service or tour you want to win</li>
  <li>(Bidding lower will give you a better chance)</li>
</ul>
<br>
<h5>NOTES:</h5>
<ul>
  <li>You can use our Search and Filters to refine the Auctions and Bids listed on our site. </li>
  <li>View all Bids at any time, accept the Bid you prefer at any time</li>
  <li>You can Delete any Auction or Bid you have posted at any time before it is Accepted</li>
  <li>When the Auctioneer accepts a Bid, both the Auctioneer and the Bidder receive emails with each other’s contact information</li>
  <li>Details of the business transaction are worked out between the Auctioneer and the Bidder, our platform does not get involved in the operational aspects</li>
  <li>The Rating Stars on our platform are based on our assessment of each subscriber based on the information the subscriber has shared with us</li>
</ul>
@elseif (App::isLocale('es'))
<p><a href="#">PorSubasta.com</a> es una plataforma de subastas que admite subastas inversas donde la oferta disminuye, así como subastas estándar donde la oferta aumenta.
     Puedes publicar traslados desde cualquier ubicación o aeropuerto a cualquier otra ubicación o aeropuerto. Puede publicar recorridos que comiencen en el punto de inicio del recorrido o desde cualquier ubicación hasta el punto de inicio del recorrido, incluido el retorno al lugar de recogida. Si usted es una agencia de traslados, excursiones o viajes, un hotel o entidad que necesita una oferta de traslados o excursiones, entonces usted es el subastador.
     Si usted es una empresa de transporte que desea llenar un tramo vacío o conseguir un trabajo de traslado o si es un operador turístico, entonces usted es el licitador.</p>
  <br>
  <h4>SUBASTADOR</h4>
  <strong>Traslado o subasta de tours (usted tiene pasajeros que necesitan un traslado o tour)</strong>
  <ul>
    <li>Ingrese la fecha de apertura de su subasta</li>
    <li>Ingrese la fecha de finalización de su subasta </li>
    <li>Introduzca la ubicación desde o la recogida</li>
    <li>Ingrese la ubicación de destino o finalización o el nombre del recorrido</li>
    <li>Ingrese la fecha de servicio</li>
    <li>Ingrese el número de personas </li>
    <li>Ingrese el número de asientos en el vehículo que prefieren los pasajeros o el número máximo de espacios disponibles para su recorrido</li>
    <li>Haga clic en Enviar y su subasta ahora estará disponible para todos los Licitantes para hacer una oferta</li>
  </ul>

  <h4>OFERTISTA</h4>
  <strong>EMPRESA DE TRANSPORTE O OPERADOR DE TURISMO</strong>
  <ul>
    <li>Revise todos los traslados o excursiones</li>
    <li>Haga una oferta por el servicio o tour que desea ganar.</li>
    <li>(Hacer una oferta más baja le dará una mejor oportunidad)</li>
  </ul>
  <br>
  <h5>NOTAS:</h5>
  <ul>
    <li>Puede utilizar nuestra Búsqueda y filtros para refinar las subastas y ofertas que figuran en nuestro sitio.</li>
    <li>Ver todas las ofertas en cualquier momento, acepte la oferta que prefiera en cualquier momento</li>
    <li>Puede eliminar cualquier subasta o oferta que haya publicado en cualquier momento antes de que se acepte</li>
    <li>Cuando el subastador acepta una oferta, tanto el subastador como el licitador reciben correos electrónicos con la información de contacto del otro</li>
    <li>Los detalles de la transacción comercial se resuelven entre el Subastador y el Licitante, nuestra plataforma no se involucra en los aspectos operativos.</li>
    <li>Las estrellas de calificación en nuestra plataforma se basan en nuestra evaluación de cada suscriptor en función de la información que el suscriptor ha compartido con nosotros</li>
  </ul>

@endif --}}

</div>

@endsection
