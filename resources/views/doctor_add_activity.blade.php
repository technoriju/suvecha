@extends('layouts.template')
@push('title')
    <title>Pharmacy - Doctor Activity Add</title>
@endpush

@section('body')


<section class="downPop alTimeActive">
	<main>
		<h3>Add DOCTOR Activaty</h3>
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
			<form action="{{$url}}" method="post" enctype="multipart/form-data">
                @csrf
			<select name="area_id" class="popInp" onchange="Doctor(this.value)">
                <option value="">Choose any Area</option>
                @if(isset($area) && count($area) > 0)
                @foreach ($area as $val)
                    <option value="{{ $val->id }}" {{ (old('area_id') == $val->id) ? 'selected' : ''}}>{{ $val->area_name }}</option>
                @endforeach
                @endif
				</select>
				<select name="doctor_id" class="popInp" placeholder="Doctor Name" id="doctor_name" onchange="DoctorDetails(this.value)">
					<option value="">Choose area first</option>
				</select>
				<input type="text" class="popInp" placeholder="Address" name="address" id="address">
                <input type="text" class="popInp" placeholder="Specialization" name="specialization_id" id="specialization_id">
                <input type="text" class="popInp" placeholder="Pharmacy" name="pharmacy_id" id="pharmacy_id">
				<select name="medicine_id[]" class="popInp" multiple>
					<option value="">Today Suggested Medicine</option>
                    @if(isset($medicine) && count($medicine) > 0)
                    @foreach ($medicine as $val)
                        <option value="{{ $val->id }}" {{ (old('medicine_id') == $val->id) ? 'selected' : ''}}>{{ $val->medicine_name }}</option>
                    @endforeach
                    @endif
				</select>
				<input type="text" class="popInp" placeholder="information" name="information" required>
                 <div id="time"></div>
                <input type="hidden" name="longitude" value="" id="longitude"><input type="hidden" name="latitude" value="" id="latitude">
				<input type="submit" class="submitBox" value="submit">
			</form>
		</div>
	</main>
</section>
@endsection

@push('script')
   <script>
       function showPosition()
            {
                if(navigator.geolocation)
                {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var positionInfo = "Your current position is (" + "Latitude: " + position.coords.latitude + ", " + "Longitude: " + position.coords.longitude + ")";
                        //document.getElementById("result").innerHTML = positionInfo;
                        console.log(position.coords.longitude);
                        $("#longitude").val(position.coords.longitude);
                        $("#latitude").val(position.coords.latitude);
                        // $.ajax({
                        //     type: "POST",
                        //     url: "/address_fetch.php",
                        //     data: {"longitude": position.coords.longitude,"latitude":position.coords.latitude},
                        //     success: function(data) {
                        //         document.getElementById("result").innerHTML = data;
                        //     }
                        // });
                    });
                }
                else { alert("Sorry, your browser does not support geolocation."); }
            }

       function Doctor(val)
        {
            $.ajax({
                type:"POST",
                url: "/doctor/fetchDoctor",
                data: {'_token': "{{csrf_token()}}", 'area_id':val},
                success: function(data)
                {
                    $("#doctor_name").html(data);
                }
            })
        }
        function DoctorDetails(val)
        {
            $.ajax({
                type:"POST",
                url: "/doctor/fetchDoctorInfo",
                data: {'_token': "{{csrf_token()}}", 'id':val},
                dataType: "JSON",
                success: function(data)
                {
                    $("#pharmacy_id").val(data.pharmacy_id);
                    $("#address").val(data.address);
                    $("#specialization_id").val(data.specialization_id);
                    $("#time").html(data.time);
                }
            })
        }
   </script>
@endpush

</body>
</html>
