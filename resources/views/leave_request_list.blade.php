@extends('layouts.template')
@push('title')
    <title>Pharmacy - Activity List</title>
@endpush

@section('body')


<section class="topCover">

</section>
<section class="mainBody">
 <h2>
        <center>Live Request List</center>
    </h2>
    <div class="listingWrap">
        @if(isset($data) && count($data)>0)
        @foreach ($data as $val)
        <a href="javascript:;" class="listblock storePopTrg">
            <span class="tag"><i class="fa fa-angle-right"></i></span>
            <picture>
                <img src="{{ url('/')}}{{ !empty($val->file_path) ? $val->file_path :'/assets/workflow/images/notification.png'}}" alt="" />
            </picture>
            <article>
                <h3>{{dateTime2($val->date_from)}}</h3>
				<h3>{{dateTime2($val->date_to)}}</h3>
                <p>{{$val->purpose}}</p>
            </article>
        </a>
        @endforeach
        @endif
    </div>
</section>


<section class="TopPop">
	<main>
		<h3>Live status</h3>
		<i class="fa fa-times closePopDown"></i>
		<p>
            <button type="button" class="btn">Approval</button>
            <button type="button" class="btn btn-success">Reject</button>
            <button type="button" class="btn btn-success">Panding</button>
        </p>
        <span>
            <i class="fa fa-clock-o"></i>
            13-03-2022, Sunday
        </span>



	</main>
	<div class="closePop">

    </div>
	</main>




</section>

<section class="downPop">
	<main>
		<h3>Enter your location</h3>
		<i class="fa fa-times closePopDown"></i>
		<div class="popupForm">
			<form action="">
				<select name="" class="popInp">
					<option value="">Country</option>
					<option value="">India</option>
				</select>
				<select name="" class="popInp">
					<option value="">State</option>
					<option value="">West bengal</option>
				</select>
				<select name="" class="popInp">
					<option value="">District</option>
					<option value="">Burdwan</option>
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
