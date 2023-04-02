<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" href="styles/style.css">
<link rel="stylesheet" href="styles/responsive.css">
<link rel="stylesheet" href="styles/slr.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="js/jquery-3.5.1-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.3.2/jquery-migrate.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.flexisel.js"></script>
<script>
$(function() {
	$('.trgdPop').click( function() {
		$('.downPop').fadeIn(300).addClass('activeDownPop');
	});
	$('.closePop, .closePopDown').click( function() {
		$('.downPop').fadeOut(800).removeClass('activeDownPop');
	});
	$('.toggleSlide').click( function() {
		$('.sideBar').fadeIn(300).addClass('activeside');
	});
	$('.closeAside').click( function() {
		$('.sideBar').fadeOut(800).removeClass('activeside');
	});
	$('footer').nextAll().remove();
});

</script>
</head>
<body>

<header>
    <div class="headerInner">
        <span class="toggleSlide"></span>
        <div class="rightContent">
            <i class="fa fa-search trgdPop"></i>
            <picture><img src="images/profileIcon.png" alt=""></picture>
        </div>
    </div>
</header>

<section class="sideBar">
    <aside>
        <img src="images/logo2.png" alt="">
        <ul>
            <li><a href="pharmacy list.html">Pharma list</a></li>
            <li><a href="doctor list.html">Dr. visit</a></li>
            <li><a href="tour list.html">Tour Planing</a></li>
            <li><a href="">Daily actvity</a></li>
           
        </ul>
        <ul>
            <li><a href="Leave request.html">Leave Request</a></li>
            <li><a href="doctor list.html">Dr.list</a></li>
            <li><a href="doctor list.html">Cellrox Dr.</a></li>
            <li><a href="">Stokost Add</a></li>
        </ul>
        <span class="socialLink">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-whatsapp"></i></a>
            <a href="#"><i class="fa fa-youtube-play"></i></a>
        </span>
    </aside>
    <div class="closeAside"></div>
</section>


<section class="topCover">
    <h2>
        <small>welcome</small>
        my profile
    </h2>
</section>
<section class="mainBody">
	<div class="myAccount">
		<div class="personalDetails">
            <picture></picture>
            <h5>Sibsankar Mukherjee
                <small>sibsankarmukherjee8@gmail.com</small>
            </h5>
            <span>
            <a href="edit_profile.html"><i class="fa fa-pencil"></i> edit profile</a>
            </span>
        </div>

        <div class="urlBlocks">
            <a href="javascript:;"><i class="fa fa-user mainIcn"></i> Sibsankar Mukherjee</a>
            <a href="javascript:;"><i class="fa fa-map-marker mainIcn"></i> Gangpur urratpara, post: Joteram, Burdwan</a>
            <a href="javascript:;"><i class="fa fa-envelope-open-o mainIcn"></i> sibsankarmukherjee8@gmail.com</a>
            <a href="javascript:;"><i class="fa fa-phone mainIcn"></i> 8016308513</a>
            <a href="login.html"><i class="fa fa-lock mainIcn"></i> logout <i class="fa fa-angle-right"></i></a>
        </div>
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
<footer>
    <span>
        <a href="javascript:;" onclick="history.back()"><i class="fa fa-arrow-left"></i></a>
        <a href="notice.html"><i class="fa fa-bell"></i></a>
        <a href="doctors & pharmacy.html"><i class="fa fa-home"></i></a>
        <a href="myprofile.html"><i class="fa fa-user"></i></a>
        <a href="javascript:;" class="reviewPopTrg"><i class="fa fa-star"></i></a>
    </span>
</footer>

</body>
</html>