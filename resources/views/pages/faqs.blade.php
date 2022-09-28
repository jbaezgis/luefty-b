@extends('layouts.app2')
@section('title', __('FAQ'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
<div class="page-title ">
    <div class="container">
        <h1 class="">FAQ</h1>
    </div>
</div>

<div class="container">
    <div class="accordion" id="accordionExample">
            @foreach($faqs as $item)
            <div class="card">
                <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    @if (App::isLocale('es'))
                        {{ $item->es_title }}
                    @else
                        {{ $item->en_title }}
                    @endif
                    </button>
                </h5>
                </div>
            
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    @if (App::isLocale('es'))
                        {!! $item->es_text !!}
                    @else
                        {!! $item->en_text !!}
                    @endif
                </div>
                </div>
            </div>
            @endforeach
    </div>
</div>

@endsection