{!! Form::model($auction, [
    'method' => 'PATCH',
    'url' => ['/fromto', $auction->id],
    'id' => 'locations_form',
    'class' => 'form-horizontal needs-validation',
    'novalidate'
]) !!}

{!! Form::close() !!}

{!! Form::model($auction, [
    'method' => 'PATCH',
    'url' => ['/booking', $auction->id],
    'id' => 'main_form',
    'class' => 'form-horizontal needs-validation',
    'novalidate'

]) !!}
    {{-- Service details --}}



{!! Form::close() !!}
