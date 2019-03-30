<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	include_once('include/json.php');	
	function GetSettings(){
		include_once('bll/settings.php');
		$setting = new Settings();
		$setting->setCompanyId(1);
		$dtSettings = $setting->GetSettings();
		return $dtSettings;
	}

	function UpdateSettings(){
		include_once('bll/settings.php');
		$setting = new Settings();
		$setting->setSettingsId($_POST['settingsId']);
		//$setting->setHomePage($_POST['homePage']);
		$setting->setMessageEmail($_POST['messageEmail']);
		//$setting->setTollFree($_POST['tollFree']);
		//$setting->setLinkedIn($_POST['linkedIn']);
		//$setting->setFacebook($_POST['facebook']);
		//$setting->setTwitter($_POST['twitter']);
		//$setting->setGooglePlus($_POST['googlePlus']);
		//$setting->setSkype($_POST['skype']);
		//$setting->setPinterest($_POST['pinterest']);
		$setting->UpdateSettings();
		if(isset($_FILES['logo'])){
			if(is_uploaded_file($_FILES['logo']['tmp_name'])) {
				if (!is_dir('../uploads/logos')) {
							mkdir('../uploads/logos');
				}
				move_uploaded_file($_FILES['logo']['tmp_name'], '../uploads/logos/logo_1.jpg');
			}
		}
	}
	
	function SaveSettings(){
		include_once('bll/settings.php');
		$setting = new Settings();
		$setting->setCompanyId(1);
		//$setting->setHomePage($_POST['homePage']);
		$setting->setMessageEmail($_POST['messageEmail']);
		//$setting->setTollFree($_POST['tollFree']);
		//$setting->setLinkedIn($_POST['linkedIn']);
		//$setting->setFacebook($_POST['facebook']);
		//$setting->setTwitter($_POST['twitter']);
		//$setting->setGooglePlus($_POST['googlePlus']);
		//$setting->setSkype($_POST['skype']);
		//$setting->setPinterest($_POST['pinterest']);
		$setting->Save();
		if(isset($_FILES['logo'])){
			if(is_uploaded_file($_FILES['logo']['tmp_name'])) {
				if (!is_dir('../uploads/logos')) {
							mkdir('../uploads/logos');
				}
				move_uploaded_file($_FILES['logo']['tmp_name'], '../uploads/logos/logo_1.jpg');
			}
		}
	}
	
	function GetSlideSettings(){
		include_once('bll/slide_settings.php');
		$slide = new SlideSettings();
		$slide->setCompanyId(1);
		$dtSlideSettings = $slide->GetSlideSettings();
		return $dtSlideSettings;
	}
	
	function SaveSlideSettings(){
		include_once('bll/slide_settings.php');
		$slide = new SlideSettings();
		$slide->setCompanyId(1);
		$slide->setSlide1($_POST['slide1']);
		$slide->setSlide2($_POST['slide2']);
		$slide->setSlide3($_POST['slide3']);
		$slide->setSlide4($_POST['slide4']);
		$slide->Save();
	}
	
	function UpdateSlideSettings(){
		include_once('bll/slide_settings.php');
		$slide = new SlideSettings();
		$slide->setSsId($_POST['ssId']);
		$slide->setSlide1($_POST['slide1']);
		$slide->setSlide2($_POST['slide2']);
		$slide->setSlide3($_POST['slide3']);
		$slide->setSlide4($_POST['slide4']);
		$slide->UpdateSettings();
	}
	
	function SaveSplitSettings(){
		include_once('bll/splits.php');
		$split = new Splits();
		$split->setCompanyId(1);
		$split->setSplitNo($_POST['splitNo']);
		$split->setImageId($_POST['imageId']);
		$split->DeleteSettings();
		$split->Save();
	}
	
	function UpdateSplitSettings(){
		include_once('bll/splits.php');
		$split = new Splits();
		$split->setSplitId($_POST['splitId']);
		$split->setSplitNo($_POST['splitNo']);
		$split->setImageId($_POST['imageId']);
		$slide->UpdateSettings();
	}
	
	function GetSplitSettings(){
		include_once('bll/splits.php');
		$split = new Splits();
		$split->setCompanyId(1);
		$dtSplitSettings = $split->GetSplitSettings();
		return $dtSplitSettings;
	}
}
?>