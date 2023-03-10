<?php
abstract class TemplateBase extends Base{
	public $ViewName = "main";
	public $HomeViewName = "splash";
	public $DefaultViewName = "main";
	public $RestrictionViewName = "restriction";

	public $AnimationSpeed = 250;
	public $DarkMode = null;

	public $BasePack = "
		<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js'></script>
		<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
		<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js'></script>
		<script src='https://kit.fontawesome.com/e557f8d9f4.js' crossorigin='anonymous'></script>
		<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css'>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js' crossorigin='anonymous'></script>
	";
	public $CustomPack = "";

	//0:	ForeColor
	//1:	Input ForeColor
	//2:	Button ForeColor
	//3:	BackColor
	//4:	Input BackColor
	//5:	Button BackColor
	public $ColorPalette = array("#dd2222","#22dd22","#2222dd","#dddd22","#22dddd","#dd22dd");
	public $ForeColorPalette = array("#010203","#010203","#010203","#010203","#fdfeff","#fdfeff");
	public $BackColorPalette = array("#fafcfd","#fdfeff","#fdfeff","#fafcfd","#3aa3e9","#3aa3e9");
	public $FontPalette = array("'dubai light', sans-serif","'dubai', sans-serif","'dubai', sans-serif","'Tahoma', sans-serif","'Tahoma', sans-serif","'Times new Romance', sans-serif");
	public $SizePalette = array("2vmin","3vmin","4vmin","5vmin","7vmin","8vmin","10vmin");
	public $ShadowPalette = array("none","4px 7px 20px #00000005","4px 7px 20px #00000015","4px 7px 20px #00000030","5px 10px 25px #00000030","5px 10px 25px #00000050","5px 10px 50px #00000050");
	public $BorderPalette = array("0px","1px solid","2px solid","5px solid","10px solid","25px solid");
	public $RadiusPalette = array("0px","3px","5px","25%","50%","100%");
	public $TransitionPalette = array("none","all .25s linear","all .5s linear","all .75s linear","all 1s linear","all 1.5s linear");
	public $OverlayPalette = array("/file/overlay/glass.png","/file/overlay/cloud.png","/file/overlay/tile.png");
	public $PatternPalette = array("/file/pattern/main.svg","/file/pattern/doddle.png","/file/pattern/doddle-color.png","/file/pattern/moon.png","/file/pattern/moon-color.png");

	public function Color(int $ind = 0) { $ind %= count($this->ColorPalette); return $this->ColorPalette[$ind];}
	public function ForeColor(int $ind = 0) { $ind %= count($this->ForeColorPalette); return $this->ForeColorPalette[$ind];}
	public function BackColor(int $ind = 0) { $ind %= count($this->BackColorPalette); return $this->BackColorPalette[$ind];}
	public function Font(int $ind = 0) { $ind %= count($this->FontPalette); return $this->FontPalette[$ind];}
	public function Size(int $ind = 0) { $ind %= count($this->SizePalette); return $this->SizePalette[$ind];}
	public function Shadow(int $ind = 0) { $ind %= count($this->ShadowPalette); return $this->ShadowPalette[$ind];}
	public function Border(int $ind = 0) { $ind %= count($this->BorderPalette); return $this->BorderPalette[$ind];}
	public function Radius(int $ind = 0) { $ind %= count($this->RadiusPalette); return $this->RadiusPalette[$ind];}
	public function Transition(int $ind = 0) { $ind %= count($this->TransitionPalette); return $this->TransitionPalette[$ind];}
	public function Overlay(int $ind = 0) { $ind %= count($this->OverlayPalette); return \MiMFa\Library\Local::GetUrl($this->OverlayPalette[$ind]);}
	public function Pattern(int $ind = 0) { $ind %= count($this->PatternPalette); return \MiMFa\Library\Local::GetUrl($this->PatternPalette[$ind]);}

	public function __construct(){
		if($this->IsDark($this->BackColor(0))===true) $this->DarkMode = true;
		else $this->DarkMode = false;
	}

	public function GetInitial():string|null{
		return "
		<script>
			const load = function(url){
				window.location.assign(url);
			}
			const open = function(url){
				window.open(url, '_blank');
			}
			const share = function(url, path=null){
				window.open('sms://'+path+'?body='+url, '_blank');
			}
			const message = function(url, path=null){
				window.open('sms://'+path+'?body='+url, '_blank');
			}
			const mailTo = function(url){
				window.open('mailto:'+url, '_blank');
			}
			const getData = function(
				request,
				requestData,
				successFunc = function(data,selector){},
				errorfunc = function(data,selector){},
				selector = '',
				beforeFunc=function(data,selector){ },
				processHandler=function(data){}) {
				var btns = selector+' input[type=button], '
					+selector+' input[type=submit], '
					+selector+' input[type=reset], '
					+selector+' button';

				$.ajax({
					type: 'GET',
					url: request,
					xhr: function () {
						var myXhr = $.ajaxSettings.xhr();
						if (myXhr.upload) myXhr.upload.addEventListener('progress', processHandler, false);
						return myXhr;
					},
					success: function (data) {
						successFunc(data,selector);
						$(btns).removeClass('hide');
						$(selector).css('opacity','1');
					},
					error: function (data) {
						errorfunc(data,selector);
						$(btns).removeClass('hide');
						$(selector).css('opacity','1');
					},
					beforeSend: function (data) {
						beforeFunc(data,selector);
						$(btns).addClass('hide');
						$(selector).css('opacity','.5');
					},
					async: true,
					data: requestData,
					cache: false,
					contentType: (typeof requestData === 'string')?'application/json; charset=utf-8':false,
					processData: false,
					timeout: 600000
				});
			}
			const postData = function(
				request,
				requestData,
				successFunc = function(data,selector){},
				errorfunc = function(data,selector){},
				selector = '',
				beforeFunc = function(data,selector){},
				processHandler=function(data){}) {
				var btns = selector+' input[type=button], '
					+selector+' input[type=submit], '
					+selector+' input[type=reset], '
					+selector+' button';

				beforeFunc(requestData,selector);
				return  $.post(request,requestData,function(data){successFunc(data,selector);}).fail(function(data){errorfunc(data,selector);});
					"
					/*$.ajax({
						type: 'POST',
						url: request,
						xhr: function () {
							var myXhr = $.ajaxSettings.xhr();
							if (myXhr.upload) myXhr.upload.addEventListener('progress', processHandler, false);
							return myXhr;
						},
						success: function (data) {
							successFunc(data,selector);
							$(btns).removeClass('hide');
							$(selector).css('opacity','1');
						},
						error: function (data) {
							errorfunc(data,selector);
							$(btns).removeClass('hide');
							$(selector).css('opacity','1');
						},
						beforeSend: function (data) {
							beforeFunc(data,selector);
							$(btns).addClass('hide');
							$(selector).css('opacity','.5');
						},
						async: true,
						data: requestData,
						cache: false,
						contentType: (typeof requestData === 'string')?'application/json; charset=utf-8':false,
						processData: false,
						timeout: 600000
					});*/
			."}
		</script>

		<style>
			:root{
				--Color-0: ".$this->Color(0).";
				--Color-1: ".$this->Color(1).";
				--Color-2: ".$this->Color(2).";
				--Color-3: ".$this->Color(3).";
				--Color-4: ".$this->Color(4).";
				--Color-5: ".$this->Color(5).";
				--ForeColor-0: ".$this->ForeColor(0).";
				--ForeColor-1: ".$this->ForeColor(1).";
				--ForeColor-2: ".$this->ForeColor(2).";
				--ForeColor-3: ".$this->ForeColor(3).";
				--ForeColor-4: ".$this->ForeColor(4).";
				--ForeColor-5: ".$this->ForeColor(5).";
				--BackColor-0: ".$this->BackColor(0).";
				--BackColor-1: ".$this->BackColor(1).";
				--BackColor-2: ".$this->BackColor(2).";
				--BackColor-3: ".$this->BackColor(3).";
				--BackColor-4: ".$this->BackColor(4).";
				--BackColor-5: ".$this->BackColor(5).";
				--Font-0: ".$this->Font(0).";
				--Font-1: ".$this->Font(1).";
				--Font-2: ".$this->Font(2).";
				--Font-3: ".$this->Font(3).";
				--Font-4: ".$this->Font(4).";
				--Font-5: ".$this->Font(5).";
				--Size-0: ".$this->Size(0).";
				--Size-1: ".$this->Size(1).";
				--Size-2: ".$this->Size(2).";
				--Size-3: ".$this->Size(3).";
				--Size-4: ".$this->Size(4).";
				--Size-5: ".$this->Size(5).";
				--Shadow-0: ".$this->Shadow(0).";
				--Shadow-1: ".$this->Shadow(1).";
				--Shadow-2: ".$this->Shadow(2).";
				--Shadow-3: ".$this->Shadow(3).";
				--Shadow-4: ".$this->Shadow(4).";
				--Shadow-5: ".$this->Shadow(5).";
				--Border-0: ".$this->Border(0).";
				--Border-1: ".$this->Border(1).";
				--Border-2: ".$this->Border(2).";
				--Border-3: ".$this->Border(3).";
				--Border-4: ".$this->Border(4).";
				--Border-5: ".$this->Border(5).";
				--Radius-0: ".$this->Radius(0).";
				--Radius-1: ".$this->Radius(1).";
				--Radius-2: ".$this->Radius(2).";
				--Radius-3: ".$this->Radius(3).";
				--Radius-4: ".$this->Radius(4).";
				--Radius-5: ".$this->Radius(5).";
				--Transition-0: ".$this->Transition(0).";
				--Transition-1: ".$this->Transition(1).";
				--Transition-2: ".$this->Transition(2).";
				--Transition-3: ".$this->Transition(3).";
				--Transition-4: ".$this->Transition(4).";
				--Transition-5: ".$this->Transition(5).";
				--Overlay-0: \"".$this->Overlay(0)."\";
				--Overlay-1: \"".$this->Overlay(1)."\";
				--Overlay-2: \"".$this->Overlay(2)."\";
				--Overlay-3: \"".$this->Overlay(3)."\";
				--Overlay-4: \"".$this->Overlay(4)."\";
				--Overlay-5: \"".$this->Overlay(5)."\";
				--Pattern-0: \"".$this->Pattern(0)."\";
				--Pattern-1: \"".$this->Pattern(1)."\";
				--Pattern-2: \"".$this->Pattern(2)."\";
				--Pattern-3: \"".$this->Pattern(3)."\";
				--Pattern-4: \"".$this->Pattern(4)."\";
				--Pattern-5: \"".$this->Pattern(5)."\";
				--Url-Overlay-0: URL(\"".$this->Overlay(0)."\");
				--Url-Overlay-1: URL(\"".$this->Overlay(1)."\");
				--Url-Overlay-2: URL(\"".$this->Overlay(2)."\");
				--Url-Overlay-3: URL(\"".$this->Overlay(3)."\");
				--Url-Overlay-4: URL(\"".$this->Overlay(4)."\");
				--Url-Overlay-5: URL(\"".$this->Overlay(4)."\");
				--Url-Pattern-0: URL(\"".$this->Pattern(0)."\");
				--Url-Pattern-1: URL(\"".$this->Pattern(1)."\");
				--Url-Pattern-2: URL(\"".$this->Pattern(2)."\");
				--Url-Pattern-3: URL(\"".$this->Pattern(3)."\");
				--Url-Pattern-4: URL(\"".$this->Pattern(4)."\");
				--Url-Pattern-5: URL(\"".$this->Pattern(4)."\");

				--Owner: \"".__(\_::$INFO->Owner,true,false)."\";
				--FullOwner: \"".__(\_::$INFO->FullOwner,true,false)."\";
				--OwnerDescription: \"".__(\_::$INFO->OwnerDescription,true,false)."\";
				--Product: \"".__(\_::$INFO->Product,true,false)."\";
				--FullProduct: \"".__(\_::$INFO->FullProduct,true,false)."\";
				--Name: \"".__(\_::$INFO->Name,true,false)."\";
				--FullName: \"".__(\_::$INFO->FullName,true,false)."\";
				--Slogan: \"".__(\_::$INFO->Slogan,true,false)."\";
				--FullSlogan: \"".__(\_::$INFO->FullSlogan,true,false)."\";
				--Description: \"".__(\_::$INFO->Description,true,false)."\";
				--FullDescription: \"".__(\_::$INFO->FullDescription,true,false)."\";

				--Path: \"".\_::$INFO->Path."\";
				--HomePath: \"".\_::$INFO->HomePath."\";
				--LogoPath: \"".\MiMFa\Library\Local::GetUrl(\_::$INFO->LogoPath)."\";
				--FullLogoPath: \"".\MiMFa\Library\Local::GetUrl(\_::$INFO->FullLogoPath)."\";
				--BannerPath: \"".\MiMFa\Library\Local::GetUrl(\_::$INFO->BannerPath)."\";
				--FullBannerPath: \"".\MiMFa\Library\Local::GetUrl(\_::$INFO->FullBannerPath)."\";
				--DownloadPath: \"".\MiMFa\Library\Local::GetUrl(\_::$INFO->DownloadPath)."\";
				--WaitSymbolPath: \"".\MiMFa\Library\Local::GetUrl(\_::$INFO->WaitSymbolPath)."\";
				--ProcessSymbolPath: \"".\MiMFa\Library\Local::GetUrl(\_::$INFO->ProcessSymbolPath)."\";
				--ErrorSymbolPath: \"".\MiMFa\Library\Local::GetUrl(\_::$INFO->ErrorSymbolPath)."\";

				--Url-Path: URL(\"".\_::$INFO->Path."\");
				--Url-HomePath: URL(\"".\_::$INFO->HomePath."\");
				--Url-LogoPath: URL(\"".\MiMFa\Library\Local::GetUrl(\_::$INFO->LogoPath)."\");
				--Url-FullLogoPath: URL(\"".\MiMFa\Library\Local::GetUrl(\_::$INFO->FullLogoPath)."\");
				--Url-BannerPath: URL(\"".\MiMFa\Library\Local::GetUrl(\_::$INFO->BannerPath)."\");
				--Url-FullBannerPath: URL(\"".\MiMFa\Library\Local::GetUrl(\_::$INFO->FullBannerPath)."\");
				--Url-DownloadPath: URL(\"".\MiMFa\Library\Local::GetUrl(\_::$INFO->DownloadPath)."\");
				--Url-WaitSymbolPath: URL(\"".\MiMFa\Library\Local::GetUrl(\_::$INFO->WaitSymbolPath)."\");
				--Url-ProcessSymbolPath: URL(\"".\MiMFa\Library\Local::GetUrl(\_::$INFO->ProcessSymbolPath)."\");
				--Url-ErrorSymbolPath: URL(\"".\MiMFa\Library\Local::GetUrl(\_::$INFO->ErrorSymbolPath)."\");
			}
		</style>";
	}
	public function GetBody():string|null{
		return "";
	}
	public function GetFinal():string|null{
		return "<script>
			AOS.init({
			  easing: 'ease-in-out-sine'
			});
		</script>";
	}


	public function IsDark($color = null):bool|null{
		if(!isValid($color)) return $this->IsDark($this->BackColor(0)) === false;
		list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
		$sc = $r+$g+$b;
		if($sc<127) return true;
		elseif($sc>382) return false;
		return null;
	}
}
?>