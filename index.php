<!DOCTYPE html> <!-- debut du HTML -->
<html>
<head>	<!--	balise de preparation de la page	-->
	<meta charset="ISO-8859-1">
	<meta http-equiv="refresh" content="40"> <!-- refresh toutes les 40 secs -->
	<title>🐶 La Chienne Météo</title>
	<style type="text/css">
		/*
			dans cette c'est le CSS: tout ce qui est mise en forme.
		*/
		body	/*	la balyse principale affichée dans la page	*/
		{
			background-image : url("./data/Background1.jpg");
			background-repeat:no-repeat;
			background-size:cover;
			background-size:100% 100vh;
		}
		.centrage	/*	centre tout ce qui a cet argument dans sa balise	*/
		{
			position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
			text-align: center; display: table-cell; vertical-align: middle;
		}
		ul
		{
			padding:0;
			margin:0;
			list-style-type:none;
		}
		li
		{
			float:left;
			border-left:0px solid black;
			width:100px;
			font-style:bold;
		}

		/*background-color: rgba(248, 247, 216, 0.7);*/
	</style>
</head>

<body>
	<div class="centrage">
		<h2><img src = "data/Logo.png"/></h2>	<!-- affichage du logo -->
		<?php	// debut du php
			echo "<h1>";
			$ti=time();	// met a jour l'heure
			echo(date("d/M",$ti) . "<br>");	//affiche la date
			echo "</h1>";

			$temperature_matin	= "0";
			$temperature_midi	= "0";
			$temperature_soir	= "0";

			main($temperature_matin, $temperature_midi, $temperature_soir);
			// echo $temperature_matin . " | " . $temperature_midi . " | " . $temperature_soir;
			?>
				</br>
				<center>
				<ul>
					<li>Matin <br>
						<?php echo $temperature_matin ?> °C
					</li>
					<li>Midi <br>
						<?php echo $temperature_midi ?> °C
					</li>
					<li>Soir<br>
						<?php echo $temperature_soir ?> °C
					</li>
				</ul>
				</center>
				</br>
				</br>

			<?php
			//echo "<h1><br>Il fait " . $t . "° </h1>";
			aff_degueu($temperature_midi);

			// $ti=time();
			// 
			// echo(date("h:i:s",$ti));

			
		?>
	</div>
</body>
</html>

<?php

	function sharingan($parsed)
	{
		$deb_temperature = 'class="temperature">';
		$fin_temperature = '°C';
		$temp = parsing($parsed, $deb_temperature, $fin_temperature);
		return ($temp);

	}

	function main(&$temperature_matin, &$temperature_midi, &$temperature_soir){

		// svg-symbol-star
		// <div class="today_nowcard-temp"><span class="">23<sup>°</sup></span></div>
		$debut_matin 	= '"previsions_matin"';
		$fin_matin	 	= '</li>';

		$debut_midi 	= '"previsions_apres_midi"';
		$fin_midi	 	= '</li>';

		$debut_soir 	= '"previsions_soir"';
		$fin_soir	 	= '</li>';

		$page 	= ameneTonBoule('http://www.my-meteo.com/meteo-france/le-mans/');

		//$parsed = parsing($page, $debut, $fin);

		$temperature_matin	= sharingan(parsing($page, $debut_matin, $fin_matin));
		$temperature_midi	= sharingan(parsing($page, $debut_midi, $fin_midi));
		$temperature_soir	= sharingan(parsing($page, $debut_soir, $fin_soir));

	}

	function parsing($str, $deb, $fin){

		$row = explode($deb, $str); 
		$lel = $row[1];		//prend la partie apres $deb

		$pute = explode($fin, $lel);
		$lel = $pute[0];	//prend la partie avant $fin

		return($lel);
	}

    function ameneTonBoule($url){

		$ch = curl_init();
		$timeout = 5; // on met un petit timeout de 5 sec
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		curl_close($ch);
        
		return($file_contents);
	}

	function aff_degueu($t){

		$i = 0;
		$nb_images_beau		= 17;
		$nb_images_pas_beau	= 6;
		$nb_images_froid	= 5;

		echo "<p>";
		if ($t>=40)
		{
			echo "Le chien chaud 🔥🔥 La planete menasse de se transformer en étoile 🌞<br>";
			echo '<img src="data/beau/beau_'.$i.'.png" width="50%" height="50%">';
		}
		else if ($t>=28 && $t<40)
		{
			$i = rand(0, 16);
			echo 'Actuellement on creve de chaud 🌭<br>';
			echo '<img src="data/beau/beau_'.$i.'.png" width="50%" height="50%">';
		}
		else if ($t>=24 && $t<28)
		{
			$i = rand(0, 16);
			echo "il fait chaud 🐶 <br>";
			echo '<img src="data/beau/beau_'.$i.'.png" width="50%" height="50%">';
		}
		else if ($t>=19 && $t<24)
		{
			$i = rand(0, 6);
			echo 'Il fait bon 😊 <br>';
			echo '<img src="data/nimporte/nimporte_'.$i.'.png" width="50%" height="50%">';
		}
		else if ($t>=14 && $t<19)
		{
			$i = rand(0, 5);
			echo "Il fait frisquet 🧥 <br>";
			echo '<img src="data/pas_beau/pas_beau_'.$i.'.png" width="50%" height="50%">';
		}
		else if ($t>=5 && $t<14)
		{
			$i = rand(0, 5);
			echo "Il fait vraiment froid 🏔️ <br>";
			echo '<img src="data/pas_beau/pas_beau_'.$i.'.png" width="50%" height="50%">';
		}
		else if ($t>=-5 && $t<5)
		{
			$i = rand(0, 5);
			echo "Chien gelé ❄️❄️";
			echo '<img src="data/pas_beau/pas_beau_'.$i.'.png" width="50%" height="50%">';
		}
		else if ($t>=-20 && $t<-5)
		{
			$i = rand(0, 5);
			echo "Niveau de surgélation dehors 🥶 <br>";
			echo '<img src="data/pas_beau/pas_beau_'.$i.'.png" width="50%" height="50%">';
		}
		else if ($t<-20)
		{
			$i = rand(0, 5);
			echo "Bienvenue en syberie 🖼️ <br>";
			echo '<img src="data/pas_beau/pas_beau_'.$i.'.png" width="50%" height="50%">';
		}
		else
		{
			$i = rand(0, 5);
			echo "🤖 Ouvrez la fenêtre, is ok, tout va bien ;) (⚠️ Le serveur brule! L'information est incompréenssible! ⚠️ )";
			echo '<img src="data/pas_beau/pas_beau_'.$i.'.png" width="50%" height="50%">';
		}
		echo "</p>";
	}
?>
