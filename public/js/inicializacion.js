$(document).ready(function () {
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

$('.txtNumeroDecimal').change(function(){
	$(this).val(parseFloat($(this).val()).toFixed(2));
});
$('.esDecimal').change(function(){
	var campo = $(this);
	var valor =campo.val();
	$(this).val(parseFloat(valor).toFixed(2));
});
$('.noEsDecimal').change(function(){
	var campo = $(this);
	var valor =campo.val();
	$(this).val(parseFloat(valor).toFixed(0));
});
$('.esMoneda').change(function(){
	var campo = $(this);
	var valor =campo.val();
	if(valor<0){
		$(this).val('0.00')
	}else{
		$(this).val(parseFloat(valor).toFixed(2));
	}
});
$('#agregarBarra').click(function(){
	//console.log('Se hizo clic en el boton agregar barra');
	if($('#txtBarras').val()!=''){
	$('#listBarras').show('normal');
	$('#listBarras').append('<li class="collection-item">'+$('#txtBarras').val()+'<a href="#!" class="secondary-content"><i class="material-icons red-text">close</i></a></li>')
	$('#txtBarras').val('');}
});

function esNumero(cadena) //true para si es número sólo
{
	if (cadena.match(/^[0-9]+$/))
	{
		return true;}
	else
	{
		return false;	}
}

$(".ocultar-mostrar-menu").click(function() {
	ocultar()
});
function ocultar(){//console.log('oc')
	$("#wrapper").toggleClass("toggled");
	//$('.navbar-fixed-top').css('left','0');
	$('.navbar-fixed-top').toggleClass('encoger');
	$('#btnColapsador').addClass('collapsed');
	$('#btnColapsador').attr('aria-expanded','false');
	$('#navbar').removeClass('in');
}
$('.has-clear').mouseenter(function(){$(this).find('input').focus();})

$('.has-clear input[type="text"]').on('input propertychange', function() {
	var $this = $(this);
	var visible = Boolean($this.val());
	$this.siblings('.form-control-clear').toggleClass('hidden', !visible);
}).trigger('propertychange');

$('.form-control-clear').click(function() {
	$(this).siblings('input[type="text"]').val('')
		.trigger('propertychange').focus();
});
/*function returnNumDecimal(numSinFormato){
return parseFloat(numSinFormato).tof()
}*/
$("input").focus(function(){this.select();}); //para seleccionar todo en un input

/*Para que la página cargue en el tab que se requiere*/
// Javascript to enable link to tab
var url = document.location.toString();
if (url.match('#')) {
    $('.nav-tabs a[href="#' + url.split('#')[1]).tab('show').click();
    console.log(url.split('#')[1]);
} //add a suffix
$('.nav-tabs a').on('shown.bs.tab', function (e) {
window.location.hash = e.target.hash;
});
$('.soloLetras').keypress(function (e) {//|| 
	if(!(e.which >= 97 /* a */ && e.which <= 122 /* z */) && !(e.which >= 48 /* 0 */ && e.which <= 90 /* 9 */)  ) {
        e.preventDefault();
    }
});