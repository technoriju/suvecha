@extends('layouts.template')
@push('title')
    <title>Pharmacy - Stockist Activity List</title>
@endpush

@section('body')

<section class="topCover">

</section>
<section class="mainBody">
<h2>  <center>Stockist List</center>

    </h2>
    <div class="contentBox">
        @if(isset($data) && count($data)>0)
        @foreach ($data as $val)
        <main>
            <picture>
                <img src="{{ url('/')}}{{ !empty($val->file_path) ? $val->file_path :'/assets/workflow/images/pharmacy shop.jpg'}}">
            </picture>
            <article class="basicInfo">
                <h5>
                    {{$val->stockist_name}}
					 <small>HQ.: {{$val->headquarter_name}}</small>
					  <p>Area: {{$val->area_name}}</p>

                    <p>address: {{$val->address ?? 'NiL'}}</p>


                </h5>
                <p><i class="fa fa-phone"></i> {{$val->phone ?? 'NiL'}}</p>
				<p><i class="fa fa-map-marker"></i> {{$val->location}}</p>
				<p><i class="fa fa-clock-o"></i> {{dateTime($val->created_at)}}</p>
            </article>
            <div class="withreview">
                <span>
                   DL No.:{{$val->dl_no ?? 'NIL'}}

                </span><br>
				<span>
                   GST NO.:{{$val->gst_no ?? 'NiL'}}

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
    <div class="contentBox">
        <main>

			 <h2>

            <picture>
                <img src="images/pharmacy shop.jpg">
            </picture>
            <article class="basicInfo">
                <h5>
                    Stockist Name
					 <small>HQ.</small>
					  <p>Area</p>

                    <p>address</p>


                </h5>
                <p><i class="fa fa-phone"></i> +91 8016308513</p>
            </article>
            <div class="withreview">
                <span>
                   DL No.:abcd

                </span>


            </div>
            <div class="expWrap">
                <h6>

                </h6>


            </div>
        </main>
    </div>

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
