<?php function activeLeftMenuItem($url){
    return request()->is($url) ? 'active' : '';
}?>


<div class="nav nav-pills flex-column me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <a class="nav-link {{ activeLeftMenuItem('administration/content/locations*') }}" href="{{url('administration/content/locations')}}">{{__('Locations')}}</a>
    {{-- <a class="nav-link {{ activeLeftMenuItem('administration/content/home*') }}" href="{{ url('administration/content/home*') }}">{{__('Home Page')}}</a> --}}
    <a class="nav-link {{ activeLeftMenuItem('administration/content/attractions*') }}" href="{{ url('administration/content/attractions') }}">{{__('Attractions')}}</a>
    <a class="nav-link {{ activeLeftMenuItem('administration/content/tours*') }}" href="{{ url('administration/content/tours') }}">{{__('Tours')}}</a>
    {{-- <a class="nav-link {{ activeLeftMenuItem('administration/content/tours*') }}" href="{{url('administration/content/tours')}}">{{__('Tours')}}</a> --}}
    <a class="nav-link {{ activeLeftMenuItem('administration/content/posts*') }}" href="{{url('administration/content/posts')}}">{{__('Posts')}}</a>
    <a class="nav-link {{ activeLeftMenuItem('administration/content/whales*') }}" href="{{url('administration/content/whales')}}">{{__('Whales')}}</a>
    <a class="nav-link {{ activeLeftMenuItem('administration/content/pages*') }}" href="{{url('administration/content/pages')}}">{{__('Pages')}}</a>
    <a class="nav-link {{ activeLeftMenuItem('administration/content/sliders*') }}" href="{{url('administration/content/sliders')}}">{{__('Sliders')}}</a>
</div>
