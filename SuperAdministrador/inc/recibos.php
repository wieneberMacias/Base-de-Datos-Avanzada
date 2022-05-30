
              
<div style="font-size: 20px;  margin-top: 10px;">
  Recibos
  <div class="btn-group" style="float: right; margin-left: 5px; margin-bottom: 2px;">
    <div class="btn-group">
      <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Sucursal
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Cuernavaca</a></li>
        <li><a class="dropdown-item" href="#">Temixco</a></li>
        <li><a class="dropdown-item" href="#">Xochitepec</a></li>
      </ul>
    </div>
  </div>
  <div class="row-1" style="margin-top: 10px;">
    <input type="date" id="eligeFecha" name="eligeFecha">
    <button type="button" class="btn btn-outline-dark" style="float: right; margin-left: 5px;" data-bs-toggle="modal" data-bs-target="#corteCaja">Hacer corte de caja</button>
    <button type="button" class="btn btn-outline-dark" style="float: right;" data-bs-toggle="modal" data-bs-target="#hacerDevolucion">Hacer devoluci&oacute;n</button>
  </div>
  <div class="row-1" style="margin-top: 30px;">
  <div class="wrapper"  style="height:65vh;">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No.Venta</th>
          <th scope="col">Fecha</th>
          <th scope="col">Sucursal</th>
          <th scope="col">Monto</th>
          <th scope="col">Detalle</th>
          <th scope="col">Factura</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>06/03/2022</td>
          <td>Cuernavaca</td>
          <td>$250</td>
          <td><button type="button" class="btn btn-outline-dark" style="float: center;" data-bs-toggle="modal" data-bs-target="#mostrarDetalle"><i class="fa fa-search-plus"></i></button></td>
          <td><button type="button" class="btn btn-outline-dark" style="float: center;" data-bs-toggle="modal" data-bs-target="#generaFactura"><i class="fa fa-book"></i></button></td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>06/03/2022</td>
          <td>Cuernavaca</td>
          <td>$500</td>
          <td><button type="button" class="btn btn-outline-dark" style="float: center;" data-bs-toggle="modal" data-bs-target="#mostrarDetalle"><i class="fa fa-search-plus"></i></button></td>
          <td><button type="button" class="btn btn-outline-dark" style="float: center;" data-bs-toggle="modal" data-bs-target="#generaFactura"><i class="fa fa-book"></i></button></td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>06/03/2022</td>
          <td>Cuernavaca</td>
          <td>$1000</td>
          <td><button type="button" class="btn btn-outline-dark" style="float: center;" data-bs-toggle="modal" data-bs-target="#mostrarDetalle"><i class="fa fa-search-plus"></i></button></td>
          <td><button type="button" class="btn btn-outline-dark" style="float: center;" data-bs-toggle="modal" data-bs-target="#generaFactura"><i class="fa fa-book"></i></button></td>
        </tr>
      </tbody>
    </table>
    </div>
  </div>
</div>
   

  <!-- Modal Factura-->
<div class="modal fade bd-example-modal-xl" id="generaFactura" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Generar Factura</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="rfc" class="col-form-label">Capture su RFC:</label>
            <input type="text" class="form-control" id="rfc" maxlength="13">
          </div>
          <div class="mb-3">
            <label for="nombre" class="col-form-label">Nombre Completo:</label>
            <input type="text" class="form-control" id="nombre">
          </div>
          <div class="mb-3">
            <label for="codigopostal" class="col-form-label">Código Postal:</label>
            <input type="text" class="form-control" id="codigopostal" maxlength="5" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
          </div>
          <div class="mb-3">
            <label for="regimenfiscal" class="col-form-label">Régimen Fiscal:</label>
            <select name="cars" id="cars" form="carform">
              <option value="opcion1">Régimen Simplificado de Confianza</option>
              <option value="opcion2">Sueldos y salarios e ingresos asimilados a salarios</option>
              <option value="opcion3">Régimen de Actividades Empresariales y Profesionales</option>
              <option value="opcion4">Régimen de Incorporación Fiscal</option>
              <option value="opcion5">Enajenación de bienes</option>
              <option value="opcion6">Régimen de Actividades Empresariales con ingresos a través de Plataformas Tecnológicas</option>
              <option value="opcion7">Régimen de Arrendamiento</option>
              <option value="opcion8">Intereses</option>
              <option value="opcion9">Obtención de premios</option>
              <option value="opcion10">Dividendos</option>
              <option value="opcion11">Demás ingresos</option>
            </select>
            <div class="mb-3">
              <label for="metodopago" class="col-form-label">Método de Pago:</label>
              <select name="cars" id="cars" form="carform">
                <option value="efectivo">Efectivo</option>
                <option value="tarjeta">Tarjet Crédito o Débito</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success">Generar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Detalle Venta-->
<div class="modal fade bd-example-modal-xl" id="mostrarDetalle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Detalle de Venta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="vendedor" class="col-form-label">Vendedor</label>
            <input type="text" readonly class="form-control" id="vendedor">
          </div>
          <div class="mb-3">
            <label for="hora" class="col-form-label">Hora</label>
            <input type="text" readonly class="form-control" id="hora">
          </div>
          <div class="mb-3">
            <label for="productos" class="col-form-label">Productos</label>
            <input type="text" readonly class="form-control" id="Productos">
          </div>
          <div class="mb-3">
            <label for="total" class="col-form-label">Total</label>
            <input type="text" readonly class="form-control" id="total">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Hacer una devolución -->
<div class="modal fade bd-example-modal-xl" id="hacerDevolucion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Devoluci&oacute;n</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="fechaCompra" class="col-form-label">Fecha de compra</label>
            <br>
            <input type="date" id="fechaDeCompra" name="fechaDeCompra">
          </div>
          <div class="mb-3">
            <label for="noCompra" class="col-form-label">N&uacute;mero de compra</label>
            <br>
            <input type="text" id="noCompra" name="noCompra">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Corte de Caja -->
<div class="modal fade bd-example-modal-xl" id="corteCaja" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Corte de caja</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="vendedor" class="col-form-label">Selecciona el día en la que deseas hacer el corte de caja</label>
            <br>
            <input type="date" id="eligeFechaCorte" name="eligeFechaCorte">
          </div>
          <div class="mb-3">
            <label for="hora" class="col-form-label">Selecciona la sucursal</label>
            <br>
            <div class="btn-group">
              <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  Sucursal
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Cuernavaca</a></li>
                  <li><a class="dropdown-item" href="#">Temixco</a></li>
                  <li><a class="dropdown-item" href="#">Xochitepec</a></li>
                </ul>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" onclick="alertGeneraDocCorteCaja()" data-bs-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>