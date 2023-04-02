@include('layouts.head')
<section class="totalFirstScreen">
	<img src="{{ url('/')}}/assets/workflow/images/edams-logo3.png" class="logo" alt="">
	<picture>
		<img src="{{ url('/')}}/assets/workflow/images/Medomand-online-Pharmacy-supply-1024x759.png" alt="">
	</picture>
	<p>Find  Doctor, Pharmacy and many more.</p>
	<div class="longBtnWrap">
		<a href="{{url('/doctor/create')}}" class="btn">Cellrox Doctor<i class="fa fa-search"></i></a>
		<a href="{{url('/pharmacy/create')}}" class="btn btn_blu">  Cellrox Pharmacy <i class="fa fa-list-ol"></i></a>
	</div>
</section>

<section class="downPop">
	<main>
		<h3>Pharmacy</h3>
		<i class="fa fa-times closePopDown"></i>
		<div class="popupForm">
			<form action="otp.html">
				<input type="text" class="popInp" placeholder="Name">
				<input type="text" class="popInp" placeholder="Mobile Number">

				<input type="submit" class="submitBox" value="submit">
			</form>
		</div>
	</main>
	<div class="closePop"></div>
</section>
</body>
</html>
