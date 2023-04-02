@extends('layouts.template')
@push('title')
    <title>Pharmacy - Tour Add</title>
@endpush

@section('body')
<section class="topCover">

</section>
<section class="mainBody">
    <h2>
        <center>
            Add Tour</center>
    </h2>
    <div class="categoryBar	editProfile">
        <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="editPrWrap">
                <picture>
                    <img src="{{ url('/') }}/assets/workflow/images/car_04.png" alt="" />
                </picture>
                </picture>
                <span>
                    @if(isset($errors) && count($errors)>0)
                    <div class="alert alert-danger" role="alert">{{$errors->first()}}</div>
                    @endif
                    @if(session('error')!== null)
                        <div class="alert alert-danger" role="alert">{{session('error')}}</div>
                    @endif
                    @if(session('success')!== null)
                        <div class="alert alert-success" role="alert">{{session('success')}}</div>
                    @endif
                    <b> Data</b>
                    <input type="date" class="usrInput" name="date">
                </span>
                <div class="popupForm">
                    <select name="headquarter_id" class="usrInput" onchange="Area(this.value);">
                        <option value="">Choose any Headquarter</option>
                        @if(isset($headquarter) && count($headquarter) > 0)
                            @foreach ($headquarter as $val)
                                <option value="{{ $val->id }}">{{ $val->headquarter_name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <input type="text" class="usrInput" placeholder="From">
                    <select name="area_from" id="area_from" class="usrInput">
                        <option value="">Choose From Area</option>
                    </select>
                </div>
                <input type="text" class="usrInput" placeholder="To">
                <select name="area_to" id="area_to" class="usrInput">
                    <option value="">Choose to Area</option>
                </select>
            </div>
            <input type="submit" value="submit" class="subbtn">
    </div>
    </form>
    </div>
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
                    $('#area_from').html(data);
                    $('#area_to').html(data);
                }
            })
        }
    </script>
@endpush
