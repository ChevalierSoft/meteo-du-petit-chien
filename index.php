<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<meta http-equiv="refresh" content="40">
	<title>🐶 La meteo du petit chien</title>
	<?php
		abstract class journee{
			const minuit 	= 0;
		    const aube 		= 5;
		    const matin 	= 8;
		    const midi 		= 12;
		    const crepuscule= 19;
		    const nuit 		= 22;
		}

		$h = date("H",time());
		$c1 = "#81F7F3";
		$c2 = "#FE2EF7";
		//$h = rand(0, 23);
		//$h = 11;
		$r1=0; $v1=0; $b1=0; /*noir*/ $r2=11; $v2=11; $b2=97; /*bleu marine #pasD'amalgame*/
		//$h = rand(0, 23);
		if 		($h>=journee::minuit && $h<journee::aube):
			$r1=0; $v1=0; $b1=0; /*noir*/ $r2=11; $v2=11; $b2=97; /*bleu marine #pasD'amalgame*/
		elseif  ($h>=journee::aube && $h<journee::matin):
			$r1=11; $v1=11; $b1=97;/*bleu marine*/ $r2=223; $v2=1; $b2=58; /*rouge*/
		elseif  ($h>=journee::matin && $h<journee::midi):
			$r1=129; $v1=255; $b1=255;/*cyan*/ $r2=255; $v2=255; $b2=255; /*blanc*/
		elseif 	($h>=journee::midi && $h<journee::crepuscule):
			$r1=255; $v1=255; $b1=255; /*blanc*/ $r2=129; $v2=255; $b2=255;/*cyan*/
		elseif 	($h>=journee::crepuscule && $h<journee::nuit):
			$r1=223; $v1=1; $b1=58; /*rouge*/ $r2=11; $v2=11; $b2=97;/*bleu marine*/
		elseif 	($h>=journee::nuit):
			$r1=11; $v1=11; $b1=97; /*bleu*/$r2=0; $v2=0; $b2=0; /*noir*/
		else:
			?><script>console.log("probleme d'heure pour l'horizon")</script><?php
		endif;
	?>
	<style type="text/css">
		body 		{
			/*background-image: linear-gradient(to bottom, <?php echo $c1; ?>, <?php echo $c2; ?> ,url(data/nuages.png)); */
			/*background-image: linear-gradient(to bottom,  rgba(255, 0, 0, 0.8), 
      		rgba(0, 0, 255, 0.8), url(data/nuages.png)); */
      		background-image:
      		linear-gradient(rgba(<?php echo $r1; ?>, <?php echo $v1; ?>, <?php echo $b1; ?>,0.8), rgba(<?php echo $r2; ?>,<?php echo $v2; ?>,<?php echo $b2; ?>,0.8)), url(data/nuages.png);
      		font
      		/*background-image: url(data/nuages2.jpg);*/
			/*linear-gradient(rgba(255,0,0,.5), rgba(0,0,0,.5)),
    url('data/nuages.png');*/
			color: #F781F3; background-attachment: fixed; margin: 0; overflow:scroll;} 
		.centrage 	{position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; display: table-cell; vertical-align: middle; } 
		/*background-color: rgba(248, 247, 216, 0.7);*/
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

			$ti=time();
			echo(date("d/m",$ti) . "<br>");
			echo(date("h:i:s",$ti));		

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

		$i=0;
		//$dir = './data/beau/';
		//$t = 15;

		echo "<p>";
		if ($t>=40){
			echo "Le chien chaud 🔥🔥 La planete menasse de se transformer en étoile 🌞";
		}
		else if ($t>=28 && $t<40){
			$i = rand(0, 16);
			echo 'Actuellement on creve de chaud 🌭<br>';
			echo '<img src="data/beau/beau_'.$i.'.png" width="50%" height="50%">';
		}
		else if ($t>=24 && $t<28){
			$i = rand(0, 16);
			echo "il fait chaud 🐶 <br>";
			echo '<img src="data/beau/beau_'.$i.'.png" width="50%" height="50%">';
		}
		else if ($t>=19 && $t<24){
			$i = rand(0, 6);
			echo 'Il fait bon 😊 <br>';
			echo '<img src="data/nimporte/nimporte_'.$i.'.png" width="50%" height="50%">';
			}
		else if ($t>=14 && $t<19){
			$i = rand(0, 5);
			echo "Il fait frisquet 🧥 <br>";
			echo '<img src="data/pas_beau/pas_beau_'.$i.'.png" width="50%" height="50%">';
		}
		else if ($t>=5 && $t<14){
			echo "Il fait vraiment froid 🏔️ <br>";
		}
		else if ($t>=-5 && $t<5){
			echo "Chien gelé ❄️❄️";
		}
		else if ($t>=-20 && $t<-5){
			echo "Niveau de surgélation dehors 🥶 <br>";
		}
		else if ($t<-20){
			echo "Bienvenue en syberie 🖼️ <br>";
		}
		else{
			echo "🤖 Ouvrez la fenêtre, is ok, tout va bien ;) (⚠️ Le serveur brule! L'information est incompréenssible! ⚠️ )";
		}
		echo "</p>";

	}
?>