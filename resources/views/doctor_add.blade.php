@extends('layouts.template')
@push('title')
    <title>Pharmacy - Doctor Add</title>
@endpush

@section('body')
    <section class="downPop alTimeActive">
        <main>
            <h3>ADD DOCTOR</h3>
            <!-- <i class="fa fa-times closePopDown"></i> -->
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
                <form action="{{$url}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <select name="district_id" class="popInp">
                        <option value="{{ $district->id }}" selected>{{ $district->name }}</option>
                    </select>
                    <select name="headquarter_id" class="popInp" onchange="Area(this.value);">
                        <option value="">Choose any Headquarter</option>
                        @if(isset($headquarter) && count($headquarter) > 0)
                            @foreach ($headquarter as $val)
                                <option value="{{ $val->id }}">{{ $val->headquarter_name }}</option>
                            @endforeach
                        @endif
                    </select>

                    <select name="area_id" class="popInp" id="area_id" onchange="Pharmacy(this.value)">
                        <option value="">Choose headquarter first</option>
                    </select>

                    <input type="text" class="popInp" placeholder="Name" name="doctor_name">
                    <input type="text" class="popInp" placeholder="Address" name="address">
                    <input type="text" class="popInp" placeholder="Phone" name="phone">
                    <select name="specialization_id" class="popInp">
                        <option value="">Choose any Specializations</option>
                        @if(isset($specializations) && count($headquarter) > 0)
                            @foreach ($specializations as $val)
                                <option value="{{ $val->id }}">{{ $val->specialization_name }}</option>
                            @endforeach
                        @endif
                    </select>

                    <select name="pharmacy_id[]" class="popInp" id="pharmacy_id" multiple>
                        <option value="">Choose area First</option>
                    </select>

                    <label for="">
                        <b>Upload Photo</b>
                        <input type="file" class="popInp" name="file_path">
                    </label>
                   <label for=""><b>Timing</b></label>
                   <?php $day_array = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'); ?>
                   @for($i=0;$i<7;$i++)
                   <div class="row">
                   <span>{{$day_array[$i]}}</span>
                   <input type="hidden" name="day_name[]" value="{{strtolower($day_array[$i])}}">
                   <select id="mon_time_from" name="start_time[{{strtolower($day_array[$i])}}]">
                        <option value="">Select Time From</option>
                        <option value="05:00:00">5.00 AM</option>
                        <option value="06:00:00">6.00 AM</option>
                        <option value="07:00:00">7.00 AM</option>
                        <option value="08:00:00">8.00 AM</option>
                        <option value="09:00:00">9.00 AM</option>
                        <option value="10:00:00">10.00 AM</option>
                        <option value="11:00:00">11.00 AM</option>
                        <option value="12:00:00">12.00 AM</option>
                        <option value="13:00:00">01.00 PM</option>
                        <option value="14:00:00">02.00 PM</option>
                        <option value="15:00:00">03.00 PM</option>
                        <option value="16:00:00">04.00 PM</option>
                        <option value="17:00:00">05.00 PM</option>
                        <option value="18:00:00">06.00 PM</option>
                        <option value="19:00:00">07.00 PM</option>
                        <option value="20:00:00">08.00 PM</option>
                        <option value="21:00:00">09.00 PM</option>
                        <option value="22:00:00">10.00 PM</option>
                        <option value="23:00:00">11.00 PM</option>
                        <option value="24:00:00">12.00 PM</option>
                    </select>
                    <span>to</span>
                    <select id="mon_time_from" name="end_time[{{strtolower($day_array[$i])}}]">
                        <option value="">Select Time To</option>
                        <option value="05:00:00">5.00 AM</option>
                        <option value="06:00:00">6.00 AM</option>
                        <option value="07:00:00">7.00 AM</option>
                        <option value="08:00:00">8.00 AM</option>
                        <option value="09:00:00">9.00 AM</option>
                        <option value="10:00:00">10.00 AM</option>
                        <option value="11:00:00">11.00 AM</option>
                        <option value="12:00:00">12.00 AM</option>
                        <option value="13:00:00">01.00 PM</option>
                        <option value="14:00:00">02.00 PM</option>
                        <option value="15:00:00">03.00 PM</option>
                        <option value="16:00:00">04.00 PM</option>
                        <option value="17:00:00">05.00 PM</option>
                        <option value="18:00:00">06.00 PM</option>
                        <option value="19:00:00">07.00 PM</option>
                        <option value="20:00:00">08.00 PM</option>
                        <option value="21:00:00">09.00 PM</option>
                        <option value="22:00:00">10.00 PM</option>
                        <option value="23:00:00">11.00 PM</option>
                        <option value="24:00:00">12.00 PM</option>
                    </select>
                    </div>
                    @for($j=1;$j<=3;$j++)
                    <div class="row">
                    <span>{{$day_array[$i]}} Schedule - {{$j}}</span>
                    <select id="mon_time_from" name="{{strtolower($day_array[$i])}}_start_time[]">
                        <option value="">Select Time From</option>
                        <option value="05:00:00">5.00 AM</option>
                        <option value="06:00:00">6.00 AM</option>
                        <option value="07:00:00">7.00 AM</option>
                        <option value="08:00:00">8.00 AM</option>
                        <option value="09:00:00">9.00 AM</option>
                        <option value="10:00:00">10.00 AM</option>
                        <option value="11:00:00">11.00 AM</option>
                        <option value="12:00:00">12.00 AM</option>
                        <option value="13:00:00">01.00 PM</option>
                        <option value="14:00:00">02.00 PM</option>
                        <option value="15:00:00">03.00 PM</option>
                        <option value="16:00:00">04.00 PM</option>
                        <option value="17:00:00">05.00 PM</option>
                        <option value="18:00:00">06.00 PM</option>
                        <option value="19:00:00">07.00 PM</option>
                        <option value="20:00:00">08.00 PM</option>
                        <option value="21:00:00">09.00 PM</option>
                        <option value="22:00:00">10.00 PM</option>
                        <option value="23:00:00">11.00 PM</option>
                        <option value="24:00:00">12.00 PM</option>
                    </select>
                    <span>to</span>
                    <select id="mon_time_from" name="{{strtolower($day_array[$i])}}_end_time[]">
                        <option value="">Select Time To</option>
                        <option value="05:00:00">5.00 AM</option>
                        <option value="06:00:00">6.00 AM</option>
                        <option value="07:00:00">7.00 AM</option>
                        <option value="08:00:00">8.00 AM</option>
                        <option value="09:00:00">9.00 AM</option>
                        <option value="10:00:00">10.00 AM</option>
                        <option value="11:00:00">11.00 AM</option>
                        <option value="12:00:00">12.00 AM</option>
                        <option value="13:00:00">01.00 PM</option>
                        <option value="14:00:00">02.00 PM</option>
                        <option value="15:00:00">03.00 PM</option>
                        <option value="16:00:00">04.00 PM</option>
                        <option value="17:00:00">05.00 PM</option>
                        <option value="18:00:00">06.00 PM</option>
                        <option value="19:00:00">07.00 PM</option>
                        <option value="20:00:00">08.00 PM</option>
                        <option value="21:00:00">09.00 PM</option>
                        <option value="22:00:00">10.00 PM</option>
                        <option value="23:00:00">11.00 PM</option>
                        <option value="24:00:00">12.00 PM</option>
                    </select>
                    </div><br>
                    @endfor
                    @endfor
                    <input type="submit" class="submitBox" value="submit">
                </form>
            </div>
        </main>
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
                    $('#area_id').html(data);
                }
            })
        }

        function Pharmacy(val)
        {
            $.ajax({
                type:"POST",
                url: "/pharmacy/fetchPharmacy",
                data: {'_token': "{{csrf_token()}}", 'area_id':val},
                success: function(data)
                {
                    $("#pharmacy_id").html(data);
                }
            })
        }
    </script>

@endpush
