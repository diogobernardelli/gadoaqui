<!--<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script> -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script type="text/javascript" src="js/jquery.maskMoney.min.js"></script>
<script type="text/javascript" src="js/jquery.numeric.js"></script> 

<script type="text/javascript">
	function login(email, senha) {
		$('.loading').show();
		$.post("ajax/login.php", { email:email, senha:senha }, function(data){
			$('.loading').hide();
			if (data.location) {
				location.href = data.location;
			} else {
				alert(data.erro);
			}
		},'json');
	}
	
	function incrementaClique(idpublicidade) {
		$.post("ajax/incrementaCliquePublicidade.php", { id:idpublicidade }, function(data){
			//FAZ NADA
		},'json');
	}
	
	function cadastraNewsletter(nome, email) {
		if (nome == 'nome')
			nome = '';
		if (email == 'e-mail')
			email = '';
			
		if (nome == '' || email == '') {
			alert ('Nome e e-mail são obrigatórios para cadastro na newsletter');
		} else {
			$('.loading').show();
			
			$.post("ajax/cadastraNewsletter.php", { nome:nome, email:email }, function(data){
				$('.loading').hide();
				if (data.msg) {
					if (data.nome) {
						$('#nomeNewsletter').val(data.nome).hide();
						$('#emailNewsletter').val(data.email).hide();
					} else {
						$('#nomeNewsletter').val('nome');
						$('#emailNewsletter').val('e-mail');
					}
					alert(data.msg);
				} else {
					alert(data.erro);
				}
			},'json');
		}
	}
</script>

<!-- CLEAR IT -->
<script type="text/javascript"> 
function clearIt(what)
{
if(what.value == what.defaultValue) what.value = '';
}
function setIt(what)
{
if(what.value == '') what.value = what.defaultValue;
}
</script>


<script src="js/nicescroll/jquery.nicescroll.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() { 
		//$(".inside").niceScroll();
	});
</script>



<!-- TOOLTIP -->
<script type="text/javascript" src="js/tooltip/jquery.tipTip.js"></script> 
<link rel="stylesheet" type="text/css" href="js/tooltip/tipTip.css"/>	
<script type="text/javascript"> 
$(function(){
	$(".classTitle").tipTip({maxWidth: "auto", edgeOffset: 10});
});
</script> 


<!-- PARALLAX -->
<script type="text/javascript">

$(document).ready(function(){
	// Cache the Window object
	$window = $(window);
			
	$('section[data-type="background"]').each(function(){
		var $bgobj = $(this); // assigning the object
					
		$(window).scroll(function() {
					
			// Scroll the background at var speed
			// the yPos is a negative value because we're scrolling it UP!								
			var yPos = -($window.scrollTop() / $bgobj.data('speed')); 
			
			// Put together our final background position
			var coords = '50% '+ yPos + 'px';
			
			// Move the background
			$bgobj.css({ backgroundPosition: coords });
		
		}); // window scroll Ends
		
	});	 // close each function
	
});

/*  Create HTML5 elements for IE's sake */

document.createElement("article");
document.createElement("section");

</script>


<!-- FACEBOOK -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=311673308982461&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<!-- SHADOWBOX 
<link rel="stylesheet" type="text/css" href="js/shadowbox/shadowbox.css">
<script type="text/javascript" src="js/shadowbox/shadowbox.js"></script>
<script type="text/javascript">
	Shadowbox.init();
</script>-->

<!-- LIGHTBOX -->
<script src="js/lightbox/lightbox.js"></script>
<link rel="stylesheet" href="js/lightbox/lightbox.css">