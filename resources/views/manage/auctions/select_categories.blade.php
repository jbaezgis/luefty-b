<?php function activeFilter($url){
    return request()->is($url) ? 'btn-primary' : 'btn-light';
  }?>

<div class="row">
    <div class="col-md-12 text-center">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{url('administration/auctions-tourist')}}" class="btn {{ activeFilter('administration/auctions-tourist') }}">{{__('Tourist Auctions')}}</a>
            <a href="{{url('administration/auctions-agencies')}}" class="btn {{ activeFilter('administration/auctions-agencies') }}">{{__('Agencies Auctions')}}</a>
        </div>
    </div>
</div>