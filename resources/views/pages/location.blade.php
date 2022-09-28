@extends('layouts.app2')
@section('title', $location->name)
@section('keywords', $location->name.', Auctions, Travel, Tourism, Tours')
@section('og-image', asset('storage/images/locations/'.$location->image))
@section('og-image-url',  asset('storage/images/locations/'.$location->image))

@section('content')
<div class="container">
    <div class="jumbotron jumbotron-fluid mb-1" style="background-image: url('{{URL::asset('storage/images/locations/'. $location->image)}}');">
        <div class="container text-center text-white custom-text-shaddow">
            <span><h4>{{__('Things to do in')}}</h4></span>
            <h1 class="display-4">{{$location->name}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <small><a href="{{url('/')}}">{{__('Home')}}</a> / <span class="text-muted">{{__('Things to do in')}} {{$location->name}}</span></small> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center py-3">
            <h1>{{__('Welcome to')}} {{$location->name}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center mb-5">
            <p>
                {!! $location->description !!}
            </p>
        </div>
    </div>

</div>
<div class="row bg-light">
    <div class="col-md-12 py-5">
        <div class="container text-center">
            <h3 class="">{{__('Top 10 attractions in')}} {{$location->name}}</h3>
            <p>
                <div class="glider-contain">
                    <div class="glider">
                        @foreach($location->attractions as $item)
                        <div class="card mr-2">
                            <a href="{{url('attraction/'. $item->slug)}}">
                                <img src="{{URL::asset('storage/images/attractions/'. $item->image)}}" class="card-img-top" alt="{{$item->image}}">
                            </a>
                            <div class="card-body">
                                <div class="text-truncate">
                                    <h5>{{$item->title}}</h5>
                                </div>
                                <p>{{$item->short_description}}</p>
                            </div>
                        </div>
                            
                        @endforeach
                    </div>
                    <button class="glider-prev">&laquo;</button>
                    <button class="glider-next">&raquo;</button>
                    <div id="dots"></div>
                </div>
            </p>
        </div>
    </div>
</div>
{{-- /container --}}
@endsection

@section('scripts')
<script>
    window.addEventListener('load',function(){
    document.querySelector('.glider').addEventListener('glider-slide-visible', function(event){
        var glider = Glider(this);
        console.log('Slide Visible %s', event.detail.slide)
    });
    document.querySelector('.glider').addEventListener('glider-slide-hidden', function(event){
        console.log('Slide Hidden %s', event.detail.slide)
    });
    document.querySelector('.glider').addEventListener('glider-refresh', function(event){
        console.log('Refresh')
    });
    document.querySelector('.glider').addEventListener('glider-loaded', function(event){
        console.log('Loaded')
    });

    window._ = new Glider(document.querySelector('.glider'), {
        slidesToShow: 1, //'auto',
        slidesToScroll: 1,
        itemWidth: 350,
        draggable: true,
        scrollLock: false,
        dots: '#dots',
        rewind: true,
        arrows: {
            prev: '.glider-prev',
            next: '.glider-next'
        },
        responsive: [
            {
                breakpoint: 800,
                settings: {
                    slidesToScroll: 'auto',
                    itemWidth: 300,
                    slidesToShow: 'auto',
                    exactWidth: true
                }
            },
            {
                breakpoint: 700,
                settings: {
                    slidesToScroll: 4,
                    slidesToShow: 4,
                    dots: false,
                    arrows: false,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToScroll: 3,
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 500,
                settings: {
                    slidesToScroll: 2,
                    slidesToShow: 2,
                    dots: false,
                    arrows: false,
                    scrollLock: true
                }
            }
        ]
    });
    });
</script>
@endsection