

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
    //console.log(url);
    var cleanedUrl = url.split('/')[2];
    let ipAddress = myarray.serverIPAddress;
    if(ipAddress[0]==='['){
      ipAddress = ipAddress.slice(1,-1);
    }
    console.log(ipAddress);

      $.getJSON( "https://freegeoip.app/json/"+ipAddress, function(newdata){
   
    cities = newdata.city;
    console.log(cities);    
    })
    let city = myarray.cities;
    //console.log(cleanedUrl);

    while(!!city){

    myobj[x] = {
        startedDateTime: myarray.startedDateTime,
        wait: myarray.timings.wait,
        serverIPAddress: ipAddress,
        request_method: myarray.request.method,
        request_URL: cleanedUrl,
        response_status: myarray.response.status,
        response_status_Text: myarray.response.statusText,
        city: city
        }
    //console.log(request_URL);
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
 
   // matchcity(myobj);
     postData(myobj);
      //postData(tempData);
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
          var ips_to_locations={};
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
  
  var latitude;
  var longitude;
  var provider;
  var city;
  

  $.getJSON('https://ipapi.co/json/', function(data){

    latitude = data.latitude;
    longitude = data.longitude;
    provider = data.org;
    console.log(longitude);
    console.log(latitude);
    //console.log(provider);

    //location = latitude.toFixed(4) + "," + longitude.toFixed(4);
   
    var moreData ={
      provider : provider,
      latitude : latitude,
      longitude : longitude
    }

    if(!!longitude, !!latitude, !!provider){
      console.log(provider);}

  }); 
 
  
  function postData(userData){
    /*for (let i=0; i<userData.length; i++)
    {
      let ipAddress = myobj[i].serverIPAddress;
      console.log(ipAddress);
        $.getJSON( "https://freegeoip.app/json/"+ipAddress, function(newdata){
     
      city = newdata.city;
      console.log(city);
  })
}
      */
    for (let i=0; i<userData.length; i++)
 {

      wait = userData[i].wait;
      request_method = userData[i].request_method;
      request_URL= myobj[i].request_URL;
      serverIPAddress = myobj[i].serverIPAddress;
      response_status = userData[i].response_status;
      response_status_Text = userData[i].response_status_Text;
      response_age = userData[i].response_age;
      request_age = userData[i].request_age;
      Request_content_type = userData[i].Request_content_type;
      Request_cache_control = userData[i].Request_cache_control;
      Request_pragma = userData[i].Request_pragma;
      Request_expires = userData[i].Request_expires;
      Request_last_modified = userData[i].Request_last_modified;
      Request_host = userData[i].Request_host;
      startedDateTime = userData[i].startedDateTime;
      Response_content_type = userData[i].Response_content_type;
      Response_cache_control = userData[i].Response_cache_control;
      Response_pragma = userData[i].Response_pragma;
      Response_expires = userData[i].Response_expires;
      Response_last_modified = userData[i].Response_last_modified;
      Response_host = userData[i].Response_host;
      longitude = longitude;
      latitude = latitude;
      provider = provider;
      city = userData[i].city;
      console.log(request_URL); 
      console.log(latitude);
      console.log(city);
     
              $.ajax({
               // url: '{{url("/user_dashboard")}}' ,
               url: '/user_dashboard',
                type: "POST",
                data: {
                
                  wait: wait, 
                  request_method: request_method,
                  request_URL: request_URL,
                  serverIPAddress: serverIPAddress,
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
                  longitude: longitude,
                  latitude: latitude,
                  provider: provider,
                  city: city
                  },
            
                cache: false,
                success: function(data){
			   
                }
              }); 
              
                 
              $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
  }
});  


}

event.preventDefault();

 alert(request_method); 
  
            
}

