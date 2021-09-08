

document.getElementById('inputfile') 
.addEventListener('change', function() { 

const fr=new FileReader(); 
fr.onload=function(){       
var myfileobj = JSON.parse(fr.result);

const entries = myfileobj.log.entries;
myobj = [];

for (x in entries) {
    
    let myarray = entries[x];
    let url = myarray.request.url;
    var new_url = url.replace('http://','').replace('https://','').split(/[/?#]/)[0];

    myobj[x] = {
        startedDateTime: myarray.startedDateTime,
        wait: myarray.timings.wait,
        serverIPAddress: myarray.serverIPAddress,
        request_method: myarray.request.method,
        request_URL: new_url,
        response_status: myarray.response.status,
        response_status_Text: myarray.response.statusText
        };
    
    for(y in myarray.request.headers){
        
        let headerName1 = myarray.request.headers[y].name;
        let headerValue1 = myarray.request.headers[y].value;

        if (headerName1 === "content-type")
        {
            myobj[x].Request_content_type = headerValue1;
        }
        else if (headerName1 === "host")
        {
            myobj[x].Request_host = headerValue1;
        }
        else if (headerName1 === "age")
        {
            myobj[x].Request_age = headerValue1;
        }
        else if (headerName1 === "expires")
        {
            myobj[x].Request_expires = headerValue1;
        }
        else if (headerName1 === "pragma")
        {
            myobj[x].Request_pragma = headerValue1;
        }
        else if (headerName1 === "cache-control")
        {
            myobj[x].Request_cache_control = headerValue1;
        }
        else if (headerName1 === "last-modified")
        {
            myobj[x].Request_last_modified = headerValue1;
        }
    }
    
    for(y in myarray.response.headers){
        
        let headerName = myarray.response.headers[y].name;
        let headerValue = myarray.response.headers[y].value;

        if (headerName === "content-type")
        {
            myobj[x].Response_content_type = headerValue;
        }
        else if (headerName === "host")
        {
            myobj[x].Response_host = headerValue;
        }
        else if (headerName === "age")
        {
            myobj[x].Response_age = headerValue;
        }
        else if (headerName === "expires")
        {
            myobj[x].Response_expires = headerValue;
        }
        else if (headerName === "pragma")
        {
            myobj[x].Response_pragma = headerValue;
        }
        else if (headerName === "cache-control")
        {
            myobj[x].Response_cache_control = headerValue;
        }
        else if (headerName === "last-modified")
        {
            myobj[x].Response_last_modified = headerValue;
        }
    }
    console.log(myobj[x]);
}
};          
fr.readAsText(this.files[0]);
}) 

function exportJson(el) {
       {
        var data = "text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(myobj));
        // what to return in order to show download window?
        el.setAttribute("href", "data:"+data);
        el.setAttribute("download", "cleanedhar.har");    
        }
      }    

      
var uploadJSON = document.getElementById("uploadJSON");

uploadJSON.addEventListener("click",()=>{
 uploadJson();
   });

function uploadJson(){
//uploadJSON.addEventListener("click",()=>{
   // getUploadData().then(result=>{
  //      findUserData().then(data=>{
    
  //        var tempData = {
  //          location: data.location,
   //         provider: data.provider,
   //         data: result.uploadData
   //       };
        postData(myobj)
        //  postData(tempData);
   //     }) 
  //  })
//});

}

function getUploadData(){
    //a promise is a returned object to which you attach callbacks, instead of passing callbacks into a function
    return new Promise((resolve,reject)=>{
      uploadData = [...myobj]
  
      let queries=0;
      var current_ips = [];
      var api_calls = [];
      var latitude;
      var longitude;
  
      for(let i=0; i<uploadData.length; i++){
  
          
  
  
          let ipAddress = uploadData[i].serverIPAddress;
          //In case there is a IPv6 address
          //they brackets that should be removed
          if(ipAddress[0]==='['){   
            ipAddress = ipAddress.slice(1,-1);
          }
        
          if(!ips_to_locations.hasOwnProperty(ipAddress) && !current_ips.includes(ipAddress)){
            current_ips.push(ipAddress);
            
            queries++;
            api_calls.push(
  
              $.ajax({
                type: 'GET',
                url: "https://freegeoip.app/json/"+ipAddress,
                crossDomain: true,
                dataType: 'json',
                success: function(data){
                  serverlocation = data.latitude+','+data.longitude;
                  ips_to_locations[ipAddress] =serverlocation;
                  uploadData[i].serverLocation = serverlocation;
                }
             })
            );
              
          }
      }
        $.when(...api_calls)
        .then((data)=>{
          for(let i=0; i<uploadData.length; i++){
            let ipAddress = uploadData[i].serverIPAddress;
            if(ipAddress[0]==='['){
              ipAddress = ipAddress.slice(1,-1);
            }
           
            if(!uploadData[i].hasOwnProperty('serverLocation')){
              uploadData[i].serverLocation = ips_to_locations[ipAddress];
            }
  
          }
          console.log(uploadData.length,queries);
          const result={
            uploadData: uploadData,
            uniqueIPs: queries
          };
  
          resolve(result);
        })
        .catch((err)=>{
          reject(err);
        });
    });
  
  }
  
function postData(userData){

 //   $.post("../database/upload_to_database.php",{userData: JSON.stringify(userData)},(res)=>{
 //     console.log(res);
  //  });

  
  
      wait= userData[1].wait;
      request_method= userData[1].request_method;
      url= userData[1].url;
      response_status = userData[1].response_status;
      response_status_Text = userData[1].response_status_Text;
      response_age = userData[1].response_age;
      request_age= userData[1].request_age;
      Request_content_type= userData[1].Request_content_type;
      Request_cache_control= userData[1].Request_cache_control;
      Request_pragma = userData[1].Request_pragma;
      Request_expires= userData[1].Request_expires;
      Request_last_modified= userData[1].Request_last_modified;
      Request_host = userData[1].Request_host;
      startedDateTime= userData[1].startedDateTime;
      Response_content_type= userData[1].Response_content_type;
      Response_cache_control= userData[1].Response_cache_control;
      Response_pragma= userData[1].Response_pragma;
      Response_expires= userData[1].Response_expires;
      Response_last_modified = userData[1].Response_last_modified;
      Response_host= userData[1].Response_host;
      console.log(wait);

              $.ajax({
               // url: '{{url("/user_dashboard")}}' ,
               url: '/user_dashboard',
                type: "POST",
                data: {
                
                  wait: wait, 
                  request_method: request_method,
                  url: url,
                  response_status : response_status,
                  response_status_Text : response_status_Text,
                  response_age : response_age,
                  request_age: request_age,
                  Request_content_type: Request_content_type,
                  Request_cache_control: Request_cache_control,
                  Request_pragma: Request_pragma,
                  Request_expires: Request_expires,
                  Request_last_modified: Request_last_modified,
                  Request_host: Request_host,
                  startedDateTime: startedDateTime,
                  Response_content_type: Response_content_type,
                  Response_cache_control: Response_cache_control,
                  Response_pragma: Response_pragma,
                  Response_expires: Response_expires,
                  Response_last_modified : Response_last_modified,
                  Response_host: Response_host,
                  },
            
                cache: false,
                success: function(data){
			   
                }
              }); 

              $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});  
 event.preventDefault();
 
            alert(request_method); 
            

}
   
