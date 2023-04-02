@extends('manage.layouts.common-template')
@push('title')
    <title>Pharmacy - Area Add</title>
@endpush
@section('body')
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Add Area</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{$url}}" method="post">
                                                @csrf
                                                @if((Request::segment(4) !== null) && Request::segment(4) == 'edit')
                                                  {{method_field('PUT')}}
                                                @endif
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @if(isset($errors) && count($errors)>0)
                                                           <div class="alert alert-danger" role="alert">{{$errors->first()}}</div>
                                                        @endif
                                                        @if(session('error')!== null)
                                                            <div class="alert alert-danger" role="alert">{{session('error')}}</div>
                                                        @endif
                                                        @if(session('success')!== null)
                                                            <div class="alert alert-success" role="alert">{{session('success')}}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Choose Headquarter (*)</label>
                                                            <select name="headquarter_id" class="form-control" required>
                                                                <option value="">Choose any Headquarter</option>
                                                                @if(isset($data2) && count($data2)>0)
                                                                    @foreach ($data2 as $val)
                                                                      <option value="{{$val->id}}" {{ (old('headquarter_id') == $val->id)? 'selected' : ((isset($data) && ($data->headquarter_id == $val->id)) ? 'selected' : '')}}>{{$val->headquarter_name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Area Name (*)</label>
                                                            <input name="area_name" type="text" class="form-control" id="" placeholder="Area Name" value="{{ $data->area_name ?? old('area_name')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!--<div class="form-group">-->
                                                        <!--    <label for="exampleInputEmail1">Choose Staion (*)</label>-->
                                                        <!--    <select name="station" class="form-control" required>-->
                                                        <!--        <option value="">Choose any Station</option>-->
                                                        <!--        <option {{(isset($data->station) && $data->station == "1") ? 'selected' : '' }} value="1">X-Station</option>-->
                                                        <!--        <option {{(isset($data->station) && $data->station == "2") ? 'selected' : '' }} value="2">Out-Station</option>-->
                                                        <!--    </select>-->
                                                        <!--</div>-->
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Distance (*)</label>
                                                            <input name="distance" type="text" class="form-control" id="" placeholder="Distance" value="{{ $data->distance ?? old('distance')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                     <div class="form-group">
                                                      <button type="submit" name="sub" value="submit" class="btn btn-primary">@if(isset($data)) Update @else Submit @endif</button>
                                                     </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Input group -->

                                </div>
                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

   <script>

   </script>

@endpush
