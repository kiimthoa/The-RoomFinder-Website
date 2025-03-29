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
	.dropdown-menu {
		position: absolute;
		bottom: 150% !important;
		top: auto;
	}
</style>
<div class="">
	<div class="banner" style="margin-top: 50px">
		<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3779.843712615024!2d105.69117641437097!3d18.67100796943029!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3139cdd74580d84b%3A0x5fce083c23b316ef!2zOTYgVHLhuqduIFF1YW5nIERp4buHdSwgVHLGsOG7nW5nIFRoaSwgVGjDoG5oIHBo4buRIFZpbmgsIE5naOG7hyBBbiwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1620613750225!5m2!1svi!2s" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
		<img width="100%" src="../images/banner.jpg">
		<div class="box-search">
			<form onsubmit="return false">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group row">
					<div class="col-xs-3">
						<select class="selectpicker" data-live-search="true" id="selectdistrict">
							@foreach($district as $quan)
							<option data-tokens="{{$quan->slug}}" value="{{ $quan->id }}">{{ $quan->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-xs-3">
						<select class="selectpicker" data-live-search="true" id="selectcategory">
							@foreach($categories as $category)
							<option data-tokens="{{ $category->slug }}" value="{{ $category->id }}">{{ $category->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-xs-3">
						<select class="selectpicker" id="selectprice" data-live-search="true">
							<option data-tokens="khoang gia" min="1" max="10000000">Khoảng giá</option>
							<option data-tokens="Tu 500.000 VNĐ - 700.000 VNĐ" min="500000" max="700000">Từ 500.000 VNĐ - 700.000 VNĐ</option>
							<option data-tokens="Tu 700.000 VNĐ - 1.000.000 VNĐ" min="700000" max="1000000">Từ 700.000 VNĐ - 1.000.000 VNĐ</option>
							<option data-tokens="Tu 1.000.000 VNĐ - 1.500.000 VNĐ" min="1000000" max="1500000">Từ 1.000.000 VNĐ - 1.500.000 VNĐ</option>
							<option data-tokens="Tu 1.500.000 VNĐ - 3.000.000 VNĐ" min="1500000" max="3000000">Từ 1.500.000 VNĐ - 3.000.000 VNĐ</option>
							<option data-tokens="Tren 3.000.000 VNĐ" min="3000000" max="10000000">Trên 3.000.000 VNĐ</option>
						</select>
					</div>
					<div class="col-xs-3">
						<button class="btn btn-success" onclick="searchMotelajax()">Tìm kiếm ngay</button>
					</div>
				</div>
				<form>
		</div>
	</div>
	<div class="container" style="margin-top:50px">

		<h3 class="title-comm"><span class="title-holder">PHÒNG TRỌ XEM NHIỀU NHẤT</span></h3>
		<div class="row">
			@foreach($hot_motelroom as $room)
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
			@endforeach
		</div>
		<div class="row" style="margin-top: 10px; margin-bottom: 10px">
			<div class="col-md-6">
				<div class="asks-first">
					<div class="asks-first-circle">
						<span class="fa fa-search"></span>
					</div>
					<div class="asks-first-info">
						<h2>GIẢI PHÁP TÌM KIẾM MỚI</h2>
						<p>Tiết kiệm nhiều thời gian cho bạn với giải pháp và công nghệ mới</p>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="asks-first2">
					<div class="asks-first-circle">
						<span class="fas fa-hourglass-start"></span>
					</div>
					<div class="asks-first-info">
						<h2>AN TOÀN - NHANH CHÓNG</h2>
						<p>Với đội ngũ Quản trị viên kiểm duyệt hiệu quả, Chất Lượng đem lại sự tin tưởng.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<h3 class="title-comm"><span class="title-holder">PHÒNG TRỌ MỚI ĐĂNG NHẤT </span></h3>
		<div class="row">
			@foreach($listmotelroom as $room)
			<div class="col-md-6">

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
				@if($listmotelroom->currentPage() != 1)
				<li><a href="{{ $listmotelroom->url($listmotelroom->currentPage() -1) }}">Trước</a></li>
				@endif
				@for($i= 1 ; $i<= $listmotelroom->lastPage(); $i++)
					<li class=" {{ ($listmotelroom->currentPage() == $i )? 'active':''}}">
						<a href="{{ $listmotelroom->url($i) }}">{{ $i }}</a>
					</li>
					@endfor
					@if($listmotelroom->currentPage() != $listmotelroom->lastPage())
					<li><a href="{{ $listmotelroom->url($listmotelroom->currentPage() +1) }}">Sau</a></li>
					@endif
			</ul>
			<!-- <div class="col-md-4">
				<img src="images/banner-1.png" width="100%">
			</div> -->
		</div>
	</div>
</div>
</div>

<script>
	var map;

	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {
				lat: 16.070372,
				lng: 108.214388
			},
			zoom: 15,
			draggable: true
		});
		/* Get latlng list phòng trọ */
		<?php
		$arrmergeLatln = array();
		foreach ($map_motelroom as $room) {
			$arrlatlng = json_decode($room->latlng, true);
			$arrImg = json_decode($room->images, true);
			$arrmergeLatln[] = ["slug" => $room->slug, "lat" => $arrlatlng[0], "lng" => $arrlatlng[1], "title" => $room->title, "address" => $room->address, "image" => $arrImg[0], "phone" => $room->phone];
		}

		$js_array = json_encode($arrmergeLatln);
		echo "var javascript_array = " . $js_array . ";\n";

		?>
		/* ---------------  */
		console.log(javascript_array);

		var listphongtro = [{
				lat: 16.067011,
				lng: 108.214388,
				title: '33 Hoàng diệu',
				content: 'bbbb'
			},
			{
				lat: 16.066330603904397,
				lng: 108.2066632380371,
				title: '33 Hoàng diệu',
				content: 'bbbb'
			}
		];
		console.log(javascript_array);

		for (i in javascript_array) {
			var data = javascript_array[i];
			var latlng = new google.maps.LatLng(data.lat, data.lng);
			var phongtro = new google.maps.Marker({
				position: latlng,
				map: map,
				title: data.title,
				icon: "images/gps.png",
				content: 'dgfdgfdg'
			});
			var infowindow = new google.maps.InfoWindow();
			(function(phongtro, data) {
				var content = '<div id="iw-container">' +
					'<img height="200px" width="300" src="uploads/images/' + data.image + '">' +
					'<a href="phongtro/' + data.slug + '"><div class="iw-title">' + data.title + '</div></a>' +
					'<p><i class="fas fa-map-marker" style="color:#003352"></i> ' + data.address + '<br>' +
					'<br>Phone. ' + data.phone + '</div>';

				google.maps.event.addListener(phongtro, "click", function(e) {

					infowindow.setContent(content);
					infowindow.open(map, phongtro);
					// alert(data.title);
				});
			})(phongtro, data);

		}
		// google.maps.event.addListener(map, 'mousemove', function (e) {
		// 	document.getElementById("flat").innerHTML = e.latLng.lat().toFixed(6);
		// 	document.getElementById("lng").innerHTML = e.latLng.lng().toFixed(6);

		// });


	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDej-CHRaTCF5vaK9vkd8vty8Eo2Vv2Ids&callback=initMap" async defer></script>
@endsection
<style>
	.box-search {
		top: 750px;
		left: 50%;
		transform: translate(-50%, -50%);
		width: 1000px !important;
		height: 70px;
		/* margin: auto; */
	}

	.banner {
		position: relative;
	}

	.asks-first2 {
		padding: 10px 0 10px 10px !important;
	}
</style>