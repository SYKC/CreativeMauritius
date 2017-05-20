<!DOCTYPE html>
<html lang="en">
<head>
 <title>Hey there!</title>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!--scripts-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/jquery.typeit/4.3.0/typeit.min.js"></script>

 <!--fonts-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
 <link href="https://fonts.googleapis.com/css?family=Roboto:400,900|Satisfy" rel="stylesheet"> 
 <link rel="icon" type="image/png" href="https://res.cloudinary.com/xdisrupt/image/upload/v1482166353/creativemauritius.com/favicon.ico">

</head>
<body>
	<div class="container home">
	   <h1 class="headline animated fadeInUp">Creative Mauritius</h1>
     <span class="tagline animated fadeIn">Creativity <span class="dot">.</span> Data <span class="dot">.</span> Outcomes</span>
     <p id="message"></p>
	</div>
	
	<div class="container-links">
	<button class="btn-login"><i class="fa fa-clock-o" aria-hidden="true"></i>
 Coming soon</button>
	</div>

	<div id="social">
	<p id="social-links">Contribute or connect with us!</p>
		<a href="https://github.com/VEEGISHx/creativemauritius/"><i class="fa fa-github-alt" aria-hidden="true"></i></a>
	</div>

	<footer class="links">
	<span class="fb-logo">Powered by</span>
	<img src="https://res.cloudinary.com/xdisrupt/image/upload/c_scale,w_120/v1495288227/creativemauritius.com/image00.png">
	</footer>

<!--  <script type="text/javascript">
		$('#message').typeIt({
			speed: 50,
			autoStart: false
		})
		.tiType('<strong>OMG</strong> a visitor! a visitor! wooooooooo! ')
		.tiPause(1000).tiBreak()
		.tiType('Wll')
		.tiPause(500)
		.tiDelete(2)
		.tiType('ell, ')
		.tiPause(1000)
		.tiType('hello there stranger :D')
		.tiBreak() .tiPause(700)
		.tiType('it\'s been quite lonely out here lately. ')
		.tiPause(1000)
		.tiType('Your visit delights me!')
		.tiPause(750)
		.tiSettings({speed: 50})
		.tiDelete()
		.tiType('I don\'t get a lot of visitors since my creators are still building me :( ')
		.tiBreak().tiPause(500)
		.tiType('But it\'s not that bad. ')
		.tiPause(500)
		.tiType('I know my creators are taking their time to puurrfec')
		.tiPause(500)
		.tiDelete(7)
		.tiType('ur')
		.tiPause(300)
		.tiDelete(2)
		.tiType('erfectionate me.')
		.tiPause(2000).tiDelete()
		.tiType('...')
		.tiPause(500)
		.tiDelete(3)
		.tiPause(1000)
		.tiType('...Oh! ')
		.tiPause(1000)
		.tiType('Please pardon my impoliteness, I forgot to introduce myself.')
		.tiBreak()
		.tiType('I am the homepage(still in my early stages) of <span class="white">creativemauritius.com</span>')
		.tiPause(1000)
		.tiDelete()
		.tiType('So..')
		.tiPause(1000)
		.tiType('what exactly is <span class="white">creativemauritius.com</span>?')
		.tiPause(1000)
		.tiBreak()
		.tiType('Creative Mauritius is an interactive experience that aims at presenting data in creative ways. We want to raise awareness about different topics in this modern digital world. ')
		.tiPause(1000)
		.tiBreak()
		.tiType('Imagine a world where we, ')
		.tiPause(1000)
		.tiDelete(26)
		.tiPause(500)
		.tiType('Wait, no. ')
		.tiPause(300)
		.tiType('I can\'t tell you more at the moment, sorry!')
		.tiPause(500)
		.tiBreak()
		.tiBreak()
		.tiType('Stay tuned to find out more :)')

	</script>

	<script type="text/javascript">
		setInterval(function() {
			document.getElementById('down').style.display = "block";
			$('#travolta').typeIt({
			speed: 50,
			autoStart: false
		})
			.tiType('So, what is all this about?')
		}, 26000);

		setInterval(function() {
			var elem = document.getElementById('down')
			elem.parentNode.removeChild(elem)
		}, 30000);

		setInterval(function() {
			document.getElementById('social').style.display = "block";
		}, 66000);
	</script>
-->

	<style type="text/css">
	    body {
			padding:0px;
			margin: 0px;
	    	color: #F6F6F6;
	    	background-color: #FFE164;
			background: url("https://res.cloudinary.com/xdisrupt/image/upload/c_scale,h_1080,q_auto:good,w_1920/v1495276613/creativemauritius.com/joao-silas-65013.jpg");
	    }

      .home {
        width: 100%;
        max-width: 1000px;
        text-align: center;
      }

	  .container-links {
		  text-align: center;
		  margin: 0px auto;
	  }

	  button.btn-login {
		  padding: 10px;
		  text-align: center;
		  border: 2px solid #00D054;
		  border-radius: 50px;
		  font-size: 20px;
		  background: none;
		  color: #F6F6F6;
		  min-width: 210px;
		  -webkit-transition: all 500ms ease-in-out;
		  -moz-transition: all 500ms ease-in-out;
		  -ms-transition: all 500ms ease-in-out;
		  -o-transition: all 500ms ease-in-out;
		  transition: all 500ms ease-in-out;
	  }

	  button.btn-login:hover {
		  background-color: #00D054;
		  -webkit-transition: all 500ms ease-in-out;
		  -moz-transition: all 500ms ease-in-out;
		  -ms-transition: all 500ms ease-in-out;
		  -o-transition: all 500ms ease-in-out;
		  transition: all 500ms ease-in-out;
		  -webkit-box-shadow: -1px 9px 33px -6px rgba(0,0,0,0.75);
		  -moz-box-shadow: -1px 9px 33px -6px rgba(0,0,0,0.75);
		  box-shadow: -1px 9px 33px -6px rgba(0,0,0,0.75);
	  }

      .headline {
        font-size: 8.5vh;
        font-family: 'Satisfy', cursive;
      }

      span.dot {
        color: #F6471E;
      }

      .tagline {
        position: relative;
		font-weight: 900;
        font-family: 'Roboto', sans-serif;
      }

		.container {
			width: 80%;
			padding: 60px;
			margin: 0px auto;
		}

		p#message {
			color: #1E3746;
			font-family: 'Space Mono', monospace;
		}

		p#social-links {
			font-family: 'Montserrat', sans-serif;
		}

		#down {
			display: none;
			width: 100%;
			position: absolute;
			bottom: 0;
		}

		p::selection, #message::selection, .ti-container::selection {
			color: #fff;
			background: #3232AA;
		}

		p#travolta {
			color: #fff;
			font-size: 30px;
			font-family: 'Space Mono', monospace;
			position: absolute;
			top: 60px;
			background-color: #000;
			left: 500px;
		}

		span.white {
			color: #fff;
			background-color: #1E3746;
			padding: 4px;
		}

		#social {
			width: 80%;
			display: none;
			padding: 0px;
			margin: 0px auto;
			text-align: center;
		}

		i[class^="icon-"]:before {
			display: inline-block;
			text-decoration: none;
		}

		.fa-github-alt, .fa-twitter {
			padding: 25px;
			font-size: 40px;
			-webkit-transition: 500ms;
			-moz-transition: 500ms;
			transition: 500ms;
		}

		.fa-github-alt:hover, .fa-twitter:hover {
			cursor: pointer;
			color: #1E3746;
			-webkit-transition: 500ms;
			-moz-transition: 500ms;
			transition: 500ms;
		}

		a#link, a#link:visited, a#link:focus {
			color: #1E3746;
			cursor: pointer;
			border-bottom: 1px solid #1E3746;
			text-decoration: none;
		}

		a, a:visited, a:focused {
			color: #1E3746;
			text-decoration: none;
		}

		/* ----------- iPhone 4 and 4S ----------- */

/* Portrait and Landscape */
@media only screen
  and (min-device-width: 320px)
  and (max-device-width: 480px)
  and (-webkit-min-device-pixel-ratio: 2) {
  		.container {
  			width: 100%;
			padding: 6px;
			margin: 0px auto;
		}
}

/* Portrait */
@media only screen
  and (min-device-width: 320px)
  and (max-device-width: 480px)
  and (-webkit-min-device-pixel-ratio: 2)
  and (orientation: portrait) {
  	  		.container {
  			width: 100%;
			padding: 6px;
			margin: 0px auto;
		}
}

/* Landscape */
@media only screen
  and (min-device-width: 320px)
  and (max-device-width: 480px)
  and (-webkit-min-device-pixel-ratio: 2)
  and (orientation: landscape) {
  	  		.container {
  			width: 100%;
			padding: 6px;
			margin: 0px auto;
		}

}

@media only screen and (max-width: 500px) {
	  	  	.container {
  			width: 100%;
			padding: 6px;
			margin: 0px auto;
		}
}

footer.links {
	height: 80px;
	padding: 10px;
	position: absolute;
	bottom: 0;
	font-family: 'Roboto', sans-serif;
	line-height: 3;
}

span.fb-logo {
    font-size: 10px;
    display: block;
    padding: 0 0 0 20px;
    margin-bottom: -20px;
}
	</style>
</body>
