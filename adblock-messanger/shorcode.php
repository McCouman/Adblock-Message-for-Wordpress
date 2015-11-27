<?php
/*
Plugin Name: Adblock Message
Plugin URI: http://wikibyte.org
Description: Erstellt einen Shortcode mit Nachricht, das kein Adblock aktiviert wurde. Damit es mehr sichere Browser im Netz gibt und Adblocker installiert werden. 
Author: Michael (M.C.) McCouman Jr.
Author URI: 
Version: 1.0.1
DomainPath: /languages
License: Mache was willst Du!
*/

/*  @date 27 Nov. 2015 by M.C. */
/* ============================================================= */


//Adblock JS 
function adblock_js( $outputJS, $intText, $get_css, $out ) { 
?> <style> <?php
//----------------------------------------------

if( $get_css != '' ){

	echo $get_css;

//----------------------------------------------
	
} else { 

?>
	#info { 
		padding: 36px 30px 25px;
    	width: 100%;
    	background: #fee;
    	border: 1px solid #D29F9F;
	}
	#button {
		padding: 13px;
    	border: 1px solid #CA2A2A;
    	background: #E23F3F;
    	color: #fff;
    	text-decoration: none;
    	font-weight: bold;
    	border-bottom: 4px solid #D03939;
	}
	#button:hover {
    	padding: 13px;
    	border: 1px solid #F14A4A;
    	background: #FF3838;
    	color: #fff;
    	text-decoration: none;
    	font-weight: bold;
    	border-bottom: 4px solid #EF1F1F;
	}
	#left {
		float: left;
    	width: 73%;
	}
	#right {
		float: right;
		margin-top: 38px;
	} <?php 
}  
?> </style> <?php 
//----------------------------------------------
	
	//div outs
	if ( $outputJS == "standard" ) {
	
		?><div class="9123746571234"></div><?php
		
	} else {
	
		?><div id="alternated"><?php echo $intText; ?></div><?php
		
	}
	
//----------------------------------------------
?>

<script type="text/javascript">
<!--
	var adblock = false;
//-->
</script>

<script type="text/javascript" src="<?php echo plugins_url() . '/adblock-messanger/ad/adframe.js'; ?>"></script>

<script type="text/javascript">
<!-- 
<?php 
//----------------------------------------------

	if ($outputJS == "standard") {
	
?>
if(adblock) {
	var allElements = document.getElementsByTagName('div');
	for (var i = 0; i < allElements.length; i++) {
		if (allElements[i].className == '9123746571234') {
			<?php echo $out; ?>
			
		}
	}
}<?php

//----------------------------------------------

	} else {
	
?>
if(adblock) {
	document.getElementById("alternated").innerHTML = '<?php echo $out; ?>';		
}
<?php
	
	}
	
//----------------------------------------------
?> 
//-->
</script><?php
}

/*
[admessage
action="" //message,image,redirect,alternate
css=""	  //#info, #button

header="" 
info=""
button_text=""
link=""

image=""
width=""
height=""

text=""
]
*/
add_shortcode( 'admessage', 'adblock_resistor' );
function adblock_resistor( $atts, $content ) {
    extract(
        shortcode_atts(
            array(
                'action' => '', //message, image, redirect, alternate
                'css' => '', 	//#info{padding: 36px 30px 25px;background:#ffe;}#button{border:1px solid #aa0;background:#ff6;color:#000;}
                
                //--message
                
                'header' => 'ACHTUNG: Wichtiger Hinweis!',
                'info' => '<b>Du nutzt keinen Adblocker um Dich im Internet zu sch&uuml;tzen!</b> Einen Adblock zu installieren geht ganz einfach. Schaue daf&uuml;r ob es ein Plugin f&uuml;r deinen Browser gibt. Klicke auf den Button und wir helfen dir bei der Suche :)',
                'button_text' => 'Jetzt einen Adblocker installieren!',
                'link'	=> 'http://lmgtfy.com/?q=adblock+download',
                
                //--image
                
                'image' => '',
                'width' => 'auto',
				'height' => 'auto',
				
				//--intText
				
				#'text' => '', //wird angezeigt wenn der Adblocker aktiv ist
				
            ), $atts, 'admessage'
        )
    );
    
    if( $action )
    {
    	$message = $action; 
    }
    
    if( $css )
    {
        $set_css = $css;
    }
    
    if( $image == "")
    {
        $image = plugins_url() . '/adblock-messanger/img/beispiel.png';
    }
    
    
    #if( $text )
    #{
    #	$set_internalText = $text;
    #}
    
#-----------------------------

//Nachrichten Abfragen
if($message == 'message')
{
	$adblockJs = 'standard'; 
	$get_css = 'ok';
	//--
	$button = '<a id="button" traget="_blank" href="'.$link.'">'.$button_text.'</a>';
	$info_out = '<div id="info"><div id="left"><h4>'.$header.'</h4><p>'.$info.'</p></div><div id="right">'.$button.'</div><div style="clear:both;"></div></div>';
	//--
	$out = "allElements[i].innerHTML = '".$info_out."';";
}
elseif ($message == 'image')
{
	$adblockJs = 'standard'; 
	//--
	$image_out = '<a href="'.$link.'"><img src="'.$image.'" width="'.$width.'" height="'.$height.'" border="0"></a>';
	//--
	$out = "allElements[i].innerHTML = '".$image_out."';";
}
elseif ($message == 'redirect')
{
	$adblockJs = 'standard'; 
	//--
	$out = 'window.location.href = "'.$link.'";';
}
elseif ($message == 'alternate')
{
	$adblockJs = ''; 
	$get_css = 'ok';
	//--
	$out = $info;
}
else {
	echo 'Error: <b>action=""</b> enth&auml;lt keine Angaben!';
}

#-----------------------------
    
    return adblock_js( $adblockJs, $set_internalText, $set_css, $out );

}
?>