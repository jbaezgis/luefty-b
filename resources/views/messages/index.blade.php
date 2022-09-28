@extends('layouts.app2')
@section('title', 'Messages')

@section('content')
<br>
<div class="container-fluid">
<section class="content-header">
  <h2>
    Mailbox
    <small>{{ $messages->count() }} new messages</small>
  </h2>
</section>
<hr>

<div class="container-fluid">
<div class="row">
        <div class="col-md-3">
          <a href="compose.html" class="btn btn-primary btn-block margin-bottom">Compose</a>
          
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>
            </div>
            <div class="box-body no-padding">
              <div class="list-group ">
              <a href="#" class="list-group-item list-group-item-action active"><i class="fa fa-inbox"></i> Inbox</a>
              <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-envelope-o"></i> Sent</a>       
            </div> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                    @foreach ($messages as $message)  
                        <tr>
                          <td class="mailbox-name"><a href="read-mail.html">{{ $message->name }}</a></td>
                          <td class="mailbox-subject"><b>{{ $message->email }}</b> - {{ $message->message }}
                          </td>
                          <td class="mailbox-attachment"></td>
                          <td class="mailbox-date">5 mins ago</td>
                        </tr>
                    @endforeach
                  
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <!-- <div class="mailbox-controls">
                
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  
                </div> -->
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>

</div>
@endsection