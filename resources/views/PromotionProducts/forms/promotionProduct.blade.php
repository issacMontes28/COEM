<div class="form-group">
  <table>
    <tr><td colspan="2"><strong>Seleccione tipo de promoción al que asignará productos</strong></td></tr>
    <tr>
      <td>
          <input type="radio" name="tipoP" value="Precios_especiales"
          data-bind="checked: tipoP, event: { click: $root.cargarPromociones() }" />
          <h8> Precios especiales</h8>
      </td>
      <td>
        <input type="radio" name="tipoP"  value="Paquetes"
          data-bind="checked: tipoP, event: { click: $root.cargarPromociones() }" />
          <h8> Paquetes</h8>
      </td>
    </tr>
    <tr>
    <td>{!!Form::label('prom','Promoción a la que asignará productos: ')!!}</td>
    <td><select data-bind="options: $root.auxPromociones, optionsText: function(item) {
                         return item.nombre()
                     },
                     value: selectedPromotion,
                     optionsCaption: 'Elija una promoción...', event: { change: $root.cargarProductos}"></select></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <button id="btnAgregar" data-bind="click: $root.agregarPromocion"
        class="btn btn-primary">Agregar nueva promoción</button>
      </td>
    </tr>
  </table>
  <div><br></br></div>
  <table data-bind="visible: nueva_promocion().length > 0, foreach: nueva_promocion">
    <thead>
        <tr><th>Nombre de la promoción</th><th>Descripción</th><th>Tipo</th><th>Acción</th>
    </thead>
    <tbody>
     <tr>
         <td><input data-bind="value: nombre"></input></td>
         <td><input data-bind="value: descripcion"></input></td>
         <td><select data-bind="options: $root.promotionTypes,
                       value: tipo"></select></td>
         <td><button data-bind="click: $root.removeNewPromocion"  class="btn btn-danger">Quitar</button></td>
     </tr>
   </tbody>
  </table>
  <div data-bind="visible: tipoP()=='Precios_especiales'"><h3><strong>Productos de almacén</strong></h3><br><br/></div>
  <table data-bind="visible: tipoP()=='Precios_especiales'">
    <thead>
          <tr><th colspan="2">Producto</th><th>Precio venta</th><th>Precio venta con tarjeta</th>
          <th>Precio venta con promoción</th></tr>
    </thead>
    <tbody data-bind="foreach: { data: productos, as: 'producto' }">
     <tr data-bind="visible: producto.tipo() == 'Producto de almacén'">
         <td><input type="checkbox" data-bind="checkedValue: $data, checked: $root.chosenProduct"></input></td>
         <td data-bind="text: producto.nombre"></td>
         <td data-bind="text: producto.precio_venta"></td>
         <td data-bind="text: producto.precio_venta_tarjeta"></td>
         <td><input data-bind="value: producto.precio_venta_promocion"/></td>
     </tr>
    </tbody>
  </table>
	<div data-bind="visible: tipoP()=='Precios_especiales'"><h3><strong>Servicios</strong></h3><br><br/></div>
	<table data-bind="visible: tipoP()=='Precios_especiales'">
		<thead>
	        <tr><th colspan="2">Producto</th><th>Precio venta</th><th>Precio venta con tarjeta</th>
          <th>Precio venta con promoción</th></tr>
	  </thead>
		<tbody data-bind="foreach: { data: productos, as: 'producto' }">
		 <tr data-bind="visible: producto.tipo() == 'Servicio'">
			   <td><input type="checkbox" data-bind="checkedValue: $data, checked: $root.chosenProduct"></input></td>
         <td data-bind="text: producto.nombre"></td>
         <td data-bind="text: producto.precio_venta"></td>
				 <td data-bind="text: producto.precio_venta_tarjeta"></td>
				 <td><input data-bind="value: producto.precio_venta_promocion"/></td>
		 </tr>
 		</tbody>
	</table>
  <div data-bind="visible: tipoP()=='Precios_especiales'"><h3><strong>Fotodepilación</strong></h3><br><br/></div>
  <table data-bind="visible: tipoP()=='Precios_especiales'">
    <thead>
          <tr><th colspan="2">Producto</th><th>Precio venta</th><th>Precio venta con tarjeta</th>
          <th>Precio venta con promoción</th></tr>
    </thead>
    <tbody data-bind="foreach: { data: productos, as: 'producto' }">
     <tr data-bind="visible: producto.tipo() == 'Fotodepilación'">
         <td><input type="checkbox" data-bind="checkedValue: $data, checked: $root.chosenProduct"></input></td>
         <td data-bind="text: producto.nombre"></td>
         <td data-bind="text: producto.precio_venta"></td>
         <td data-bind="text: producto.precio_venta_tarjeta"></td>
         <td><input data-bind="value: producto.precio_venta_promocion"/></td>
     </tr>
    </tbody>
  </table>
  <div data-bind="visible: tipoP()=='Precios_especiales'"><h3><strong>Consultas</strong></h3><br><br/></div>
  <table data-bind="visible: tipoP()=='Precios_especiales'">
    <thead>
          <tr><th colspan="2">Producto</th><th>Precio venta</th><th>Precio venta con tarjeta</th>
            <th>Precio venta con promoción</th></tr>
    </thead>
    <tbody data-bind="foreach: { data: productos, as: 'producto' }">
     <tr data-bind="visible: producto.tipo() == 'Consulta'">
         <td><input type="checkbox" data-bind="checkedValue: $data, checked: $root.chosenProduct"></input></td>
         <td data-bind="text: producto.nombre"></td>
         <td data-bind="text: producto.precio_venta"></td>
         <td data-bind="text: producto.precio_venta_tarjeta"></td>
         <td><input data-bind="value: producto.precio_venta_promocion"/></td>
     </tr>
    </tbody>
  </table>


  <div data-bind="visible: tipoP()=='Paquetes'"><h3><strong>Productos de almacén</strong></h3><br><br/></div>
  <table data-bind="visible: tipoP()=='Paquetes'">
    <thead>
          <tr><th colspan="2">Producto</th><th>Precio venta</th><th>Precio venta con tarjeta</th>
          <th>Cantidad de unidades para esta promoción</th><th>Precio venta con promoción</th></tr>
    </thead>
    <tbody data-bind="foreach: { data: productos, as: 'producto' }">
     <tr data-bind="visible: producto.tipo() == 'Producto de almacén'">
         <td><input type="checkbox" data-bind="checkedValue: $data, checked: $root.chosenProduct"></input></td>
         <td data-bind="text: producto.nombre"></td>
         <td data-bind="text: producto.precio_venta"></td>
         <td data-bind="text: producto.precio_venta_tarjeta"></td>
         <td><input data-bind="value: cantidad_productos"/></td>
         <td><input data-bind="value: producto.precio_venta_promocion"/></td>
     </tr>
    </tbody>
  </table>
	<div data-bind="visible: tipoP()=='Paquetes'"><h3><strong>Servicios</strong></h3><br><br/></div>
	<table data-bind="visible: tipoP()=='Paquetes'">
		<thead>
	        <tr><th colspan="2">Producto</th><th>Precio venta</th><th>Precio venta con tarjeta</th>
          <th>Cantidad de unidades para esta promoción</th><th>Precio venta con promoción</th></tr>
	  </thead>
		<tbody data-bind="foreach: { data: productos, as: 'producto' }">
		 <tr data-bind="visible: producto.tipo() == 'Servicio'">
			   <td><input type="checkbox" data-bind="checkedValue: $data, checked: $root.chosenProduct"></input></td>
         <td data-bind="text: producto.nombre"></td>
         <td data-bind="text: producto.precio_venta"></td>
				 <td data-bind="text: producto.precio_venta_tarjeta"></td>
         <td><input data-bind="value: cantidad_productos"/></td>
				 <td><input data-bind="value: producto.precio_venta_promocion"/></td>
		 </tr>
 		</tbody>
	</table>
  <div data-bind="visible: tipoP()=='Paquetes'"><h3><strong>Fotodepilación</strong></h3><br><br/></div>
  <table data-bind="visible: tipoP()=='Paquetes'">
    <thead>
          <tr><th colspan="2">Producto</th><th>Precio venta</th><th>Precio venta con tarjeta</th>
          <th>Cantidad de unidades para esta promoción</th><th>Precio venta con promoción</th></tr>
    </thead>
    <tbody data-bind="foreach: { data: productos, as: 'producto' }">
     <tr data-bind="visible: producto.tipo() == 'Fotodepilación'">
         <td><input type="checkbox" data-bind="checkedValue: $data, checked: $root.chosenProduct"></input></td>
         <td data-bind="text: producto.nombre"></td>
         <td data-bind="text: producto.precio_venta"></td>
         <td data-bind="text: producto.precio_venta_tarjeta"></td>
         <td><input data-bind="value: cantidad_productos"/></td>
         <td><input data-bind="value: producto.precio_venta_promocion"/></td>
     </tr>
    </tbody>
  </table>
  <div data-bind="visible: tipoP()=='Paquetes'"><h3><strong>Consultas</strong></h3><br><br/></div>
  <table data-bind="visible: tipoP()=='Paquetes'">
    <thead>
          <tr><th colspan="2">Producto</th><th>Precio venta</th><th>Precio venta con tarjeta</th>
          <th>Cantidad de unidades para esta promoción</th><th>Precio venta con promoción</th></tr>
    </thead>
    <tbody data-bind="foreach: { data: productos, as: 'producto' }">
     <tr data-bind="visible: producto.tipo() == 'Consulta'">
         <td><input type="checkbox" data-bind="checkedValue: $data, checked: $root.chosenProduct"></input></td>
         <td data-bind="text: producto.nombre"></td>
         <td data-bind="text: producto.precio_venta"></td>
         <td data-bind="text: producto.precio_venta_tarjeta"></td>
         <td><input data-bind="value: cantidad_productos"/></td>
         <td><input data-bind="value: producto.precio_venta_promocion"/></td>
     </tr>
    </tbody>
  </table>
	<div><br><br/></div>
	<button id="btnAgregar" data-bind="click: $root.agregarPromociones"  class="btn btn-success">Registrar precios de promociones</button>
</div>
