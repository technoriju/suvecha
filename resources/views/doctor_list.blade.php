@extends('layouts.template')
@push('title')
    <title>Pharmacy - Doctor List</title>
@endpush

@section('body')

    <section class="topCover">

    </section>
    <section class="mainBody">
        <div class="contentBox">
            @if(isset($data) && count($data)>0)
            @foreach ($data as $val)
                <main>
                    <h2><small>Doctor</small>Profile</h2>
                    <a href="#" title="Download PDF" class="downloadPdf"><i class="fa fa-file-pdf-o"></i></a>

                    <a href="reviewPage.html" title="Review" class="reviewBttnWrap"><i class="fa fa-star-o"></i></a>
                    <picture>
                        <img src="{{ url('/')}}{{ !empty($val->file_path) ? $val->file_path :'/assets/workflow/images/OIP (1).jpeg'}}">
                    </picture>
                    <article class="basicInfo">

                        <h5>
                            {{$val->doctor_name}}
                            <small>{{$val->specialization['specialization_name'] ?? ''}}</small>
                            <small>Address</small>
                            <p>{{$val->address ?? ''}}</p>
                        </h5>
                        <p><i class="fa fa-phone"></i> {{$val->phone ?? 'NIL'}}</p>
                    </article>
                    <div class="withreview">
                        <span></span>

                        <div class="expWrap">
                            <h6>
                                <small>Nearest Pharmacy</small>
                                @isset($val->pharmacy_id)
                                    @php
                                    $pharmacy = PharmacyName($val->pharmacy_id);
                                    @endphp
                                    @foreach($pharmacy as $key)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{$key->pharmacy_name ?? 'NIL'}}
                                            </label>
                                        </div>
                                    @endforeach
                                @endisset
                            </h6>
                        </div>
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
                        <img src="images/OIP (1).jpeg">
                    </picture>
                    <article class="basicInfo">
                        <h5>
                            Mrs: Ratna Dutta
                            <small>MBA,MD, cardiologist</small>
                            <small>Kolkata</small>
                        </h5>
                        <p><i class="fa fa-phone"></i> +91 8016308513</p>
                    </article>
                    <div class="withreview">
                        <span>

                        </span>
                        <div class="reviewWrap">

                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <b>(550 Reviews)</b>
                        </div>
                    </div>
                    <div class="expWrap">
                        <h6>
                            <small>Delling Product</small>

                            <div class="form-check">
                             <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                             <label class="form-check-label" for="flexCheckDefault">
                             1
                             </label>
                           </div>
                           <div class="form-check">
                             <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                             <label class="form-check-label" for="flexCheckChecked">
                            2
                             </label>

                        </h6>
                        <h6 class="exp">5 Years Experiance</h6>
                    </div>
                </main>
            </div>
        </section-->



        <!--section class="downPop">
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
        </section-->
    @endsection
