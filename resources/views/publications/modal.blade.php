<div class="modal fade" id="theModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="titleModal">Modal title</h1>
                <button type="button" class="btn-close btnClose"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="publicationForm" name="publicationForm" method="POST"
                    enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="hidden" name="id" id="id">
                        <label for="title" class="form-label">Titúlo:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Titúlo">
                        <span class="error-message text-danger" id="titleError"></span>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Contenido:</label>
                        <textarea name="content" class="form-control" id="content" rows="5"></textarea>
                        <span class="error-message text-danger" id="contentError"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btnClose">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
                <button type="button" class="btn btn-primary" id="btnUpdate">Actualizar</button>
            </div>
        </div>
    </div>
</div>
