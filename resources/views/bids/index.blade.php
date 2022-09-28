@extends('layouts.app2')

@section('content')
<div class="page-title ">
    <div class="container">
      <h1 class="">Auctions</h1>
    </div>
</div>
<br>
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bids</div>
                <div class="card-body">


                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Auct-ID</th>
                                    <th>Auction</th>
                                    <th>Ofertador</th>
                                    <th>Auct-Status</th>
                                    <th>Delete?</th>
                                    <th>Bid</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($bids as $item)
                                <tr>
                                    {{-- <td>{{ $item->auction->id }}</td> --}}
                                    <td>{{ $item->auction->fromcity->name }} a {{ $item->auction->tocity->name }}</td>
                                    <td>{{ $item->auction->status }}</td>
                                    <td>{{ $item->auction->deleted === 1 ? 'Yes' : 'No'}}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->bid }}</td>
                                    <td>
                                        <a href="{{ url('/bids/' . $item->id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                        <a href="{{ url('/bids/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => ['/bids', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete User',
                                            )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="pagination"> {!! $bids->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
