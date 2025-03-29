@extends('layouts.master')
@section('content')
<?php
function limit_description($string)
{
	$string = strip_tags($string);
	if (strlen($string) > 100) {

		// truncate string
		$stringCut = substr($string, 0, 100);
		$endPoint = strrpos($stringCut, ' ');

		//if the string doesn't contain any space then it will cut without word basis.
		$string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
		$string .= '...';
	}
	return $string;
}
function time_elapsed_string($datetime, $full = false)
{
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'năm',
		'm' => 'tháng',
		'w' => 'tuần',
		'd' => 'ngày',
		'h' => 'giờ',
		'i' => 'phút',
		's' => 'giây',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' trước' : 'Vừa xong';
}
?>
<style>
	.title-holder:before {
		display: none;
	}

	.title-holder:after {
		display: none;
	}
</style>

<div class="container-fluid" style="padding-left: 0px;padding-right: 0px;">



</div>
<div class="container" style="min-height: 400px; margin-top:70px">
	<h3 class="title-comm"><span class="title-holder" style="    font-weight: 600;
    text-align: center;
    padding: 10px;
    padding-bottom: 20px;
	background-color: white;
	color:black;
	padding-top: 20px;">DANH SÁCH PHÒNG TRỌ</span></h3>
	@if(count($listmotel) == 0)
	Không có kết quả nào trong danh mục này
	@endif
	<div class="row">
		@foreach($listmotel as $room)
		<div class="col-md-12">

			<?php
			$img_thumb = json_decode($room->images, true);
			?>
			<div class="room-item-vertical">
				<div class="row">
					<div class="col-md-4">
						<div class="wrap-img-vertical" style="background: url(uploads/images/<?php echo $img_thumb[0]; ?>) center;     background-size: cover;">

							<div class="category">
								<a href="category/{{ $room->category->id }}">{{ $room->category->name }}</a>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="room-detail">
							<h4><a href="phongtro/{{ $room->slug }}">{{ $room->title }}</a></h4>
							<div class="room-meta">
								<span><i class="fas fa-user-circle"></i> Người đăng: {{ $room->user->name }}</span>
								<span class="pull-right"><i class="far fa-clock"></i> <?php
																						echo time_elapsed_string($room->created_at);
																						?></span>
							</div>

							<div class="room-info">
								<span><i class="far fa-stop-circle"></i> Diện tích: <b>{{ $room->area }} m<sup>2</sup></b></span>
								<span class="pull-right"><i class="fas fa-eye"></i> Lượt xem: <b>{{ $room->count_view }}</b></span>
								<div class="address"><i class="fas fa-map-marker"></i> Địa chỉ: {{ $room->address }}</div>
								<div style="color: #e74c3c"><i class="far fa-money-bill-alt"></i> Giá thuê: <b>{{ number_format($room->price) }}</b></div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		@endforeach
		<ul class="pagination pull-right">
			@if($listmotel->currentPage() != 1)
			<li><a href="{{ $listmotel->url($listmotel->currentPage() -1) }}">Trước</a></li>
			@endif
			@for($i= 1 ; $i<= $listmotel->lastPage(); $i++)
				<li class=" {{ ($listmotel->currentPage() == $i )? 'active':''}}">
					<a href="{{ $listmotel->url($i) }}">{{ $i }}</a>
				</li>
				@endfor
				@if($listmotel->currentPage() != $listmotel->lastPage())
				<li><a href="{{ $listmotel->url($listmotel->currentPage() +1) }}">Sau</a></li>
				@endif
		</ul>
		<!-- <div class="col-md-4">
		<img src="images/banner-1.png" width="100%">
	</div> -->
	</div>
</div>
@endsection