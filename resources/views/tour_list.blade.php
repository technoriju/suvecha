@extends('layouts.template')
@push('title')
    <title>Pharmacy - Tour List</title>
@endpush

@section('body')


<section class="topCover">

</section>
<section class="mainBody">
<h2>
       <center> Monthly Tour Plan</center>
    </h2>
    @if(isset($data) && count($data)>0)
    @foreach ($data as $val)
    <div class="listingWrap">
        <a href="javascript:;" class="listblock storePopTrg">
            <span class="tag"><i class="fa fa-angle-right"></i></span>
            <picture>
                <!--img src="images/c_logo.png" alt="" /-->
				<p>{{dateTime2($val->date)}}</p>
            </picture>
            <article>
                <h3>{{AreaName($val->area_from)}}</h3>

                <h3>{{AreaName($val->area_to)}}</h3>
            </article>
        </a>
    </div>
    @endforeach
    @endif
</section>


<section class="TopPop">
	<main>
        <i class="fa fa-times closePopDown"></i>
        <picture><img src="images/car_04.png" alt=""></picture>
		<h3 class="storeName">Head Qut</h3>
		<p class="sDetails">Mr Name
        <span>
            <i class="fa fa-clock-o"></i>
            Date: 12 November 2022
        </span>
        <span>
            <i class="fa fa-map-marker"></i>

		  <span> Area</span>
		  <span> Area</span>


        </span>

        <span>
            <a href="ad tour.html"><i class="fa fa-plus"></i> Add</a>
            <a href="ad tour.html"><i class="fa fa-edit"></i> Edit</a>
            <a href="#"><i class="fa fa-trash"></i> Delate</a>
        </span>
	</main>
	<div class="closePop"></div>
	</main>
</section>

<section class="downPop">
	<main>
		<h3>Enter your location</h3>
		<i class="fa fa-times closePopDown"></i>
		<div class="popupForm">
			<form action="">

				<select name="" class="popInp">
					<option value="">State</option>
					<option value="">West bengal</option>
				</select>
				<select name="" class="popInp">
					<option value="">District</option>
					<option value="">HQ</option>
				</select>
				<input type="text" class="popInp" placeholder="Post">
				<input type="text" class="popInp" placeholder="Panchyate">
				<input type="submit" class="submitBox" value="submit">
			</form>
		</div>
	</main>
	<div class="closePop"></div>
</section>
@endsection
