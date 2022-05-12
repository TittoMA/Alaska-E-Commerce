@extends('layouts.master')

@section('title', 'Home |')
@section('menuHome', 'active')

@section('head')
<style>
	#banner {
		background-color: #ec5757;
		height: 450px;
	}

	#mask {
		background-color: rgba(69, 167, 126, 0.342);
	}

	.title-text {
		overflow: hidden;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
	}

	.desc-text {
		overflow: hidden;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
	}
</style>
@endsection

@section('content')

<div id="banner" class="container-fluid p-0">
	<div id="mask" class="d-flex align-items-center h-100">
		<div class="container text-white">
			<div class="row">

				<div class="col-12 col-md-6 d-flex align-items-center">
					<div class="text-center text-md-start mx-auto mx-md-0">
						<h1 class="mb-4">Alaska.</h1>
						<h3 class="mb-3">Temukan jasa editing yang sesuai dengan kebutuhan anda.</h3>
						<form class="pb-3">
							<div class="input-group">
								<input class="form-control py-3 px-4" style="border-radius: 50px" id="searchInput" placeholder="Search" type="search">
								<div class="input-group-append">
									<button class="btn def-button ms-1 py-3 px-4" style="border-radius: 50px" type="button" id="searchBtn"><i
										class="fa fa-search"></i></button>
								</div>
							</div>
						</form>
							{{-- <a href="{{ url('services') }}" class="btn def-button mt-3">Shop Now</a> --}}

					</div>
				</div>

				<div class="col-12 col-md-6 d-none d-md-block">
					<div style="height: 350px; width: 100%">
						<img style="height: 100%; width: 100%; object-fit: contain; object-position: center"
							src="{{ asset('/img/illustration2.png') }}" alt="">
					</div>
				</div>

			</div>
		</div>
	</div>
</div>


<div class="container mt-5 mb-3">

	<div class="mb-3 d-flex align-items-center">
		<div>
			<h4>Our Category</h4>
			<hr width="100px" size="7px">
		</div>
		<a class="btn def-button d-block ms-auto" href="{{ url('category') }}" style="font-size: 15px">View All
			Category</a>
	</div>
	<div class="row g-2 mb-5">
		@foreach ($categories as $item)
		<div class="col-6 col-md-2 d-flex justify-content-center text-center">
			<div>
				<div class="mb-3" style="max-height: 175px; max-width: 175px; border-radius: 100px; overflow: hidden;">
					<img style="height: 100%; width: 100%; object-fit: cover; object-position: center"
						src="{{ asset('/img/'.$item->photo)}}" alt="">
				</div>
				<h5><a style="font-weight: 900" href="{{ url('category/'. $item->category_name) }}">{{ $item->category_name }}</a></h5>
			</div>
			{{-- <div class="card br-card def-shadow mb-2">
				<div class="card-img-top" style="height: 200px; width: 100%">
					<img style="height: 100%; width: 100%; object-fit: cover; object-position: center"
						src="{{ asset('/img/'.$item->photo)}}" alt="">
				</div>
				<div class="card-body">

					<h5><a href="{{ url('category/'. $item->category_name) }}">{{ $item->category_name }}</a></h5>
					<p>{{ $item->description }}</p>

				</div>
			</div> --}}
		</div>
		@endforeach
	</div>

	<div class="mb-3 d-flex align-items-center">
		<div>
			<h4>Explore Popular Services</h4>
			<hr width="100px" size="7px">
		</div>
		<a class="btn def-button d-block ms-auto" href="{{ url('popularity') }}" style="font-size: 15px">View
			Popular Service</a>
	</div>
	<div class="row mb-5 g-3">
		@foreach ($services as $item)
		<div class="col-6">
			<div class="card br-card def-shadow mb-2">
				<div class="row g-0">
					<div class="col-md-4">
						<img style="height: 200px; width: 100%; object-fit: cover; object-position: center"
							src="{{ asset('/img/uploads/'.$item['photo'])}}" alt="...">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title title-text">{{ $item['service_name'] }}</h5>
							<p class="card-text desc-text mb-2">{{ $item['description'] }}</p>
							<p class="card-text mb-2"><small>By {{ $item['store_name'] }}</small></p>

							<a href="{{ url('service/'.$item['id'])}}" class="btn def-button mt-2">Detail</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>

</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $("#searchBtn").click(function() {
            let search =$("#searchInput").val();
            document.location = "/search/" + search;
        })
    })
</script>
@endsection