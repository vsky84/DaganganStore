<div class="container-fluid">
	<div style="text-align: right"> <!-- Font Size (?) / Icon -->
		<!-- <a href="#"><i style="margin-right: 10px"></i><span>Konfirmasi Pembayaran</span></a>
		<a href="#"><i style="margin-right: 10px"></i><span>Login</span></a>
		<a href="#"><i style="margin-right: 10px"></i><span>Daftar</span></a> -->
	</div>
</div>
<!-- NAVBAR MENUTITLE -->
<div style="margin:0;font-family:Arial;">
	
	<div class="topnav" id="myTopnav">
	  	<h4><b>DaganganStore</b></h4>
	  	<a href="#">LOGIN</a>
	  	<a href="<?php echo base_url('index.php/Home/openAbout'); ?>">About</a>
	  	<a href="<?php echo base_url('index.php/Home/openShoppingCart'); ?>">Shopping Cart <!-- <span class="badge" style="background-color: red; margin-bottom: 5px;">1</span> --></a>

		<a href="<?php echo base_url(); ?>" class="">HOME</a>
	  	<a href="<?php echo base_url('index.php/Home/debugPanel'); ?>">DEBUG - [REMOVE THIS]</a>
		  
	  	
	  	<!-- Menu Icon kalau versi mobile -->
	  	<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
	</div>
	<script>
		function myFunction() {
	  		var x = document.getElementById("myTopnav");
	  		if (x.className === "topnav") {
	    		x.className += " responsive";
	  		} else {
	    		x.className = "topnav";
	  		}
		}
	</script>
</div>

<style type="text/css">
	/* STYLE UNTUK NAVBAR MENU TITLE */
	.topnav {
		overflow: hidden;
		background-color: #333;
	}
	.topnav h4{
		float: left;
		color: white;
		padding-top: 4px;
		padding-left: 10px;
	}
	.topnav a {
		float: right;
		display: block;
		color: #f2f2f2;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
		font-size: 17px;
	}

	.active {
		background-color: maroon;
		color: white;
	}

	.topnav .icon {
		display: none;
	}

	.topnav a:hover, .category:hover .dropbtn {
	  	background-color: #555;
	  	color: white;
	}

	@media screen and (max-width: 600px) {
	  	.topnav a:not(:first-child), .category .dropbtn {
	    	display: none;
	  	}
	  	.topnav a.icon {
	    	float: right;
	    	display: block;
	  	}
	}

	@media screen and (max-width: 600px) {
	  	.topnav.responsive {position: relative;}
	  	.topnav.responsive .icon {
	    	position: absolute;
	    	right: 0;
	    	top: 0;
	  	}
	  	.topnav.responsive a {
	    	float: none;
	    	display: block;
	    	text-align: right;
	  	}
	  	.topnav.responsive .category {float: none;}
	  	1
	  	.topnav.responsive .category-content {position: relative;}
	  	.topnav.responsive .category .dropbtn {
	    	display: block;
	    	width: 100%;
	    	text-align: left;
	  	}
	}
</style>
