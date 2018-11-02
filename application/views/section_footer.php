</div>
<a id="to-top" href="#"><i class="fas fa-angle-up"></i></a>
<script>
window.onscroll = function() {scrollFunction()};

var navbar = document.getElementById("navigation");
var sticky = navbar.offsetTop;

function scrollFunction() {
	if (window.pageYOffset >= sticky) {
		navbar.classList.add("sticky")
	} else {
		navbar.classList.remove("sticky");
	}
  
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("to-top").style.display = "block";
    } else {
        document.getElementById("to-top").style.display = "none";
    }
}

$('#to-top').each(function(){
  $(this).click(function(){ 
    $('html').animate({ scrollTop: 0 }, 'slow'); return true; 
  });
});
</script>
</body>
</html>