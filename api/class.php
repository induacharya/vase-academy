<?php

//Add class request
$app->post('/addClass', function ($request, $response, $args) {
$result =  new stdClass();
$responseData = array();

$param =  $request->getParsedBody();
$cname = $param['cname'];


$CurTime = time();

$Database=new Database();

$Database->query("SELECT * FROM class WHERE cname=:cname");
$DBParameters["cname"]=$cname;
$Database->bindParameters($DBParameters);
$Database->execute();
$ExeceptionDetails = $Database->getExceptionDetails();
$QryOutput=$Database->single();


if( $QryOutput){
    $responseData['status']="error";
    $responseData['message']="Class name already exists !";
}else{
    $Database->beginTransaction();

    $Insrtqry="INSERT INTO class (cname,createdtime,modifiedtime
    ) VALUES (:cname,FROM_UNIXTIME(:createdtime),FROM_UNIXTIME(:modifiedtime))";
                
    $insertParams= array('cname'=>$cname,'createdtime'=>$CurTime,'modifiedtime'=>$CurTime);
    
    $ExecutionDetails = $Database->executeQuery($Insrtqry, $insertParams);
    $ExecutionDetails['query']	= $Database->getQRY($Insrtqry, $insertParams);

    $Database->endTransaction();
    $responseData['status']="success";
    $responseData['message']="class name added successfully !";
}

echo json_encode($responseData);
});



//Get all the class details

$app->get('/getClassList', function ($request, $response, $args) {
    $result =  new stdClass();
    $Database=new Database();
    $responseData = array();
$Database->query("SELECT * FROM class");
$Database->execute();
$ExeceptionDetails = $Database->getExceptionDetails();
$QryOutput=$Database->resultset();
$responseData['status']="success";
$responseData['message']=" ";
$responseData['data']=$QryOutput;
    echo json_encode($responseData);
});    


//Update class request
$app->post('/updateClass', function ($request, $response, $args) {
    $result =  new stdClass();
    $responseData = array();
    
    $param =  $request->getParsedBody();
    
    $cname = $param['cname'];
    $cid = $param['cid'];

    $CurTime = time();
    
    $Database=new Database();
    
    $Database->query("SELECT * FROM class WHERE cname=:cname and cid != :cid");
    $DBParameters["cname"]=$cname;
    $DBParameters["cid"]=$cid;
    $Database->bindParameters($DBParameters);
    $Database->execute();
    $ExeceptionDetails = $Database->getExceptionDetails();
    $QryOutput=$Database->single();
    
    
    if( $QryOutput){
        $responseData['status']="error";
        $responseData['message']="class name already exists !";
    }else{
        $Database->beginTransaction();
    
        $Updateqry="UPDATE class set cname=:cname,modifiedtime=FROM_UNIXTIME(:modifiedtime)
    where cid=:cid";
                
    $UpdateParams= array('cid'=>$cid,'cname'=>$cname,'modifiedtime'=>$CurTime);
    
    $ExecutionDetails = $Database->executeQuery($Updateqry, $UpdateParams);
    $ExecutionDetails['query']	= $Database->getQRY($Updateqry, $UpdateParams);
    
        $Database->endTransaction();
        $responseData['status']="success";
        $responseData['message']="Updated successfully !";
    }
    
    echo json_encode($responseData);
    });

//Delete class request


$app->post('/deleteclass', function ($request, $response, $args) {
    $result =  new stdClass();
    $param =  $request->getParsedBody();
    $cId = $param['cId'];      
    $Database=new Database();

    $Database->query("SELECT classId FROM studentprofile WHERE classId=:cId");
    
    $DBParameters["cId"]=$cId;
    $Database->bindParameters($DBParameters);
    $Database->execute();
    $ExeceptionDetails = $Database->getExceptionDetails();
    $QryOutput=$Database->single();
    
    if(!empty($QryOutput))
    { 
        $responseData['status']="error";
        $responseData['message']="Student already register the Class.You cannot delet now!";
        echo json_encode($responseData);
        return;
    }
    else
    {


    $Database->beginTransaction();
    $DelOS="DELETE FROM class WHERE cId=:cId";
            
$DelParams= array('cId'=>$cId);

$ExecutionDetails = $Database->executeQuery($DelOS, $DelParams);
$ExecutionDetails['query']	= $Database->getQRY($DelOS, $DelParams);

if($ExecutionDetails['stat'])
{
    // $Errors["Dialogue"]=2;
    // GOTO ErrorInside;
    echo "<pre>";
    print_r($ExecutionDetails1);echo "</pre>";
    echo json_encode("deletion failure..");
}

$Database->endTransaction();
$responseData['status']="success";
$responseData['message']="Deleted successfully !";
    echo json_encode($responseData);
    }
});





/**
  *  class subject mapping 
  */
  $app->post('/Classsubmap', function ($request, $response, $args) {
    $result =  new stdClass();
    $responseData = array();
    
    $param =  $request->getParsedBody();
     
    $cId = $param['cId'];
    $sid = $param['sId'];
    $CurTime = time();
    $Database=new Database();

    $Database->beginTransaction();
    foreach($sid as $key => $value){
    
    $Insrtqry="INSERT INTO classSub (cid,sid,createdtime,modifiedtime
    ) VALUES (:cId,:sid,FROM_UNIXTIME(:createdtime),FROM_UNIXTIME(:modifiedtime))";
                
    $insertParams= array('cId'=>$cId,'sid'=>$value['sid'],
                         'createdtime'=>$CurTime,'modifiedtime'=>$CurTime);
    
    $ExecutionDetails = $Database->executeQuery($Insrtqry, $insertParams);
    $ExecutionDetails['query']  = $Database->getQRY($Insrtqry, $insertParams);
    
    //In data is not inserting enable below commented line
    if($ExecutionDetails['stat'])
    {
       // $Errors["Dialogue"]=2;
       // GOTO ErrorInside;
       echo "<pre>";
       print_r($ExecutionDetails);echo "</pre>";
       echo json_encode("insertion failure..");
       return;
    }

    }
    $Database->endTransaction();
    $responseData['status']="success";
    $responseData['message']="Class subject Assigned successfully..!";

    echo json_encode($responseData); 
    });
     

    /* api to get Classsub details */
    $app->get('/getClasssubmap', function ($request, $response, $args) {
    //$result =  new stdClass();
    $Database=new Database();
    $responseData = array();
    $Database->query("select * from classsub");
    $Database->execute();
    $ExeceptionDetails = $Database->getExceptionDetails();
    $QryOutput=$Database->resultset();
    $responseData['status']="success";
    $responseData['message']=" ";
    $responseData['data']=$QryOutput;
    echo json_encode($responseData);
    });


//Update class request
$app->post('/updateClass', function ($request, $response, $args) {
    $result =  new stdClass();
    $responseData = array();
    
    $param =  $request->getParsedBody();
    
    $cname = $param['cname'];
    $cid = $param['cid'];

    $CurTime = time();
    
    $Database=new Database();
    
    $Database->query("SELECT * FROM studentprofile WHERE cname=:cname and cid != :cid");
    $DBParameters["cname"]=$cname;
    $DBParameters["cid"]=$cid;
    $Database->bindParameters($DBParameters);
    $Database->execute();
    $ExeceptionDetails = $Database->getExceptionDetails();
    $QryOutput=$Database->single();
    
    
    if( $QryOutput){
        $responseData['status']="error";
        $responseData['message']="class name already exists !";
    }else{
        $Database->beginTransaction();
    
        $Updateqry="UPDATE class set cname=:cname,modifiedtime=FROM_UNIXTIME(:modifiedtime)
    where cid=:cid";
                
    $UpdateParams= array('cid'=>$cid,'cname'=>$cname,'modifiedtime'=>$CurTime);
    
    $ExecutionDetails = $Database->executeQuery($Updateqry, $UpdateParams);
    $ExecutionDetails['query']	= $Database->getQRY($Updateqry, $UpdateParams);
    
        $Database->endTransaction();
        $responseData['status']="success";
        $responseData['message']="Updated successfully !";
    }
    
    echo json_encode($responseData);
    });

    