	$(document).ready(function () {
		$.ajaxSetup({
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$("#sidebar").mCustomScrollbar({
			theme: "minimal-dark",
			mouseWheelPixels: 200
		});

		$('#dismiss, .overlay').on('click', function () {
			ocultarPanel()
		});
					$('.sidebar-header').click(function(){
						ocultarPanel();
					});
					$('#btnBrand').click(function(){
						mostrarPanel();
					});
				
				function ocultarPanel(){
					$('#sidebar').removeClass('active');
		$('.overlay').removeClass('active');
					$('#sidebarCollapse').toggleClass('tieneMostrar');
				}
				function mostrarPanel(){
					$('#sidebar').addClass('active');
		$('.overlay').addClass('active');
		$('.collapse.in').toggleClass('in');
		$('a[aria-expanded=true]').attr('aria-expanded', 'false');
					$('#sidebarCollapse').toggleClass('tieneMostrar');
				}

		$('#sidebarCollapse').on('click', function () {
			if($(this).hasClass('tieneMostrar')){
								mostrarPanel();
							}else{
								ocultarPanel();
							}
						
		});
	});

	function mostrarError( titulo, mensaje ){
		$('#toastAdverTitle').text(titulo); $('#toastError').text(mensaje); $('#tostadaError').toast('show');
	}
	function mostrarInfo( titulo, mensaje ){
		$('#toastInfoTitle').text(`¡${titulo}!`); $('#toastInfo').text(mensaje); $('#tostadaInfo').toast('show');
	} 

	function pantallaOver(tipo) {
		if(tipo){$('#overlay').css('display', 'initial');}
		else{ $('#overlay').css('display', 'none'); }
	}

	$('.esDecimal').change(function(){
		var campo = $(this);
		var valor =campo.val();
		$(this).val(parseFloat(valor).toFixed(2));
	});
	$('.esMoneda').change(function(){
		var campo = $(this);
		var valor =parseFloat(campo.val());
		if(valor<0){
			$(this).val('0.00')
		}else{
			$(this).val(parseFloat(valor).toFixed(2));
		}
	});

function urlBase(url){
	//return '{{url()}}/'+ url;
	var bUrl = window.location.href;
	var arr = bUrl.split("/");
	var result = arr[0] + "//" + arr[2];
	return result+"/"+url; 
}

$('form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});