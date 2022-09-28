<div class="row">
    <div class="col-md-12">
        <div class="{{ $errors->has('lang') ? ' has-error' : ''}}">
            {!! Form::label('module', trans('globals.module'), ['class' => 'control-label']) !!}
            <select class="form-control {{ $errors->has('module') ? 'has-error' : '' }} select2" id="module" name="module">
                <option value="Auctions" @if ($formMode === 'edit'){{ $task->module == 'en' ? 'selected' : '' }}@endif>Auctions</option>
                <option value="Auctions" @if ($formMode === 'edit'){{ $task->module == 'es' ? 'selected' : '' }}@endif>Bids</option>
            </select>
            {!! $errors->first('module', '<p class="help-block">:message</p>') !!}
        </div>
        <br>
    </div>

    <div class="col-md-12">
        <div class="{{ $errors->has('name') ? ' has-error' : ''}}">
            {!! Form::label('name', 'Name: ', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
        <br>
    </div>
    <div class="col-md-12">
        <div class="{{ $errors->has('description') ? ' has-error' : ''}}">
            {!! Form::label('description', 'description: ', ['class' => 'control-label']) !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12">
        
        <br>
        <div class="">
            {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
        </div>

    </div>
</div>

