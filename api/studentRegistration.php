<?php    

$app->post('/addstudentprofile', function ($request, $response, $args) {
    $result =  new stdClass();
    $responseData = array();
    $param =  $request->getParsedBody();
 
   
    $name = $param['name'];
    $uname = $param['uname'];
    $upassword = $param['upassword'];
    $father_name = $param['father_name'];
    $emailid = $param['emailid'];
    $mobilenumber = $param['mobilenumber'];
    $dob = $param['dob'];
    $gender = $param['gender'];
    $address = $param['address'];
    $className = $param['className'];
    $subjectName = $param['subjectName'];
    $verifyemail = 0;
    $utype = 'U';
    $token = '';
    $profilepicurl = '';

    $CurTime = time();
    $Database=new Database();    
    
    //Check for existing email id
    $Database->query("SELECT emailid FROM studentprofile WHERE emailid=:emailid");
    
    $DBParameters["emailid"]=$emailid;
    $Database->bindParameters($DBParameters);
    $Database->execute();
    $ExeceptionDetails = $Database->getExceptionDetails();
    $QryOutput=$Database->single();
    
    if(!empty($QryOutput))
    { 
        $responseData['status']="error";
        $responseData['message']="Email Already Exists!";
        echo json_encode($responseData);
        return;
    }
    else
    {
        //Check for mobile number
        $Database->query("SELECT mobilenumber FROM studentprofile WHERE mobilenumber=:mobilenumber");
    
        $DBParameters1["mobilenumber"]=$mobilenumber;
        $Database->bindParameters($DBParameters1);
        $Database->execute();
        $ExeceptionDetails4 = $Database->getExceptionDetails();
        $QryOutput1=$Database->single();
    
        if(!empty($QryOutput1))
        { 
            $responseData['status']="error";
            $responseData['message']="Mobile Number Already Exists!";
            echo json_encode($responseData);
            return;
        }
        else
        {
            $Database->beginTransaction();
            $verifyemail=0;
           
            $InsrtQry="INSERT INTO studentprofile (emailid, mobilenumber, verifyemail, dob, name, uname, address, gender, father_name, className, subjectName, profilepicurl,  createdtime, modifiedtime) 
            VALUES (:emailid, :mobilenumber, :verifyemail, :dob, :name, :uname, :address, :gender, :father_name, :className, :subjectName, :profilepicurl,  FROM_UNIXTIME(:createdtime), FROM_UNIXTIME(:modifiedtime))";
                        


            $InsrtParams= array('emailid'=>$emailid, 'mobilenumber'=>$mobilenumber, 'verifyemail'=>$verifyemail, 'dob'=>$dob, 'name'=>$name, 'uname'=>$uname, 'address'=>$address, 'gender'=>$gender, 'father_name'=>$father_name, 'className'=>$className, 'subjectName'=>$subjectName, 'profilepicurl'=>$profilepicurl, 'createdtime'=>$CurTime,'modifiedtime'=>$CurTime);

  
            $ExecutionDetails = $Database->executeQuery($InsrtQry, $InsrtParams);
            $ExecutionDetails['query']	= $Database->getQRY($InsrtQry, $InsrtParams);

            if($ExecutionDetails['stat']) {
                // $Errors["Dialogue"]=2;
                // GOTO ErrorInside;
                echo "<pre>";
                print_r($ExecutionDetails);echo "</pre>";
                echo json_encode("udpation failure..");
                return;
            }    
           
            $sid = $Database->lastInsertId();

            $InsrtQry1="INSERT INTO users (uemail, upassword, utype, token, createdtime, modifiedtime) values (:uemail, :upassword, :utype, :token, FROM_UNIXTIME(:createdtime), FROM_UNIXTIME(:modifiedtime))";
                        
            $InsrtParams1= array('uemail'=>$emailid, 'upassword'=>$upassword, 'utype'=>$utype, 'token'=>$token, 'createdtime'=>$CurTime,'modifiedtime'=>$CurTime);

            $ExecutionDetails2 = $Database->executeQuery($InsrtQry1, $InsrtParams1);
            $ExecutionDetails2['query']	= $Database->getQRY($InsrtQry, $InsrtParams1);

             

            $uploadedFile='';
            $uploadedFiles = $request->getUploadedFiles();
            if($uploadedFile != ''){
            //To get directory
            $app = new \Slim\App();
            $container = $app->getContainer();
            $container['upload_directory'] = __DIR__ . '/profilePic';
            $directory = $container['upload_directory'];
            
            $uploadedFiles = $request->getUploadedFiles();
            $uploadedFile = $uploadedFiles['proiflepicupload'];
            
            // handle single input with single file upload
            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            
                $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
                $basename = $sid;
                $filename = sprintf('%s.%0.8s', $basename, $extension);
            
                $newfilename = $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

                //update profilepic
                $profilepicurl=$directory."\\".$filename;
                $UpdateURL="UPDATE studentprofile SET profilepicurl=:profilepicurl, modifiedtime=FROM_UNIXTIME(:CurTime) WHERE stid=:sid";
                
                $UpdtURLParams= array('profilepicurl'=>$profilepicurl,'stid'=>$sid,'CurTime'=>$CurTime);

                $ExecutionDetails1 = $Database->executeQuery($UpdateURL, $UpdtURLParams);
                $ExecutionDetails1['query']	= $Database->getQRY($UpdateURL, $UpdtURLParams);

                

                /*if($ExecutionDetails1['stat']) {
                    // $Errors["Dialogue"]=2;
                    // GOTO ErrorInside;
                    echo "<pre>";
                    print_r($ExecutionDetails1);echo "</pre>";
                    echo json_encode("udpation failure..");
                    return;
                }     */
                 //In data is not inserting enable below commented line
   

            }

        }

            // Start - Sending Mail
            // $mail_template = '';
            // $link = '<a href="http://localhost:8080/vase-academy/api/emailverification?stid='.$stid.'">';
            // $mail_template.='<br> Hi '.$firstname.', <br><br> Please click below link to verify email address<br><br>'.$link;
            // $mail_to = $emailid;
            // $subject = 'Dracs Online Portal Email Verification';
            // require("mail.php");
            // End - Sending Mail

            // // Start - Sending SMS
            // $sms_template = '';
            // $sms_template.='Hi '.$firstname.', ';
            // $sms_template.='Please click below link to verify email address';
            // $mobile = $mobilenumber;
            // require("sms.php");
            // // End - Sending SMS

            $Database->endTransaction();
            $responseData['status']="success";
            $responseData['message']="Registered successfully. Please verify your mail address";
        }
    }
    
    echo json_encode($responseData);
});


//Add Teachers Profiles 




$app->post('/addTeacherprofile', function ($request, $response, $args) {
    $result =  new stdClass();
    $responseData = array();
    $param =  $request->getParsedBody();
 
   
    $Teachername = $param['Teachername'];
    $emailid = $param['emailid'];
    $mobilenumber = $param['mobilenumber'];
    $password =$param['password'];
  
    $CurTime = time();
    $Database=new Database();    
    
    //Check for existing email id
    $Database->query("SELECT emailid FROM teacherprofile WHERE emailid=:emailid");
    
    $DBParameters["emailid"]=$emailid;
    $Database->bindParameters($DBParameters);
    $Database->execute();
    $ExeceptionDetails = $Database->getExceptionDetails();
    $QryOutput=$Database->single();
    
    if(!empty($QryOutput))
    { 
        $responseData['status']="error";
        $responseData['message']="Email Already Exists!";
        echo json_encode($responseData);
        return;
    }
    else
    {
        //Check for mobile number
        $Database->query("SELECT mobilenumber FROM teacherprofile WHERE mobilenumber=:mobilenumber");
    
        $DBParameters1["mobilenumber"]=$mobilenumber;
        $Database->bindParameters($DBParameters1);
        $Database->execute();
        $ExeceptionDetails4 = $Database->getExceptionDetails();
        $QryOutput1=$Database->single();
    
        if(!empty($QryOutput1))
        { 
            $responseData['status']="error";
            $responseData['message']="Mobile Number Already Exists!";
            echo json_encode($responseData);
            return;
        }
        else
        {
            $Database->beginTransaction();
                     
            $InsrtQry="INSERT INTO teacherprofile (emailid,password, mobilenumber, Teachername,  createdtime, modifiedtime) 
            VALUES (:emailid,:password, :mobilenumber, :Teachername, FROM_UNIXTIME(:createdtime), FROM_UNIXTIME(:modifiedtime))";

            $InsrtParams= array('emailid'=>$emailid,'password'=>$password,'mobilenumber'=>$mobilenumber,'Teachername'=>$Teachername, 'createdtime'=>$CurTime,'modifiedtime'=>$CurTime);

  
            $ExecutionDetails = $Database->executeQuery($InsrtQry, $InsrtParams);
            $ExecutionDetails['query']	= $Database->getQRY($InsrtQry, $InsrtParams);

            if($ExecutionDetails['stat']) {
                // $Errors["Dialogue"]=2;
                // GOTO ErrorInside;
                echo "<pre>";
                print_r($ExecutionDetails);echo "</pre>";
                echo json_encode("udpation failure..");
                return;
            }    
           
           
            $Database->endTransaction();
            $responseData['status']="success";
            $responseData['message']="Registered successfully. Please verify your mail address";
        }
    }
    
    echo json_encode($responseData);
});
