<?php
/*
Plugin Name: Adblock Message
Plugin URI: https://github.com/McCouman/Adblock-Message-for-Wordpress
Description: Erzeugt per Shortcode oder Widgets, das kein Adblock installiert oder aktiviert wurde. Warum? - Damit es mehr sichere Browser im Netz gibt und Adblocker installiert werden :)
Author: Michael (M.C.) McCouman Jr.
Author URI: http://wikibyte.org
Version: 1.2.4
DomainPath: /languages
License: MIT
*/

/* =============================================================
 * Copyright (c) 2015 copyright by Michael McCouman Junior
 *
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.  IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 *
 * @date 27 Nov. 2015 by M.C. (Shortcode)
 * @edit 29 Nov. 2015 by M.C. (3 Widgets)
 * ============================================================= */


//Adblock JS 
function adblock_js( $outputJS, $intText, $get_css, $out ) {
	?>
	<style> <?php
//----------------------------------------------

if( $get_css != '' ){

	echo $get_css;

//----------------------------------------------
	
} else {

	$rand = rand();

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
		}

		<?php
	   }
	   ?> </style> <?php
	//----------------------------------------------
	
	//div outs
	if ( $outputJS == "standard" ) {

		?>
		<div class="<?php echo $rand; ?>"></div><?php
		
	} else {

		?>
		<div id="alternated"><?php echo $intText; ?></div><?php
		
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
		if (adblock) {
			var allElements = document.getElementsByTagName('div');
			for (var i = 0; i < allElements.length; i++) {
				if (allElements[i].className == '<?php echo $rand; ?>') {
					<?php echo $out; ?>

				}
			}
		}
		<?php

		//----------------------------------------------

			} else {

		?>
		if (adblock) {
			document.getElementById("alternated").innerHTML = '<?php echo $out; ?>';
		}
		<?php

			}

		//----------------------------------------------
		?>
		//-->
	</script><?php
}

/**
 * Shortcode zum einfügen in eine Wordpressseite
 *
 * @function adblock_js( $outputJS, $intText, $get_css, $out )
 * @info [admessage action="" css=""	header="" info="" button_text="" link="" image="" width="" height=""]
*/
add_shortcode( 'admessage', 'adblock_resistor' );
function adblock_resistor( $atts, $content ) {
	extract(
		shortcode_atts(
			array(
				'action' => '',
				'css'    => '',

				//--message

				'header'      => 'ACHTUNG: Wichtiger Hinweis!',
				'info'        => '<b>Du nutzt keinen Adblocker um Dich im Internet zu sch&uuml;tzen!</b> Einen Adblock zu installieren geht ganz einfach. Schaue daf&uuml;r ob es ein Plugin f&uuml;r deinen Browser gibt. Klicke auf den Button und wir helfen dir bei der Suche :)',
				'button_text' => 'Jetzt einen Adblocker installieren!',
				'link'        => 'http://lmgtfy.com/?q=adblock+download',

				//--image

				'image'  => '',
				'width'  => 'auto',
				'height' => 'auto',

			), $atts, 'admessage'
		)
	);

	if ( $action ) {
		$message = $action;
	}

	if ( $css ) {
		$set_css = $css;
	}

	if ( $image == "" ) {
		$image = plugins_url() . '/adblock-messanger/img/beispiel.png';
	}

	#-----------------------------

	//Nachrichten Abfragen
	if ( $message == 'message' ) {
		$adblockJs = 'standard';
		$get_css   = 'ok';
		$button    = '<a id="button" traget="_blank" href="' . $link . '">' . $button_text . '</a>';
		$info_out  = '<div id="info"><div id="left"><h4>' . $header . '</h4><p>' . $info .
		             '</p></div><div id="right">' .
		             $button . '</div><div style="clear:both;"></div></div>';
		$out       = "allElements[i].innerHTML = '" . $info_out . "';";
	} elseif ( $message == 'image' ) {
		$adblockJs = 'standard';
		//--
		$image_out = '<a href="' . $link . '"><img src="' . $image . '" width="' . $width . '" height="' . $height .
		             '" border="0"></a>';
		//--
		$out = "allElements[i].innerHTML = '" . $image_out . "';";
	} elseif ( $message == 'redirect' ) {
		$adblockJs = 'standard';
		//--
		$out = 'window.location.href = "' . $link . '";';
	} elseif ( $message == 'alternate' ) {
		$adblockJs = '';
		$get_css   = 'ok';
		//--
		$out = $info;
	} else {
		echo 'Error: <b>action=""</b> enth&auml;lt keine Angaben!';
	}

	#-----------------------------

	return adblock_js( $adblockJs, $set_internalText, $set_css, $out );

}

//--------------------------------------- WIDGETS -----------------------------------------------


/**
 * Message Widget (Eigene Box)
 */
class adblockmessage_widget
	extends
	WP_Widget {

	function __construct() {
		parent::__construct(
			'adblockmessage_widget',
			__( 'Adblocker Nachrichtenbox', 'adblockmessage_widget_domain' ),
			array(
				'description' => __( 'Zeigt eine Adblocker Nachrichtenbox in deiner Sidebar wenn ein Besucher keinen Adblocker aktiviert hat. ',
				                     'adblockmessage_widget_domain' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		$title      = apply_filters( 'widget_title', $instance[ 'title' ] );
		$header     = $instance[ 'header' ];
		$infos      = $instance[ 'infos' ];
		$buttontext = $instance[ 'buttontext' ];
		$buttonlink = $instance[ 'buttonlink' ];
		$css        = $instance[ 'css' ];

		echo $args[ 'before_widget' ];

		if ( ! empty( $title ) ) {
			#Test: echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
		}

		// Html output
		$button   = '<div id="button"><a id="button-link" traget="_blank" href="' . $buttonlink . '">' . $buttontext .
		            '</a></div>';
		$info_out = '<div id="adblocker-messages"><h4>' . $header . '</h4><p>' . $infos . '</p>' .
		            $button . '</div>';

		// Div out
		echo '<div class="' . $title . '"></div>';
		?>
		<script type="text/javascript">
			<!--
			var adblock = false;
			//-->
		</script>
		<script type="text/javascript" src="<?php echo plugins_url() . '/adblock-messanger/ad/adframe.js'; ?>"></script>
		<script type="text/javascript">
			if (adblock) {
				var allElements = document.getElementsByTagName('div');
				for (var i = 0; i < allElements.length; i++) {
					if (allElements[i].className == '<?php echo $title; ?>') {
						allElements[i].innerHTML = '<?php echo $info_out; ?>';
					}
				}
			}
		</script>
		<style>
			<?php echo $css; ?>
		</style><?php

		echo $args[ 'after_widget' ];
	}

	public function form( $instance ) {

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = md5( $header . $info . $buttontext );
		}

		if ( isset( $instance[ 'header' ] ) ) {
			$header = $instance[ 'header' ];
		} else {
			$header = __( 'Wichtiger Hinweis!', 'adblockmessage_widget_domain' );
		}

		if ( isset( $instance[ 'infos' ] ) ) {
			$infos = $instance[ 'infos' ];
		} else {
			$infos
				= "Du nutzt keinen Adblocker um Dich im Internet zu sch&uuml;tzen! Einen Adblock zu installieren geht ganz einfach. Schaue daf&uuml;r ob es ein Plugin f&uuml;r deinen Browser gibt. Klicke auf den Button und wir helfen dir bei der Suche :)";
		}

		if ( isset( $instance[ 'buttontext' ] ) ) {
			$buttontext = $instance[ 'buttontext' ];
		} else {
			$buttontext = __( 'Adblocker installieren!', 'adblockmessage_widget_domain' );
		}

		if ( isset( $instance[ 'buttonlink' ] ) ) {
			$buttonlink = $instance[ 'buttonlink' ];
		} else {
			$buttonlink = __( 'http://lmgtfy.com/?q=adblock+download', 'adblockmessage_widget_domain' );
		}

		if ( isset( $instance[ 'css' ] ) ) {
			$css = $instance[ 'css' ];
		} else {
			$css_out
				 = '#adblocker-messages {
	padding: 36px 30px 25px;
	width: 100%;
	background: #fee;
	border: 1px solid #D29F9F;
}
#button {
	padding: 13px;
	border: 1px solid #CA2A2A;
	background: #E23F3F;
	text-decoration: none;
	font-weight: bold;
	border-bottom: 4px solid #D03939;
	width: 100%;
	text-align: center;
}
#button-link {
	padding: 13px;
	color: #fff;
	width: 100%;
}
#button:hover {
	border: 1px solid #F14A4A;
	background: #FF3838;
	color: #fff;
	text-decoration: none;
	font-weight: bold;
	border-bottom: 4px solid #EF1F1F;
}';
			$css = __( $css_out, 'adblockmessage_widget_domain' );
		}

		?>
		<p>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>"
			       type="text"
			       value="<?php echo md5( $header . $info . $buttontext ); ?>"
			       style="width:100%; display:none;"/>
		</p>

		<!--header-->
		<p>
			<label for="<?php echo $this->get_field_id( 'header' ); ?>">
				<?php _e( 'Überschrift:' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'header' ); ?>"
			       name="<?php echo $this->get_field_name( 'header' ); ?>"
			       type="text"
			       value="<?php echo esc_attr( $header ); ?>"
			       style="width:100%;"/>
		</p>

		<!--info-->
		<p>
			<label for="<?php echo $this->get_field_id( 'infos' ); ?>">
				<?php _e( 'Info Nachricht:' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'infos' ); ?>"
			       name="<?php echo $this->get_field_name( 'infos' ); ?>"
			       type="text"
			       value="<?php echo esc_attr( $infos ); ?>"
			       style="width:100%;"/>
		</p>

		<!--buttontext-->
		<p>
			<label for="<?php echo $this->get_field_id( 'buttontext' ); ?>">
				<?php _e( 'Button Text:' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'buttontext' ); ?>"
			       name="<?php echo $this->get_field_name( 'buttontext' ); ?>"
			       type="text"
			       value="<?php echo esc_attr( $buttontext ); ?>"
			       style="width:100%;"/>
		</p>

		<!--buttonlink-->
		<p>
			<label for="<?php echo $this->get_field_id( 'buttonlink' ); ?>">
				<?php _e( 'Button Link:' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'buttonlink' ); ?>"
			       name="<?php echo $this->get_field_name( 'buttonlink' ); ?>"
			       type="text"
			       value="<?php echo esc_attr( $buttonlink ); ?>"
			       style="width:100%;"/>
		</p>

		<!--css-->
		<p>
			<label for="<?php echo $this->get_field_id( 'css' ); ?>">
				<?php _e( 'CSS:' ); ?>
			</label>
			<textarea id="<?php echo $this->get_field_id( 'css' ); ?>"
			          name="<?php echo $this->get_field_name( 'css' ); ?>"
			          style="width:100%; height: 140px;"><?php
				echo esc_attr( $css );
				?></textarea>
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance                 = array();
		$instance[ 'title' ]      = ( ! empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] )
			: '';
		$instance[ 'header' ]     = ( ! empty( $new_instance[ 'header' ] ) ) ? strip_tags( $new_instance[ 'header' ] )
			: '';
		$instance[ 'infos' ]      = ( ! empty( $new_instance[ 'infos' ] ) ) ? strip_tags( $new_instance[ 'infos' ] )
			: '';
		$instance[ 'buttontext' ] = ( ! empty( $new_instance[ 'buttontext' ] ) )
			? strip_tags( $new_instance[ 'buttontext' ] ) : '';
		$instance[ 'buttonlink' ] = ( ! empty( $new_instance[ 'buttonlink' ] ) )
			? strip_tags( $new_instance[ 'buttonlink' ] ) : '';
		$instance[ 'css' ]        = ( ! empty( $new_instance[ 'css' ] ) ) ? strip_tags( $new_instance[ 'css' ] ) : '';

		return $instance;
	}
}

function adblockmessage_load_widget() {
	register_widget( 'adblockmessage_widget' );
}

add_action( 'widgets_init', 'adblockmessage_load_widget' );


/**
 * Image Widget (Bilderinfo)
 */
class adblockimage_widget
	extends
	WP_Widget {

	function __construct() {
		parent::__construct(
			'adblockimage_widget',
			__( 'Adblocker Bildernachricht', 'adblockimage_widget_domain' ),
			array(
				'description' => __( 'Zeigt eine Adblocker Bildinformation in deiner Sidebar wenn ein Besucher keinen Adblocker installiert hat. ',
				                     'adblockimage_widget_domain' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );

		$image  = $instance[ 'image' ];
		$width  = $instance[ 'width' ];
		$height = $instance[ 'height' ];
		$link   = $instance[ 'link' ];


		echo $args[ 'before_widget' ];

		if ( ! empty( $title ) ) {
			#Test: echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
		}

		// Html output
		$image_out = '<a href="' . $link . '"><img src="' . $image . '" width="' . $width . '" height="' . $height .
		             '" border="0"></a>';
		// Div out
		echo '<div class="' . $title . '"></div>';
		?>
		<script type="text/javascript">
			<!--
			var adblock = false;
			//-->
		</script>
		<script type="text/javascript" src="<?php echo plugins_url() . '/adblock-messanger/ad/adframe.js'; ?>"></script>
		<script type="text/javascript">
			if (adblock) {
				var allElements = document.getElementsByTagName('div');
				for (var i = 0; i < allElements.length; i++) {
					if (allElements[i].className == '<?php echo $title; ?>') {
						allElements[i].innerHTML = '<?php echo $image_out; ?>';
					}
				}
			}
		</script>
		<?php

		echo $args[ 'after_widget' ];
	}

	public function form( $instance ) {

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = md5( $image . $width . $link );
		}

		if ( isset( $instance[ 'image' ] ) ) {
			$image = $instance[ 'image' ];
		} else {
			$image = plugins_url() . '/adblock-messanger/img/beispiel.png';
		}

		if ( isset( $instance[ 'width' ] ) ) {
			$width = $instance[ 'width' ];
		} else {
			$width = 'auto';
		}

		if ( isset( $instance[ 'height' ] ) ) {
			$height = $instance[ 'height' ];
		} else {
			$height = 'auto';
		}

		if ( isset( $instance[ 'link' ] ) ) {
			$link = $instance[ 'link' ];
		} else {
			$link = __( 'http://lmgtfy.com/?q=adblock+download', 'adblockmessage_widget_domain' );
		}


		?>
		<p>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>"
			       type="text"
			       value="<?php echo md5( $image . $width . $link ); ?>"
			       style="width:100%; display:none;"/>
		</p>

		<!--image-->
		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>">
				<?php _e( 'Bild URL:' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'image' ); ?>"
			       name="<?php echo $this->get_field_name( 'image' ); ?>"
			       type="text"
			       value="<?php echo esc_attr( $image ); ?>"
			       style="width:100%;"/>
		</p>


		<div style="float: left; width: 50%">
			<!--width-->
			<label for="<?php echo $this->get_field_id( 'width' ); ?>">
				<?php _e( 'Breite: (% / px)' ); ?>
			</label>
			<br>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>"
			       name="<?php echo $this->get_field_name( 'width' ); ?>"
			       type="text"
			       value="<?php echo esc_attr( $width ); ?>"
			       style="width:100%;"/>
		</div>
		<div style="float: right; width: 50%">
			<!--height-->
			<label for="<?php echo $this->get_field_id( 'height' ); ?>">
				<?php _e( 'Höhe: (px)' ); ?>
			</label>
			<br>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>"
			       name="<?php echo $this->get_field_name( 'height' ); ?>"
			       type="text"
			       value="<?php echo esc_attr( $height ); ?>"
			       style="width:100%;"/>
		</div>

		<!--link-->
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>">
				<?php _e( 'Link zur URL:' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'link' ); ?>"
			       name="<?php echo $this->get_field_name( 'link' ); ?>"
			       type="text"
			       value="<?php echo esc_attr( $link ); ?>"
			       style="width:100%;"/>
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance             = array();
		$instance[ 'title' ]  = ( ! empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
		$instance[ 'image' ]  = ( ! empty( $new_instance[ 'image' ] ) ) ? strip_tags( $new_instance[ 'image' ] ) : '';
		$instance[ 'width' ]  = ( ! empty( $new_instance[ 'width' ] ) ) ? strip_tags( $new_instance[ 'width' ] ) : '';
		$instance[ 'height' ] = ( ! empty( $new_instance[ 'height' ] ) ) ? strip_tags( $new_instance[ 'height' ] ) : '';
		$instance[ 'link' ]   = ( ! empty( $new_instance[ 'link' ] ) ) ? strip_tags( $new_instance[ 'link' ] ) : '';

		return $instance;
	}
}

function adblockimage_load_widget() {
	register_widget( 'adblockimage_widget' );
}

add_action( 'widgets_init', 'adblockimage_load_widget' );


/**
 * Redirect Widget (Weiterleitung)
 */
class adblockredirect_widget
	extends
	WP_Widget {

	function __construct() {
		parent::__construct(
			'adblockredirect_widget',
			__( 'Adblocker Weiterleitung', 'adblockredirect_widget_domain' ),
			array(
				'description' => __( 'Leitet automatisch auf eine festgelegte Seite weiter, wenn ein Besucher keinen Adblocker installiert hat. ',
				                     'adblockredirect_widget_domain' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
		$link  = $instance[ 'link' ];

		echo $args[ 'before_widget' ];

		if ( ! empty( $title ) ) {
			#Test: echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
		}

		// Div out
		echo '<div class="' . $title . '"></div>';
		?>
		<script type="text/javascript">
			<!--
			var adblock = false;
			//-->
		</script>
		<script type="text/javascript" src="<?php echo plugins_url() . '/adblock-messanger/ad/adframe.js'; ?>"></script>
		<script type="text/javascript">
			if (adblock) {
				var allElements = document.getElementsByTagName('div');
				for (var i = 0; i < allElements.length; i++) {
					if (allElements[i].className == '<?php echo $title; ?>') {
						window.location.href = "<?php echo $link; ?>";
					}
				}
			}
		</script>
		<?php

		echo $args[ 'after_widget' ];
	}

	public function form( $instance ) {

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = md5( site_url() . $link );
		}

		if ( isset( $instance[ 'link' ] ) ) {
			$link = $instance[ 'link' ];
		} else {
			$link = site_url() . '/mein-sitename';
		}


		?>
		<p>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>"
			       type="text"
			       value="<?php echo md5( network_site_url() . $link ); ?>"
			       style="width:100%; display:none;"/>
		</p>

		<!--link-->
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>">
				<?php _e( 'Link zur Infoseite:' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'link' ); ?>"
			       name="<?php echo $this->get_field_name( 'link' ); ?>"
			       type="text"
			       value="<?php echo esc_attr( $link ); ?>"
			       style="width:100%;"/>
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance            = array();
		$instance[ 'title' ] = ( ! empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
		$instance[ 'link' ]  = ( ! empty( $new_instance[ 'link' ] ) ) ? strip_tags( $new_instance[ 'link' ] ) : '';

		return $instance;
	}
}

function adblockredirect_load_widget() {
	register_widget( 'adblockredirect_widget' );
}
add_action( 'widgets_init', 'adblockredirect_load_widget' );


?>