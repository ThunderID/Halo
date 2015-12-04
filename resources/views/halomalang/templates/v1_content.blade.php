@section('nav')
<nav class="navbar navbar-default" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class='network'>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<a href="" class='mr-m'>Daftarkan Usaha Saya</a>
					<a href="" class='mr-m'>Beriklan</a>
					<a href="" class='mr-m'>Kerja Sama</a>
					<a href="" class='pull-right'>Login</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="hidden-xs ">
				<a class="navbar-brand" href="/">HALOMALANG</a>
			</div>
			<div class="visible-xs text-center pt-m pb-m">
				<a href="/">HALOMALANG</a>
			</div>
		</div>
	</div>
	
	<div class='nav-divider'></div>

	<div class='container'>
		<div class="row">
			{{-- MOBILE --}}
			<div class="visible-xs nav-menu text-center">
				<a href="" class='nav-menu-item'>Home</a>
				<a href="" class='nav-menu-item'>Kuliner</a>
				<a href="" class='nav-menu-item'>Wisata</a>
				<a href="" class='nav-menu-item'>Event</a>
				<a href="" class='nav-menu-item'>Hotel</a>
				<a href="" class='nav-menu-item'>Shopping</a>
			</div>
			{{-- DESKTOP --}}
			<div class="hidden-xs nav-menu">
				<span class="input-group col-xs-3 pull-right">
					<input type="text" class="form-control" id="exampleInputAmount" placeholder="Search">
					<span class="input-group-btn">
						<button type="button" class="btn btn-primary"><i class='fa fa-search'></i></button>
					</span>
				</span>
				<a href="" class='nav-menu-item'>Home</a>
				<a href="" class='nav-menu-item'>Kuliner</a>
				<a href="" class='nav-menu-item'>Wisata</a>
				<a href="" class='nav-menu-item'>Event</a>
				<a href="" class='nav-menu-item'>Hotel</a>
				<a href="" class='nav-menu-item'>Shopping</a>
			</div>
		</div>
	</div>
</nav>
@stop

@section('footer')
<div class='footer'>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-4">

			</div>
			<div class="col-xs-12 col-lg-4">
				<b>TENTANG KAMI</b>
				<p>HaloMalang.com dibuat sebagai media komunikasi bagi komunitas di Malang sehingga dapat meningkatkan keakraban dan persaudaraan penduduk kota Malang.</p>
				<p>Salam Satu Jiwa!</p>
			</div>
			<div class="col-xs-12 col-lg-4">
				<b>BEKERJA SAMA</b>
				<ul>
					<li><a href="">Beriklan</a></li>
					<li><a href="">Media Partners</a></li>
					<li><a href="">Citizen Journalism</a></li>
					<li><a href="">Edukasi</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
@stop