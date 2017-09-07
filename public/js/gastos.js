//Función para agregar un nuevo gasto y agregarlo a un arreglo,
//el cuál se enviará para guardar en base de datos .
function Gasto(elemento){
 this.id=ko.observable(elemento.id);
 this.concepto=ko.observable(elemento.concepto);
 this.tipo_gasto=ko.observable(elemento.tipo_gasto);
 this.cantidad=ko.observable(elemento.cantidad);
 this.fecha_pago=ko.observable(elemento.fecha_pago);
}

//La función appViewModel es la clase principal desde la cual se realizan todas
//las operaciones pertinentes.
function appViewModel(){

  // se utiliza la variable self para evitar causar conflictos en el compilador.
  // hace referencia a los atrubutos de la clase appViewModel.
	var self=this;

  //variable que guarda el gasto elegida para facturar en la venta actual.
  self.chosenExpense = ko.observableArray();

	//arreglo donde se cargan todos los gastos que se muestran en el checkbox .
  self.gastos=ko.observableArray([]);

  //arreglo donde se cargan los gastos fijos que se muestran en el checkbox .
  self.gastos_fijos=ko.observableArray([]);

  //arreglo donde se cargan los gastos variables que se muestran en el checkbox .
  self.nuevos_gastos_variables=ko.observableArray([]);

  //arreglo donde se cargan los gastos variables que se muestran en el checkbox .
  self.gastos_variables=ko.observableArray([]);


	//Función que lee el archivo en formato json que contiene los gastos guardados en la base de datos.
  $.getJSON('../json/gastos.json',function(result){
    //el método map pasa cada gasto que lee de la base de datos a un arreglo temporal.
  	var gastosArreglo= $.map(result,function(item){
  	 	return new Gasto(item);
  	});
    //los gastos se cargan en el arreglo que se mostrará en el checkbox .
  	self.gastos(gastosArreglo);
    for (var i = 0; i < self.gastos().length; i++) {
      if (self.gastos()[i].tipo_gasto()=='Fijo') {
          self.gastos_fijos.push(self.gastos()[i]);
      }
      else {
        self.gastos_variables.push(self.gastos()[i]);
      }
    }
  });

  //Añade un nuevo gasto mensual y lo guarda en un arreglo.
  self.agregarGastoMensual=function(){
        alert("Se han guardado gastos mensuales con éxito");
        var token = $("#token").val();
        $.ajax({
           url: 'monthlyExpenses/AddItem',
           headers: {'X-CSRF-TOKEN': token},
           type: 'POST',
           data: {gastos: self.chosenExpense(),nuevos_gastos_variables: self.nuevos_gastos_variables()},
           dataType: 'JSON',
           error: function(respuesta) {alert("error");},
           success: function(respuesta) {
             if (respuesta) {
               alert(mensaje);
             }else {
               alert("error");
             }
           }
       });
  }
  //Añade un nuevo gasto variable
  self.agregarGastoVariable=function(){
      self.nuevos_gastos_variables.push(new Gasto({id: 0,concepto: "Nuevo gasto",tipo_gasto: "variable",cantidad:0}));
  }
  //Quita nuevo gasto variable
  self.removeNewVariable=function(gasto){self.nuevos_gastos_variables.remove(gasto)}
}
//Se aplican los "enlaces" o "encadenamientos"  de las variables de javascript con sus
//contrapartes en la parte visual de la aplicación
ko.applyBindings(new appViewModel());
