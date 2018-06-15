$("#form").submit(function(e){
    var bValido = true;
    var usr = document.getElementById("usuario").value;
    var pas = document.getElementById("contrasena").value;
    
    if(usr == "")
    {
        document.getElementById("usrval").style.display="";  
        bValido=false;             
    }
    else
    {
        document.getElementById("usrval").style.display="none";                   
    }
    
    if(pas == "")
    {
        document.getElementById("pasval").style.display="";
        bValido=false;
    }
    else
    {
        document.getElementById("pasval").style.display="none";
    } 
    if(!bValido)
    {
        e.preventDefault();
    }
    else if(usr != "" && pas != "")
    {
        document.getElementById("usrval").style.display="none";
        document.getElementById("pasval").style.display="none";       
    }    
});