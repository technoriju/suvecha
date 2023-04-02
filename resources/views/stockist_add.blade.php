@extends('layouts.template')
@push('title')
    <title>Pharmacy - Stockist Add</title>
@endpush

@section('body')
    <section class="topCover">
        <h2><small>welcome</small></h2>
    </section>
    <section class="mainBody">
        <div class="categoryBar editProfile">
            <form action="{{$url}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="editPrWrap">
                    <picture>
                        <img src="{{ url('/')}}/assets/workflow/images/car_04.png" alt="" />
                        <label>
                            <input type="file" name="file_path">
                            <i class="fa fa-pencil"></i>
                        </label>
                    </picture>
                    <h2> Add Stockist</h2>
                    @if(isset($errors) && count($errors)>0)
                    <div class="alert alert-danger" role="alert">{{$errors->first()}}</div>
                    @endif
                    @if(session('error')!== null)
                        <div class="alert alert-danger" role="alert">{{session('error')}}</div>
                    @endif
                    @if(session('success')!== null)
                        <div class="alert alert-success" role="alert">{{session('success')}}</div>
                    @endif
                    <div class="popupForm">
                        <select name="headquarter_id" class="usrInput" onchange="Area(this.value);">
                            <option value="">Choose any Headquarter</option>
                            @if(isset($headquarter) && count($headquarter) > 0)
                                @foreach ($headquarter as $val)
                                    <option value="{{ $val->id }}">{{ $val->headquarter_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <select name="area_id" id="area_id" class="usrInput">
                            <option value="">Choose any Area</option>
                            @if(isset($area) && count($area) > 0)
                            @foreach ($area as $val)
                                <option value="{{ $val->id }}" {{ (isset($data) && ($data->area_id == $val->id)) ? 'selected' : ((old('area_id') == $val->id) ? 'selected' : '')}}>{{ $val->area_name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <input type="text" placeholder="store name" class="usrInput" name="store_name" value="{{old('store_name')}}"/>
                    <input type="text" placeholder="Store Address" class="usrInput" name="address" value="{{old('address')}}"/>
                    <input type="number" placeholder="Store Phone Number" class="usrInput" name="phone"  value="{{old('phone')}}"/>
                    <input type="text" class="usrInput" placeholder="DL No." name="dl_no" value="{{old('dl_no')}}">
                    <input type="text" placeholder="Gst No" class="usrInput" name="gst_no" value="{{old('gst_no')}}"/>

                    <input type="submit" value="submit" class="subbtn">
                </div>
            </form>
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
@push('script')
    <script>
         function Area(val)
        {
            $.ajax({
                type:"POST",
                url: "/doctor/fetchArea",
                data: {'_token': "{{csrf_token()}}", 'headquarter_id':val},
                success: function(data)
                {
                    $('#area_id').html(data);
                }
            })
        }
    </script>
@endpush
