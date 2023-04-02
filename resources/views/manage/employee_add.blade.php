@extends('manage.layouts.common-template')
@push('title')
    <title>Pharmacy - Employee Add</title>
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
                                            <h5>Add Employee</h5>
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
                                                            <select name="headquarter_id[]" class="form-control" multiple required>
                                                                <option value="">Choose any Headquarter</option>
                                                                @php $exp = array() @endphp
                                                                @if(isset($data))
                                                                  @php $exp = explode(",",$data->headquarter_id) @endphp
                                                                @endif
                                                                @if(isset($headquarter) && count($headquarter)>0)
                                                                        @foreach ($headquarter as $val)
                                                                        @if(isset($exp) && count($exp)>0)
                                                                         @for($i=0;$i<count($exp);$i++)
                                                                         <option value="{{$val->id}}" {{ (old('headquarter_id') == $val->id)? 'selected' : ((isset($data) && ($exp[$i] == $val->id)) ? 'selected' : '')}}>{{$val->headquarter_name}}</option>
                                                                         @endfor
                                                                         @else
                                                                        <option value="{{$val->id}}" {{ (old('headquarter_id') == $val->id)? 'selected' : ''}}>{{$val->headquarter_name}}</option>
                                                                         @endif
                                                                        @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Employee Name (*)</label>
                                                            <input name="employee_name" type="text" class="form-control" id="" placeholder="Employee Name" value="{{ $data->employee_name ?? old('employee_name')}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Password (*)</label>
                                                            <input name="password" type="text" class="form-control" id="" placeholder="Password" value="{{ $data->password ?? old('password')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Role Name (*)</label>
                                                            <select name="role_id" class="form-control" required>
                                                                <option value="">Choose any Role</option>
                                                                @if(isset($role) && count($role)>0)
                                                                    @foreach ($role as $val)
                                                                      <option value="{{$val->id}}" {{ (old('role_id') == $val->id)? 'selected' : ((isset($data) && ($data->role_id == $val->id)) ? 'selected' : '')}}>{{$val->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Employee Phone (*)</label>
                                                            <input name="phone" type="text" class="form-control" id="" placeholder="Phone" value="{{ $data->phone ?? old('phone')}}">
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
