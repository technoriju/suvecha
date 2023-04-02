@extends('layouts.template')
@push('title')
    <title>Pharmacy - T.A Bill Add</title>
@endpush

@section('body')
    <section class="topCover">
        <h2>
            <small>Welcome</small>
        </h2>
    </section>

    <section class="mainBody">
        <div class="categoryBar editProfile">
            <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="editPrWrap">
                    <picture>
                        <img src="{{ url('/')}}/assets/workflow/images/car_04.png" alt="" />
                        <label>
                            <input type="file" name="file_path">
                            <i class="fa fa-pencil"></i>
                        </label>
                    </picture>
                    <h2> Add T.A Bill</h2>
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
                    </div>

                    <table id="myTable" class="bill-table table order-list">
                        <thead>
                            <tr>
                                <td>Date</td>
                                <td>Headquarter</td>
                                <td>Station</td>
                                <td>Area</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody id="countrow">
                            <tr>
                                <td>
                                    <input type="date" name="date[]" id="date0" placeholder="Choose Date" class="form-control"/>
                                    <input type="hidden" name="rowcount" id="rowcount" value="1">
                                </td>
                                <td><select class="form-control" name="headquarter_id[]" id="headquarter_id0" required="" onchange="Area(getAttribute('id'));">
                                    <option value="">Choose any Headquarter</option>
                                    @if(isset($headquarter) && count($headquarter) > 0)
                                        @foreach ($headquarter as $val)
                                            <option value="{{ $val->id }}">{{ $val->headquarter_name }}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                </td>
                                <td>
                                    <select name="station[]" id="station0" class="form-control" required >
                                        <option value="">Choose any Station</option>
                                        <option value="1">X-Station</option>
                                        <option value="2">Out-Station</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="area_id0[]" id="area_id0" class="form-control" multiple>
                                        <option value="0">Choose Station first</option>
                                    </select>
                                </td>
                                <td><a class="deleteRow"></a>
                                    <input type="button" class="btn btn-md btn-success" id="addrow" value="Add Row" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
        function Area(id)
        {
            var suffix = id.match(/\d+/);
            var head = $('#headquarter_id'+suffix).val();
            $.ajax({
                type:"POST",
                url: "/ta-bill/areaTa",
                data: {'_token': "{{csrf_token()}}", 'headquarter_id':head},
                success: function(data)
                {
                    $('#area_id'+suffix).html(data);
                }
            })
        }


        $(document).ready(function() {
            var counter = 0;

            $("#addrow").on("click", function() {
                var date = $('#date'+counter).val();
                var head = $('#headquarter_id'+counter).val();
               if(head != '' && date != '')
               {
                    counter++;
                    $('#rowcount').val(parseInt($('#rowcount').val()) + parseInt(1));
                    var newRow = $("<tr>");
                    var cols = "";

                    //$("#qnt0").clone().appendTo("#qnt"+counter);
                    cols += '<td><input type="date" class="form-control" placeholder="Choose Date" id="date' + counter + '" name="date[]"/></td>';
                    cols += '<td><select class="form-control" name="headquarter_id[]" id="headquarter_id' + counter + '" onchange="Area(this.id);"></select></td>';
                    cols += '<td><select class="form-control" name="station[]" id="station' + counter + '" ></select></td>';
                    cols += '<td><select class="form-control" name="area_id'+counter+'[]" id="area_id' + counter + '" multiple></select></td>';
                    cols += '<td><input type="button" id="ibtnDel" class="btn btn-md btn-danger"  value="Delete"></td>';
                    newRow.append(cols);
                    $("table.order-list").append(newRow);

                    var $options = $("#headquarter_id0 > option").clone();
                    $('#headquarter_id'+counter).append($options);

                    var $options2 = $("#area_id0 > option").clone();
                    $('#area_id'+counter).append($options2);

                    var $options3 = $("#station0 > option").clone();
                    $('#station'+counter).append($options3);

               } else { alert('Headquarter and Date fields are required') }

            });

            $("table.order-list").on("click", "#ibtnDel", function(event) {
                $(this).closest("tr").remove();
                counter -= 1
                $('#rowcount').val(parseInt($('#rowcount').val()) - parseInt(1));
            });
        });
    </script>
@endpush
