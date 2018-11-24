{% if total < 3 %}
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Reservación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <p> ¿Desea reservar <strong>{{material.nombre}}</strong>?</p>
                    <p>Tiene hasta el <strong>{{limite}}</strong> para realizar el préstamo</p>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-lg-12 text-right">
                    <form role="form" action="{{url('busqueda/reservar/'~ material.id)}}" method="post">
                        <input type="submit" class="btn btn-primary" id="despedir" value="Si">
                        <button type="button" class="btn btn-secondary" onclick="return cerrar_modal()"> No </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
{% else %}
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reservación Denegada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <p> El maximo de recursos bibliograficos que puede prestar son 3 </p>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-lg-12 text-right">
                    <button type="button" class="btn btn-secondary" onclick="return cerrar_modal()"> Aceptar </button>
                </div>
            </div>
        </div>
    </div>
{% endif %}