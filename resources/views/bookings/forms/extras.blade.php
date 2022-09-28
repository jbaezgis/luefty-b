<div class="box box-solid box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">{{__('Extras')}}</h4>
    </div>
    <div class="card-body">
        <div class="row">

            <div class="col-md-6">
                <div class="d-flex flex-row">
                    <div class="p-1"><i class="fa fa-wheelchair fa-lg text-info" aria-hidden="true"></i></div>
                    <div class="p-1">
                        <strong>Wheelchair</strong>
                        <span class="text-info">{{$auction->country->currency_symbol}} 7.00</span><br>
                        <span><small>(folding type only)</small></span>
                    </div>
                    <div class="p-1">
                        <div class="form-group">
                            {{-- <label for="inputEmail4">{{ __('Language') }}</label> --}}
                            <select class="form-control" id="wheelchair" name="wheelchair" value="{{ old('wheelchair') }}">
                                <option value="">0</option>
                                @if (App\Extra::where('auction_id', $auction->id)->where('name', 'Wheelchair')->count())
                                    <option value="1" {{$extra_wheelchair->quantity == 1 ? 'selected' : ''}}>1</option>
                                    <option value="2" {{$extra_wheelchair->quantity == 2 ? 'selected' : ''}}>2</option>
                                    <option value="3" {{$extra_wheelchair->quantity == 3 ? 'selected' : ''}}>3</option>
                                    <option value="4" {{$extra_wheelchair->quantity == 4 ? 'selected' : ''}}>4</option>
                                    <option value="5" {{$extra_wheelchair->quantity == 5 ? 'selected' : ''}}>5</option>
                                @else
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                @endif
                            </select>
            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-row">
                    <div class="p-1"><i class="fa fa-clock-o fa-lg text-info" aria-hidden="true"></i></div>
                    <div class="p-1">
                        <strong>5 min extra stop in same town</strong><br>
                        <span class="text-info">{{$auction->country->currency_symbol}} 15.00</span><br>
                        {{-- <span><small>(folding type only)</small></span> --}}
                    </div>
                    <div class="p-1">
                        <div class="form-group">
                            {{-- <label for="inputEmail4">{{ __('Language') }}</label> --}}
                            <select class="form-control" id="min_extra" name="min_extra" value="{{ old('min_extra') }}">
                                <option value="">0</option>
                                @if (App\Extra::where('auction_id', $auction->id)->where('name', '5 min extra')->count())
                                    <option value="1" {{$extra_5min->quantity == 1 ? 'selected' : ''}}>1</option>
                                    <option value="2" {{$extra_5min->quantity == 2 ? 'selected' : ''}}>2</option>
                                    <option value="3" {{$extra_5min->quantity == 3 ? 'selected' : ''}}>3</option>
                                    <option value="4" {{$extra_5min->quantity == 4 ? 'selected' : ''}}>4</option>
                                    <option value="5" {{$extra_5min->quantity == 5 ? 'selected' : ''}}>5</option>
                                @else
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                @endif
                            </select>
            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-row">
                    <div class="p-1"><i class="fa fa-child fa-lg text-info" aria-hidden="true"></i></div>
                    <div class="p-1">
                        <strong>Child seat</strong>
                        <span class="text-info">{{$auction->country->currency_symbol}} 10.00</span><br>
                        {{-- <span><small>Suitable for toddlers weighing 9-18 kg (approx 1 to 6 years)</small></span> --}}
                    </div>
                    <div class="p-1 text-right">
                        <div class="form-group">
                            {{-- <label for="inputEmail4">{{ __('Language') }}</label> --}}
                            <select class="form-control" id="child_seat" name="child_seat" value="{{ old('child_seat') }}">
                                <option value="">0</option>
                                @if (App\Extra::where('auction_id', $auction->id)->where('name', 'Child seat')->count())
                                    <option value="1" {{$extra_child_seat->quantity == 1 ? 'selected' : ''}}>1</option>
                                    <option value="2" {{$extra_child_seat->quantity == 2 ? 'selected' : ''}}>2</option>
                                    <option value="3" {{$extra_child_seat->quantity == 3 ? 'selected' : ''}}>3</option>
                                    <option value="4" {{$extra_child_seat->quantity == 4 ? 'selected' : ''}}>4</option>
                                    <option value="5" {{$extra_child_seat->quantity == 5 ? 'selected' : ''}}>5</option>
                                @else
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                @endif
                            </select>
            
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <div class="p-1">
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-row">
                    <div class="p-1"><i class="fa fa-child fa-lg text-info" aria-hidden="true"></i></div>
                    <div class="p-1">
                        <strong>Booster seat</strong>
                        <span class="text-info">{{$auction->country->currency_symbol}} 10.00</span><br>
                        {{-- <span><small>(folding type only)</small></span> --}}
                    </div>
                    <div class="p-1">
                        <div class="form-group">
                            {{-- <label for="inputEmail4">{{ __('Language') }}</label> --}}
                            <select class="form-control" id="booster_seat" name="booster_seat" value="{{ old('booster_seat') }}">
                                <option value="">0</option>
                                @if (App\Extra::where('auction_id', $auction->id)->where('name', 'Booster seat')->count())
                                    <option value="1" {{$extra_booster_seat->quantity == 1 ? 'selected' : ''}}>1</option>
                                    <option value="2" {{$extra_booster_seat->quantity == 2 ? 'selected' : ''}}>2</option>
                                    <option value="3" {{$extra_booster_seat->quantity == 3 ? 'selected' : ''}}>3</option>
                                    <option value="4" {{$extra_booster_seat->quantity == 4 ? 'selected' : ''}}>4</option>
                                    <option value="5" {{$extra_booster_seat->quantity == 5 ? 'selected' : ''}}>5</option>
                                @else
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                @endif
                            </select>
            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>