@extends('manage.layouts.common-template')
    @push('title')
        <title>Pharmacy - Employee List</title>
    @endpush
    @push('style')
        <style>
            #panel { padding: 10px; display: none; }
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
                                                    <h5>All Employee List</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body data-tablee table-responsive">

                                            <div id="for_filter_by" class="for_filter_by" style="display: inline-block;">
                                                <form action="{{$url}}" method="post">
                                                    @csrf
                                                <label for="filter_by">Filter By Date:</label>
                                                <input id="filter_input" type="date" name="dateFrom" value="{{$form_data['dateFrom'] ?? ''}}" required>
                                                <label for="filter_by">To:</label>
                                                <input id="filter_input" type="date" name="dateTo" value="{{$form_data['dateTo'] ?? ''}}" required>
                                                <select id="filter_by" name="role" onchange="Employee(this.value)">
                                                    <option value="">Select any Role</option>
                                                    @if(isset($role) && count($role)>0)
                                                    @foreach($role as $val2)
                                                       <option value="{{$val2->id}}" {{(isset($form_data['role']) && $form_data['role'] == $val2->id)? 'selected':''}}>{{$val2->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <select id="filter_by" name="emp" class="employee">
                                                    <option value="">Select any Employee</option>
                                                    @if(isset($employee) && count($employee)>0)
                                                    @foreach($employee as $val3)
                                                        <option value="{{$val3->id}}" {{(isset($form_data['emp']) && $form_data['emp'] == $val3->id)? 'selected':''}}>{{$val3->employee_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <button id="filter_by">Search</button>
                                                </form>
                                            </div>
                                            <table class="table table-hover tablemanager">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">From Headquarter</th>
                                                        <th scope="col">To Headquarter</th>
                                                        <th scope="col">Area</th>
                                                        <th scope="col">Station</th>
                                                        <th scope="col">Kilometer</th>
                                                        <th scope="col">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(isset($data) && count($data)>0)
                                                    @foreach($data as $val)
                                                    @php
                                                        $hq2 = '';
                                                        $list = AreaList2($val->area_id);
                                                        foreach($list as $hq):
                                                        $hq2 .= $hq->area_name.' | ';
                                                        endforeach;
                                                    @endphp
                                                    <tr>
                                                      <td data-label="Date">{{$val->employee_name}}</td>
                                                      <td data-label="Date">{{$val->date}}</td>
                                                      <td data-label="From Headquarter">{{$val->headown}}</td>
                                                      <td data-label="To Headquarter">{{$val->headquarter_name}}</td>
                                                      <td data-label="Area">{{$hq2}}</td>
                                                      <td data-label="Station">{{($val->station == 3)?'Headquarter':(($val->station == 1)?'X-Station':'Out-Station')}}</td>
                                                      <td data-label="Kilometer">{{$val->distance}}</td>
                                                      <td data-label="Amount">{{$val->total_amount}}</td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                  </tbody>
                                            </table>
                                            {{!! $data->links() !!}}

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

            function Delete(id)
            {
                var x=confirm("Are you sure want to Delete?");
                if(x) { DeleteRecord(id); } else { return false; }
            }

           function Employee(id)
           {
              $.ajax(
                {
                    url: "/manage/ta-bill/empfetch",
                    type: 'POST',
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    success: function (data){

                        $(".employee").html(data.val);

                    }
                });
           }

        </script>
@endpush
