<?php
error_reporting(0);
if (isset($_POST["submit"])) {
    
$dbname = $_POST["funnal_database"];
$allrange = $_POST["content"];
$sdate = strtotime($_POST["start_date"]);
$edate = strtotime($_POST["end_date"]);
$status = $_POST["funnal_database_status"];
$osdate = str_replace("-", " - ", $_POST["start_date"]);
$oedate = str_replace("-", " - ", $_POST["end_date"]);
	
	if($dbname == 'Loyalty'){
		
		define('DB_SERVER', 'localhost'); 
		define('DB_SERVER_USERNAME', 'vichomes_ikab');
		define('DB_SERVER_PASSWORD', 'v!KmasrsboX{');  
		define('DB_DATABASE', 'vichomes_ikab');
		 
		function db_connect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = 'db_link'){
			global $$link;
			$$link = mysql_connect($server, $username, $password);
			if ($$link) mysql_select_db($database);
			return $$link;
		}
			db_connect() or die('Unable to connect to database server!');

		$arry = array();
		
		if($status == 0){

		  if(empty($sdate) && empty($edate)){
				$enquiries    = "select * from gtc_user";	
				$res = mysql_query($enquiries);
		  }else{
				$enquiries    = "select * from gtc_user WHERE time between $sdate and $edate";	
				$res = mysql_query($enquiries);
		  }
				if(mysql_num_rows($res)){
				$counter = 1;
				?><div style="width:100%; height:auto" id="seller_content_box">

				<table class="hoverTable" id="export_funnal" cellpadding="0" cellspacing="0" width="100%" border="0">
				<tr>
					<th class="talve_class_heading" align="left">Campaign</th>			
					<th class="talve_class_heading" align="left">First name</th>			
					<th class="talve_class_heading" align="left">Last name</th>		
					<th class="talve_class_heading" align="left" >Email</th>
					<th class="talve_class_heading" align="left" >province</th>
					<th class="talve_class_heading" align="left" >Date</th>						
				</tr>
				<?php 
				$counter = 0;
				while( $row = mysql_fetch_array( $res)   ) {
					$class = 'talve_class_2';
				?>

				<tr>			
					<td valign="middle" class="<?php echo $class?>"><?php echo  $row['campaign']; ?></td>	
					<td valign="middle" class="<?php echo $class?>"><?php echo  $row['first_name']; ?></td>			
					<td valign="middle" class="<?php echo $class?>" ><?php echo  $row['last_name']; ?></td>		
					<td valign="middle" class="<?php echo $class?>"><?php echo  $row['email']; ?></td>		
					<td valign="middle" class="<?php echo $class?>"><?php echo  $row['province']; ?></td>	
					<td valign="middle" class="<?php echo $class?>"><?php echo  date("m-d-Y",$row['time']); ?></td>
				</tr>
					
				<?php 
				$counter++;
				} ?>		
				</table>				
				</div>		  
		<?php }
		}else{
		
			if(empty($sdate) && empty($edate)){
				$enquiries    = "select * from gtc_user";	
				$res = mysql_query($enquiries);
			}else{
				$enquiries    = "select * from gtc_user WHERE time between $sdate and $edate";	
				$res = mysql_query($enquiries);
			}

			while( $row = mysql_fetch_row( $res)   ) {
				$arry[] = $row;
			}
			
			//print_r($arry);
			
			header('Content-Type: application/excel');
			header('Content-Disposition: attachment; filename="loyalty_gtc_user.csv"');

			$arry[0] = array('id','campaign', 'first_name', 'last_name', 'email', 'country', 'province', 'day', 'month', 'year', 'telephone_no', 'std_code', 'street', 'post_code', 'city', 'gtc_conditions', 'cashback_notification', 'time');

			$fp = fopen('php://output', 'w');
			foreach ($arry as $line) {
				
				fputcsv($fp, $line, ',');
			}

			fclose($fp);
		}
	}else if($dbname == 'Offers'){
		
		define('DB_SERVER', 'localhost'); 
		define('DB_SERVER_USERNAME', 'vichomes_geo');
		define('DB_SERVER_PASSWORD', '!pD3Vw}TaW6f');
		define('DB_DATABASE', 'vichomes_geo');
		 
		function db_connect_offers($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = 'db_link'){
			global $$link;
			$$link = mysql_connect($server, $username, $password);
			if ($$link) mysql_select_db($database);
			return $$link;
		}
			db_connect_offers() or die('Unable to connect to database server!');

		$arry = array();
		
		if($status == 0){

		  if(empty($osdate) && empty($oedate)){
				$enquiries = "select * from users order by id desc";
				$res = mysql_query($enquiries);
		  }else{
				$enquiries    = "select * from users WHERE add_date between '".$osdate."' and '".$oedate."'";	
				$res = mysql_query($enquiries);
		  }
	   if(mysql_num_rows($res)){	   
	   	$counter = 1;
	   ?><div style="width:100%; height:auto" id="seller_content_box">	
		<table class="hoverTable" id="export_funnal" cellpadding="0" cellspacing="0" width="100%" border="0">
		<tr>				
			<th class="talve_class_heading" align="left">#</th>				
			<th class="talve_class_heading" align="left">Name</th>
			<th class="talve_class_heading" align="left">Email</th>
			<th class="talve_class_heading" align="left">Phone</th>
			<th class="talve_class_heading" align="left">Date</th>		
		</tr>
		
		<?php 
		$counter = 0;
		while( $row = mysql_fetch_array( $res) ) {
		$class = 'talve_class_2';
		if($counter % 2 != 0)
		{
			$class = 'talve_class_one';
		}
		?>
		<tr>				
			<td valign="middle" align="left" class="<?php echo $class?>"><?php echo  $counter+1; ?></td>					
			<td valign="middle" class="<?php echo $class?>"><?php echo  $row['name']; ?></td>			
			<td valign="middle" align="left" class="<?php echo $class?>" ><?php echo  $row['email']; ?></td>			
			<td valign="middle" class="<?php echo $class?>"><?php echo  $row['phone']; ?></td>
			<td valign="middle" class="<?php echo $class?>"><?php echo  $row['add_date']; ?></td>
		</tr>
			
		<?php 
		$counter++;
		} ?>		
		</table>			  
	  </div>
	  <?php }
		}else{
		
			if(empty($osdate) && empty($oedate)){
				$enquiries = "select * from users order by id asc";
				$res = mysql_query($enquiries);
			}else{
				$enquiries    = "select * from users WHERE add_date between '".$osdate."' and '".$oedate."' order by id asc";	
				$res = mysql_query($enquiries);
			}

			while( $row = mysql_fetch_row( $res)   ) {
				$arry[] = $row;
			}
			
/* 			echo '<pre>';print_r($arry);
			die; */
			header('Content-Type: application/excel');
			header('Content-Disposition: attachment; filename="offers_user.csv"');

			$arry[0] = array('id','type', 'name', 'email', 'phone', 'address', 'property_sell_value', 'property_condition', 'other_details', 'sell_date', 'already_has_agent', 'add_date');

			$fp = fopen('php://output', 'w');
			foreach ($arry as $line) {
				
				fputcsv($fp, $line, ',');
			}

			fclose($fp);
		}
	}else{
		echo '	<div class="wrap" id="if-error" align="center" style="margin-top: 20%;"><h2 style="color: #FF5722;"> You do not select any Database or field ! <br> Please go back and fill form properly. </h2></div>';
	}
	if($status == 0){
	?>
	<style>table, th, td { border: 1px solid #9EBAA0; border-collapse: collapse; }  th, td { padding: 1%; } </style>
<?php }
	}