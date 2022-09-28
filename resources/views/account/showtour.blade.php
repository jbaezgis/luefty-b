@extends('layouts.app2')

@section('content')
<br>

<div class="container">
                        
            <a class="btn btn-secondary" href="/transfers">Atrás</a>
            <hr>
        <div class="row">
            <div class="col-md-8">
                    <h3>{{ $tour->location }}
                        {{-- <small class=" {{ ($auction->status === 'Closed') ? 'text-success' : 'text-warning' }}"> - ({{ $auction->status }})</small> --}}
                        <span class="badge {{ ($tour->status === 'Closed') ? 'badge-success' : 'badge-warning' }}">{{ $tour->status }}</span>
                    </h3>
                    <h6 class="card-title text-muted">Subastador rating: <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i></i><i class="fa fa-star text-warning"></i><i class="fa fa-star-half-o text-warning"></i> (4.5)</h6>
                    
                    <p><strong>Finaliza:</strong> {{ date('j F, Y', strtotime($tour->end_date)) }} </p>
                    <p><strong>Hora:</strong> {{ date('g:i a', strtotime($tour->end_date)) }}</p>
                    <p><strong>Dias:</strong> {{ $tour->days }}</p>

                    

               
            </div>
            
            <div class="col-md-4">
                <!-- @if (auth()->check()) 
                    @if ($tour->user_id === Auth::user()->id)
                        No puedes ofertar en una subasta creada por ti.
                    @endif
                @else 
                    @if (auth()->check())
                        <form method="POST" action="{{ route('bids.store', $tour->id) }}">
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

                @endif
 -->
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
                            {{-- won: {{ $bid_won }} --}}
                            @foreach ($tour->bids as $bid)
                            <tr class="{{ ($bid->won === 1) ? 'table-success' : '' }}">
                                {{-- <td>{{ $bid->user->name }}</td> --}}
                                <td><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i></i><i class="fa fa-star-o text-warning"></i><i class="fa fa-star-o text-warning"></i> (3)</td>
                                <td>${{ number_format($bid->bid, 2, '.', ',') }} </td>
                                <td>
                                    {{-- <a class="btn btn-success btn-sm" href="#"><i class="fa fa-check"></i> Aceptar</a> --}}
                                    @if ($bid_won)

                                    @else
                                    {!! Form::open([
                                        'method' => 'PATCH',
                                        'url' => ['/bidstour', $bid->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-success btn-sm',
                                                'title' => 'Aceptar oferta',
                                                'onclick'=>'return confirm("Seguro que desea aceptar esta oferta?")'
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