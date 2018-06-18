$("#formDatos").submit(function(e){
    var bValido = true;
    
    var nom = document.getElementById("nombre").value.trim();
    var dir = document.getElementById("direccion").value.trim();    
    var con = document.getElementById("contrasena").value.trim(); 
    
    var regexLet = /[A-Za-z]/;
    var regexDni = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;
    var regexPass = /^(?=.*\d).{4,8}$/;

    //validacion nombre
    if(nom == "")
    {
        document.getElementById("nomval").style.display="";
        document.getElementById("nomval2").style.display="none";           
        bValido=false;
    }
    else if(regexLet.test(nom) == false)
    {
        document.getElementById("nomval").style.display="none";        
        document.getElementById("nomval2").style.display="";  
        bValido=false;             
    }
    else
    {
        document.getElementById("nomval").style.display="none";
        document.getElementById("nomval2").style.display="none";           
    } 
    //validacion direccion
    if(dir == "")
    {
        document.getElementById("dirval").style.display="";
        bValido=false;
    }
    else
    {
        document.getElementById("dirval").style.display="none";
    }

    //validacion contraseña
    if(con == "")
    {
        document.getElementById("pasval").style.display="";
        document.getElementById("pasval2").style.display="none";        
        bValido=false;
    }
    else if(regexPass.test(con) == false)
    {
        document.getElementById("pasval").style.display="none";
        document.getElementById("pasval2").style.display="";        
        bValido=false;
    }
    else
    {
        document.getElementById("pasval").style.display="none";
        document.getElementById("pasval2").style.display="none";        
    }

    if(!bValido)
    {
        e.preventDefault();
    }
    else
    {
        document.getElementById("nomval").style.display="none";        
        document.getElementById("dirval").style.display="none";
        document.getElementById("pasval").style.display="none";
        
        document.getElementById("nomval2").style.display="none";                       
        document.getElementById("pasval2").style.display="none";
        
    }    
});