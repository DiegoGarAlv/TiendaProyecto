$("#formModificarFamilia").submit(function(e){
    var bValido = true;
    var fam = document.getElementById("familia").value.trim();
    var nom = document.getElementById("nombre").value.trim();
    
    var regexLet = /[A-Za-z]/;    
    
    //Validacion codigo
    if(fam == 0)
    {
        document.getElementById("famval").style.display=""; 
        
        bValido=false;             
    }    
    else
    {
        document.getElementById("famval").style.display="none";        
    }

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

    if(!bValido)
    {
        e.preventDefault();
    }
    else
    {
        document.getElementById("famval").style.display="none";   
        document.getElementById("nomval").style.display="none";    
        document.getElementById("nomval2").style.display="none"; 
    }     
});