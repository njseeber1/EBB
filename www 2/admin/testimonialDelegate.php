<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	include_once('include/json.php');
	function GetTestimonialList(){
		$json = new JSON();
		include_once('bll/testimonials.php');
		$testimonial = new Testimonials();
		$testimonial->setCompanyId(1);
		$dtTestimonialList = $testimonial->GetTestimonialList();
		$jsonResult->ColumnHeadings = array('ID','Testimonial','Author',' ',' ');
		if(count($dtTestimonialList) > 0) $jsonResult->Data = $dtTestimonialList;
		return $json->serialize($jsonResult);
	}

	function GetTestimonialDetails(){
		$json = new JSON();
		include_once('bll/testimonials.php');
		$testimonial = new Testimonials();
		$testimonial->setCompanyId(1);
		$testimonial->setTestimonialId($_GET['testimonialId']);
		$dtTestimonial = $testimonial->GetTestimonialDetails();
		return $dtTestimonial;
	}

	function UpdateTestimonial(){
		include_once('bll/testimonials.php');
		$testimonial = new Testimonials();
		$testimonial->setCompanyId(1);
		$testimonial->setTestimonialId($_POST['testimonialId']);
		$testimonial->setTitle($_POST['title']);
		$testimonial->setTestimonial($_POST['testimonial']);
		$testimonial->setAuthor($_POST['author']);
		$testimonial->UpdateTestimonial();
	}
	
	function SaveTestimonial(){
		include_once('bll/testimonials.php');
		$testimonial = new Testimonials();
		$testimonial->setCompanyId(1);
		$testimonial->setTitle($_POST['title']);
		$testimonial->setTestimonial($_POST['testimonial']);
		$testimonial->setAuthor($_POST['author']);
		$testimonial->setStatus(1);
		$testimonialId = $testimonial->Save();
	}
	
	function DeleteTestimonial(){
		include_once('bll/testimonials.php');
		$testimonial = new Testimonials();
		$testimonial->setTestimonialId($_GET['testimonialId']);
		$testimonial->DeleteTestimonial();
	}
}
?>