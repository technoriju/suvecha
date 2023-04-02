@extends('manage.layouts.common-template')
@push('title')
    <title>Pharmacy - Headquarter Distances</title>
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
                                            <h5>Distances Headquarter</h5>
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
                                                            <select name="headquarterFrom" class="form-control" required>
                                                                <option value="">Choose any Headquarter</option>
                                                                @if(isset($data) && count($data)>0)
                                                                    @foreach ($data as $val)
                                                                      <option {{( old('headquarterFrom') !== null ) ? 'selected' : '' }} value="{{$val->id}}">{{$val->headquarter_name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Choose Headquarter (*)</label>
                                                            <select name="headquarterTo" class="form-control" required>
                                                                <option value="">Choose any Headquarter</option>
                                                                @if(isset($data) && count($data)>0)
                                                                    @foreach ($data as $val)
                                                                      <option {{( old('headquarterTo') !== null ) ? 'selected' : '' }} value="{{$val->id}}">{{$val->headquarter_name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Choose Headquarter (*)</label>
                                                            <input name="distance" type="text" class="form-control" placeholder="Distance" value="{{ old('distance')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                     <div class="form-group">
                                                      <button type="submit" name="sub" value="submit" class="btn btn-primary">@if(isset($data)) Update @else Submit @endif</button>
                                                     </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card-body data-tablee table-responsive">
                                        <table class="table table-hover tablemanager">
                                            <thead>
                                                <tr>
                                                    <th class="disableSort">#</th>
                                                    <th>Headquarter From</th>
                                                    <th>Headquarter To</th>
                                                    <th>Distance</th>
                                                    <th class="disableFilterBy">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($data2) && count($data2)>0)  @php $count=0 @endphp
                                                    @foreach ($data2 as $val)  @php $count++ @endphp
                                                        <tr>
                                                            <form action="{{ url('/manage/headquarter/distanceUpd') }}" method="post"> @csrf
                                                            <td>{{$count}}</td>
                                                            <td>{{$val->headquarter_name2}}</td>
                                                            <td>{{$val->headquarter_name}}</td>
                                                            <td>
                                                                <input name="distance" type="text" value="{{$val->distance}}">
                                                                <input name="distance_id" type="hidden" value="{{$val->id}}">
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-primary" type="submit">Update</button>
                                                            </td>
                                                            </form>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                  <tr><td>No data found</td></tr>
                                                @endif
                                            </tbody>
                                        </table>
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

   <script src="{{ url('assets/manage/js/tableManager.js') }}"></script>
   <script>
         $('.tablemanager').tablemanager({

            disable: ["last"],
            appendFilterby: true,
            dateFormat: [
                [4, "mm-dd-yyyy"]
            ],
            debug: true,
            vocabulary: {
                voc_filter_by: 'Filter By',
                voc_type_here_filter: 'Filter...',
                voc_show_rows: 'Rows Per Page'
            },
            pagination: true,
            showrows: [10, 20, 50, 100],
            disableFilterBy: [1]
            });
   </script>

@endpush
