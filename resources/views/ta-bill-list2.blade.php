@extends('layouts.template')
@push('title')
    <title>Pharmacy - T.A Bill List</title>
@endpush

@section('body')
<section class="topCover">
    <h2>
        <small>welcome</small>
    </h2>
</section>
  <section class="mainBody">
    <div class="categoryBar editProfile">
        <table id="myTable" class="bill-table table order-list" border="2">
            <thead>
                <tr>
                    <td>Emp. Name</td>
                    <td>Total Amt</td>
                    <td>Stay Bill</td>
                </tr>
            </thead>
            <tbody>
                @if(isset($data) && count($data)>0)
                @foreach($data as $val)
                 @php
                    $emphead = explode(",",$val->emphead);
                    $tabillhead = explode(",", $val->tabillhead);
                    $match = array_diff($emphead, $tabillhead);
                    // print_r($emphead);
                    // print_r($tabillhead);
                    // print_r($match);
                    // echo "<br>";
                 @endphp
                 @if(empty($match))
                    <tr>
                        <td>{{$val->employee_name}}</td>
                        <td>{{$val->total_amount}}</td>
                        <td><a target="_blank" href="{{url("/").$val->stay_bill}}"><img src="{{url("/").$val->stay_bill}}" height="50" width="50"></td>
                    </tr>
                 @else
                 <tr><td>No Record found</td></tr>
                 @endif
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
  </section>
@endsection
