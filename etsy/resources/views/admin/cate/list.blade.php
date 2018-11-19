@extends('admin.layout.master')
@section('title', 'Category list page')
@section('header-scripts')
<!-- Bootstrap -->
<link href="template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="template/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="template/vendors/nprogress/nprogress.css" rel="stylesheet">
<!-- iCheck -->
<link href="template/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link href="template/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="template/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="template/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="template/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="template/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Categories <small>Manager categories</small></h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>
  	@if(session('flash')=='success')
  	<div class="alert alert-{{ session('flash') }} alert-dismissible fade in" role="alert">
  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
  		</button>
  		<strong>Congratulation!</strong> {{ session('messages') }}.
  	</div>
    @elseif(session('flash')=='danger')
    <div class="alert alert-{{ session('flash') }} alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <strong>Sorry!</strong> {{ session('messages') }}
    </div>
    @elseif(session('flash')=='warning')
    <div class="alert alert-{{ session('flash') }} alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <strong>Sorry!</strong> {{ session('messages') }}.
    </div>
  	@endif

	<div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Fixed Header Example <small>Users</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p class="text-muted font-13 m-b-30">
              This table show all categories have in Database.
            </p>
            <table id="datatable-fixed-header" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>No#</th>
                  <th>ID</th>
                  <th>Name</th>
                  <!-- <th>ID</th> -->
                  <th>Category Name</th>
                  <th>Number Child</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>


              <tbody>
              	<?php
              		$i = 1;
              	?>
              	@foreach($cates as $cate)
                <tr id="action_{{ $cate->id }}">
                  <td>{{ $i }}</td>
                  <td>{{ $cate->id }}</td>
                  <td>{!! $cate->short_name !!}</td>
                  <!-- <td>{{ $cate->id }}</td> -->
                  <td>{{ $cate->category_name }}</td>
                  <td>{{ $cate->num_children }}</td>
                  <td id="action_button">
                    @if($cate->status == 1)
                    <!-- <a onclick="return confirmDelete('Are you sure?')" href="admin/cate/update/{{ $cate->id }}" id="updateCate" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Active</a> -->
                    <a href="javascript:void(0)" id="activeCate" class="btn btn-success btn-xs" cateID="{{ $cate->id }}"><i class="fa fa-eye"></i> Active</a>
                    @else
                    <a href="javascript:void(0)" id="inactiveCate" class="btn btn-dark btn-xs" cateID="{{ $cate->id }}"><i class="fa fa-eye-slash"></i> Inactive</a>
                    <!-- <span class="label label-default">Inactive</span> -->
                    @endif
                  </td>
                  <td>
                  	<a onclick="return confirmDelete('Are you sure?')" href="javascript:void(0)" id="deleteCate" class="btn btn-danger btn-xs" cateID="{{ $cate->id }}"><i class="fa fa-trash-o"></i> Delete</a>
                    <a href="admin/cate/get-sub/{{ $cate->id }}" class="btn btn-primary btn-xs"><i class="fa fa-child"></i> Get Child</a>
                  </td>
                </tr>
                <?php 
                	$i++
                ?>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
@endsection

@section('footer-scripts')
<!-- jQuery -->
<script src="template/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="template/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="template/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="template/vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="template/vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="template/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="template/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="template/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="template/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="template/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="template/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="template/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="template/vendors/jszip/dist/jszip.min.js"></script>
<script src="template/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="template/vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Todo Scripts -->
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('a#activeCate').on('click', function() {
      var url = 'admin/cate/update/';
      var cateID = $(this).attr('cateID');
      var click = $(this);
      var action_button = $(this).parent('#action_button');

      $.ajax({
        url: url+cateID,
        type: 'GET',
        cache: false,
        data: {'cateID':cateID},
        success: function(data) {
          if(data == 'ok') {
            click.remove();
            action_button.append('<a href="javascript:void(0)" id="inactiveCate" class="btn btn-dark btn-xs" cateID="'+cateID+'"><i class="fa fa-eye-slash"></i> Inactive</a>');
          } else {
            alert('Error! Please contact Admintractor.');
          }
        }        
      });
    });

    $('a#inactiveCate').on('click', function() {
      var url = 'admin/cate/update/';
      var cateID = $(this).attr('cateID');
      var click = $(this);
      var action_button = $(this).parent('#action_button');

      $.ajax({
        url: url+cateID,
        type: 'GET',
        cache: false,
        data: {'cateID':cateID},
        success: function(data) {
          if(data == 'ok') {
            click.remove();
            action_button.append('<a href="javascript:void(0)" id="activeCate" class="btn btn-success btn-xs" cateID="'+cateID+'"><i class="fa fa-eye"></i> Active</a>');
          } else {
            alert('Error! Please contact Admintractor.');
          }
        }        
      });
    });

    $('a#deleteCate').on('click', function() {
      var url = 'admin/cate/delete/';
      var cateID = $(this).attr('cateID');
      var click = $('#action_'+cateID+'');

      $.ajax({
        url: url+cateID,
        type: 'GET',
        cache: false,
        data: {'cateID':cateID},
        success: function(data) {
          if(data == 'ok') {
            click.remove();
            // action_button.append('<a href="javascript:void(0)" id="activeCate" class="btn btn-success btn-xs" cateID="'+cateID+'"><i class="fa fa-eye"></i> Active</a>');
          } else {
            alert('Error! Please contact Admintractor.');
          }
        }        
      });
    });

  });

</script>
<!-- #Todo Scripts -->
@endsection