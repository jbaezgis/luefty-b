<!-- Arreglo para menu activo -->
    <?php function accountActiveMenu($url){
      return request()->is($url) ? 'active' : '';
    }?>
<!-- fin -->

<div class="col-md-3">
    
    <div class="box box-solid">
        <div class="box-header with-border">
        <h3 class="box-title">Menu</h3>
        </div>
        <div class="box-body no-padding">
        <div class="list-group ">
        <a href="/account" class="list-group-item list-group-item-action {{ accountActiveMenu('account') }}"><i class="fa fa-inbox"></i> Dashboard</a>
        @if (Auth::check() && Auth::user()->can('myauctions-menu'))
        <a href="/my-auctions" class="list-group-item list-group-item-action {{ accountActiveMenu('my-auctions') }}"><i class="fa fa-car"></i> Traslados</a>   
        @endif
        @if (Auth::check() && Auth::user()->can('mytours-menu'))
        <a href="/my-tours" class="list-group-item list-group-item-action {{ accountActiveMenu('my-tours') }}"><i class="fa fa-bus"></i> Tours</a>   
        @endif
        @if (Auth::check() && Auth::user()->can('mybids-menu'))
        <a href="/my-bids" class="list-group-item list-group-item-action {{ accountActiveMenu('my-bids') }}"><i class="fa fa-money"></i> Mis Ofertas</a>      
        @endif
        </div> 
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /. box -->

    {{-- <div class="box box-solid">
        <div class="box-header with-border">
        <h3 class="box-title">User menu</h3>
        </div>
        <div class="box-body no-padding">
        <div class="list-group ">
        <a href="#" class="list-group-item list-group-item-action {{ accountActiveMenu('profile') }}"><i class="fa fa-user-circle-o"></i> Mi perfil</a>
        <a href="#" class="list-group-item list-group-item-action {{ accountActiveMenu('change-password') }}"><i class="fa fa-key"></i> Cambiar contraseña</a>   
        <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-sign-out"></i> Cerrar seccion</a>   
        </div> 
        </div>
        <!-- /.box-body -->
    </div> --}}
    <!-- /. box -->
</div>