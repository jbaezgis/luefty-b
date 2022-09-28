<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=> __('Name')]) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder'=> __('Email')]) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::text('company_name', null, ['class' => 'form-control', 'placeholder'=> __('Company Name')]) !!}
        </div>
    </div>
    <div class="col-md-3 d-none d-lg-block d-xl-block">
        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> {{ __('Search') }} </button>
        <a href="{{ url('/manage/users') }}" class="btn btn-warning">{{ __('Clear filters')}}</a>
    </div>
    <div class="col-md-3 d-none d-block d-sm-block d-md-none">
        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search"></i> {{ __('Search') }} </button>
        <a href="{{ url('/manage/users') }}" class="btn btn-warning btn-sm">{{ __('Clear filters')}}</a>
    </div>
</div>
