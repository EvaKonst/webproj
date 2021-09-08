<?php
    include "../app/config/database.php";
   // session_start();

 //   $userData = json_decode($_POST['userData']);

    
 //   $user_email = $_SESSION['useremail'];
 //   $user_location = $userData->location;
 //   $user_provider = $userData->provider;
    
 //selects records for specific provider  
 //   $sql_select_prov = "SELECT *
 //           FROM provider
 //           WHERE name=\"$user_provider\" ";

 //   $query_result = mysqli_query($conn,$sql_select_prov );

    
 //   if($row = mysqli_fetch_assoc($query_result )){
 //       $provider_id = $row['id'];

  //  }
  //  else{
  //      $sql_insert_prov = "INSERT INTO provider(name) VALUES (\"$user_provider\")";
  //      $run = mysqli_query($conn, $sql_insert_prov );
  //      $provider_id = $conn->insert_id;
  //  }

    
 //   $sql_insert_upload = "INSERT INTO uploads(`id`, `userEmail`, `uploadDatetime`, `location`, `provider`) 
 //                       VALUES (NULL, \"$user_email\",NOW(),\"$user_location\", $provider_id) ";
 //   $run = mysqli_query($conn, $sql_insert_upload );
    //retrieve id of new insert
 //   $last_upload_id=$conn->insert_id;


    //creates array: inserts
    $inserts=array();

    //calls the data part of userData an myobj
    foreach($userData->data as $myobj){
        //passes the arguments found in myobj aka data of userData

        //timings
        $wait=$myobj->wait;

        //request_method
        $request_method=$myobj->request_method;
        //request_URL
        $url=$myobj->request_URL;
        //response_status
        $response_status=$myobj->response_status;
        //response_status_Text
        $response_status_Text=$myobj->response_status_Text;
        //serverLocation from getUploadData function
        $res_serverLocation = $myobj->serverLocation;
        //response-headers-depended vars
        //Response_age
        $response_age =  $myobj->response_age;  
        $request_age =  $myobj->request_age; 
    //    $res_TTL="NULL";  //
    //    $can_ttl_be_changed=1; //if ttl is set by cache control no other header should change it
        //Response_content_type
        $Request_content_type =  $myobj->Request_content_type; 
        $Request_cache_control =  $myobj->Request_cache_control;
        $Request_pragma =  $myobj->Request_pragma; 
        $Request_expires =  $myobj->Request_expires; 
        $Request_last_modified =  $myobj->$Request_last_modified; 
        $Request_host =  $myobj->$Request_host; 
   //     $res_cacheability="no-cache";
   //     $can_cacheability_be_changed=1;//if cacheability is set by cache control no other header should change it
   //     $res_hasMinFresh=0;
   //     $res_hasMaxStale=0;
        //startedDateTime
        $datetime=$myobj->startedDateTime;
        $Response_content_type =  $myobj->Response_content_type; 
        $Response_cache_control =  $myobj->Response_cache_control;
        $Response_pragma =  $myobj->Response_pragma; 
        $Response_expires =  $myobj->Response_expires; 
        $Response_last_modified =  $myobj->$Response_last_modified; 
        $Response_host =  $myobj->$Response_host; 
        
        //checking the response headers and saving their values
/*        $res_headers=$myobj->response->headers;
        foreach($res_headers as $header){
            $name=$header->name;
            switch($name){
                case "age":
                    $res_age=$header->value;
                    break;
                case "content-type":
                    $res_contentType=$header->value;
                    $temp=array_map("trim",explode(";", $res_contentType));
                    $res_contentType="\"$temp[0]\"";
                    break;
                case "cache-control":
                    //cache-control is seperated
                    $cc=array_map("trim",preg_split('/(,|;)/', $header->value));
                    foreach($cc as $cc_value){
                        switch($cc_value){
                            case "public":
                                $res_cacheability="public";
                                $can_cacheability_be_changed=0;
                                break;
                            case "private":
                                $res_cacheability="private";
                                $can_cacheability_be_changed=0;
                                break;
                            case "no-cache":
                                $res_cacheability="no-cache";
                                $can_cacheability_be_changed=0;
                                break;
                            case "no-store":
                                $res_cacheability="no-store";
                                $can_cacheability_be_changed=0;
                                break;
                            default:
                                $temp=array_map("trim",explode("=", $cc_value));
                                if($temp[0]=="max-age"){
                                    $res_TTL=$temp[1];
                                    $can_ttl_be_changed=0;
                                }elseif($temp[0]=="min-fresh"){
                                    $res_hasMinFresh=1;
                                }elseif($temp[0]=="max-stale"){
                                    $res_hasMaxStale=1;
                                }
                                break;
                        }
                    }
                    break;
                case "pragma":
                    if($can_cacheability_be_changed){
                        $res_cacheability=$header->value;
                    }
                    break;
                case "expires":
                    if($can_ttl_be_changed){
                        $temp=strtotime($header->value)-strtotime($datetime);
                        if($temp>0){
                            $res_TTL=$temp;
                        }
                    }
                    break;
                default:
                    break;
            }
        }

        //isCached is set after the end of headers
        $res_isCached=($res_cacheability=="no-cache"||$res_cacheability=="no-store")? 0:1;
        if($res_cacheability!="NULL"){$res_cacheability="\"$res_cacheability\"";}//not to insert "NULL"
        $res_statusText=($res_statusText=="")?"\"void\"":"\"$res_statusText\"";
        $day=date( "N", strtotime($datetime)); 
        $hour=(new DateTime($datetime))->format('H');
        $minutes = (new DateTime($datetime))->format('i');

        if($minutes>30){
            $hour = $hour + 1;
        }
 */      
        $inserts[]="($last_upload_id, \"$res_serverLocation\",  $wait, \"$method\", \"$url\", $res_status, $res_statusText, $res_age, $res_TTL, $res_contentType, $res_cacheability, $res_isCached, $res_hasMinFresh, $res_hasMaxStale, $day, \"$hour\")";

    }

    
    
    $inserts_piecies=array_chunk($inserts,6500);
    $insert_entries_stmt=array();
    for($i=0; $i<count($inserts_piecies);$i++ ){
        
        $insert_entries_stmt[$i]="INSERT INTO `entries`( `upload`, `serverLocation`, `timingsWait`, `request_method`, `request_url`, `response_status`, `response_statusTest`, `response_age`, `response_TTL`, `response_contentType`, `response_cacheability`, `response_isCached`, `response_hasMinFresh`, `response_hasMaxStale`, `day`, `time`) VALUES ".implode(',', $inserts_piecies[$i]);
        
        if($conn->query($insert_entries_stmt[$i])===TRUE){
            echo "Done " . $i . PHP_EOL;
        }else{
            echo "Error:" . $conn->error;
        }
    }
    
    


?>