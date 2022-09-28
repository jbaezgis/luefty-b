<div class="col-md-3">
    {!! Form::open(['method' => 'GET', 'url' => '/transfers', 'class' => 'form-inline my-2 my-lg-0', 'role' => 'search'])  !!}
    <div class="box box-solid">
        <div class="box-header with-border">
        <h3 class="box-title">Filtros</h3>
        </div>
        <div class="box-body">
            {{-- <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search...">
                <span class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div> --}}
            <div class="form-group">
                <label for="from">Desde</label>
                <input type="text" class="form-control" name="from" id="from" value="{{ old('from') }}">
            </div>
            <div class="form-group">
                <label for="to">Hasta</label>
                <input type="text" class="form-control" name="to" id="to">
            </div>
            
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button class="btn btn-secondary btn-block" type="submit">
                <i class="fa fa-search"></i> Filtrar
            </button>
        </div>
    </div>
    <!-- /. box -->
    {!! Form::close() !!}
</div>