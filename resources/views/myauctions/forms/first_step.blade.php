@csrf
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="category_id">{{__('Auction type')}}</label>
            {!! Form::select('category_id', App\Category::where('disable', 0)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'category_id','placeholder'=>__('Select a Category'), 'class'=>'form-control select2', 'required']) !!}
            {{-- {!! Form::select('from_city', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'from_city', 'placeholder'=>'', 'class'=>'form-control select2', 'required' ]) !!} --}}
            <div class="invalid-feedback">
                {{__('Please select a Category.')}}
            </div>
        </div>
    </div>{{-- end col-md-12 --}}
</div>{{-- end row --}}
