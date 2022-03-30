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

if (isModalOpen()) {
    include __DIR__ . '/delete-modal.php';
}

// Jobs list
$jobList = '';
foreach ($jobs as $job) {
    $jobList .= '<tr>
                    <td>' . $job->title . '</td>
                    <td>' . $job->description . '</td>
                    <td>' . ($job->active === 'y' ? 'Ativo' : 'Inativo') . '</td>
                    <td>' . date('d/m/Y à\s H:i:s', strtotime($job->date)) . '</td>
                    <td class="d-flex">
                        <div>
                            <form method="GET" action="/edit.php">
                                <input type=text style="display: none;" name="id" value="' . $job->id . '" >
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </form>
                        </div>
                        <div class="ms-1">
                            <form method="GET">
                                <input type=text style="display: none;" name="title" value="' . $job->title . '" >
                                <input type=text style="display: none;" name="id" value="' . $job->id . '" >
                                <input type=text style="display: none;" name="deleteModalOpen" value="true" >
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </div>
                    </td>
                 </tr>';
}

$jobList = strlen($jobList)
    ? $jobList
    : '<tr><td colspan="6" class="text-center">Nenhum resultado encontrado</td></tr>';

// GETS
unset($_GET['page']);
$gets = http_build_query($_GET) ? '&' . http_build_query($_GET) : '';

// pagination
$pages      = $paginationService->getPages();
$pagination = '
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href=?page=' . $currentPage - 1 . $gets . '>Previous</a></li>
        ';

foreach ($pages as $page) {
    $active = $page['currentPage'] ? 'active' : '';

    $pagination .= '
        <li class="page-item ' . $active . '"><a class="page-link" href=?page=' . $page['page'] . $gets . '>' . $page['page'] . '</a></li>
    ';
}

$pagination .= '
                <li class="page-item"><a class="page-link" href=?page=' . $currentPage + 1 . $gets . '>Next</a></li>
            </ul>
        </nav>';

?>

<section class="mt-3">
    <?php echo showMessage(); ?>
    <a href="/register-job.php">
        <button class="btn btn-success">
            Nova vaga
        </button>
    </a>
</section>

<section class="mt-3">
    <form method="GET">
        <div class="row">
            <div class="col">
                <input class="form-control" type="text" name="search" placeholder="Buscar por vaga"
                    value="<?php echo $search ?>">
            </div>

            <div class="col">
                <select class="form-control" name="active">
                    <option value="">Todos</option>
                    <option value="y" <?php echo $status === 'y' ? 'selected' : '' ?>>Ativos</option>
                    <option value="n" <?php echo $status === 'n' ? 'selected' : '' ?>>Inativos</option>
                </select>
            </div>

            <div class="col">
                <button class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
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
            <?php echo $jobList ?>
        </tbody>
    </table>
</section>

<section>
    <?php echo $pagination; ?>
</section>