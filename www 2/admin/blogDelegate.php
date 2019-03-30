<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	include_once('include/json.php');
	function GetBlogList(){
		$json = new JSON();
		include_once('bll/blogs.php');
		$blog = new Blogs();
		$blog->setCompanyId(1);
		$dtBlogList = $blog->GetBlogList();
		$jsonResult->ColumnHeadings = array('ID','Date','Heading',' ',' ');
		if(count($dtBlogList) > 0) $jsonResult->Data = $dtBlogList;
		return $json->serialize($jsonResult);
	}

	function GetBlogDetails(){
		$json = new JSON();
		include_once('bll/blogs.php');
		$blog = new Blogs();
		$blog->setCompanyId(1);
		$blog->setBlogId($_GET['blogId']);
		$dtBlog = $blog->GetBlogDetails();
		return $dtBlog;
	}

	function UpdateBlog(){
		include_once('bll/blogs.php');
		$blog = new Blogs();
		$blog->setCompanyId(1);
		$blog->setBlogId($_POST['blogId']);
		$blog->setHeading($_POST['heading']);
		$blog->setBlogDate($_POST['blogDate']);
		$blog->setcontent($_POST['content']);
		$blog->UpdateBlog();
		if(isset($_FILES['blogImage'])){ 
			if(is_uploaded_file($_FILES['blogImage']['tmp_name'])) {
				if (!is_dir('../uploads/blogs')) { 
							mkdir('../uploads/blogs');
				}echo 'listing image';
				move_uploaded_file($_FILES['blogImage']['tmp_name'], '../uploads/blogs/blog_'.$_POST['blogId'].'.jpg');
			}
		}
	}
	
	function SaveBlog(){
		include_once('bll/blogs.php');
		$blog = new Blogs();
		$blog->setCompanyId(1);
		$blog->setHeading($_POST['heading']);
		$blog->setBlogDate($_POST['blogDate']);
		$blog->setcontent($_POST['content']);
		$blogId = $blog->Save();
		
		if(isset($_FILES['blogImage'])){
			if(is_uploaded_file($_FILES['blogImage']['tmp_name'])) {
				if (!is_dir('../uploads/blogs')) {
							mkdir('../uploads/blogs');
				}
				move_uploaded_file($_FILES['blogImage']['tmp_name'], '../uploads/blogs/blog_'.$blogId.'.jpg');
			}
		}
	}
	
	function DeleteBlog(){
		include_once('bll/blogs.php');
		$blog = new Blogs();
		$blog->setBlogId($_GET['blogId']);
		$blog->DeleteBlog();
	}
}
?>