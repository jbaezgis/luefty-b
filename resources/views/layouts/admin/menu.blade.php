<?php function activeMenu($url){
  return request()->is($url) ? 'btn-primary' : 'btn-light';
}?>
<?php function activeMenuItem($url){
  return request()->is($url) ? 'active' : '';
}?>
<div class="container-fluid">

  <div class="row border-bottom py-1">
      <div class="col-md-12">
        <div class="container">
          <div class="row">
            {{-- left menu --}}
            <div class="col-md-2">
              <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{route('admin.dashboard')}} " class="btn {{ activeMenu('administration') }}">{{__('Dashboard')}}</a>
              </div>
            </div>
  
            {{-- right menu --}}
            <div class="col-md-10 text-right">
              
              <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{url('administration/coupons')}} " class="btn {{ activeMenu('administration/coupons') }}">{{__('Coupons')}}</a>
                <a href="{{url('administration/transfers/list')}} " class="btn {{ activeMenu('administration/transfers/list') }}">{{__('Transfers List')}}</a>
                <a href="{{url('administration/auctions-tourist')}} " class="btn {{ activeMenu('administration/auctions*') }}">{{__('Manage Auctions')}}</a>
                <a href="{{route('countries.index')}} " class="btn {{ activeMenu('locations*') }}">{{__('Countries')}}</a>
                <a href="{{url('administration/content/attractions')}} " class="btn {{ activeMenu('administration/content/*') }}">{{__('Content')}}</a>
                {{-- <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn {{ activeMenu('administration/content/*') }} dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{__('Content')}}
                  </button>
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item {{ activeMenuItem('administration/attractions/*') }}" href="{{url('administration/attractions')}}">{{__('Attractions')}}</a>
                    <a class="dropdown-item {{ activeMenuItem('administration/tours/*') }}" href="{{url('administration/tours')}}">{{__('Tours')}}</a>
                    <a class="dropdown-item {{ activeMenuItem('administration/posts/*') }}" href="{{url('administration/posts')}}">{{__('Posts')}}</a>
                    <a class="dropdown-item {{ activeMenuItem('administration/content/whales/*') }}" href="{{url('administration/whales')}}">{{__('Whales')}}</a>
                    <a class="dropdown-item {{ activeMenuItem('administration/content/pages/*') }}" href="{{url('administration/content/pages')}}">{{__('Pages')}}</a>
                  </div>
                </div> --}}
                {{-- <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{__('Maintenance')}}
                  </button>
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item {{ activeMenuItem('csountries*') }}" href="#"><i class="fa fa-map-marker"></i> {{__('Locations')}}</a>
                    <a class="dropdown-item" href="#">{{__('Places Descriptions')}}</a>
                  </div>
                </div> --}}
                <a href="{{url('administration/users')}}" class="btn {{ activeMenu('administration/users*') }}"><i class="fa fa-user" aria-hidden="true"></i> {{__('Users')}}</a>
                <a href="#" class="btn btn-light"><i class="fa fa-gears" aria-hidden="true"></i> {{__('Settings')}}</a>
              </div>
              
            </div>
          </div>
  
        </div>{{-- /container --}}
      </div>
  
  </div>
</div>