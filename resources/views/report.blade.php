@extends('layouts.common-template')
@push('title')
    <title>Suvecha - Category</title>
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
                                            <h5>All Reports</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ url('/report') }}" method="post" id="categoryform">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Date - From:</label>
                                                            <input type="date" name="datef" class="form-control" required value="{{$post_data['datef'] ?? ''}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Date - To:</label>
                                                            <input type="date" name="datet" class="form-control" value="{{ $post_data['datet'] ?? date('Y-m-d') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Product:</label>
                                                            <select name="product" class="form-control">
                                                                <option value="">Select any One</option>
                                                                @if(isset($product) && count($product)>0)
                                                                @foreach ($product as $prod)
                                                                    @php $selected = ''; @endphp
                                                                    @if(isset($post_data['product']) && ($post_data['product'] == $prod->product_id))
                                                                        @php $selected = 'selected'; @endphp
                                                                    @endif
                                                                  <option value="{{$prod->product_id}}" {{$selected}}>{{$prod->product_name}}</option>
                                                                @endforeach
                                                             @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <button type="submit" name="sub" value="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        {{-- result data --}}
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h5>
                                                        @isset($post_data)
                                                           @isset($post_data['product'])
                                                              @php $qp = productNQP($post_data['product']) @endphp
                                                           @endisset
                                                            Report Of {{$post_data['datef'] ?? ''}} to {{$post_data['datet'] ?? ''}}
                                                            @if(isset($qp))
                                                              {{ "And Product is ". $qp->product_name }}
                                                            @endif
                                                        @endisset
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="">#</th>
                                                        <th>Product Name</th>
                                                        <th>Qty</th>
                                                        <th>Sales Price</th>
                                                        <th>Total Price({{$data['total_sales'] ?? ''}})</th>
                                                        <th>Profit({{$data['total_profit'] ?? ''}})</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(isset($data['data']) && count($data['data'])>0)  @php $count=0 @endphp

                                                        @foreach ($data['data'] as $val)  @php $count++ @endphp
                                                            <tr>
                                                                <td>{{$count}}</td>
                                                                <td>{{$val->product_name}}</td>
                                                                <td>{{$val->qty}}</td>
                                                                <td>{{$val->sales_price}}</td>
                                                                <td>{{$val->total_price}}</td>
                                                                <td>{{$val->profit}}</td>
                                                                <td>{{dateFormat($val->created_at)}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                      <tr><td>No data found</td></tr>
                                                    @endif
                                                </tbody>
                                            </table>
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

@endpush
