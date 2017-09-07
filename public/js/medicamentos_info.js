//Función que crea un objeto Producto, sacado del archivo json
function Producto(elemento){
 this.id=ko.observable(elemento.id);
 this.nombre=ko.observable(elemento.nombre);
 this.descripcion=ko.observable(elemento.descripcion);
 this.tipo=ko.observable(elemento.tipo);
 this.existencias=ko.observable(elemento.existencias);
 this.precio_compra=ko.observable(elemento.precio_compra);
 this.precio_venta=ko.observable(elemento.precio_venta);
 this.created_at=ko.observable(elemento.created_at);
 this.updated_at=ko.observable(elemento.updated_at);
}
//La función appViewModel es la clase principal desde la cual se realizan todas
//las operaciones pertinentes.
function appViewModel(){

  // se utiliza la variable self para evitar causar conflictos en el compilador.
  // hace referencia a los atrubutos de la clase appViewModel.
	var self=this;

  //variable que guarda el producto elegido para hacer la regresión lineal.
  self.chosenProduct = ko.observableArray();
  //arreglo donde se cargan todos los productos que se guardan en el select .
  self.productos=ko.observableArray([]);

  //arreglo donde se cargan todos los productos según la opción que elija el usuario
  self.nuevosProductos=ko.observableArray([]);

	//Función que lee el archivo en formato json que contiene los productos guardados
  //en la base de datos.
  $.getJSON('../json/medicamentos.json',function(result){
    //el método map pasa cada producto que lee de la base de datos a un arreglo temporal.
  	var medicamentosArreglo= $.map(result,function(item){
  	 	return new Producto(item);
  	});
    //los consecutivos se cargan en el arreglo que los contendrá
    self.productos(medicamentosArreglo);
  });
}

//Se aplican los "enlaces" o "encadenamientos"  de las variables de javascript con sus
//contrapartes en la parte visual de la aplicación
ko.applyBindings(new appViewModel());
