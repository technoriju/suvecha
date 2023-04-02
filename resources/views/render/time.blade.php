
<label for=""><b>Timing</b></label>
<?php $day_array = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'); ?>
<div class="row">

@if(isset($doctor_time))
  @foreach($doctor_time as $time)

            <span>{{$time->day_name}}</span>
            <select id="mon_time_from" name="start_time[{{$time->day_name}}]">
                <option @if( isset($time->open_time) && $time->open_time=='05:00:00' ) selected @endif value="10:00:00">5.00 AM</option>
                <option @if( isset($time->open_time) && $time->open_time=='06:00:00' ) selected @endif value="10:00:00">6.00 AM</option>
                <option @if( isset($time->open_time) && $time->open_time=='07:00:00' ) selected @endif value="10:00:00">7.00 AM</option>
                <option @if( isset($time->open_time) && $time->open_time=='08:00:00' ) selected @endif value="10:00:00">8.00 AM</option>
                <option @if( isset($time->open_time) && $time->open_time=='09:00:00' ) selected @endif value="10:00:00">9.00 AM</option>
                <option @if( isset($time->open_time) && $time->open_time=='10:00:00' ) selected @endif value="10:00:00">10.00 AM</option>
                <option @if(isset($time->open_time) && $time->open_time=='11:00:00' ) selected @endif value="11:00:00">11.00 AM</option>
                <option @if( isset($time->open_time) && $time->open_time=='12:00:00' ) selected @endif value="12:00:00">12.00 AM</option>
                <option @if(isset($time->open_time) && $time->open_time=='13:00:00' ) selected @endif value="13:00:00">01.00 PM</option>
                <option @if(isset($time->open_time) && $time->open_time=='14:00:00' ) selected @endif value="14:00:00">02.00 PM</option>
                <option @if( isset($time->open_time) && $time->open_time=='15:00:00' ) selected @endif value="15:00:00">03.00 PM</option>
                <option @if( isset($time->open_time) && $time->open_time=='16:00:00' ) selected @endif value="16:00:00">04.00 PM</option>
                <option @if( isset($time->open_time) && $time->open_time=='17:00:00' ) selected @endif value="17:00:00">05.00 PM</option>
                <option @if( isset($time->open_time) && $time->open_time=='18:00:00' ) selected @endif value="18:00:00">06.00 PM</option>
                <option @if( isset($time->open_time) && $time->open_time=='19:00:00' ) selected @endif value="19:00:00">07.00 PM</option>
                <option @if( isset($time->open_time) && $time->open_time=='20:00:00' ) selected @endif value="20:00:00">08.00 PM</option>
                <option @if( isset($time->open_time) && $time->open_time=='21:00:00' ) selected @endif value="21:00:00">09.00 PM</option>
                <option @if( isset($time->open_time) && $time->open_time=='22:00:00' ) selected @endif value="22:00:00">10.00 PM</option>
                <option @if( isset($time->open_time) && $time->open_time=='23:00:00' ) selected @endif value="23:00:00">11.00 PM</option>
                <option @if( isset($time->open_time) && $time->open_time=='24:00:00' ) selected @endif value="24:00:00">12.00 PM</option>
            </select>
            <span>to</span>
            <select id="mon_time_from" name="end_time[{{$time->day_name}}]">
                <option @if( isset($time->close_time) && $time->close_time=='05:00:00' ) selected @endif value="10:00:00">5.00 AM</option>
                <option @if( isset($time->close_time) && $time->close_time=='06:00:00' ) selected @endif value="10:00:00">6.00 AM</option>
                <option @if( isset($time->close_time) && $time->close_time=='07:00:00' ) selected @endif value="10:00:00">7.00 AM</option>
                <option @if( isset($time->close_time) && $time->close_time=='08:00:00' ) selected @endif value="10:00:00">8.00 AM</option>
                <option @if( isset($time->close_time) && $time->close_time=='09:00:00' ) selected @endif value="10:00:00">9.00 AM</option>
                <option @if( isset($time->close_time) && $time->close_time=='10:00:00' ) selected @endif value="10:00:00">10.00 AM</option>
                <option @if( isset($time->close_time) && $time->close_time=='11:00:00' ) selected @endif value="11:00:00">11.00 AM</option>
                <option @if( isset($time->close_time) && $time->close_time=='12:00:00' ) selected @endif value="12:00:00">12.00 AM</option>
                <option @if( isset($time->close_time) && $time->close_time=='13:00:00' ) selected @endif value="13:00:00">01.00 PM</option>
                <option @if( isset($time->close_time) && $time->close_time=='14:00:00' ) selected @endif value="14:00:00">02.00 PM</option>
                <option @if( isset($time->close_time) && $time->close_time=='15:00:00' ) selected @endif value="15:00:00">03.00 PM</option>
                <option @if( isset($time->close_time) && $time->close_time=='16:00:00' ) selected @endif value="16:00:00">04.00 PM</option>
                <option @if( isset($time->close_time) && $time->close_time=='17:00:00' ) selected @endif value="17:00:00">05.00 PM</option>
                <option @if( isset($time->close_time) && $time->close_time=='18:00:00' ) selected @endif value="18:00:00">06.00 PM</option>
                <option @if( isset($time->close_time) && $time->close_time=='19:00:00' ) selected @endif value="19:00:00">07.00 PM</option>
                <option @if( isset($time->close_time) && $time->close_time=='20:00:00' ) selected @endif value="20:00:00">08.00 PM</option>
                <option @if( isset($time->close_time) && $time->close_time=='21:00:00' ) selected @endif value="21:00:00">09.00 PM</option>
                <option @if( isset($time->close_time) && $time->close_time=='22:00:00' ) selected @endif value="22:00:00">10.00 PM</option>
                <option @if( isset($time->close_time) && $time->close_time=='23:00:00' ) selected @endif value="23:00:00">11.00 PM</option>
                <option @if( isset($time->close_time) && $time->close_time=='24:00:00' ) selected @endif value="24:00:00">12.00 PM</option>
            </select>
            </div>
            @if(isset($time->schedule)) @php $count = 0 @endphp
            @foreach($time->schedule as $schedule_time) @php $count++; @endphp
            <div class="row">
            <span>{{$time->day_name}} Schedule - {{$count}}</span>
            <select id="mon_time_from" name="{{$time->day_name}}_start_time[]">
                <option value="">Select Time From</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='05:00:00' ) selected @endif value="05:00:00">5.00 AM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='06:00:00' ) selected @endif value="06:00:00">6.00 AM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='07:00:00' ) selected @endif value="07:00:00">7.00 AM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='08:00:00' ) selected @endif value="08:00:00">8.00 AM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='09:00:00' ) selected @endif value="09:00:00">9.00 AM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='10:00:00' ) selected @endif value="10:00:00">10.00 AM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='11:00:00' ) selected @endif value="11:00:00">11.00 AM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='12:00:00' ) selected @endif value="12:00:00">12.00 AM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='13:00:00' ) selected @endif value="13:00:00">01.00 PM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='14:00:00' ) selected @endif value="14:00:00">02.00 PM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='15:00:00' ) selected @endif value="15:00:00">03.00 PM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='16:00:00' ) selected @endif value="16:00:00">04.00 PM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='17:00:00' ) selected @endif value="17:00:00">05.00 PM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='18:00:00' ) selected @endif value="18:00:00">06.00 PM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='19:00:00' ) selected @endif value="19:00:00">07.00 PM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='20:00:00' ) selected @endif value="20:00:00">08.00 PM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='21:00:00' ) selected @endif value="21:00:00">09.00 PM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='22:00:00' ) selected @endif value="22:00:00">10.00 PM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='23:00:00' ) selected @endif value="23:00:00">11.00 PM</option>
                <option @if( isset($schedule_time->open_time) && $schedule_time->open_time=='24:00:00' ) selected @endif value="24:00:00">12.00 PM</option>
            </select>
            <span>to</span>
            <select id="mon_time_from" name="{{$time->day_name}}_end_time[]">
                <option value="">Select Time To</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='05:00:00' ) selected @endif value="05:00:00">5.00 AM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='06:00:00' ) selected @endif value="06:00:00">6.00 AM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='07:00:00' ) selected @endif value="07:00:00">7.00 AM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='08:00:00' ) selected @endif value="08:00:00">8.00 AM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='09:00:00' ) selected @endif value="09:00:00">9.00 AM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='10:00:00' ) selected @endif value="10:00:00">10.00 AM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='11:00:00' ) selected @endif value="11:00:00">11.00 AM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='12:00:00' ) selected @endif value="12:00:00">12.00 AM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='13:00:00' ) selected @endif value="13:00:00">01.00 PM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='14:00:00' ) selected @endif value="14:00:00">02.00 PM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='15:00:00' ) selected @endif value="15:00:00">03.00 PM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='16:00:00' ) selected @endif value="16:00:00">04.00 PM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='17:00:00' ) selected @endif value="17:00:00">05.00 PM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='18:00:00' ) selected @endif value="18:00:00">06.00 PM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='19:00:00' ) selected @endif value="19:00:00">07.00 PM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='20:00:00' ) selected @endif value="20:00:00">08.00 PM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='21:00:00' ) selected @endif value="21:00:00">09.00 PM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='22:00:00' ) selected @endif value="22:00:00">10.00 PM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='23:00:00' ) selected @endif value="23:00:00">11.00 PM</option>
                <option @if( isset($schedule_time->close_time) && $schedule_time->close_time=='24:00:00' ) selected @endif value="24:00:00">12.00 PM</option>
            </select>
            </div>
            <br>
            @endforeach
            @endif


@endforeach
@endif
