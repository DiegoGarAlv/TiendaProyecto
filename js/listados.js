$("#generarListadoClientes").click(function(e){    
    $.ajax({
        url: "getDatos/clientes.php",
        type: "GET",
        async: true,        
        success: function(oClientes, sStatus, oAjax)
        {       
            var datosRecogidos = [];

            for (var i = 0 ; i< oClientes.length; i++)
            {                    
                var Clientes = oClientes[i]
                datosRecogidos.push(Clientes);
            }    
               
            var pdf = new jsPDF();
                pdf.text(20,20,"Listado de Clientes");

                pdf.text(20,30,"DNI");
                pdf.text(60,30,"Nombre");
                pdf.text(100,30,"Dirección");
                pdf.text(150,30,"Usuario");
                pdf.text(20,35,"---------------------------------------------------------------------------------------");

                var horizontal = 20;
                var vertical = 40;
                for (var i = 0 ; i< datosRecogidos.length; i++)
                {   
                    pdf.text(20,vertical,datosRecogidos[i].dni);
                    pdf.text(60,vertical,datosRecogidos[i].nombre);
                    pdf.text(100,vertical,datosRecogidos[i].direccion);
                    pdf.text(150,vertical,datosRecogidos[i].usuario);
                    vertical+=10;
                }
                pdf.save('ListadoClientes.pdf');            
                                            }        
        });
});
$("#generarListadoPedidos").click(function(e){    
    $.ajax({
        url: "getDatos/pedidos.php",
        type: "GET",
        async: true,        
        success: function(oPedidos, sStatus, oAjax)
        {       
            var datosRecogidos = [];

            for (var i = 0 ; i< oPedidos.length; i++)
            {                    
                var Pedidos = oPedidos[i]
                datosRecogidos.push(Pedidos);
            }        
               
            var pdf = new jsPDF();
                pdf.text(20,20,"Listado de Pedidos");
                
                pdf.text(20,30,"Nombre");
                pdf.text(60,30,"Pedido");
                pdf.text(100,30,"Fecha");
                pdf.text(150,30,"Total");
                pdf.text(20,35,"---------------------------------------------------------------------------------------");
                
                var horizontal = 20;
                var vertical = 40;
                for (var i = 0 ; i< datosRecogidos.length; i++)
                {   
                    pdf.text(20,vertical,datosRecogidos[i].nombre);
                    pdf.text(60,vertical,datosRecogidos[i].pedido);
                    pdf.text(100,vertical,datosRecogidos[i].fecha);
                    pdf.text(150,vertical,datosRecogidos[i].total);
                    vertical+=10;
                }
                pdf.save('ListadoPedidos.pdf');            
                                            }        
        });
});
$("#generarListadoProductos").click(function(e){    
    $.ajax({
        url: "getDatos/productos.php",
        type: "GET",
        async: true,        
        success: function(oProductos, sStatus, oAjax)
        {       
            var datosRecogidos = [];

            for (var i = 0 ; i< oProductos.length; i++)
            {                    
                var Productos = oProductos[i]
                datosRecogidos.push(Productos);
            }        
               
            var pdf = new jsPDF();
                pdf.text(20,20,"Listado de Productos");
                
                pdf.text(20,30,"Codigo");
                pdf.text(60,30,"Nombre");
                pdf.text(100,30,"NomCorto");
                pdf.text(130,30,"Precio");
                pdf.text(160,30,"Familia");
                pdf.text(20,35,"---------------------------------------------------------------------------------------");

                var horizontal = 20;
                var vertical = 40;
                for (var i = 0 ; i< datosRecogidos.length; i++)
                {   
                    pdf.text(20,vertical,datosRecogidos[i].codigo);
                    pdf.text(60,vertical,datosRecogidos[i].nombre);
                    pdf.text(100,vertical,datosRecogidos[i].corto);
                    pdf.text(130,vertical,datosRecogidos[i].precio);
                    pdf.text(160,vertical,datosRecogidos[i].familia);
                    vertical+=10;
                }
                pdf.save('ListadoProductos.pdf');            
                                            }        
        });
});
$("#generarListadoPedidosUser").click(function(e){    
    $.ajax({
        url: "getDatos/pedidosuser.php",
        type: "GET",
        async: true,        
        success: function(oPedidos, sStatus, oAjax)
        {       
            var datosRecogidos = [];

            for (var i = 0 ; i< oPedidos.length; i++)
            {                    
                var Pedidos = oPedidos[i]
                datosRecogidos.push(Pedidos);
            }        
               
            var pdf = new jsPDF();
                pdf.text(20,20,"Listado de Pedidos");
                
                pdf.text(20,30,"Nombre");
                pdf.text(60,30,"Pedido");
                pdf.text(100,30,"Fecha");
                pdf.text(150,30,"Total");
                pdf.text(20,35,"---------------------------------------------------------------------------------------");
                
                var horizontal = 20;
                var vertical = 40;
                for (var i = 0 ; i< datosRecogidos.length; i++)
                {   
                    pdf.text(20,vertical,datosRecogidos[i].nombre);
                    pdf.text(60,vertical,datosRecogidos[i].pedido);
                    pdf.text(100,vertical,datosRecogidos[i].fecha);
                    pdf.text(150,vertical,datosRecogidos[i].total);
                    vertical+=10;
                }
                pdf.save('ListadoPedidos.pdf');            
                                            }        
        });
});