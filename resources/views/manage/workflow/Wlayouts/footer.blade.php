<footer>
    <span>
        <a href="javascript:;" onclick="history.back()"><i class="fa fa-arrow-left"></i></a>
        <a href="notice.html"><i class="fa fa-bell"></i></a>
        <a href="doctors & pharmacy.html"><i class="fa fa-home"></i></a>
        <a href="myprofile.html"><i class="fa fa-user"></i></a>
        <a href="javascript:;" class="reviewPopTrg"><i class="fa fa-star"></i></a>
    </span>
</footer>

<script src="{{ url('/')}}/assets/workflow/js/jquery-3.5.1-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.3.2/jquery-migrate.min.js"></script>
<script src="{{ url('/')}}/assets/workflow/js/bootstrap.min.js"></script>
<script src="{{ url('/')}}/assets/workflow/js/jquery.flexisel.js"></script>
<script>
  $(function() {
    $('.btn_blu').click( function() {
            $('.downPop').fadeIn(300).addClass('activeDownPop');
    });
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
@stack('script')
</body>
</html>
