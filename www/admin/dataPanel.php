<?php 
include_once('include/json.php');
switch($query){
	case 'Get all active users':
		include_once('userDelegate.php');
		$jsonData = GetUserList();	
		break;
	case 'Get all active offices':
		include_once('officeDelegate.php');
		$jsonData = GetOfficeList();	
		break;
	case 'Get all active blogs':
		include_once('blogDelegate.php');
		$jsonData = GetBlogList();	
		break;
	case 'Get all active news':
		include_once('newsDelegate.php');
		$jsonData = GetNewsList();	
		break;
	case 'Get all active testimonials':
		include_once('testimonialDelegate.php');
		$jsonData = GetTestimonialList();	
		break;
	case 'Get all active brokers':
		include_once('brokerDelegate.php');
		$jsonData = GetBrokerList();	
		break;
	case 'Get all active listings':
		include_once('listingDelegate.php');
		$jsonData = GetListings();	
		break;
	case 'Get all active resources':
		include_once('resourceDelegate.php');
		$jsonData = GetResourceList();	
		break;	
	case 'Get settings':
		include_once('settingsDelegate.php');
		$jsonData = GetSettings();	
		break;		
}
$json = new JSON();
$dtResult = $json->unserialize($jsonData);
//$user->UserList[0]->userName;

$columnHeading = $dtResult->ColumnHeadings;
$columnCount = count((array)$dtResult->ColumnHeadings);
$rowCount = count($dtResult->Data);
$data = $dtResult->Data;
?>
<div class="row">
	<div class="span16, offset4">
		<h2><?php echo $menu; if($_GET['linkName'] != '') echo ' - '.$_GET['linkName']; else if($_GET['menuName'] != '') echo ' - '.$_GET['menuName'];?></h2>
		<hr>
		<table class="bordered-table zebra-striped">
			<thead>
				<tr>
					<?php
						for($cnt = 0; $cnt < $columnCount; $cnt++){
							echo '<th>'.$columnHeading[$cnt].'</th>';
						}
					?>
				</tr>
			</thead>
			<tbody>					
				<?php
					for($rCnt = 0; $rCnt < $rowCount; $rCnt++){
						echo '<tr>';
							foreach($data[$rCnt] as $key=>$value){
								echo '<td>'.$value.'</td>';
							}
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
		<?php
		if($dtResult->PageNo > 1)echo '
		<div class="pagination">
			<ul id="pagingBar">					  
				<li class="prev" id="prevId"><a href="'.$dtResult->PreviousPage.'">← Previous</a></li>
				<li class="next" id="nextId"><a href="'.$dtResult->NextPage.'">Next →</a></li>
			</ul>
		</div>
		';
		?>
		<p id="c2dm"></p>
	</div>
</div>