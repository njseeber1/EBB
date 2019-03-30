<?php
include_once $root.'dal/clsDataTable.php';
include_once $root.'utils/stringHelper.php';
class Blogs extends DefaultTable
{
	var $blogId;
	var $companyId;
	var $heading;
	var $blogDate;
	var $content;
	
	function Blogs()
	{
		$this->tableName = 'blogs';
        $this->rowsPerPage = 10;
        $this->fieldList = array('blogId', 'companyId', 'heading', 'blogDate', 'content');
        $this->fieldList['blogId'] = array('pkey' => 'y');
		$this->errors = array();
	}
	
	public function setBlogId($blogId){
		$this->blogId = $blogId;
	}
	
	public function setCompanyId($companyId){
		$this->companyId = $companyId;
	}
	
	public function setHeading($heading){
		$this->heading = PutEscapeSequence($heading);
	}
	
	public function setBlogDate($blogDate){
		$this->blogDate = $blogDate;
	}
	
	public function setContent($content){
		$this->content = PutEscapeSequence($content);
	}
		
	//------------------------------------
	
	public function Save(){
		try{
			$fieldArray = array('companyId'=>$this->companyId,'heading'=>$this->heading,'blogDate'=>$this->blogDate,'content'=>$this->content);
			$this->prepareConnection();
			$this->Insert($fieldArray);
			$this->blogId = $this->lastInsert;
			return $this->blogId;
		}catch(Exception $ex) {
			return $this->blogId;
		}
	}
	
	public function GetBlogList(){
		$query = "SELECT blogId, blogDate, heading, CONCAT('<a href=\"frmBlogs.php?mode=Update&blogId=',blogId,'\">','Edit','</a>') AS editBlog, CONCAT('<a href=\"frmBlogs.php?mode=Delete&blogId=',blogId,'\">','Delete','</a>') AS deleteBlog  FROM blogs WHERE companyId = ".$this->companyId;
		$this->prepareConnection();
		$dtBlogList = $this->SqlQueryAll($query);
		return $dtBlogList;
	}
	
	public function GetLastBlog(){
		$this->rowsPerPage = 1;
		$query = "SELECT blogId, blogDate, heading, content  FROM blogs WHERE companyId = ".$this->companyId." ORDER BY blogDate DESC";
		$this->prepareConnection();
		$dtLastBlog = $this->SqlQuery($query);
		return $dtLastBlog;
	}
	
	public function GetBlogs(){
		$query = "SELECT blogId, DATE_FORMAT(blogDate,'%M %d, %Y') AS blogDate, heading, content  FROM blogs WHERE companyId = ".$this->companyId." ORDER BY blogDate DESC";
		$this->prepareConnection();
		$dtBlogs = $this->SqlQueryAll($query);
		return $dtBlogs;
	}
	
	
	public function GetBlogDetails(){
		$query = "SELECT blogId, blogDate, heading, content  FROM blogs WHERE blogId = ".$this->blogId;
		$this->prepareConnection();
		$dtBlogDetails = $this->SqlQuery($query);
		return $dtBlogDetails;
	}
	
	function UpdateBlog(){
		$fieldArray = array('blogId'=>$this->blogId,'blogDate'=>$this->blogDate,'heading'=>$this->heading,'content'=>$this->content);
		$this->prepareConnection();
		$this->Update($fieldArray);
	}
	
	function DeleteBlog(){
		$fieldArray = array('blogId'=>$this->blogId);
		$this->prepareConnection();
		$this->Delete($fieldArray);
	}
}
?>