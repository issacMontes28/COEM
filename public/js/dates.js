//Función para agregar una nueva cita
function Cita(elemento){
 this.id_cita=ko.observable(elemento.id_cita);
 this.paciente=ko.observable(elemento.paciente);
 this.fecha=ko.observable(elemento.fecha);
 this.hora=ko.observable(elemento.hora);
 this.division=ko.observable(elemento.division);
 this.tipo_cita=ko.observable(elemento.tipo_cita);
 this.doctor=ko.observable(elemento.doctor);
 this.cantidad=ko.observable(elemento.cantidad);
}
//Función para agregar un nuevo doctor
function Doctor(elemento){
  this.id_doctor=ko.observable(elemento.id);
  this.nombre=ko.observable(elemento.nombre);
  this.apaterno=ko.observable(elemento.apaterno);
  this.amaterno=ko.observable(elemento.amaterno);
}

/*Funcion que agrega un nuevo objeto que guarda una fecha
con las ventas por área , gastos y el total de cada fecha.*/
function ContFecha(elemento){
  this.fecha=ko.observable(elemento.fecha);
  this.citas=ko.observableArray(elemento.citas);
  this.totalcitas=ko.observable(elemento.totalcitas);
  this.fechaLetra=ko.observable(elemento.fechaLetra);
}

/*Funcion que agrega un nuevo objeto que guarda el número de citas
hecho por cada doctor.*/
function ContDoctor(elemento){
  this.doctor=ko.observable(elemento.doctor)
  this.totalcitas=ko.observable(elemento.totalcitas);
}

/*La función appViewModel es la clase principal desde la cual se realizan todas
las operaciones pertinentes.*/
function appViewModel(){

  /*se utiliza la variable self para evitar causar conflictos en el compilador.
  hace referencia a los atrubutos de la clase appViewModel.*/
	var self=this;

  //arreglos donde se cargan todas las fechas.
  self.fechas=ko.observableArray([]);
  self.fechasLetra=ko.observableArray([]);

  //arrego auxiliar para guardar fechas
  self.aux_fechas = ko.observableArray([]);

  /*arreglos donde se cargan todos los doctores y
  citas leídos del archivo json.*/

  self.doctores=ko.observableArray([]);
  self.citas=ko.observableArray([]);

  /*arreglo donde se cargan todos los doctores y citas que correspondan a las fechas.
  elegidas por el usuario*/
  self.auxiliar_doctores=ko.observableArray([]);
  self.auxiliar_citas=ko.observableArray([]);
  self.auxiliar_citas2=ko.observableArray([]);
  self.aux_arreglo_doctores_citas = ko.observableArray([]);

  self.fecha_inicial=ko.observable();
  self.fecha_final=ko.observable();
  self.totalGlobal=ko.observable(0);

	//Función que lee el archivo en formato json que contiene las citas guardadas en la base de datos.
  $.getJSON('../json/citas.json',function(result){
    //el método map pasa cada cita que lee de la base de datos a un arreglo temporal.
  	var citasArreglo= $.map(result,function(item){
  	 	return new Cita(item);
  	});
        self.citas(citasArreglo);
  });

  //Función que lee el archivo en formato json que contiene los doctores guardados en la base de datos.
  $.getJSON('../json/doctores.json',function(result){
    //el método map pasa cada doctor que lee de la base de datos a un arreglo temporal.
  	var doctoresArreglo= $.map(result,function(item){
  	 	return new Doctor(item);
  	});
        self.doctores(doctoresArreglo);
  });


  //Método que selecciona las citas
  self.obtener=function(){
    //Se vacían los arreglos que se va a ocupar en cada ocación
    self.fechas([]);
    self.fechasLetra([]);
    self.aux_fechas([]);

    self.auxiliar_citas([]);
    self.auxiliar_doctores([]);
    self.totalGlobal(0);

    //se crea una variable javascript con la fecha final para poder hacer la seleccion
    var res = self.fecha_final().split("-");
    var anio = res[0];
    var mes = res[1];
    var dia = res[2];

    var res = mes.concat('/',dia,'/',anio);
    var aux_fecha_final = new Date(res);

    //se crea una variable javascript con la fecha inicial para poder hacer la seleccion
    var res = self.fecha_inicial().split("-");
    var anio = res[0];
    var mes = res[1];
    var dia = res[2];

    var res = mes.concat('/',dia,'/',anio);
    var aux_fecha_inicial = new Date(res);

    //ciclo para elegir citas
    for (var i = 0; i < self.citas().length; i++) {
      var fecha_aux = new Date(self.citas()[i].fecha());
      if (fecha_aux >= aux_fecha_inicial && fecha_aux <= aux_fecha_final) {
         self.auxiliar_citas.push(self.citas()[i]);
       }
     }


    /*Se escogen solo las fechas sin repetir del arreglo de los ingresos elegidos
    para mostrarlos en las tablas*/
      var bandera_busqueda=0;
      for (var i = 0; i < self.auxiliar_citas().length; i++) {
        var nfecha = self.auxiliar_citas()[i].fecha();
        self.totalGlobal(self.totalGlobal() + self.auxiliar_citas()[i].cantidad());
        if (i == 0) {
          self.fechas.push(nfecha);
        }
        else {
            for (var z = 0; z < self.fechas().length; z++) {
              if (nfecha == self.fechas()[z]) {bandera_busqueda=1;}
            }
            if (bandera_busqueda==0) {
              self.fechas.push(nfecha);
            }
            bandera_busqueda=0;
        }
      }
      /***se ordena el arreglo de fechas***/


      //Se pasan las fechas a un arreglo auxiliar para poder ordenarlos
      for (var i = 0; i < self.fechas().length; i++) {
         self.aux_fechas.push(new Date(self.fechas()[i]));
      }
      self.aux_fechas.sort(function(a,b){return a.getTime() - b.getTime()});
      //una vez ordenado el arreglo, se vuelve a pasar al arreglo original

      self.fechas([]);
      for (var i = 0; i < self.aux_fechas().length; i++) {
        //las fechas no se pueden concatenar, se usan auxiliares
        var month = self.aux_fechas()[i].getMonth()+1;
        if (month<10) {var aux_month = "0"+month.toString()}
        else {var aux_month = month.toString();}
        var day = self.aux_fechas()[i].getDate();
        if (day<10) {var aux_day = "0" + day.toString();}
        else{var aux_day = day.toString();}
        var year = self.aux_fechas()[i].getFullYear();
        var aux_year = year.toString();
        var res = aux_month.concat('/',aux_day,'/',aux_year);
        self.fechas.push(res);
        var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio",
        "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        var f=new Date(self.aux_fechas()[i]);
        self.fechasLetra.push(diasSemana[f.getDay()] +  "  " +f.getDate() + " de " +
        meses[f.getMonth()] + " de " + f.getFullYear());
      }

      //arreglo auxiliar para los ingresos encontrados en la fecha
      var aux_arreglo_ingresos_citas = ko.observableArray([]);
      for (var i = 0; i < self.fechas().length; i++) {
        aux_arreglo_ingresos_citas([]);
        var totalcitas = 0;
        var nfecha = self.fechas()[i];
         for (var j = 0; j < self.auxiliar_citas().length; j++) {
           if (nfecha == self.auxiliar_citas()[j].fecha()) {
                aux_arreglo_ingresos_citas.push(self.auxiliar_citas()[j]);
                totalcitas =
                totalcitas + self.auxiliar_citas()[j].cantidad()
            }
        }
        self.auxiliar_citas2.push(new ContFecha({fecha: nfecha,
        citas: aux_arreglo_ingresos_citas(),
        totalcitas: totalcitas,fechaLetra: self.fechasLetra()[i]}));
      }

      //arreglo auxiliar para listar el número de citas para cada doctor
      self.aux_arreglo_doctores_citas([]);
      for (var i = 0; i < self.doctores().length; i++) {
        var totalcitas = 0;
        var doctor = self.doctores()[i].nombre().concat(' ',
        self.doctores()[i].apaterno(),' ',self.doctores()[i].amaterno());
         for (var j = 0; j < self.auxiliar_citas().length; j++) {
           if (doctor == self.auxiliar_citas()[j].doctor()) {totalcitas = totalcitas + 1;}
        }
        self.aux_arreglo_doctores_citas.push(new ContDoctor({doctor: doctor,
          totalcitas: totalcitas}));
      }
  }
}
//Se aplican los "enlaces" o "encadenamientos"  de las variables de javascript con sus
//contrapartes en la parte visual de la aplicación
ko.applyBindings(new appViewModel());
