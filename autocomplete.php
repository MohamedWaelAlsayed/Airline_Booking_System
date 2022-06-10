<?php
    require_once('connect.php');
    $search=$_GET['term'];
    $sql="select * from [airlineresvervationsystem].[dbo].[airport] where City like '%".$search."%' order by City";
    $result=sqlsrv_query($db,$sql, array(), array( "Scrollable" => 'keyset' ));
    $sdata=array();
    if(sqlsrv_num_rows($result)>0){
        while($row=sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
            $data['id']=$row['Airport_ID'];
            $data['value']=$row['City'];
            array_push($sdata,$data);
        }
    }

echo json_encode($sdata);
?>
