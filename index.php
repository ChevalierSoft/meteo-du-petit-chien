<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<meta http-equiv="refresh" content="40">
	<title>🐶 La meteo du petit chien</title>
	<style type="text/css"> 	
		body 		{background-image: linear-gradient(to bottom, #000000, #8888ee 100%); color: #F781F3; background-attachment: fixed; margin: 0;} 
		.centrage 	{text-align: center;}
	</style>
</head>

<body>
	<div class="centrage">
		<h2>🐶 Potit Chien</h2>

		<?php

			$tmp = main();
			$t = intval($tmp);

			echo "<h1><br>Il fait " . $t . "° </h1>";
			aff_degueu($t);

		?>
	</div>
</body>
</html>

<?php

	function main(){

		// svg-symbol-star
		// <div class="today_nowcard-temp"><span class="">23<sup>°</sup></span></div>
		$debut = 'class="today_nowcard-temp"><span class="">';
		$fin = '<sup>';
		$page 	= ameneTonBoule('https://weather.com/fr-FR/temps/aujour/l/47.99,0.20?par=google');

		$parsed = parsing($page, $debut, $fin);

		return($parsed);

	}

	function parsing($str, $deb, $fin){

		$row = explode($deb, $str); 
		$lel = $row[1];		//prend la partie apres $deb

		$pute = explode('<sup>', $lel);
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

		echo "<p>";
		if ($t>=40)
			echo "Le chien chaud 🔥🔥 La planete menasse de se transformerr en étoile 🌞";
		else if ($t>=28 && $t<40){
			echo 'Actuellement on creve de chaud 🌭<br>';
			?>
			<img src="data/chien_chaud.jpg" width="50%" height="50%">
			<?php
		}
		else if ($t>=24 && $t<28)
			echo "il fait chaud 🐶";
		else if ($t>=19 && $t<24)
			echo "Il fait bon 😊";
		else if ($t>=14 && $t<19)
			echo "Il fait frisquet 🧥";
		else if ($t>=5 && $t<14)
			echo "Il fait vraiment froid 🏔️";
		else if ($t>=-5 && $t<5)
			echo "Chien gelé ❄️❄️";
		else if ($t>=-20 && $t<-5)
			echo "Niveau de surgélation dehors 🥶";
		else if ($t<-20)
			echo "Bienvenue en syberie 🖼️";
		else
			echo "🤖 Ouvrez la fenêtre, is ok, tout va bien ;) (⚠️ Le serveur brule! L'information est incompréenssible! ⚠️ )";
		echo "</p>";

	}
?>