$("#form").submit(function(){
    var usr = document.getElementById("usuario").value;
    var pas = document.getElementById("contrasena").value;
    
    if(usr == "")
    {
        document.getElementById("usrval").style.display="";  
        return false;               
    }
    else
    {
        document.getElementById("usrval").style.display="none";                   
    }
    
    if(pas == "")
    {
        document.getElementById("pasval").style.display="";
        return false;        
    }
    else
    {
        document.getElementById("pasval").style.display="none";
    } 

    if(usr != "" && pas != "")
    {
        document.getElementById("usrval").style.display="none";
        document.getElementById("pasval").style.display="none";
        return true;
    }    
});