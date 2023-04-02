@extends('layouts.template')

@push('title')

    <title>Pharmacy - Doctor Activity Add</title>

@endpush



@section('body')



<section class="topCover">



</section>

<section class="mainBody">

 <h2>

        <center>

		Daily Activity</center>

    </h2>

    <h4>Choose by Group</h4>

    <div class="catListingWrp">

        <span>



            <a href="#doctor">Doctor Activity</a>

            <a href="#pharmacy">Pharmacy Activity</a>

            <a href="#stockist"> Stokost Activity</a>



        </span>

    </div>









<section class="mainBody">

    <div class="contentBox">

        <h2>

                            <small>Doctor Activaty List</small>

                        </h2>

            @if(isset($doctor) && count($doctor)>0)

                @foreach ($doctor as $val)

                    <main id="doctor">



                        <a href="#" title="Download PDF" class="downloadPdf"><i class="fa fa-file-pdf-o"></i></a>



                        <a href="reviewPage.html" title="Review" class="reviewBttnWrap"><i class="fa fa-star-o"></i></a>

                        <picture>

                            <img src="{{ url('/')}}/assets/workflow/images/OIP (1).jpeg">

                        </picture>

                        <article class="basicInfo">



                            <h5>

                                {{uppercase($val->doctor_name)}}



                                <small> {{$val->specialization_name}}</small>

                                <small>Address</small>

                                <p>{{$val->address ?? ''}}</p>

                            </h5>

                            <p><i class="fa fa-phone"></i> {{$val->phone}}</p>

                            <p><i class="fa fa-map-marker"></i> {{$val->location}}</p>

                            <p><i class="fa fa-clock-o"></i> {{dateTime($val->created_at)}}</p>

                        </article>

                        <div class="withreview">

                            <span>

                            </span>

                            <div class="expWrap">

                                <h6>

                                    <small>Today Suggest Medicine</small>

                                    @isset($val->medicine_id)

                                        @php

                                        $medicine = MedicineName($val->medicine_id);

                                        @endphp

                                        @foreach($medicine as $key)

                                            <div class="form-check">

                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                                                <label class="form-check-label" for="flexCheckDefault">

                                                    {{$key->medicine_name}}

                                                </label>

                                            </div>

                                        @endforeach

                                    @endisset

                                </h6>

                                <!--h6 class="exp">5 Years Experiance</h6-->

                            </div>

                        </div>

                    </main>

                @endforeach

            @else

               <h3><small>Today Doctor Activaty Status: Empty </small></h3>

            @endif





             <h2>

                            <small>Pharmacy Activaty List</small>

                        </h2>

            @if(isset($pharmacy) && count($pharmacy)>0)

            @foreach ($pharmacy as $val)

                <main id="pharmacy">



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





            <h2>

                            <small>Stockist Activaty List</small>

                        </h2>

            @if(isset($stockist) && count($stockist)>0)

            @foreach ($stockist as $val)

            <main id="stockist">



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

	<div class="closePop"></div>

</section>

@endsection
