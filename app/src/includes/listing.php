<?php


function showMessage()
{
    $message = '';

    if (isset($_GET['status'])) {
        switch ($_GET['status']) {
            case 'success':
                $message = '<div class="mt-3 alert alert-success" role="alert">✅ Ação executada com sucesso!</div>';
                break;

            case 'error':
                $message = '<div class="mt-3 alert alert-warning" role="alert">❌ Falha ao executar ação!</div>';
                break;
        }
    }

    return $message;
}

function isModalOpen()
{
    return isset($_GET['deleteModalOpen']) &&
        $_GET['deleteModalOpen'] === 'true' &&
        isset($_GET['id']) &&
        is_numeric($_GET['id']);
}

$renderJobList = function () use ($jobs) {
    $results = '';

    foreach ($jobs as $job) {
        $results .= '<tr>
                    <td>' . $job->title . '</td>
                    <td>' . $job->description . '</td>
                    <td>' . ($job->active === 'y' ? 'Ativo' : 'Inativo') . '</td>
                    <td>' . date('d/m/Y à\s H:i:s', strtotime($job->date)) . '</td>
                    <td>
                        <a href=edit.php?id=' . $job->id . '>
                            <button class="btn btn-primary">
                                Editar
                            </button>
                        </a>
                        <a href=/?deleteModalOpen=true' . '&id=' . $job->id . '>
                            <button class="btn btn-danger">
                                Excluir
                            </button>
                        </a>
                    </td>
                 </tr>';
    }

    return $results;
};

if (isModalOpen()) {
    include __DIR__ . '/delete-modal.php';
}

echo showMessage();
?>

<section class="mt-3">
    <a href="/register.php">
        <butto class="btn btn-success">
            Nova vaga
        </butto>
    </a>
</section>

<section>
    <table class="table bg-light mt-3">
        <thead>
            <tr>
                <th>
                    Titulo
                </th>
                <th>
                    Descrição
                </th>
                <th>
                    Situação
                </th>
                <th>
                    Data
                </th>
            </tr>
        </thead>

        <tbody>
            <?php echo $renderJobList() ?>
        </tbody>
    </table>
</section>