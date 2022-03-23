<section class="mt-3">
    <a href="/index.php">
        <butto class="btn btn-success">
            Voltar
        </butto>
    </a>
</section>

<section class="mt-3">
    <h2>Cadastrar vaga</h2>

    <form method="POST">
        <div class="form-group mt-3">
            <label for="title">Titulo</label>
            <input class="form-control" name="title" type="text">
        </div>

        <div class="form-group mt-3">
            <label for="description">Descrição</label>
            <textarea name="description" class="form-control" rows="5"></textarea>
        </div>

        <div class="form-group mt-3">
            <label>Estatus</label>

            <div class="mt-3">
                <div class="form-check form-check-inline">
                    <label class="form-control" for="active">
                        <input type="radio" name="active" value="y" checked> Ativo
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-control" for="active">
                        <input type="radio" name="active" value="n"> Inativo
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <button class="btn btn-success" name="send" type="submit">Cadastrar</button>
        </div>
    </form>
</section>