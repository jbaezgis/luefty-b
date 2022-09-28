
{{-- Extras --}}
<div class="row">
    <div class="col-md-6">
        <strong>{{ __('Requirements for provider') }}</strong>
        <form method="POST" id="extraspro" action="{{ route('extraspro.store', $auction->id) }}">
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
                    <button type="submit" form="extraspro" onclick="saveDataPro()"class="btn btn-primary btn-block" style="margin-top: 32px" data-submit-value="Please wait...">
                        {{ __('Add') }}
                    </button>
                </div>{{-- end flex item--}}
            </div>{{-- end flex row--}}
            
        </form>

        {{-- Extras providers --}}

        <table class="table">
                <tbody>
                    @foreach ($extraspro as $item)
                        <tr>
                            <td scope="row"><strong>{{ $item->quantity }}</strong> {{ $item->extra->name }}</td>
                            <td>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'url' => ['/extraspro', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => "__('Delete Extra')",
                                            'onclick'=>'return confirm("__("Confirm delete?")")'
                                    )) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    <div class="col-md-6">
        <strong>{{ __('Passengers') }}</strong>
        <form method="POST" action="{{ route('extraspass.store', $auction->id) }}">
            {{ csrf_field() }}
            <div class="d-flex flex-row bd-highlight mb-3">
                <div class="p-2 w-100 bd-highlight">
                    <div class="form-group"> 
                        <label for="extra_id">{{ __('Extra') }}</label>
                        {!! Form::select('extra_id', App\Extra::where('type', 'Passenger')->pluck('name', 'id'), null, ['placeholder'=>'', 'class'=>'form-control select2', 'required' ]) !!}
                        @if($errors->any())
                            <small id="bidErrors" class="form-text text-danger">{{ $errors->first('bid') }}</small>
                        @endif
                    </div> {{-- end form-group--}}
                </div>{{-- end flex item--}}
                <div class="p-2 bd-highlight">
                    <div class="form-group">
                        <label for="quantity">{{ __('Quantity') }}</label>
                        <input type="number" class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" id="quantity" name="quantity" value="" aria-describedby="quantityErrors">
                        @if($errors->any())
                            <small id="quantityErrors" class="form-text text-danger">{{ $errors->first('quantity') }}</small>
                        @endif
                    </div> {{-- end form-group--}}
                </div>{{-- end flex item--}}
                <div class="p-2 bd-highlight">
                    <button type="submit" id="addpass" onclick="saveDataPass()" class="btn btn-primary btn-block" style="margin-top: 32px">
                        {{ __('Add') }}
                    </button>
                </div>{{-- end flex item--}}
            </div>{{-- end flex row--}}
        </form>

        {{-- Extras passenger --}}
        <table class="table">
            <tbody id="extraspassrows">
                {{-- @foreach ($extraspass as $item)
                    <tr>
                        <td scope="row"><strong>{{ $item->quantity }}</strong> {{ $item->extra->name }}</td>
                        <td>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'url' => ['/extraspass', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-sm',
                                        'title' => 'Delete Extra',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                )) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
