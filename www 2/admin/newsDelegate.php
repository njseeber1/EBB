<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	include_once('include/json.php');
	function GetNewsList(){
		$json = new JSON();
		include_once('bll/news.php');
		$news = new News();
		$news->setCompanyId(1);
		$dtNewsList = $news->GetNewsList();
		$jsonResult->ColumnHeadings = array('ID','Date','Heading','Author',' ',' ');
		if(count($dtNewsList) > 0) $jsonResult->Data = $dtNewsList;
		return $json->serialize($jsonResult);
	}

	function GetNewsDetails(){
		$json = new JSON();
		include_once('bll/news.php');
		$news = new News();
		$news->setCompanyId(1);
		$news->setNewsId($_GET['newsId']);
		$dtNews = $news->GetNewsDetails();
		return $dtNews;
	}

	function UpdateNews(){
		include_once('bll/news.php');
		$news = new News();
		$news->setCompanyId(1);
		$news->setNewsId($_POST['newsId']);
		$news->setHeading($_POST['heading']);
		$news->setNewsDate($_POST['newsDate']);
		$news->setAuthor($_POST['author']);
		$news->setContent($_POST['content']);
		$news->UpdateNews();
	}
	
	function SaveNews(){
		include_once('bll/news.php');
		$news = new News();
		$news->setCompanyId(1);
		$news->setHeading($_POST['heading']);
		$news->setNewsDate($_POST['newsDate']);
		$news->setAuthor($_POST['author']);
		$news->setContent($_POST['content']);
		$newsId = $news->Save();
	}
	
	function DeleteNews(){
		include_once('bll/news.php');
		$news = new News();
		$news->setNewsId($_GET['newsId']);
		$news->DeleteNews();
	}
}
?>