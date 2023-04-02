@extends('layouts.template')
@push('title')
    <title>Pharmacy - Stockist Activity Add</title>
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
                    <picture><img src="{{ url('/')}}/assets/workflow/images/car_04.png" alt="" />
                        <label>
                            <input type="file" name="file_path">
                            <i class="fa fa-pencil"></i>
                        </label>
                    </picture>
                    <h2> Add Stockist actvity</h2>
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
                        <select name="area_id" class="usrInput" onchange="Stockist(this.value)">
                            <option value="">Choose any Area</option>
                            @if(isset($area) && count($area) > 0)
                            @foreach ($area as $val)
                                <option value="{{ $val->id }}">{{ $val->area_name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="popupForm">
                        <select name="stockist_id" class="usrInput" id="stockist_id" onchange="StockistDetails(this.value)">
                            <option value="">Choose Area first</option>
                        </select>
                    </div>
                    <input type="text" class="usrInput" placeholder="DL No." name="dl_no" id="dl_no" value="{{old('dl_no')}}">
                    <input type="text" placeholder="Store Address" class="usrInput" name="address"  id="address" value="{{old('address')}}"/>
                    <input type="number" placeholder="Store Phone Number" class="usrInput" name="phone"  id="phone" value="{{old('phone')}}"/>
                    <input type="text" placeholder="information"class="usrInput" name="information" value="{{old('')}}" />
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
    function Stockist(val)
    {
        $('#dl_no').val("");
        $('#address').val("");
        $('#phone').val("");
        $.ajax({
            'type':"POST",
            'url': "/stockist/fetchStockist",
            'data': {'_token': "{{csrf_token()}}", 'area_id':val},
            success: function(data)
            {
                $("#stockist_id").html(data);
            }
        })
    }
    function StockistDetails(val)
    {
        $.ajax({
            type:"POST",
            url: "/stockist/fetchStockistInfo",
            data: {'_token': "{{csrf_token()}}", 'id':val},
            dataType: "JSON",
            success: function(data)
            {
                $("#dl_no").val(data.dl_no);
                $("#address").val(data.address);
                $("#phone").val(data.phone);
            }
        })
    }
</script>
@endpush
