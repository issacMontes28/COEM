//Función para agregar una nueva venta y agregarla a un arreglo,
//el cuál se enviará para guardar en base de datos .
function Venta(elemento){
 this.id_cliente=ko.observable(elemento.id_cliente);
 this.id_producto=ko.observable(elemento.id_producto);
 this.producto=ko.observable(elemento.producto);
 this.cantidad=ko.observable(elemento.cantidad);
 this.subtotal=ko.observable(elemento.subtotal);
 this.formaPago=ko.observable(elemento.formaPago);
 this.promocion=ko.observable(elemento.promocion);
}
//Función para agregar promociones
function Promocion(elemento){
 this.id=ko.observable(elemento.id);
 this.nombre=ko.observable(elemento.nombre);
 this.descripcion=ko.observable(elemento.descripcion);
 this.tipo=ko.observable(elemento.tipo);
}
//Función para agregar productos asociados a las promociones
function PromotionProduct(elemento){
 this.id=ko.observable(elemento.id);
 this.id_producto=ko.observable(elemento.id_producto);
 this.id_promocion=ko.observable(elemento.id_promocion);
 this.cantidad_productos=ko.observable(elemento.cantidad_productos);
 this.precio=ko.observable(elemento.precio);
}

//Función  que crea objetos de tipo Cita, los cuáles se guardan en un arreglo para
//posteriormente cargarlos como opciones en el <selec></select> .
function Cita(elemento){
 this.id=ko.observable(elemento.id);
 this.id_cliente=ko.observable(elemento.id_cliente);
 this.paciente=ko.observable(elemento.paciente);
 this.tipo_cita=ko.observable(elemento.tipo_cita);
 this.id_producto=ko.observable(elemento.id_producto);
 this.producto=ko.observable(elemento.producto);
 this.cantidad=ko.observable(elemento.cantidad);
 this.subtotal=ko.observable(elemento.subtotal);
 this.precio_cita=ko.observable(elemento.precio_cita);
 this.precio_cita_tarjeta=ko.observable(elemento.precio_cita_tarjeta);
 this.fecha=ko.observable(elemento.fecha);
 this.hora=ko.observable(elemento.hora);
 this.division=ko.observable(elemento.division);
 this.id_promocion=ko.observable(elemento.id_promocion);
 this.promocion=ko.observable(elemento.promocion);
}

//Función  que crea objetos de tipo Cliente, los cuáles se guardan en un arreglo para
//posteriormente cargarlos como opciones en el <selec></select> .
function Cliente(elemento){
 this.id=ko.observable(elemento.id);
 this.nombre=ko.observable(elemento.cliente);
 this.correo=ko.observable(elemento.correo);
 this.fecha_inicio=ko.observable(elemento.fecha_inicio);
 this.peso=ko.observable(elemento.peso);
}

//Función  que crea objetos de tipo Producto, los cuáles se guardan en un arreglo para
//posteriormente cargarlos como opciones en el <selec></select> .
function Producto(elemento){
 this.id=ko.observable(elemento.id);
 this.nombre=ko.observable(elemento.nombre);
 this.descripcion=ko.observable(elemento.descripcion);
 this.tipo=ko.observable(elemento.tipo);
 this.existencias=ko.observable(elemento.existencias);
 this.precio_compra=ko.observable(elemento.precio_compra);
 this.precio_venta=ko.observable(elemento.precio_venta);
 this.precio_venta_tarjeta=ko.observable(elemento.precio_venta_tarjeta);
 this.area=ko.observable(elemento.area);
}

//Función  que crea objetos de tipo Producto_venta, los cuáles representan los
//productos agregados a la venta actual, éstos se guardan en un arreglo para
//posteriormente desplegarlos en una tabla con los productos agregados
//hasta ahora en la venta.
function Producto_venta(elemento){
 this.id_producto=ko.observable(elemento.id_producto);
 this.producto=ko.observable(elemento.producto);
 this.precio=ko.observable(elemento.precio);
 this.cantidad=ko.observable(elemento.cantidad);
 this.subtotal=ko.observable(elemento.subtotal);
 this.forma_pago=ko.observable(elemento.forma_pago);
 this.id_promocion=ko.observable(elemento.id_promocion);
 this.promocion=ko.observable(elemento.promocion);
}

//La función appViewModel es la clase principal desde la cual se realizan todas
//las operaciones pertinentes.
function appViewModel(){

  // se utiliza la variable self para evitar causar conflictos en el compilador.
  // hace referencia a los atrubutos de la clase appViewModel.
	var self=this;

  //arreglo donde se guardan las ventas que se almacenarán en la base de datos .
  self.ventas=ko.observableArray([]);
  //arreglo donde se cargan las citas de las cuales se elegirá la que sea de la fecha buscada .
  self.citas=ko.observableArray([]);
  //arreglo donde se cargan las citas que se muestran en e <select></select> .
  self.citasElegir=ko.observableArray([]);
  //arreglo donde se cargan los productos antes de que se muestren en el <select></select> .
  self.productos=ko.observableArray([]);
  //arreglo donde se cargan los productos que se muestran en el <select></select> .
  self.auxproductos=ko.observableArray([]);
  //arreglo donde se cargan los clientes que se muestran en el <select></select> .
  self.clientes=ko.observableArray([]);
  //arreglo donde se guardan los productos agregados a la venta actual.
  self.productos_venta=ko.observableArray([]);
  //arreglo donde se guardan las nuevas depilaciones.
  self.nueva_depilacion=ko.observableArray([]);
  //arreglo donde se guardan las nuevas mesoterapias.
  self.nueva_mesoterapia=ko.observableArray([]);
  //arreglo donde se guardan las promociones que se muestran en el <select></select>.
  self.promociones=ko.observableArray([]);
  //arreglo donde se guardan los productos asociados a las promociones.
  self.promotionProducts=ko.observableArray([]);

  //variable que guarda las unidades de cada producto que se agrega a la venta.
  self.cantidad = ko.observable();
  //variable que guarda la cita elegida para facturar en la venta actual.
  self.selectedDate = ko.observable();
  //variable que guarda el cliente elegido para facturar en la venta actual.
  self.selectedCliente = ko.observable();
  //variable que guarda el producto para facturar en la venta actual.
  self.selectedProduct = ko.observable();
  //variable que guarda la promoción seleccionada para aplicar descuento en la venta actual.
  self.selectedPromotion = ko.observable();
  //variable que guarda la fecha de la que se extraerá la cita
  self.fecha = ko.observable();
  //variable que guarda la forma de pago de la venta
  self.formaPago = ko.observable();
  //variable que guarda el área de los productos(solo aplica a ventas facturando unicamente productos)
  self.areap = ko.observable();
  //variable que guarda el área de la cita
  self.division = ko.observable();
  //Variable que guarda los tipos adicionales de consultas
  self.tiposCitas = ko.observableArray(['Paquete','Control de peso','Una vez al mes','Labor social','Control nutricional','Tratamiento médico']);
  //variable que guarda el tipo de cita adicional
  self.selectedTipoCita = ko.observable();

  //Función que lee el archivo en formato json que contiene los medicamentos guardados en la base de datos.
  $.getJSON('../../../json/medicamentos.json',function(result){
    //el método map pasa cada medicamento que lee de la base de datos a un arreglo temporal.
  	var medicamentosArreglo= $.map(result,function(item){
  	 	return new Producto(item);
  	});
    //los medicamentos se cargan en el arreglo que se mostrará en el <select></select> .
  	self.productos(medicamentosArreglo);
  });

  //Función que lee el archivo en formato json que contiene las citas guardadas en la base de datos.
  $.getJSON('../../../json/cita_venta.json',function(result){
    //el método map pasa cada cita que lee de la base de datos a un arreglo temporal.
  	  var citasArreglo = $.map(result,function(item){
  	 	return new Cita(item);
  	 });
     self.selectedDate(citasArreglo[0]);
     self.division(self.selectedDate().division());
  });

  //Función que lee el archivo en formato json que contiene los clientes guardados en la base de datos.
  $.getJSON('../../../json/clientes.json',function(result){
    //el método map pasa cada cliente que lee de la base de datos a un arreglo temporal.
  	 var clientesArreglo= $.map(result,function(item){
  	 	return new Cliente(item);
  	 });
     //los clientes se cargan en el arreglo que se mostrará en el <select></select>
  	 self.clientes(clientesArreglo);
  });

  //Función que lee el archivo en formato json que contiene los clientes guardados en la base de datos.
  $.getJSON('../../../json/promotions.json',function(result){
    //el método map pasa cada cliente que lee de la base de datos a un arreglo temporal.
  	 var promotionsArreglo= $.map(result,function(item){
  	 	return new Promocion(item);
  	 });
     //los clientes se cargan en el arreglo que se mostrará en el <select></select>
  	 self.promociones(promotionsArreglo);
  });

  //Función que lee el archivo en formato json que contiene los clientes guardados en la base de datos.
  $.getJSON('../../../json/promotionProducts.json',function(result){
    //el método map pasa cada cliente que lee de la base de datos a un arreglo temporal.
     var promotionProductsArreglo= $.map(result,function(item){
      return new PromotionProduct(item);
     });
     //los clientes se cargan en el arreglo que se mostrará en el <select></select>
     self.promotionProducts(promotionProductsArreglo);
  });

  self.cargarProductosDos=function(){
    self.auxproductos([]);
    var area = self.areap();
    for (var i = 0; i < self.productos().length; i++) {
      if (area == "P.Área Bienestar") {
        if (self.productos()[i].area()=="Área Bienestar" && self.productos()[i].tipo()=="Producto de almacén"
        && self.productos()[i].existencias()>=1){ self.auxproductos.push(self.productos()[i]);}
      }
      if (area == "P.Área Salud") {
        if (self.productos()[i].area()=="Área Salud" && self.productos()[i].tipo()=="Producto de almacén"
        && self.productos()[i].existencias()>=1){ self.auxproductos.push(self.productos()[i]);}
      }
      if (area == "S.Área bienestar") {
        if (self.productos()[i].area()=="Área Bienestar" && self.productos()[i].tipo()=="Servicio")
        { self.auxproductos.push(self.productos()[i]);}
      }
      if (area == "S.Área Salud") {
        if (self.productos()[i].area()=="Área Salud" && self.productos()[i].tipo()=="Servicio")
        { self.auxproductos.push(self.productos()[i]);}
      }
      if (area == "Suplemento") {
        if (self.productos()[i].area()=="Área Salud" && self.productos()[i].tipo()=="Suplemento")
        { self.auxproductos.push(self.productos()[i]);}
      }
      if (area == "Mesoterapia") {
        if (self.productos()[i].area()=="Área Bienestar" && self.productos()[i].tipo()=="Mesoterapia")
        { self.auxproductos.push(self.productos()[i]);}
      }
      if (area == "Depilación") {
        if (self.productos()[i].area()=="Área Bienestar" && self.productos()[i].tipo()=="Fotodepilación")
        { self.auxproductos.push(self.productos()[i]);}
      }
    }
  }

  //agregar nueva depilación
  self.agregarDepilacion=function(){
      self.nueva_depilacion.push(new Producto_venta({id_producto: "ndepilacion",producto: "Nueva Fotodepilación",
      precio: 0,cantidad:0, subtotal: 0}));
  }
  //Quita nueva depilación
  self.removeNewDepilacion=function(depilacion){self.nueva_depilacion.remove(depilacion)}

  //agregar nueva depilación
  self.agregarMesoterapia=function(){
      self.nueva_mesoterapia.push(new Producto_venta({id_producto: "nmesoterapia",producto: "Nueva Mesoterapia",
      precio: 0,cantidad:0, subtotal: 0}));
  }
  //Quita nueva depilación
  self.removeNewMesoterapia=function(mesoterapia){self.nueva_mesoterapia.remove(mesoterapia)}

  self.recargar=function(){
    var r= confirm("¿Salir de la venta actual?");
    if (r==true) {location.reload();}
  }

  //Método que selecciona las citas de acuerdo a la fecha que se ha elegido//
  self.obtener=function(){
    if (self.fecha()==undefined) {
      alert("Elija una fecha primero");
    }
    else {
      self.citasElegir([]);
      //se crea una variable javascript con la fecha  para poder hacer la seleccion
      var res = self.fecha().split("-");
      var anio = res[0];
      var mes = res[1];
      var dia = res[2];

      var fecha = anio.concat('-',mes,'-',dia);

      //ciclo para elegir citas
      for (var i = 0; i < self.citas().length; i++) {
        var fecha_aux = self.citas()[i].fecha();
        if (fecha_aux == fecha) {
          self.citasElegir.push(self.citas()[i]);
         }
       }
    }
  }

  //Añade un nuevo producto a la venta actual y lo guarda en un arreglo.
  self.agregarProducto_venta=function(){
    if (self.selectedProduct()==undefined) {
      alert("Seleccione un producto primero");
    }
    else {
      var id  = self.selectedProduct().id();
      var nombre  = self.selectedProduct().nombre();
      if (self.formaPago()==undefined || self.formaPago()==null) {
        alert("Elija una forma de pago primero")
      }
      else {
        if (self.formaPago()=="Efectivo") {
          var precio = self.selectedProduct().precio_venta();
        }
        if (self.formaPago()=="T.Crédito" || self.formaPago()=="T.Débito") {
          var precio = self.selectedProduct().precio_venta_tarjeta();
        }
        if (self.selectedPromotion().nombre()!="Ninguna promoción") {
          var id_promo = self.selectedPromotion().id();
          var id_prod = self.selectedProduct().id();
          var bandera = 0;
          for (var i = 0; i < self.promotionProducts().length; i++) {
            if (self.promotionProducts()[i].id_producto() == id_prod &&
                self.promotionProducts()[i].id_promocion() == id_promo) {
                  var precio = self.promotionProducts()[i].precio();
                  bandera = 1;
            }
          }
          if (bandera == 0) {
              if (self.formaPago()=="Efectivo") {
                var precio = self.selectedProduct().precio_venta();
              }
              if (self.formaPago()=="T.Crédito" || self.formaPago()=="T.Débito") {
                var precio = self.selectedProduct().precio_venta_tarjeta();
              }
          }
        }
        //Si no se especifica una cantidad de unidades del producto, se asume que solo
        //se busca una unidad de ese producto.
        if (self.cantidad()==null || self.cantidad()=="") {var cantidad = 1;}
        else {var cantidad = self.cantidad();}

        var subtotal= precio * cantidad;
        if (bandera == 0) {
          //Se crea un objeto de producto de la venta actual y se guarda en el arreglo.
          var producto_venta= new Producto_venta({id_producto: id ,producto: nombre ,precio: precio ,
            cantidad: cantidad,
            subtotal: subtotal, forma_pago: self.formaPago(),
            id_promocion: self.promociones()[0].id(), promocion: self.promociones()[0].nombre()});
          self.productos_venta.push(producto_venta);
        }
        else {
          //Se crea un objeto de producto de la venta actual y se guarda en el arreglo.
          var producto_venta= new Producto_venta({id_producto: id ,producto: nombre ,precio: precio ,
            cantidad: cantidad,
            subtotal: subtotal, forma_pago: self.formaPago(),
            id_promocion: self.selectedPromotion().id(), promocion: self.selectedPromotion().nombre()});
          self.productos_venta.push(producto_venta);
        }
        bandera = 0;
      }
    }
	}
// Método para determinar el precio total tanto de la cita como de los medicamentos a facturar.
   self.totalSurcharge = ko.computed(function() {
        var total = 0;
      //En un ciclo se suman los subtotales de los productos de la venta actual.
      for (var i = 0; i < self.productos_venta().length; i++){
          total += self.productos_venta()[i].subtotal();}
          //El bloque try-catch atrapa la excepción de cuando la variable selectedDate aún
          //está vacía, y por lo tanto no se puede acceder al atributo subtotal().
          try{total += self.selectedDate().subtotal()}
          catch(e){}
      return total;
   });

   //Función para eliminar un producto del arreglo que guarda los productos
   //consumidos en la venta actual.
   self.removeProduct = function(producto) { self.productos_venta.remove(producto) }

   //Función para actualizar los precios de los productos
   //consumidos en la venta actual.
   self.updateProduct = function(producto) {
     self.auxPV = ko.observableArray([]);
     for (var i = 0; i < self.productos_venta().length; i++) {
       self.auxPV.push(self.productos_venta()[i]);
     }
     self.productos_venta.splice(0,self.productos_venta().length);

     self.auxCita = ko.observable(self.selectedDate());
     self.selectedDate();

     //Para actualizar precios de la cita elegida
     if (self.formaPago()=="Efectivo" &&
     self.selectedPromotion().nombre()=="Ninguna promoción") {
       self.auxCita().subtotal(self.auxCita().precio_cita());
     }
     if ((self.formaPago()=="T.Crédito" || self.formaPago()=="T.Débito")
     && self.selectedPromotion().nombre()=="Ninguna promoción") {
       self.auxCita().subtotal(self.auxCita().precio_cita_tarjeta());
     }
     try {
          if (self.selectedPromotion().nombre()!="Ninguna promoción") {
          var id_promo = self.selectedPromotion().id();
          var id_prod2 =  self.auxCita().id_producto();
          var bandera = 0;
          for (var k = 0; k < self.promotionProducts().length; k++) {
            if (self.promotionProducts()[k].id_producto() == id_prod2 &&
                self.promotionProducts()[k].id_promocion() == id_promo) {
                 self.auxCita().subtotal(self.promotionProducts()[k].precio());
                 self.auxCita().forma_pago(self.formaPago());
                 self.auxCita().id_promocion(id_promo);
                 self.auxCita().promocion(self.selectedPromotion().nombre());
                 bandera = 1;
            }
          }
          if (bandera == 0) {
            if (self.auxproductos()[j].id() == prod) {
              if (self.formaPago()=="Efectivo") {
                self.auxCita().subtotal(self.auxCita().precio_cita());
                self.auxPV()[i].forma_pago(self.formaPago());
              }
              if (self.formaPago()=="T.Crédito" || self.formaPago()=="T.Débito") {
                self.auxCita().subtotal(self.auxCita().precio_cita_tarjeta());
                self.auxPV()[i].forma_pago(self.formaPago());
              }
          }
          bandera = 0;
        }
      }
     } catch (e) {}
   //Para todos los demás productos que no sean la cita
     for (var i = 0; i < self.auxPV().length; i++) {
        var prod = self.auxPV()[i].id_producto();
        for (var j = 0; j < self.auxproductos().length; j++) {
          if (self.auxproductos()[j].id() == prod) {
            if (self.formaPago()=="Efectivo" &&
            self.selectedPromotion().nombre()=="Ninguna promoción") {
              self.auxPV()[i].precio(self.auxproductos()[j].precio_venta());
              self.auxPV()[i].subtotal(self.auxproductos()[j].precio_venta() *
              self.auxPV()[i].cantidad());
              self.auxPV()[i].forma_pago(self.formaPago());
              if (self.auxPV()[i].id_promocion()!="1") {
                self.auxPV()[i].id_promocion(self.promociones()[0].id());
                self.auxPV()[i].promocion(self.promociones()[0].nombre());
              }
            }
            if ((self.formaPago()=="T.Crédito" || self.formaPago()=="T.Débito")
            && self.selectedPromotion().nombre()=="Ninguna promoción") {
              self.auxPV()[i].precio(self.auxproductos()[j].precio_venta_tarjeta());
              self.auxPV()[i].subtotal(self.auxproductos()[j].precio_venta_tarjeta() *
              self.auxPV()[i].cantidad());
              self.auxPV()[i].forma_pago(self.formaPago());
              if (self.auxPV()[i].id_promocion()!="1") {
                self.auxPV()[i].id_promocion(self.promociones()[0].id());
                self.auxPV()[i].promocion(self.promociones()[0].nombre());
              }
            }
            if (self.selectedPromotion().nombre()!="Ninguna promoción") {
              var id_promo = self.selectedPromotion().id();
              var id_prod2 =  self.auxPV()[i].id_producto();
              var bandera = 0;
              for (var k = 0; k < self.promotionProducts().length; k++) {
                if (self.promotionProducts()[k].id_producto() == id_prod2 &&
                    self.promotionProducts()[k].id_promocion() == id_promo) {
                     self.auxPV()[i].precio(self.promotionProducts()[k].precio());
                     self.auxPV()[i].subtotal(self.promotionProducts()[k].precio() *
                     self.auxPV()[i].cantidad());
                     self.auxPV()[i].forma_pago(self.formaPago());
                     self.auxPV()[i].id_promocion(id_promo);
                     self.auxPV()[i].promocion(self.selectedPromotion().nombre());
                     bandera = 1;
                }
              }
              if (bandera == 0) {
                if (self.auxproductos()[j].id() == prod) {
                  if (self.formaPago()=="Efectivo") {
                    self.auxPV()[i].precio(self.auxproductos()[j].precio_venta());
                    self.auxPV()[i].subtotal(self.auxproductos()[j].precio_venta() *
                    self.auxPV()[i].cantidad());
                    self.auxPV()[i].forma_pago(self.formaPago());
                    self.auxPV()[i].id_promocion(self.promociones()[0].id());
                    self.auxPV()[i].promocion(self.promociones()[0].nombre());
                  }
                  if (self.formaPago()=="T.Crédito" || self.formaPago()=="T.Débito") {
                    self.auxPV()[i].precio(self.auxproductos()[j].precio_venta_tarjeta());
                    self.auxPV()[i].subtotal(self.auxproductos()[j].precio_venta_tarjeta() *
                    self.auxPV()[i].cantidad());
                    self.auxPV()[i].forma_pago(self.formaPago());
                    self.auxPV()[i].id_promocion(self.promociones()[0].id());
                    self.auxPV()[i].promocion(self.promociones()[0].nombre());
                  }
              }
              bandera = 0;
            }
          }
        }
      }
    }
    for (var i = 0; i < self.auxPV().length; i++) {
       self.productos_venta.push(self.auxPV()[i]);
    }
    self.auxPV.splice(0,self.auxPV().length);
    self.selectedDate(self.auxCita());
    self.auxCita();
   }

   //Método para agregar una nueva venta al arreglo de ventas, y después pasarlo
   //a la base de datos.
   self.agregarVenta=function(){
     if (self.selectedDate()==undefined) {
       alert("Elija una cita primero");
     }
     else if (self.formaPago()==undefined) {
       alert("Elija una forma de pago")
     }
     else {
       var r = confirm("Presione 'Aceptar' para registrar la venta");
       if (r==true) {
         // crea un nuevo objeto Venta y después lo añade al arreglo.
         var id_cliente = self.selectedDate().id_cliente();
         var venta= new Venta({id_cliente: id_cliente,id_producto: self.selectedDate().id_producto(),
          producto:self.selectedDate().tipo_cita() , cantidad: self.selectedDate().cantidad(),subtotal: self.selectedDate().subtotal(),
         formaPago: self.formaPago(),promocion: self.selectedPromotion().id()});
         self.ventas().push(venta);

         if (self.nueva_depilacion().length > 0) {
           for (var i = 0; i < self.nueva_depilacion().length; i++) {
             venta= new Venta({id_cliente: id_cliente,id_producto: self.nueva_depilacion()[i].id_producto(),
              producto:self.nueva_depilacion()[i].producto() ,cantidad: self.nueva_depilacion()[i].cantidad(),subtotal: self.nueva_depilacion()[i].subtotal(),
             formaPago: self.formaPago(),promocion: self.selectedPromotion().id()});
             self.ventas().push(venta);
           }
         }
         if (self.nueva_mesoterapia().length > 0) {
           for (var i = 0; i < self.nueva_mesoterapia().length; i++) {
             venta= new Venta({id_cliente: id_cliente,id_producto: self.nueva_mesoterapia()[i].id_producto(),
              producto:self.nueva_mesoterapia()[i].producto() ,cantidad: self.nueva_mesoterapia()[i].cantidad(),subtotal: self.nueva_mesoterapia()[i].subtotal(),
             formaPago: self.formaPago(),promocion: self.selectedPromotion().id()});
             self.ventas().push(venta);
           }
         }
         for (var i = 0; i < self.productos_venta().length; i++) {
           venta= new Venta({id_cliente: id_cliente,id_producto: self.productos_venta()[i].id_producto(),
            producto:self.productos_venta()[i].producto() , cantidad: self.productos_venta()[i].cantidad(),subtotal: self.productos_venta()[i].subtotal(),
           formaPago: self.formaPago(), promocion: self.selectedPromotion().id()});
           self.ventas().push(venta);
         }
         var token = $("#token").val();
         $.ajax({
            url: 'dateSale/agregarVentaCita',
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            data: {ventas: self.ventas()},
            dataType: 'JSON',
            error: function(respuesta) {alert("error");},
            success: function(respuesta) {
              if (respuesta) {
                alert("Se ha agregado una venta con éxito");
                document.location.href = '/pdf';
                if (self.nueva_depilacion().length > 0) {
                  alert("Modifique los datos del nuevo(s) tipo de depilación en el menú Productos");
                }
              }else {
                alert("error");
              }
            }
        });
       }
    }
	}

}
//Se aplican los "enlaces" o "encadenamientos"  de las variables de javascript con sus
//contrapartes en la parte visual de la aplicación
ko.applyBindings(new appViewModel());
