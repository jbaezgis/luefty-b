@csrf
<div class="row">
    <div class="col-md-12">
        {{__('Auction type')}}:<br/>
        {!! Form::select('category_id', App\Category::pluck('name', 'id'), null, ['placeholder'=>__('Select a Category'), 'class'=>'form-control select2']) !!}
    </div>
</div>{{-- end row --}}
