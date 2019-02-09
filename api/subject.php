<?php

//Add subject request
$app->post('/addSubject', function ($request, $response, $args) {
    $result =  new stdClass();
    $responseData = array();
    
    $param =  $request->getParsedBody();
    $sname = $param['sname'];
    
    $CurTime = time();
    
    $Database=new Database();
    
    $Database->query("SELECT * FROM subject WHERE sname=:sname");
    $DBParameters["sname"]=$sname;
    $Database->bindParameters($DBParameters);
    $Database->execute();
    $ExeceptionDetails = $Database->getExceptionDetails();
    $QryOutput=$Database->single();
    
    
    if( $QryOutput){
        $responseData['status']="error";
        $responseData['message']="Subject name already exists !";
    }else{
        $Database->beginTransaction();
    
        $Insrtqry="INSERT INTO subject (sname,createdtime,modifiedtime
        ) VALUES (:sname,FROM_UNIXTIME(:createdtime),FROM_UNIXTIME(:modifiedtime))";
                    
        $insertParams= array('sname'=>$sname,'createdtime'=>$CurTime,'modifiedtime'=>$CurTime);
        
        $ExecutionDetails = $Database->executeQuery($Insrtqry, $insertParams);
        $ExecutionDetails['query']	= $Database->getQRY($Insrtqry, $insertParams);
        //In data is not inserting enable below commented line
        /*if($ExecutionDetails['stat'])
        {
            // $Errors["Dialogue"]=2;
            // GOTO ErrorInside;
            echo "<pre>";
            print_r($ExecutionDetails);echo "</pre>";
            echo json_encode("insertion failure..");
            return;
        }  */
        $Database->endTransaction();
        $responseData['status']="success";
        $responseData['message']="Subject name added successfully !";
    }
    
    echo json_encode($responseData);
    });


  //Get all the subject details

  $app->get('/getSubjectList', function ($request, $response, $args) {
    $result =  new stdClass();
    $Database=new Database();
    $responseData = array();
$Database->query("SELECT * FROM Subject");
$Database->execute();
$ExeceptionDetails = $Database->getExceptionDetails();
$QryOutput=$Database->resultset();
$responseData['status']="success";
$responseData['message']=" ";
$responseData['data']=$QryOutput;
    echo json_encode($responseData);
});


//Update subject request
$app->post('/updateSubject', function ($request, $response, $args) {
    $result =  new stdClass();
    $responseData = array();
    
    $param =  $request->getParsedBody();
    
    $sname = $param['sname'];
    $sid = $param['sid'];

    $CurTime = time();
    
    $Database=new Database();
    
    $Database->query("SELECT * FROM subject WHERE sname=:sname and sid != :sid");
    $DBParameters["sname"]=$sname;
    $DBParameters["sid"]=$sid;
    $Database->bindParameters($DBParameters);
    $Database->execute();
    $ExeceptionDetails = $Database->getExceptionDetails();
    $QryOutput=$Database->single();
    
    
    if( $QryOutput){
        $responseData['status']="error";
        $responseData['message']="subject name already exists !";
    }else{
        $Database->beginTransaction();
    
        $Updateqry="UPDATE subject set sname=:sname,modifiedtime=FROM_UNIXTIME(:modifiedtime)
    where sid=:sid";
                
    $UpdateParams= array('sid'=>$sid,'sname'=>$sname,'modifiedtime'=>$CurTime);
    
    $ExecutionDetails = $Database->executeQuery($Updateqry, $UpdateParams);
    $ExecutionDetails['query']	= $Database->getQRY($Updateqry, $UpdateParams);
    
        $Database->endTransaction();
        $responseData['status']="success";
        $responseData['message']="Updated successfully !";
    }
    
    echo json_encode($responseData);
    });

  //Delete class request


$app->post('/deleteSubject', function ($request, $response, $args) {
    $result =  new stdClass();
    $param =  $request->getParsedBody();
    $sId = $param['sId'];      
    $Database=new Database();

    $Database->query("SELECT subjectId FROM studentprofile WHERE 
                        FIND_IN_SET((SELECT sid FROM subject WHERE sid=:sId), subjectId)");
    
    $DBParameters["sId"]=$sId;
    $Database->bindParameters($DBParameters);
    $Database->execute();
    $ExeceptionDetails = $Database->getExceptionDetails();
    $QryOutput=$Database->single();
    
    if(!empty($QryOutput))
    { 
        $responseData['status']="error";
        $responseData['message']="Student already register to the Subject.You cannot delet now!";
        echo json_encode($responseData);
        return;
    }
    else
    {


    $Database->beginTransaction();
    $DelOS="DELETE FROM subject WHERE sId=:sId";
            
$DelParams= array('sId'=>$sId);

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






//Update classsub  request
$app->post('/updateclasssubmap', function ($request, $response, $args) {
    $result =  new stdClass();
    $responseData = array();
    
    $param =  $request->getParsedBody();
    
    $cmap = $param['cmap'];
    $sid = $param['sid'];

    $CurTime = time();
    
    $Database=new Database();
    
    $Database->query("SELECT * FROM subject WHERE cmap=:cmap");
    $DBParameters["cmap"]=$cmap;
    $DBParameters["sid"]=$sid;
    $Database->bindParameters($DBParameters);
    $Database->execute();
    $ExeceptionDetails = $Database->getExceptionDetails();
    $QryOutput=$Database->single();
    
    
    if( $QryOutput){
        $responseData['status']="error";
        $responseData['message']="Class name already exists !";
    }else{
        $Database->beginTransaction();
    
        $Updateqry="UPDATE subject set cmap=:cmap,modifiedtime=FROM_UNIXTIME(:modifiedtime)
    where sid=:sid";
                
    $UpdateParams= array('sid'=>$sid,'cmap'=>$cmap,'modifiedtime'=>$CurTime);
    
    $ExecutionDetails = $Database->executeQuery($Updateqry, $UpdateParams);
    $ExecutionDetails['query']	= $Database->getQRY($Updateqry, $UpdateParams);
    
        $Database->endTransaction();
        $responseData['status']="success";
        $responseData['message']="Updated successfully !";
    }
    
    echo json_encode($responseData);
    });

    //POST all the class details

    $app->post('/getClasssubmap', function ($request, $response, $args) {
        $result =  new stdClass();
        $Database=new Database();
        $responseData = array();
        $param =  $request->getParsedBody();  
        $cid = $param['cid'];
    $Database->query("SELECT sid,sname FROM subject WHERE 
                      FIND_IN_SET((SELECT cid FROM class WHERE cid=:cid), cmap) ");
    $Database->execute();
    $ExeceptionDetails = $Database->getExceptionDetails();
    $QryOutput=$Database->resultset();
    $responseData['status']="success";
    $responseData['message']=" ";
    $responseData['data']=$QryOutput;
        echo json_encode($responseData);
    });   
   