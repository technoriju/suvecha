@extends('manage.layouts.common-template')
    @push('title')
        <title>Pharmacy - Role List</title>
    @endpush
    @push('style')
        <style>
            #panel { padding: 10px; display: none; }
            input {
            border-top-style: hidden;
            border-right-style: hidden;
            border-left-style: hidden;
            border-bottom-style: groove;
            background-color: #fff;
        }
        </style>
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
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h5>All Role List</h5>
                                                </div>
                                            </div>
                                        </div>
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
                                        <div class="card-body data-tablee table-responsive">
                                            <table class="table table-hover tablemanager">
                                                <thead>
                                                    <tr>
                                                        <th class="disableSort">#</th>
                                                        <th>Role</th>
                                                        <th>Fixed Price(Headquarter)</th>
                                                        <th>Fixed Price(X Station)</th>
                                                        <th>Fixed Price(Out Station)</th>
                                                        <th class="disableFilterBy">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(isset($data) && count($data)>0)  @php $count=0 @endphp
                                                        @foreach ($data as $val)  @php $count++ @endphp
                                                            <tr>
                                                                <form action='/manage/dashboard' method="post"> @csrf
                                                                <td>{{$count}}</td>
                                                                <td>{{$val->name}}</td>
                                                                <td>
                                                                    <input name="fixed_price_h" type="text" value="{{$val->fixed_price_h}}">
                                                                </td>
                                                                <td>
                                                                    <input name="fixed_price_x" type="text" value="{{$val->fixed_price_x}}">
                                                                    <input name="role_id" type="hidden" value="{{$val->id}}">
                                                                </td>
                                                                <td>
                                                                    <input name="fixed_price_o" type="text" value="{{$val->fixed_price_o}}">
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
                                    </div>
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
        <script type="text/javascript">

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
            // $('.tablemanager').tablemanager();

            function Delete(id)
            {
                var x=confirm("Are you sure want to Delete?");
                if(x) { DeleteRecord(id); } else { return false; }
            }

           function DeleteRecord(id)
           {
              $.ajax(
                {
                    url: "/manage/area/"+id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (data){

                        swal({
                            title: "Great job!",
                            text: "Area Data Deleted",
                            type: "success"
                        }).then(function() {
                            window.location = "manage/area";
                        });
                    }
                });
           }

        </script>
@endpush
