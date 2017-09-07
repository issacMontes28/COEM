//Función que crea un objeto "Consecutivo", el cual se refiere al peso del paciente según las sesiones
function Consecutivo(elemento){
 this.id=ko.observable(elemento.id);
 this.nombre=ko.observable(elemento.paciente);
 this.fecha=ko.observable(elemento.fecha);
 this.hora=ko.observable(elemento.hora);
 this.division=ko.observable(elemento.division);
 this.tipo_cita=ko.observable(elemento.tipo_cita);
 this.doctor=ko.observable(elemento.doctor);
}
//Función que crea un objeto de tipo cliente, el cual se mostrará en el select
function Cliente(elemento){
 this.id_paciente=ko.observable(elemento.id_paciente);
 this.nombre=ko.observable(elemento.nombre);
}

//La función appViewModel es la clase principal desde la cual se realizan todas
//las operaciones pertinentes.
function appViewModel(){

  // se utiliza la variable self para evitar causar conflictos en el compilador.
  // hace referencia a los atrubutos de la clase appViewModel.
	var self=this;

  //variable que guarda el paciente elegido para hacer la regresión lineal.
  self.chosenPacient = ko.observableArray();
  //arreglo donde se cargan todos los consecutivos que se guardan en el select .
  self.consecutivos=ko.observableArray([]);

	//arreglo donde se cargan todos los pacientes que se cargan en el select.
  self.pacientes=ko.observableArray([]);

  //arreglo donde se cargan todos los consecutivos del paciente elegido
  self.consec_pacientes=ko.observableArray([]);

	//Función que lee el archivo en formato json que contiene los consecutivos guardados
  //en la base de datos.
  $.getJSON('../json/citas.json',function(result){
    //el método map pasa cada consecutivo que lee de la base de datos a un arreglo temporal.
  	var pacientesArreglo= $.map(result,function(item){
  	 	return new Consecutivo(item);
  	});
    //los consecutivos se cargan en el arreglo que los contendrá
    self.consecutivos(pacientesArreglo);
    //Se escogen solo los nombres sin repetir del arreglo de consecutivos para mostrarlos en
    //el select de pacientes
    for (var i = 0; i < self.consecutivos().length; i++) {
          if (i == 0) {
            nombre = self.consecutivos()[i].nombre();
            paciente = new Cliente({nombre: self.consecutivos()[i].nombre()});
            self.pacientes.push(paciente);
          }
          else {
            if (nombre != self.consecutivos()[i].nombre()) {
              nombre = self.consecutivos()[i].nombre();
              paciente = new Cliente({nombre: self.consecutivos()[i].nombre()});
              self.pacientes.push(paciente);}}
    }
  });

  self.conpaciente=function(){
    /*En este ciclo se guardan los consecutivos del paciente elegido para mostrarlo*/
     self.consec_pacientes([]);
      for (var i = 0; i < self.consecutivos().length; i++) {
         if (self.consecutivos()[i].nombre() == self.chosenPacient().nombre()) {
           self.consec_pacientes.push(self.consecutivos()[i]);
         }
      }
  }

}

//Se aplican los "enlaces" o "encadenamientos"  de las variables de javascript con sus
//contrapartes en la parte visual de la aplicación
ko.applyBindings(new appViewModel());
