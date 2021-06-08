
<?php

require_once("db.php");
	$search_keyword = '';
    $search3 = "2021-12-31";

    $t=time();
    //echo($t . "<br>");
    //echo(date("Y-m-d",$t));
  //  $search2 = date("Y-m-d",$t);
    $search2 = "2021-01-01";
     //   $id_lager =$_REQUEST['id_lager']; 
if (isset($_REQUEST["new_date"])) {

		$search_keyword = $_REQUEST['search']['keyword'];
		$search2 = $_REQUEST['search2'];
		$search3 = $_REQUEST['search3'];
    } 

?>
<!DOCTYPE html>
<html>
  <head>

       <link rel="shortcut icon" href="logo_calender.png" type="image/x-icon">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Payment</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="style.css" rel="stylesheet">
<style >
    .hin { margin-top: 25px;margin-left: 50px; color:#f51c0c;}
    .btn { color:#FFF;border-radius: 4px;background-color:#cde4e5; padding:4px;font-size: 18px;}
    #wrap2{width: 1100px;margin-left: 5px}
	#keyword2{border: #CCC 1px solid; border-radius: 4px; padding: 2px;font-size: 18px;background-color:#f5f5f5;}
    #keyword3{border: #CCC 1px solid; border-radius: 4px; padding: 2px;font-size: 18px;background-color:#f5f5f5;}
</style>
</head>
<body>

    

    


<div id="wrap2">   
<div class="container">   
    <form name='frmSearch' action='' method='post'>     
    <div class="hin"><h4>Note: a statistical study over one year only, from January to December</h4></div>
    <div class="row  mb-2">
        <div class="col-1 mt-2">
            <h4>From</h4>
        </div>  
        <div class="col-2 mt-2">
            <input type='date' name='search2' value='<?php echo $search2; ?>' id="keyword2" maxlength='25' class="form-control">
        </div>
        <div class="col-1 mt-2">
            <h4>To</h4>
        </div>          
        <div class="col-2 mt-2">
            <input type='date' name='search3' value="<?php echo $search3; ?>" id="keyword3" maxlength='25' class="form-control">
        </div>
         
        <div class="col-4 mt-2">
            <input type='text' name='search[keyword]' autofocus value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25' class="form-control">
        </div> 
        <div class="col-1 mt-2">
            <input name="new_date" type="submit" value="Search" class="btn">
        </div>
      
    </div>
    

    

    
 <?php
// ---------------- Pivot ------------------
$sql = "SELECT  
	IFNULL(artcours, 'TOTAL') AS officer_name,
	COUNT( IF( MONTH(created_at) = 1, amount, NULL) ) AS coun_1,
	SUM( IF( MONTH(created_at) = 1, amount, 0) ) AS january,
	COUNT( IF( MONTH(created_at) = 2, amount, NULL) ) AS coun_2,
	SUM( IF( MONTH(created_at) = 2, amount, 0) ) AS februay,
	COUNT( IF( MONTH(created_at) = 3, amount, NULL) ) AS coun_3,
	SUM( IF( MONTH(created_at) = 3, amount, 0) ) AS march,
    COUNT( IF( MONTH(created_at) = 4, amount, NULL) ) AS coun_4,
	SUM( IF( MONTH(created_at) = 4, amount, 0) ) AS April,
	COUNT( IF( MONTH(created_at) = 5, amount, NULL) ) AS coun_5,
	SUM( IF( MONTH(created_at) = 5, amount, 0) ) AS May,
	COUNT( IF( MONTH(created_at) = 6, amount, NULL) ) AS coun_6,
	SUM( IF( MONTH(created_at) = 6, amount, 0) ) AS June,
    COUNT( IF( MONTH(created_at) = 7, amount, NULL) ) AS coun_7,
	SUM( IF( MONTH(created_at) = 7, amount, 0) ) AS July,
	COUNT( IF( MONTH(created_at) = 8, amount, NULL) ) AS coun_8,
	SUM( IF( MONTH(created_at) = 8, amount, 0) ) AS August,
	COUNT( IF( MONTH(created_at) = 9, amount, NULL) ) AS coun_9,
	SUM( IF( MONTH(created_at) = 9, amount, 0) ) AS September,
    COUNT( IF( MONTH(created_at) = 10, amount, NULL) ) AS coun_10,
	SUM( IF( MONTH(created_at) = 10, amount, 0) ) AS October,
	COUNT( IF( MONTH(created_at) = 11, amount, NULL) ) AS coun_11,
	SUM( IF( MONTH(created_at) = 11, amount, 0) ) AS November,
	COUNT( IF( MONTH(created_at) = 12, amount, NULL) ) AS coun_12,
	SUM( IF( MONTH(amount) = 12, amount, 0) ) AS December,
	
	COUNT(amount) AS count,
	SUM( amount ) AS total
FROM payment WHERE ((payment.created_at) Between '$search2%' AND '$search3%')
GROUP BY artcours
WITH ROLLUP";

    $result = mysqli_query($con, $sql);

    
?>
        
<table class="tbl-qa table table-hover">
  <thead>
	<tr>
	  <th class="table-header" width="4%">Name</th>
      <th class="table-header" width="4%">Jan</th>
      <th class="table-header" width="4%">Feb</th>    
      <th class="table-header" width="4%">Mar</th>
      <th class="table-header" width="4%">Apr</th>
      <th class="table-header" width="4%">May</th>    
      <th class="table-header" width="4%">Jui</th> 
      <th class="table-header" width="4%">Jul</th>
      <th class="table-header" width="4%">Aug</th>    
      <th class="table-header" width="4%">Sep</th>
      <th class="table-header" width="4%">Oct</th>
      <th class="table-header" width="4%">Nov</th>    
      <th class="table-header" width="4%">Dec</th>  
      <th class="table-header" width="4%">Total</th> 
	</tr>
  </thead>
  <tbody id="table-body">
	<?php
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
	?>
	  <tr class="table-row">
		<td><?php echo $row["officer_name"]; ?></td>
        <td><?php echo round($row["january"],1); ?></td>
   		<td><?php echo round($row["februay"],1); ?></td>
        <td><?php echo round($row["march"],1); ?></td>
   		<td><?php echo round($row["April"],1); ?></td>
        <td><?php echo round($row["May"],1); ?></td>
   		<td><?php echo round($row["June"],1); ?></td>
        <td><?php echo round($row["July"],1); ?></td>
   		<td><?php echo round($row["August"],1); ?></td>
        <td><?php echo round($row["September"],1); ?></td>
   		<td><?php echo round($row["October"],1); ?></td>
        <td><?php echo round($row["November"],1); ?></td>
   		<td><?php echo round($row["December"],1); ?></td>          
        <td><?php echo round($row["total"],0); ?></td>

	  </tr>
    <?php
      }
        }
       ?>
      
    </tbody>
</table>    
<?php    
    
//    ------- End Pivot ------------
    
?>
        
<?php 
 $sql = "SELECT student.id, student.fullname, payment.amount, payment.numpayment, payment.type, payment.notes, payment.created_at, payment.artcours
FROM student LEFT JOIN payment ON student.id = payment.student_id
WHERE ((((student.fullname)LIKE '%$search_keyword%') or ((payment.amount)LIKE '%$search_keyword%') or ((payment.numpayment)LIKE '%$search_keyword%')) AND ((payment.created_at) Between '$search2%' AND '$search3%'))

";

$result = mysqli_query($con, $sql);

?>        
<?php 
 $sqltotalamount = "SELECT Sum(payment.amount) AS SumOfamount
FROM student LEFT JOIN payment ON student.id = payment.student_id
WHERE ((((student.fullname)LIKE '%$search_keyword%') or ((payment.amount)LIKE '%$search_keyword%') or ((payment.numpayment)LIKE '%$search_keyword%')) AND ((payment.created_at) Between '$search2%' AND '$search3%'))

";

$resulttotalamount = mysqli_query($con, $sqltotalamount);

?>
        <table class="tbl-qa table table-hover">
      <thead>
        <tr >
          <th class="table-header" width="5%">ID</th>
          <th class="table-header" width="5%">FullName*</th>
           <th class="table-header" width="5%">Num Payment*</th>
          <th class="table-header" width="5%">artcours</th>            
          <th class="table-header" width="5%">Notes</th>
          <th class="table-header" width="5%">Created At</th>
          <th class="table-header" width="5%">Amount*</th>             
        </tr>
      </thead>
      <tbody id="table-body">
        <?php

            $i=0;
            while ($row = mysqli_fetch_assoc($result)) {
                $i=$i+1;
        ?>
          <tr class="table-row">

            <td><?php echo ($i); ?></td>          
            <td><?php echo ($row["fullname"]); ?></td>
            <td><?php echo ($row["numpayment"]); ?></td> 
            <td><?php echo ($row["artcours"]); ?></td>               
            <td><?php echo ($row["notes"]); ?></td>
            <td><?php echo date_format(date_create($row["created_at"]),"d.m.Y"); ?></td>
            <td><?php echo ($row["amount"]); ?></td>              
          </tr>
        <?php
          }
           ?>
<?php

            $i=0;
            while ($row = mysqli_fetch_assoc($resulttotalamount)) {
                $i=$i+1;
?>
          <tr class="table-row">
            <td colspan="5"></td>      
            <td>Toltal</td>               
            <td><?php echo ($row["SumOfamount"]); ?></td>              
          </tr>
<?php
            }
   ?>
        </tbody>
    </table>

        </form>


    
    
</div>

    </div>   
   
    </body>
</html>
