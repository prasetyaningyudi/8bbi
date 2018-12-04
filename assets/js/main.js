$(document).ready(function(){
	function detectmob() { 
	 if( navigator.userAgent.match(/Android/i)
	 || navigator.userAgent.match(/webOS/i)
	 || navigator.userAgent.match(/iPhone/i)
	 || navigator.userAgent.match(/iPad/i)
	 || navigator.userAgent.match(/iPod/i)
	 || navigator.userAgent.match(/BlackBerry/i)
	 || navigator.userAgent.match(/Windows Phone/i)
	 ){
		return true;
	  }
	 else {
		return false;
	  }
	}

	if(detectmob() == true) {//For mobile 
		$('.pcweb').css('display', 'none'); // atau gunakan $('.pcweb').hide();
	} else { 
		$('.mobile').css('display', 'none'); // atau gunakan $('.mobile').hide();
	}
});