@extends('layouts.template')
@push('title')
    <title>Pharmacy - Activity List</title>
@endpush

@section('body')

<section class="topCover">

</section>
<section class="mainBody">
<h2>
        <center>Pharmacy actvity</center>

    </h2>
    <div class="contentBox">
        @if(isset($data) && count($data)>0)
        @foreach ($data as $val)
            <main>
                <a href="#" title="Download PDF" class="downloadPdf"><i class="fa fa-file-pdf-o"></i></a>
                <a href="reviewPage.html" title="Review" class="reviewBttnWrap"><i class="fa fa-star-o"></i></a>
                <picture>
                    <img src="{{ url('/')}}{{ !empty($val->file_path) ? $val->file_path :'/assets/workflow/images/pharmacy shop.jpg'}}">
                </picture>
                <article class="basicInfo">
                    <h5>
                        {{$val->pharmacy_name}}
                        <small>HQ.: {{$val->headquarter_name}}</small>
                        <p>Area: {{$val->area_name}}</p>

                        <p>address: {{$val->address ?? "NIL"}}</p>


                    </h5>
                                    <p><i class="fa fa-phone"></i> {{$val->phone ?? 'NIL'}}</p>
                    <p><i class="fa fa-map-marker"></i> {{$val->location}}</p>
                    <p><i class="fa fa-clock-o"></i> {{dateTime($val->created_at)}}</p>
                </article>
                <div class="withreview">
                    <span>
                    DL No.:{{$val->dl_no ?? 'NIL'}}

                    </span>


                </div>
                <div class="expWrap">
                    <h6>

                    </h6>


                </div>
            </main>
        @endforeach
        @endif
    </div>
    <!--div class="contentBox">
        <main>
            <a href="#" title="Download PDF" class="downloadPdf"><i class="fa fa-file-pdf-o"></i></a>
            <a href="reviewPage.html" title="Review" class="reviewBttnWrap"><i class="fa fa-star-o"></i></a>
            <picture>
                <img src="images/pharmacy shop.jpg">
            </picture>
            <article class="basicInfo">
                <h5>
                   Pharmacy Name

                    <small>Burdwan</small>
                </h5>
                <p><i class="fa fa-phone"></i> +91 8016308513</p>
            </article>
            <div class="withreview">
                <span>
                    Order Name:abcd

                </span>
                <div class="reviewWrap">

                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <b>(550 Reviews)</b>
                </div>
            </div-->

        </main>
    </div>
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
