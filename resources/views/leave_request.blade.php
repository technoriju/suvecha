@extends('layouts.template')
@push('title')
    <title>Pharmacy - Leave Request Add</title>
@endpush
@section('body')
    <section class="topCover">
    </section>
    <section class="mainBody">
        <h2><center>Leave Request</center></h2>
        <div class="categoryBar editProfile">
            <form action="{{$url}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="editPrWrap">
                    <picture>
                        <img src="{{ url('/')}}/assets/workflow/images/car_04.png" alt="" />
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
                    <div class="popupForm">
                    <select name="headquarter_id" class="usrInput" >
                        <option value="">Choose any Headquarter</option>
                        @if(isset($headquarter) && count($headquarter) > 0)
                            @foreach ($headquarter as $val)
                                <option value="{{ $val->id }}">{{ $val->headquarter_name }}</option>
                            @endforeach
                        @endif
                    </select>
                    </div>
                        <b>Purpose</b>
                        <input type="text" placeholder="purpose" class="usrInput" name="purpose"/>
                        <b> From</b>
                        <input type="date" class="usrInput" name="date_from">
                        <b>To</b>
                        <input type="date" class="usrInput" name="date_to">
                    </span>
                    <input type="submit" value="submit" class="subbtn">
                </div>
            </form>
        </div>
    </section>
@endsection
