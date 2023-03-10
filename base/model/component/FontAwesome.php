<?php namespace MiMFa\Component;
class FontAwesome extends Component{
	public $DefaultRoot = "body";

	public function EchoStyle($root=null){
		$root = $root??$this->DefaultRoot;
		?>
		<style>
			<?php echo $root; ?> .fa {
			padding: 20px;
			min-width: 60px;
			text-align: center;
			text-decoration: none;
			margin: 5px 2px;
			opacity: 0.9;
			<?php echo  \MiMFa\Library\Style::UniversalProperty("transition",\_::$TEMPLATE->Transition(1)); ?>;
			}

			<?php echo $root; ?> .fa:hover {
			opacity: 0.95;
			color: <?php echo \_::$TEMPLATE->ForeColor(1); ?>;
			background-color: <?php echo \_::$TEMPLATE->BackColor(1); ?>;
			<?php echo  \MiMFa\Library\Style::UniversalProperty("transition",\_::$TEMPLATE->Transition(1)); ?>;
			}
		</style>
		<?php
	}
	
	public function EchoTechnologyStyle($root=null){
		$root = $root??$this->DefaultRoot;
		?>
		<style>
			<?php echo $root; ?> .fa:hover {
				opacity: 1;
				color: #fafafa;
				<?php echo  \MiMFa\Library\Style::UniversalProperty("transition",\_::$TEMPLATE->Transition(1)); ?>;
			}

			<?php echo $root; ?> .fa-facebook:hover {
			background-color: #3B5998;
			}

			<?php echo $root; ?> .fa-twitter:hover {
			background-color: #55ACEE;
			}

			<?php echo $root; ?> .fa-google:hover {
			background-color: #dd4b39;
			}

			<?php echo $root; ?> .fa-linkedin:hover {
			background-color: #007bb5;
			}

			<?php echo $root; ?> .fa-youtube:hover {
			background-color: #bb0000;
			}

			<?php echo $root; ?> .fa-instagram:hover {
			background-color: #125688;
			}

			<?php echo $root; ?> .fa-pinterest:hover {
			background-color: #cb2027;
			}

			<?php echo $root; ?> .fa-snapchat-ghost:hover {
			background-color: #fffc00;
			}

			<?php echo $root; ?> .fa-skype:hover {
			background-color: #00aff0;
			}

			<?php echo $root; ?> .fa-whatsapp:hover {
			background-color: #2cd61c;
			}

			<?php echo $root; ?> .fa-android:hover {
			background-color: #a4c639;
			}

			<?php echo $root; ?> .fa-dribbble:hover {
			background-color: #ea4c89;
			}

			<?php echo $root; ?> .fa-vimeo:hover {
			background-color: #45bbff;
			}

			<?php echo $root; ?> .fa-tumblr:hover {
			background-color: #2c4762;
			}

			<?php echo $root; ?> .fa-comments:hover {
			background-color: #00b489;
			}

			<?php echo $root; ?> .fa-telegram:hover {
			background-color: #45bbff;
			}

			<?php echo $root; ?> .fa-stumbleupon:hover {
			background-color: #eb4924;
			}

			<?php echo $root; ?> .fa-flickr:hover {
			background-color: #f40083;
			}

			<?php echo $root; ?> .fa-envelope:hover {
			background-color: #430297;
			}

			<?php echo $root; ?> .fa-soundcloud:hover {
			background-color: #ff5500;
			}

			<?php echo $root; ?> .fa-reddit:hover {
			background-color: #ff5700;
			}

			<?php echo $root; ?> .fa-github:hover {
			background-color: #8957e5;
			}

			<?php echo $root; ?> .fa-rss:hover {
			background-color: #ff6600;
			}
			<?php echo $root; ?> .fa-fax:hover {
			background-color: #ed2476;
			}
			<?php echo $root; ?> .fa-phone:hover {
			background-color: #38E54D;
			}
			<?php echo $root; ?> .fa-map-marker:hover {
			background-color: #bd081c;
			}
		</style>
		<?php
	}
}
?>