<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Confirmar Devolución</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="col-lg-12">
                <p> ¿Desea confirmar la devolución? </p>
                <p> Usuario: <strong>{{prestamo.Prestamistas.Users.username}}</strong></p>
                <p> Material bibliográfico: <strong>{{prestamo.MaterialesBibliograficos.nombre}}</strong></p>
            </div>
        </div>
        <div class="modal-footer">
            <div class="col-lg-12 text-right">
                <form role="form" action="{{url('prestamo/devolver/'~ prestamo.id)}}" method="post">
                    <input type="submit" class="btn btn-primary" id="despedir" value="Si">
                    <button type="button" class="btn btn-secondary" onclick="return cerrar_modal()"> No </button>
                </form>
            </div>
        </div>
    </div>
</div>