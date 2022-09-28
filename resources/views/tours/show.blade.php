@extends('layouts.app2')

@section('content')
<br>

<div class="container">
                        
            <a class="btn btn-secondary" href="/transfers">Atrás</a>
            <hr>
        <div class="row">
            <div class="col-md-8">
                    <h3>{{ $tour->location }}</h3>
                    <h6 class="card-title text-muted">Subastador rating: <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i></i><i class="fa fa-star text-warning"></i><i class="fa fa-star-half-o text-warning"></i> (4.5)</h6>
                    
                    <p><strong>Finaliza:</strong> {{ date('j F, Y', strtotime($tour->end_date)) }} </p>
                    <p><strong>Hora:</strong> {{ date('g:i a', strtotime($tour->end_date)) }}</p>
                    <p><strong>Dias:</strong> {{ $tour->days }}</p>
                    <p><strong>Detalles:</strong> <br />
                        {{ $tour->description }}</p>

                    

               
            </div>
            
            <div class="col-md-4">
                @if (auth()->check() and $tour->user_id === auth()->user()->id) 
                    No puedes ofertar en un tour creado por ti.
                @elseif (auth()->check())
                        <form method="POST" action="{{ route('tours.storeBid', $tour->id) }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                
                                <input type="number" class="form-control {{ $errors->has('bid') ? 'is-invalid' : '' }}" id="bid" name="bid" value="" aria-describedby="bidErrors">
                                
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block" data-submit-value="Please wait...">
                                Hacer una oferta
                            </button>
                        </form>
                @else
                    <p>Debes iniciar sección para hacer una oferta.</p>
                    <p>
                        <a href="/login">Inicia sección</a> o
                        <a href="/register">Regístrate</a>
                    </p>
                @endif

            </div>
        </div>
        <hr>

<br>
<div class="row">
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header with-border"><h4>Ofertas</h4></div>
            <div class="box-body">
                @if (auth()->check())
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                {{-- <th>User</th> --}}
                                <th >Ofertador Rating</th>
                                <th>@sortablelink('bid', 'Oferta')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tour->bids as $bid)
                            <tr class="{{ ($bid->user_id === Auth::user()->id) ? 'table-light' : '' }}">
                                {{-- <td>{{ $bid->user->name }}</td> --}}
                                <td><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i></i><i class="fa fa-star-o text-warning"></i><i class="fa fa-star-o text-warning"></i> (3)</td>
                                <td>${{ number_format($bid->bid, 2, '.', ',') }}</td>
                                <td>
                                    @if ($bid->user_id === Auth::user()->id)
                                    <!-- <a class="btn btn-danger btn-sm" href="#"><i class="fa fa-trash-o"></i></a> -->
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/bids', $bid->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Delete Bid',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                    {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr> 
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                @endif
                @if (auth()->guest())
                <p>Debes iniciar sección para ver las ofertas.</p>
                <p>
                    <a href="/login">Inicia sección</a> o
                    <a href="/register">Regístrate</a>
                </p>
                @endif
            </div>
        </div>
    </div>
</div>

</div>
    </div>


@endsection