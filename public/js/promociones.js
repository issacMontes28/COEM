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
 this.precio_venta_promocion=ko.observable(0);
 this.cantidad_productos=ko.observable(1);
}

function Promocion(elemento){
 this.id=ko.observable(elemento.id);
 this.nombre=ko.observable(elemento.nombre);
 this.descripcion=ko.observable(elemento.descripcion);
 this.tipo=ko.observable(elemento.tipo);
}

//La función appViewModel es la clase principal desde la cual se realizan todas
//las operaciones pertinentes.
function appViewModel(){

  // se utiliza la variable self para evitar causar conflictos en el compilador.
  // hace referencia a los atrubutos de la clase appViewModel.
	var self=this;

  //arreglo donde se cargan los productos antes de que se muestren en el <select></select> .
  self.productos=ko.observableArray([]);
  //arreglo donde se cargan las promociones antes de que se muestren en el<select></select> .
  self.promociones=ko.observableArray([]);
  //arreglo donde se cargan las promociones que se muestran en el<select></select> .
  self.auxPromociones=ko.observableArray([]);
  //variable que guarda la promoción elegida
  self.selectedPromotion = ko.observable();
  //variable que guarda el tipo de promoción al que se le va a asignar productos
  self.tipoP = ko.observable();
  //variable que guarda el producto elegido.
  self.chosenProduct = ko.observableArray([]);
  //variable que guarda la nueva promoción.
  self.nueva_promocion = ko.observableArray([]);
  self.promotionTypes = ko.observableArray(['Paquete','Precios especiales']);


  //Función que lee el archivo en formato json que contiene los medicamentos guardados en la base de datos.
  $.getJSON('../json/medicamentos.json',function(result){
    //el método map pasa cada medicamento que lee de la base de datos a un arreglo temporal.
  	var medicamentosArreglo= $.map(result,function(item){
  	 	return new Producto(item);
  	});
    //los medicamentos se cargan en el arreglo que se mostrará en el <select></select> .
  	self.productos(medicamentosArreglo);
  });

  //Función que lee el archivo en formato json que contiene las promociones de la base de datos.
  $.getJSON('../json/promociones.json',function(result){
    //el método map pasa cada medicamento que lee de la base de datos a un arreglo temporal.
    var promocionesArreglo= $.map(result,function(item){
      return new Promocion(item);
    });
    //los medicamentos se cargan en el arreglo que se mostrará en el <select></select> .
    self.promociones(promocionesArreglo);
  });

  self.cargarPromociones=function(){
    self.auxPromociones([]);
    var tipo = self.tipoP();
    for (var i = 0; i < self.promociones().length; i++) {
      if (tipo == "Precios_especiales") {
        if (self.promociones()[i].tipo()=="Precios especiales"){
          self.auxPromociones.push(self.promociones()[i]);}
      }
      if (tipo == "Paquetes") {
        if (self.promociones()[i].tipo()=="Paquete"){
          self.auxPromociones.push(self.promociones()[i]);}
      }
     }
   }

   //agregar nueva depilación
   self.agregarPromocion=function(){
       self.nueva_promocion.push(new Promocion({id: 0,nombre: "Nueva Promoción",
       descripcion: "Agregue descripcion", tipo:"Paquete"}));
   }
   //Quita nueva depilación
   self.removeNewPromocion=function(promocion){self.nueva_promocion.remove(promocion)}

  //Añade un nuevo gasto mensual y lo guarda en un arreglo.
  self.agregarPromociones=function(){
    if (self.tipoP()==undefined) {
      alert("Elija un tipo de promoción primero");
    }
    if (self.nueva_promocion().length>0) {
      self.selectedPromotion = ko.observable(self.nueva_promocion()[0]);
    }
    if (self.selectedPromotion()==undefined && self.nueva_promocion().length==0) {
      alert("Elija una promoción o agregue una nueva promoción primero");
    }
    else if (self.chosenProduct().length==0) {
      alert("Seleccione algún producto primero")
    }
    else{
      var token = $("#token").val();
      $.ajax({
         url: 'promotionProduct/AddItem',
         headers: {'X-CSRF-TOKEN': token},
         type: 'POST',
         data: {promocion: self.selectedPromotion(),productos: self.chosenProduct()},
         dataType: 'JSON',
         error: function(respuesta) {alert("error");},
         success: function(respuesta) {
           if (respuesta) {
             alert("Se han asignado productos a la promoción con éxito");
             location.reload();
           }else {
             alert("error");
           }
         }
     });
   }
  }
}
//Se aplican los "enlaces" o "encadenamientos"  de las variables de javascript con sus
//contrapartes en la parte visual de la aplicación
ko.applyBindings(new appViewModel());
