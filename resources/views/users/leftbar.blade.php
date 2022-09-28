
<!-- Profile Image -->
<div class="box box-primary">
    <div class="box-body box-profile">
        {{-- <img class="profile-user-img img-responsive rounded-circle" src="/uploads/avatars/{{ $user->avatar }}" alt="User profile picture"> --}}

        <h3 class="profile-username text-center">{{ $user->name }}</h3>

        <p class="text-muted text-center">{{ $user->company_name }} <br>
        {{-- <small class="text-success">{{ __('Public')}} <i class="fa fa-check-circle" aria-hidden="true"></i></small>  --}}
        </p>
      

      <ul class="list-group list-group-unbordered">
        @if ($auctions->count())
          <li class="list-group-item">
            <b>{{ __('Auctions') }}</b> <a class="pull-right">{{ $auctions->count() }}</a>
          </li>
        @endif

        <li class="list-group-item">
          <b>{{ __('Followers') }}</b> <a class="pull-right">{{ $user->profile->followers->count()}}</a>
        </li>
        <li class="list-group-item">
          <b>{{ __('Following') }}</b> <a class="pull-right">{{ $user->following->count()}}</a>
        </li>

        {{-- <li class="list-group-item">
          <b>Friends</b> <a class="pull-right">13,287</a>
        </li> --}}
      </ul>

          {!! Form::open([
            'method' => 'POST',
            'url' => ['/follow', $user->id],
            'style' => 'display:inline'
          ]) !!}

          {{-- @if ($fallows) --}}
            <button class="btn {{ $buttonclass }} btn-block" type="submit">{{ $buttontext }}</button>
{{--           
              {!! Form::button('Add to my favorites', array(
                      'type' => 'submit',
                      'class' => 'btn btn-primary btn-sm btn-block',
                      'title' => __('Add'),
                      'data-toggle' => 'tooltip',
                      'data-placement' => 'top'
                      // 'onclick' => 'return confirm("Surely you want to delete?")'
              )) !!} --}}
          {!! Form::close() !!}

      {{-- <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button> --}}
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
