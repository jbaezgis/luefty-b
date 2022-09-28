@extends('layouts.app2')

@section('content')
<br>
<div class="container">
        <div class="row">
          <div class="col-md-12">
            <a href="{{ route('users.index') }} " class="btn btn-light"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Go back to Members') }} </a>
            <p></p>
          </div>
                <div class="col-md-3">
                  @include('users.leftbar')
                </div>

                <div class="col-md-9">

                    {{-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{ __('Profile')}}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('Notifications')}}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">{{ __('Activity log')}}</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                      </div> --}}

                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title">{{ __('Member details') }}</h3>
                      </div>
                      <div class="box-body">
                        {{-- <div class="row">
                          <div class="col-md-12 text-center">
                            <h3>{{ auth()->user()->name }}</h3>
                            <small class="text-muted">{{ __('Company Name') }}</small>
                            <p>{{ auth()->user()->company_name }}</p>
                          </div>
                        </div> --}}
                        {{-- <div class="row">
                          <div class="col-md-4">
                            <small class="text-muted">{{ __('Name') }}</small>
                            <p>{{ auth()->user()->name }}</p>
                          </div>
                          <div class="col-md-4">
                            <small class="text-muted">{{ __('Company Name') }}</small>
                            <p>{{ auth()->user()->company_name }}</p>
                          </div>
                        </div> --}}

                        <div class="row">
                          @if ($user->address_ispublic == 1)
                            <div class="col-md-4">
                              <small class="text-muted">{{ __('Address') }}</small>
                              <p>{{ $user->address }}</p>
                            </div>
                          @endif
                            <div class="col-md-4">
                              <small class="text-muted">{{ __('Location') }}</small>
                              <p>{{ $user->location['name'] }}</p>
                            </div>
                            <div class="col-md-4">
                              <small class="text-muted">{{ __('Country') }}</small>
                              <p>{{ $user->country['en_name'] }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                              <small class="text-muted">{{ __('Email') }}</small>
                              <p>{{ $user->email }}</p>
                            </div>
                            @if ($user->phone_ispublic == 1)
                            <div class="col-md-4">
                              <small class="text-muted">{{ __('Phone') }}</small>
                              <p>{{ $user->phone }}</p>
                            </div>
                            @endif
                            <div class="col-md-4">
                              <small class="text-muted">{{ __('Web site') }}</small>
                              <p>{{ $user->web_site }}</p>
                            </div>
                        </div>

                        <div class="row">
                            @if ($user->rnc_ispublic == 1)
                            <div class="col-md-4">
                              <small class="text-muted">{{ __('RNC') }}</small>
                              <p>{{ $user->rnc }}</p>
                            </div>
                            @endif
                            @if ($user->cedula_ispublic == 1)
                            <div class="col-md-4">
                              <small class="text-muted">{{ __('Cédula') }}</small>
                              <p>{{ $user->cedula }} </p>
                            </div>
                            @endif
                            <div class="col-md-4">
                              {{-- <small class="text-muted">{{ __('Country') }}</small>
                              <p>{{ $user->country->en_name }}</p> --}}
                            </div>
                        </div>

                      </div>
                    </div>

                    {{-- User Auctions --}}
                    @if ($auctions->count())
                    <div class="box box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">{{ __('User Auctions') }}</h3>
                        </div>
                        <div class="box-body">
                          <table class="table">
                            <tbody>
                                @foreach ($auctions as $item)
                                  <tr>
                                    <td scope="row">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <a class="text-decoration-none" href="{{ url('/auctions/' . $item->id) }}">@lang('globals.from') <strong><span class="text-capitalize">{{ $item->fromcity->name }}</span> - {{ $item->fromlocation['name'] }}</strong> @lang('globals.to') <strong><span class="text-capitalize">{{ $item->tocity->name }}</span> - {{ $item->tolocation['name'] }}</strong></a>
                                        </div>
                                        <div class="col-md-12">
                                          <small class="text-muted">
                                              @if (Config::get('app.locale') == 'en')
                                              <span class="badge {{ $item->category_id == 1 ? 'badge-primary' : 'badge-success' }} ">{{ $item->category['name'] }}</span>
                                          @else
                                              <span class="badge {{ $item->category_id == 1 ? 'badge-primary' : 'badge-success' }}">{{ $item->category['es_name'] }}</span>
                                          @endif
                                          |

                                          @if ($item->category_id == 1)

                                          <strong>{{ __('Bid')}}s</strong>: <span class="text-primary">{{ $bids->where('auction_id', $item->id)->count() }}</span> |

                                          <strong>{{ __('Passengers') }}:</strong>
                                          <span id="passengers" class="text-primary">{{ $item->passengers }}</span>
                                          |
                                          <strong> {{ __('Service')}}</strong>: <span class="text-primary">{{ date('l j, F Y', strtotime($item->date)) }}, {{ date('g:i A', strtotime($item->time)) }}</span>

                                          @elseif ($item->category_id == 2)
                                          <strong>{{ __('Starting bid') }}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">$ {{ number_format($item->starting_bid, 2, '.', ',') }}</span> |
                                          <strong>{{ __('Seats available') }}:</strong>
                                          <span class="text-success">{{ $item->passengers }}</span>
                                          |
                                          <strong>{{ __('Original') }}:</strong>
                                          <span class="text-success ">{{ $item->shared_seats }}</span>
                                          |
                                          <strong>{{__('Date')}}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('l, F j - Y', strtotime($item->date)) }}</span> | <strong> {{ __('Boarding Time')}}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('g:i A', strtotime($item->from_time)) }}</span> <strong> {{ __('Departue Time')}}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('g:i A', strtotime($item->to_time)) }}</span>
                                          @endif
                                          </small>
                                        </div>
                                      </div>

                                    </td>
                                  </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- /.col -->
              </div>


</div>
@endsection
