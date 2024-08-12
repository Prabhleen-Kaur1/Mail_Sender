
var submit=document.querySelector("form");
submit.onsubmit=(e)=>{
    e.preventDefault();
    //document.querySelector("span").style.display="block";
    document.querySelector("span").style.color="black";
        let XHR=new XMLHttpRequest();
        // XHR.addEventListener("load",is);
        // XHR.addEventListener("error",on_error);
        XHR.open("POST","send_email.php",true);
        XHR.onload=()=>
        {
            if(XHR.readyState==4&&XHR.status==200)
            {
                    let response=XHR.response;   
                
                    if(response.indexOf('enter email and name correctly')!=-1||response.indexOf("enter a valid email address")!=-1||response.indexOf("Message could not be sent")!=-1||response.indexOf("Message has been sent")==-1)
                    {
                        
                        document.querySelector("span").style.color="red";
                        
                    }
                    else
                    {
                        submit.reset();
                        setTimeout(()=>
                        {
                            document.querySelector("span").innerHTML="Send Message";
                        },3000);
                    }
                    document.querySelector("span").innerHTML=response;
                    
            }
            
        }
        let formdata=new FormData(submit);
            XHR.send(formdata);
         
}