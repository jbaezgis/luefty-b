<div class="row">
    <div class="col-md-2">
        <div class="form-group">

            {!! Form::text('service_number', null, ['class' => 'form-control', 'placeholder'=> __('Service number')]) !!}
        </div>
    </div>
    <div class="col-md-3">
            <button class="btn btn-primary" type="submit">{{--<i class="fa fa-search"></i>--}} {{ __('Selected') }} </button>
            <a href="{{ url('/myauctions/privatetransfers/index') }}" class="btn btn-warning">{{ __('All')}}</a>
    </div>
</div>
{{-- <hr> --}}
<div class="row">
    <div class="col-md-3">
        <div class="form-group">

            {!! Form::select('from', App\Location::pluck('name', 'id'), null, ['placeholder'=> __('From location'), 'id'=>'from', 'class'=>'form-control select2']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">

            {!! Form::select('to', App\Location::pluck('name', 'id'), null, ['placeholder'=> __('To location'), 'id'=>'to', 'class'=>'form-control select2']) !!}
        </div>
    </div>
    <div class="col-md-3" >
        <button class="btn btn-primary" type="submit">{{--<i class="fa fa-search"></i>--}} {{ __('Selected') }} </button>
        <a href="{{ url('/myauctions/privatetransfers/index') }}" class="btn btn-warning">{{ __('All')}} </a>
    </div>

</div>
{{-- <div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::select('from', array('Open', 'Closed'), null, ['placeholder'=> __('--Select Status--'), 'id'=>'from', 'class'=>'form-control select2']) !!}
        </div>
    </div>

    <div class="col-md-3" >
        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
        <a href="{{ url('/myauctions') }}" class="btn btn-warning">{{ __('See all')}} </a>
    </div>

</div> --}}
