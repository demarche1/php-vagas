<div class="modal text-dark" style="display: block;" tabindex="1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deletar vaga</h5>
                <a href="/?deleteModalOpen=false">
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </a>
            </div>
            <div class="modal-body ">
                Deseja deletar a vaga <?php echo $_GET['title'] ?>?
            </div>
            <div class="modal-footer">
                <a href="/?deleteModalOpen=false">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Fechar</button>
                </a>
                <a href="/delete.php?id=<?php echo $_GET['id'] ?>">
                    <button type="button" class="btn btn-danger">Deletar</button>
                </a>
            </div>
        </div>
    </div>
</div>