//Función para agregar un nuevo gasto y agregarlo a un arreglo
function Gasto(elemento){
 this.fecha=ko.observable(elemento.fecha);
 this.concepto=ko.observable(elemento.concepto);
 this.cantidad=ko.observable(elemento.cantidad);
}
//Función para agregar un nueva ganancia
function Ganancia(elemento){
  this.fecha=ko.observable(elemento.fecha);
  this.concepto=ko.observable(elemento.concepto);
  this.cantidad=ko.observable(elemento.cantidad);
  this.area=ko.observable(elemento.area);
}

/*Funcion que agrega un nuevo objeto que guarda una fecha
con las ventas por área , gastos y el total de cada fecha.*/
function ContFecha(elemento){
  this.fecha=ko.observable(elemento.fecha);
  this.ventasimagen=ko.observableArray(elemento.ventasimagen);
  this.ventassalud=ko.observableArray(elemento.ventassalud);
  this.gastos=ko.observableArray(elemento.gastos);
  this.totalimagen=ko.observable(elemento.totalimagen);
  this.totalsalud=ko.observable(elemento.totalsalud);
  this.totalgastos=ko.observable(elemento.totalgastos);
  this.fechaLetra=ko.observable(elemento.fechaLetra);
}
/*La función appViewModel es la clase principal desde la cual se realizan todas
las operaciones pertinentes.*/
function appViewModel(){

  // se utiliza la variable self para evitar causar conflictos en el compilador.
  // hace referencia a los atrubutos de la clase appViewModel.
	var self=this;


	//arreglo donde se cargan todos los gastos leídos del archivo json.
  self.gastos=ko.observableArray([]);

  //arreglos donde se cargan todas las fechas.
  self.fechas=ko.observableArray([]);
  self.fechasLetra=ko.observableArray([]);

  //arrego auxiliar para guardar fechas
  self.aux_fechas = ko.observableArray([]);

  //arreglo donde se cargan todos los ingresos leídos del archivo json.
  self.ingresos=ko.observableArray([]);

  /*arreglo donde se cargan todos los gastos que correspondan a las fechas.
  elegidas por el usuario*/
  self.auxiliar_gastos=ko.observableArray([]);

  /*arreglo donde se cargan todos los ingresos encontrados en el
  rango de fechas.*/
  self.auxiliar_ingresos=ko.observableArray([]);

  //arreglo donde se guardan los objetos de tipo ContFecha
  self.auxiliar_ingresos2=ko.observableArray([]);

  self.fecha_inicial=ko.observable();
  self.fecha_final=ko.observable();


	//Función que lee el archivo en formato json que contiene los gastos guardados en la base de datos.
  $.getJSON('../json/gastos_mensuales.json',function(result){
    //el método map pasa cada gasto que lee de la base de datos a un arreglo temporal.
  	var gastosArreglo= $.map(result,function(item){
  	 	return new Gasto(item);
  	});
        self.gastos(gastosArreglo);
  });

  //Función que lee el archivo en formato json que contiene los gastos guardados en la base de datos.
  $.getJSON('../json/ingresos_mensuales.json',function(result){
    //el método map pasa cada gasto que lee de la base de datos a un arreglo temporal.
  	var ingresosArreglo= $.map(result,function(item){
  	 	return new Ganancia(item);
  	});
        self.ingresos(ingresosArreglo);
  });


  //Método que selecciona los gastos e ingresos entre las fechas deseadas
  self.obtener=function(){
    //Se vacían los arreglos que se va a ocupar en cada ocación
    self.fechas([]);
    self.fechasLetra([]);
    self.aux_fechas([]);
    self.auxiliar_ingresos([]);
    self.auxiliar_gastos([]);
    self.auxiliar_ingresos2([]);

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

    //ciclo para elegir gastos
    for (var i = 0; i < self.gastos().length; i++) {
      var fecha_aux = new Date(self.gastos()[i].fecha());
      if (fecha_aux >= aux_fecha_inicial && fecha_aux <= aux_fecha_final) {
         self.auxiliar_gastos.push(self.gastos()[i]);
       }
     }

     //ciclo para elegir ingresos
     for (var i = 0; i < self.ingresos().length; i++) {
       var fecha_aux = new Date(self.ingresos()[i].fecha());
       if (fecha_aux >= aux_fecha_inicial && fecha_aux <= aux_fecha_final) {
          self.auxiliar_ingresos.push(self.ingresos()[i]);
        }
      }
      /*Se escogen solo las fechas sin repetir del arreglo de los ingresos elegidos
      para mostrarlos en las tablas*/
      var bandera_busqueda=0;
      for (var i = 0; i < self.auxiliar_ingresos().length; i++) {
            if (i == 0) {
              var nfecha = self.auxiliar_ingresos()[i].fecha();
              self.fechas.push(nfecha);
            }
            else {
                for (var z = 0; z < self.fechas().length; z++) {
                  if (nfecha == self.fechas()[z]) {bandera_busqueda=1;}}
                if (bandera_busqueda==0) {
                  self.fechas.push(nfecha);
                }bandera_busqueda=0;}
      }
      bandera_busqueda=0;
      for (var i = 0; i < self.auxiliar_gastos().length; i++) {
            if (i == 0) {
              var nfecha = self.auxiliar_gastos()[i].fecha();
              self.fechas.push(nfecha);
            }
            else {
              if (nfecha != self.auxiliar_gastos()[i].fecha()) {
                for (var z = 0; z < self.auxiliar_gastos().length; z++) {
                  if (nfecha == self.auxiliar_gastos()[i].fecha()) {bandera_busqueda=1;}}
                if (bandera_busqueda==0) {
                nfecha = self.auxiliar_gastos()[i].fecha();
                self.fechas.push(nfecha);
              }}}
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
        var res = aux_month.concat('-',aux_day,'-',aux_year);
        self.fechas.push(res);
        var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio",
        "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        var f=new Date(self.aux_fechas()[i]);
        self.fechasLetra.push(diasSemana[f.getDay()] +  "  " +f.getDate() + " de " +
        meses[f.getMonth()] + " de " + f.getFullYear());
      }

      //arreglo auxiliar para los ingresos encontrados en la fecha
      var aux_arreglo_ingresos_imagen = ko.observableArray([]);
      //arreglo auxiliar para los ingresos encontrados en la fecha
      var aux_arreglo_ingresos_salud = ko.observableArray([]);
      //arreglo auxiliar para los gastos encontrados en la fecha
      var aux_arreglo_gastos = ko.observableArray([]);
      for (var i = 0; i < self.fechas().length; i++) {
        aux_arreglo_ingresos_imagen([]);
        aux_arreglo_ingresos_salud([]);
        aux_arreglo_gastos([]);
        //La banderas indican cuándo se encontró un gasto o un ingreso
        //en la fecha interada, para insertarlo en el arreglo correspondiente
        var bandera_ingresos = 0;
        var totalimagen = 0;
        var totalsalud = 0;
        var totalgastos = 0;
        var nfecha = self.fechas()[i];
         for (var j = 0; j < self.auxiliar_ingresos().length; j++) {;
           if (nfecha == self.auxiliar_ingresos()[i].fecha()) {
              if (self.auxiliar_ingresos()[i].area()=="Área Bienestar") {
                aux_arreglo_ingresos_imagen.push(self.auxiliar_ingresos()[j]);
                bandera_ingresos=1; totalimagen = totalimagen + self.auxiliar_ingresos()[j].cantidad()}
              if (self.auxiliar_ingresos()[i].area()=="Área Salud") {
                aux_arreglo_ingresos_salud.push(self.auxiliar_ingresos()[j]);
                bandera_ingresos=1; totalsalud = totalsalud + self.auxiliar_ingresos()[j].cantidad();}
            }
         }
         for (var k = 0; k < self.auxiliar_gastos().length; k++) {
           if (nfecha == self.auxiliar_gastos()[k].fecha()) {
              aux_arreglo_gastos.push(self.auxiliar_gastos()[k]);
              bandera_ingresos=1;
              totalgastos= totalgastos + self.auxiliar_gastos()[k].cantidad();
            }
         }
         if (bandera_ingresos==1) {
           self.auxiliar_ingresos2.push(new ContFecha({fecha: nfecha, ventasimagen: aux_arreglo_ingresos_imagen(),
           ventassalud: aux_arreglo_ingresos_salud(), gastos: aux_arreglo_gastos(),totalimagen: totalimagen,
           totalsalud: totalsalud, totalgastos: totalgastos, fechaLetra: self.fechasLetra()[i]}));}
        }
  }

  // Método para determinar el total de ingresos en un rango de fechas
     self.totalIngresos = ko.computed(function() {
        var total = 0;
        //En un ciclo se suman las ganancias
        for (var i = 0; i < self.auxiliar_ingresos().length; i++){
            //El bloque try-catch atrapa la excepción de cuando la variable selectedDate aún
            //está vacía, y por lo tanto no se puede acceder al atributo subtotal().
            try{total += self.auxiliar_ingresos()[i].cantidad();}
            catch(e){console.log("Aún no se ha definido la variable",e)}}
        return total;
     });

     // Método para determinar el total de ingresos en un rango de fechas
        self.totalIngresosImagen = ko.computed(function() {
           var total = 0;
           //En un ciclo se suman las ganancias
           for (var i = 0; i < self.auxiliar_ingresos().length; i++){
               //El bloque try-catch atrapa la excepción de cuando la variable selectedDate aún
               //está vacía, y por lo tanto no se puede acceder al atributo subtotal().
               try{
                 if (self.auxiliar_ingresos()[i].area()=="Área Bienestar") {
                  total += self.auxiliar_ingresos()[i].cantidad();
                 }}
               catch(e){console.log("Aún no se ha definido la variable",e)}}
           return total;
        });
    // Método para determinar el total de ingresos en un rango de fechas
       self.totalIngresosSalud = ko.computed(function() {
          var total = 0;
          //En un ciclo se suman las ganancias
          for (var i = 0; i < self.auxiliar_ingresos().length; i++){
              //El bloque try-catch atrapa la excepción de cuando la variable selectedDate aún
              //está vacía, y por lo tanto no se puede acceder al atributo subtotal().
              try{  if (self.auxiliar_ingresos()[i].area()=="Área Salud") {
                  total += self.auxiliar_ingresos()[i].cantidad();
                 }}
              catch(e){console.log("Aún no se ha definido la variable",e)}}
          return total;
       });

  // Método para determinar el total de gastos en un rango de fechas
    self.totalGastos = ko.computed(function() {
       var total = 0;
       //En un ciclo se suman las ganancias
       for (var i = 0; i < self.auxiliar_gastos().length; i++){
           //El bloque try-catch atrapa la excepción de cuando la variable selectedDate aún
           //está vacía, y por lo tanto no se puede acceder al atributo subtotal().
           try{total += self.auxiliar_gastos()[i].cantidad();}
           catch(e){console.log("Aún no se ha definido la variable",e)}}
       return total;
    });

  // Método para determinar el total de ingresos en un rango de fechas
    self.diferencia = ko.computed(function() {
       var total_gastos = 0;
       var totalIngresos = 0;

       //En un ciclo se suman las ganancias
       for (var i = 0; i < self.auxiliar_gastos().length; i++){
           //El bloque try-catch atrapa la excepción de cuando la variable selectedDate aún
           //está vacía, y por lo tanto no se puede acceder al atributo subtotal().
           try{total_gastos += self.auxiliar_gastos()[i].cantidad();}
            catch(e){console.log("Aún no se ha definido la variable",e)}}
       for (var i = 0; i < self.auxiliar_ingresos().length; i++){
           //El bloque try-catch atrapa la excepción de cuando la variable selectedDate aún
           //está vacía, y por lo tanto no se puede acceder al atributo subtotal().
           try{totalIngresos += self.auxiliar_ingresos()[i].cantidad();}
           catch(e){console.log("Aún no se ha definido la variable",e)}}
       var diferencia = totalIngresos - total_gastos;
       return diferencia;
    });

}
//Se aplican los "enlaces" o "encadenamientos"  de las variables de javascript con sus
//contrapartes en la parte visual de la aplicación
ko.applyBindings(new appViewModel());
