<?php
include_once $root.'dal/clsDataTable.php';
include_once $root.'utils/stringHelper.php';
class News extends DefaultTable
{
	var $newsId;
	var $companyId;
	var $heading;
	var $author;
	var $newsDate;
	var $content;

	function News()
	{
		$this->tableName = 'news';
        $this->rowsPerPage = 10;
        $this->fieldList = array('newsId', 'companyId', 'heading', 'author', 'newsDate', 'content');
        $this->fieldList['newsId'] = array('pkey' => 'y');
		$this->errors = array();
	}
	
	public function setNewsId($newsId){
		$this->newsId = $newsId;
	}
	
	public function setCompanyId($companyId){
		$this->companyId = $companyId;
	}
	
	public function setHeading($heading){
		$this->heading = PutEscapeSequence($heading);
	}
	
	public function setAuthor($author){
		$this->author = PutEscapeSequence($author);
	}
	
	public function setNewsDate($newsDate){
		$this->newsDate = $newsDate;
	}
	
	public function setContent($content){
		$this->content = PutEscapeSequence($content);
	}
		
	//------------------------------------
	
	public function Save(){
		try{
			$fieldArray = array('companyId'=>$this->companyId,'heading'=>$this->heading,'author'=>$this->author,'newsDate'=>$this->newsDate,'content'=>$this->content);
			$this->prepareConnection();
			$this->Insert($fieldArray);
			$this->newsId = $this->lastInsert;
			return $this->newsId;
		}catch(Exception $ex) {
			return $this->newsId;
		}
	}
	
	public function GetNewsList(){
		$query = "SELECT newsId, newsDate, heading, author, CONCAT('<a href=\"frmNews.php?mode=Update&newsId=',newsId,'\">','Edit','</a>') AS editNews, CONCAT('<a href=\"frmNews.php?mode=Delete&newsId=',newsId,'\">','Delete','</a>') AS deleteNews  FROM news WHERE companyId = ".$this->companyId;
		$this->prepareConnection();
		$dtNewsList = $this->SqlQueryAll($query);
		return $dtNewsList;
	}
	
	public function GetLatestNews(){
		$this->rowsPerPage = 1;
		$query = "SELECT newsId, newsDate, heading, author, content  FROM news WHERE companyId = ".$this->companyId." ORDER BY newsDate DESC";
		$this->prepareConnection();
		$dtLatestNews = $this->SqlQuery($query);
		return $dtLatestNews;
	}
	
	public function GetNews(){
		$query = "SELECT newsId, DATE_FORMAT(newsDate,'%M %d, %Y') AS newsDate, heading, author, content  FROM news WHERE companyId = ".$this->companyId." ORDER BY newsDate DESC";
		$this->prepareConnection();
		$dtNews = $this->SqlQueryAll($query);
		return $dtNews;
	}
	
	
	public function GetNewsDetails(){
		$query = "SELECT newsId, newsDate, heading,author, content  FROM news WHERE newsId = ".$this->newsId;
		$this->prepareConnection();
		$dtNewsDetails = $this->SqlQuery($query);
		return $dtNewsDetails;
	}
	
	function UpdateNews(){
		$fieldArray = array('newsId'=>$this->newsId,'newsDate'=>$this->newsDate,'heading'=>$this->heading,'author'=>$this->author,'content'=>$this->content);
		$this->prepareConnection();
		$this->Update($fieldArray);
	}
	
	function DeleteNews(){
		$fieldArray = array('newsId'=>$this->newsId);
		$this->prepareConnection();
		$this->Delete($fieldArray);
	}
}
?>