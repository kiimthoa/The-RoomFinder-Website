@extends('admin.layout.master')
@section('content2')
<!-- Main content -->
<div class="content-wrapper">
	<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Danh sách các phòng trọ</h4>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="admin"><i class="icon-home2 position-left"></i> Trang chủ</a></li>
							<li class="active">Trang Quản Lý</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->
	<div class="content">
		<div class="row">
			<div class="col-12">
				<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Danh sách các phòng trọ <span class="badge badge-primary">{{$motelrooms->count()}}</span></h5>
						</div>

						<div class="panel-body">
							Các <code>Tài khoản</code> được liệt kê tại đây. <strong>Dữ liệu đang cập nhật.</strong>
						</div>
                        @if(session('thongbao'))
                        <div class="alert bg-success">
							<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
							<span class="text-semibold">Well done!</span>  {{session('thongbao')}}
						</div>
                        @endif
						<table class="table datatable-show-all">
							<thead>
								<tr class="bg-blue">
									<th>ID</th>
									
									<th>Tiêu đề</th>
									<th>Danh mục</th>
									<th>Giá phòng</th>
									<th>Trạng thái</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($motelrooms as $room)
								<tr>
									<td>{{$room->id}}</td>
									
									<td><a href="phongtro/{{$room->slug}}" target="_blank">{{$room->title}}</a></td>
									<td>{{$room->category->name}}</td>
									
									<td>{{$room->price}}</td>
									<td>
										@if($room->approve == 1)
											<span class="label label-success">Đã kiểm duyệt</span>
										@elseif($room->tinhtrang == 0)
											<span class="label label-danger">Chờ Phê Duyệt</span>
										@endif
									</td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													@if($room->approve == 1)
														<li><a href="admin/motelrooms/unapprove/{{$room->id}}"><i class="icon-file-pdf"></i> Bỏ kiểm duyệt</a></li>
													@elseif($room->tinhtrang == 0)
														<li><a href="admin/motelrooms/approve/{{$room->id}}"><i class="icon-file-pdf"></i> Kiểm duyệt</a></li>
													@endif
													<li><a data-toggle='modal' data-target='#confirm{{$room->id}}'><i class="icon-file-excel"></i> Xóa</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<div class='modal fade' id='confirm{{$room->id}}'>
									<div class='modal-dialog'>
										<div class='modal-content'>
											<div class='modal-header'>
												<h5 class='modal-title'><strong>XÁC NHẬN XÓA</strong></h5>
												<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
												<span aria-hidden='true'>&times;</span>
												</button>
											</div>
											<div class='modal-body'>
												<p>Tất cả những thông tin liên quan tới bài đăng này sẽ bị xóa</p>
												<p>Bạn chắc chắn muốn xóa bài đăng này?</p>
											</div>
											<div class='modal-footer'>
												<button type='button' class='btn btn-secondary' data-dismiss='modal'>Hủy</button>
												<a href='admin/motelrooms/del/{{$room->id}}'><button type='button' class='btn btn-primary'> Xóa </button></a>
											</div>
										</div>
									</div>
								</div>
								@endforeach
								
							</tbody>
						</table>
					</div>
			</div>
		</div>
		<!-- Footer -->
		<div class="footer text-muted">
			&copy; 2025. <a href="#">Phòng trọ TP Cần Thơ</a> by <a href="" target="_blank">Lương Thị Kim Thoa</a>
		</div>
		<!-- /footer -->
	</div>
</div>
@endsection