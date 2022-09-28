{{ csrf_field() }}
<div class="d-flex flex-row bd-highlight mb-3">
        <div class="p-2 w-100 bd-highlight">
            <div class="form-group">
                <label for="extra_id">{{ __('Extra') }}</label>
                {!! Form::select('extra_id', App\Extra::where('type', 'Provider')->pluck('name', 'id'), null, ['placeholder'=>'', 'class'=>'form-control select2', 'required' ]) !!}
                @if($errors->any())
                    <small id="bidErrors" class="form-text text-danger">{{ $errors->first('bid') }}</small>
                @endif
            </div> {{-- end form-group--}}
        </div>{{-- end flex item--}}
        <div class="p-2 bd-highlight">
            <div class="form-group">
                <label for="quantity">{{ __('Quantity') }}</label>
                <input type="number" class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" id="quantity" name="quantity" value="" aria-describedby="quantityErrors" required>
                @if($errors->any())
                    <small id="quantityErrors" class="form-text text-danger">{{ $errors->first('quantity') }}</small>
                @endif
            </div> {{-- end form-group--}}
        </div>{{-- end flex item--}}
        <div class="p-2 bd-highlight">
            <button type="submit"  class="btn btn-primary btn-block" style="margin-top: 32px"">
                {{ __('Add') }}
            </button>
        </div>{{-- end flex item--}}
    </div>{{-- end flex row--}}