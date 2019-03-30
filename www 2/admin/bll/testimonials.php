<?php
include_once $root.'dal/clsDataTable.php';
include_once $root.'utils/stringHelper.php';
class Testimonials extends DefaultTable
{
	var $testimonialId;
	var $companyId;
	var $title;
	var $testimonial;
	var $author;
	var $status;
	var $errors;
    var $message;
	
	function Testimonials()
	{
		$this->tableName = 'testimonials';
        $this->rowsPerPage = 10;
        $this->fieldList = array('testimonialId', 'title', 'companyId', 'testimonial', 'author', 'status');
        $this->fieldList['testimonialId'] = array('pkey' => 'y');
		$this->errors = array();
	}
	
	public function setTestimonialId($testimonialId){
		$this->testimonialId = $testimonialId;
	}
	
	public function setCompanyId($companyId){
		$this->companyId = $companyId;
	}
	
	public function setTitle($title){
		$this->title = $title;
	}
	
	public function setTestimonial($testimonial){
		$this->testimonial = PutEscapeSequence($testimonial);
	}
	
	public function setAuthor($author){
		$this->author = PutEscapeSequence($author);
	}
	
	public function setStatus($status){
		$this->status = $status;
	}
		
	//------------------------------------
	
	public function Save(){
		try{
			$fieldArray = array('companyId'=>$this->companyId,'title'=>$this->title,'testimonial'=>$this->testimonial,'author'=>$this->author,'status'=>$this->status);
			$this->prepareConnection();
			$this->Insert($fieldArray);
			$this->testimonialId = $this->lastInsert;
			return $this->testimonialId;
		}catch(Exception $ex) {
			return $this->testimonialId;
		}
	}
	
	public function GetTestimonialList(){
		$query = "SELECT testimonialId, title, author, CONCAT('<a href=\"frmTestimonials.php?mode=Update&testimonialId=',testimonialId,'\">','Edit','</a>') AS editTestimonial, CONCAT('<a href=\"frmTestimonials.php?mode=Delete&testimonialId=',testimonialId,'\">','Delete','</a>') AS deleteTestimonial  FROM testimonials WHERE companyId = ".$this->companyId." AND status = 1";
		$this->prepareConnection();
		$dtTestimonialList = $this->SqlQueryAll($query);
		return $dtTestimonialList;
	}
	
	public function GetTestimonials(){
		$query = "SELECT testimonialId, title, testimonial, author  FROM testimonials WHERE companyId = ".$this->companyId." AND status = 1";
		$this->prepareConnection();
		$dtTestimonials = $this->SqlQueryAll($query);
		return $dtTestimonials;
	}
	
	public function GetTestimonialDetails(){
		$query = "SELECT testimonialId, title, testimonial, author  FROM testimonials WHERE testimonialId = ".$this->testimonialId;
		$this->prepareConnection();
		$dtTestimonialDetails = $this->SqlQuery($query);
		return $dtTestimonialDetails;
	}
	
	function UpdateTestimonial(){
		$fieldArray = array('testimonialId'=>$this->testimonialId,'title'=>$this->title,'testimonial'=>$this->testimonial,'author'=>$this->author);
		$this->prepareConnection();
		$this->Update($fieldArray);
	}
	
	function DeleteTestimonial(){
		$fieldArray = array('testimonialId'=>$this->testimonialId, 'status'=>0);
		$this->prepareConnection();
		$this->Update($fieldArray);
	}
}
?>