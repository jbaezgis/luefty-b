    {{-- <div class="col-md-2">
        <div class="form-group">
            {!! Form::text('service_number', null, ['class' => 'form-control', 'placeholder'=> __('Auction #')]) !!}
        </div>
    </div> --}}
    {{-- <div class="col-md-12">
        <div class="form-group mb-n1">
            <label for="from">@lang('globals.from')</label>
            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('From location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
        </div>
    </div> --}}
    <div class="col-md-5">
        <div class="form-group">
            {{-- <label for="from">@lang('globals.from')</label> --}}
            {{-- <a tabindex="0" class="" role="button" data-toggle="tooltip" data-placement="right" title="{{ __('From location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a> --}}
            {!! Form::select('from_city', App\Location::where('country_id', Auth::user()->country_id)->where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'from_city', 'placeholder'=>__('--From location--'), 'class'=>'form-control select2' ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from_location') }}</small>
        </div>
    </div>
    {{-- <div class="col-md-6">
        <div class="form-group">
            <label for="to">@lang('globals.to')</label>
            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('To location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a>

            {!! Form::select('from_location', App\Place::where('location_id', $from_city)->orderBy('name')->pluck('name', 'id'), null, ['id'=>'from_location', 'placeholder'=>__('--Select a Place--'), 'class'=>'form-control select2' ]) !!}
            <small id="toErrors" class="form-text text-danger">{{ $errors->first('to_location') }}</small>
        </div>
    </div> --}}
    {{-- <div class="col-md-12">
        <div class="form-group mb-n1">
            <label for="from">@lang('globals.to')</label>
            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('From location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
        </div>
    </div> --}}
    <div class="col-md-5">
        <div class="form-group">
            {{-- <label for="from">@lang('globals.to')</label> --}}
            {{-- <a tabindex="0" class="" role="button" data-toggle="tooltip" data-placement="right" title="{{ __('To location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a> --}}
            {!! Form::select('to_city', App\Location::where('country_id', Auth::user()->country_id)->where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'to_city', 'placeholder'=>__('--To location--'), 'class'=>'form-control select2' ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from_location') }}</small>
        </div>
    </div>
    {{-- <div class="col-md-6">
        <div class="form-group">
            <label for="to">@lang('globals.to')</label>
            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('To location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a>

            {!! Form::select('to_location', App\Place::where('location_id', $to_city)->orderBy('name')->pluck('name', 'id'), null, ['id'=>'to_location', 'placeholder'=>__('--Select a Place--'), 'class'=>'form-control select2' ]) !!}

            <small id="toErrors" class="form-text text-danger">{{ $errors->first('to_location') }}</small>
        </div>
    </div> --}}
{{-- <div class="col-md-2">
    <div class="form-group">
        <label for="to">Hasta</label>
        {!! Form::select('category_id', App\Category::where('disable', 0)->pluck('name', 'id'), null, ['placeholder'=> __('Category'), 'class'=>'form-control select2']) !!}
    </div>
</div> --}}

<div class="col-md-2">
    <div class="form-group">
        {{-- <label for="to">Hasta</label> --}}
        {!! Form::text('date', null, ['class' => 'form-control datepicker', 'placeholder'=> __('Date')]) !!}
    </div>
</div>






