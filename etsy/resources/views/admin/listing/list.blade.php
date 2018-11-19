@extends('admin.layout.master')
@section('title', 'Etsy Manager - Listing list page')
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
        <h3>Listings <small>Manager listings</small></h3>
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
                  <th>Category Name</th>
                  <th>Quanlity</th>
                  <th>Price</th>
                  <th>Action</th>
                </tr>
              </thead>


              <tbody>
              	<?php
              		$i = 1;
              	?>
              	@foreach($listings as $lt)
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $lt->id }}</td>
                  <td>{!! $lt->title !!}</td>
                  <td>
                  <?php
                    $cate = DB::table('cates')->where('id', $lt->category_id)->first();
                    if(!isset($cate)):
                      echo '<span style="color:red">NULL</span>';
                    else:
                      echo $cate->category_name;
                      //print_r($cate);
                    endif;
                  ?>
                  </td>
                  <td>{{ $lt->quantity }}</td>
                  <td>{{ $lt->price }}</td>
                  <td>
                  	<a onclick="return confirmDelete('Are you sure?')" href="" class="btn btn-success btn-xs">Update</a>
                  	<a onclick="return confirmDelete('Are you sure?')" href="" class="btn btn-danger btn-xs">Delete</a>
                    <a target="_blank" href="{{ $lt->url }}" class="btn btn-primary btn-xs">Link</a>
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
@endsection