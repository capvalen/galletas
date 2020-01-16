<!-- Sidebar  -->
<nav id="sidebar">
	<div id="dismiss" class="d-flex justify-content-center align-items-center">
		<i class="icofont-simple-left-down"></i>
	</div>

	<div class="sidebar-header">
		<img class="img-fluid" src="{{url('images/empresa.png?v=1.1')}}">
	</div>

	<ul class="list-unstyled components">
		<p class="text-center"><small>Versión 1.0</small></p>
		<li>
			<a href="{{route('panel')}}" class="d-flex align-items-center"><i class="icofont-home"></i> <span class="liText">Principal</span> </a>
    </li>
    <li>
      <a href="{{route('galeria.mostrar')}}"><i class="icofont-users-alt-1"></i> Galería</a>
    </li>
    <li>
      <a href="{{route('clientes')}}"><i class="icofont-users-alt-1"></i> Clientes</a>
    </li>
    <li>
      <a href="{{route('compras')}}"><i class="icofont-cart-alt"></i> Compras</a>
    </li>
    <li>
      <a href="{{route('caja')}}"><i class="icofont-money-bag"></i> Caja</a>
    </li>
    <li>
      <a href="alumnos.php"><i class="icofont-handshake-deal"></i> Ventas</a>
    </li>
    <li>
      <a href="ciclos.php"><i class="icofont-cubes"></i> Inventario</a>
    </li>
    <li>
      <a href="mesacademico.php"><i class="icofont-card"></i> Créditos</a>
    </li>
    <li>
      <a href="mesacademico.php"><i class="icofont-pie"></i> Productos</a>
    </li>
    <li>
      <a href="mesacademico.php"><i class="icofont-map-pins"></i> Rutas</a>
    </li>
    <li>
      <a href="mesacademico.php"><i class="icofont-barricade"></i> Mantenimientos</a>
    </li>
		<li>
			<a href="configuraciones.php" class="d-flex align-items-center"><i class="icofont-ui-settings"></i>
				Configuraciones</span></a>
		</li>
		
	</ul>
</nav>
<!-- Fin Sidebar  -->

<!--Barra de Menú-->
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #3E4095">
	<div class="container-fluid">
		<button type="button" id="sidebarCollapse" class="btn btn-outline-light tieneMostrar mr-3 px-2">
			<i class="icofont-navigation-menu"></i>
		</button>

		<a class="navbar-brand" href="#!" id="btnBrand">
			<!--<img src="images/logoceid2.png?v=1.1" width="auto" height="45" class="d-inline-block align-top" alt="">  -->
			<span>Fábrica Marie</span>
		</a>
		<button class="btn btn-outline-light d-inline-block d-lg-none ml-auto px-2" id="btnSubNavegacion" type="button"
			data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
			aria-expanded="false" aria-label="Toggle navigation">
			<i class="icofont-caret-down"></i>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="nav navbar-nav ml-auto">
				<li class="nav-item d-none">
					<a class="nav-link" href="#"> Mi perfil</a>
				</li>

				<li class="nav-item dropdown ">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false">
						<ion-icon name="settings"></ion-icon> {{Auth::user()->name}}
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown07">
						<a class="dropdown-item" href="perfil.php"><i class="icofont-id"></i> Mi perfil</a>
						<a class="dropdown-item" href="{{ route('logout') }}"><i class="icofont-exit"></i> Cerrar sesión</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
<!--Fin de barra de menú-->