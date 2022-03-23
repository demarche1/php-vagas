<?php

$results = '';

foreach ($jobs as $job) {
    $results .= '<tr>
                    <td>' . $job->title . '</td>
                    <td>' . $job->description . '</td>
                    <td>' . ($job->active === 'y' ? 'Ativo' : 'Inativo') . '</td>
                    <td>' . $job->date . '</td>
                 </tr>';
}


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
            <?= $results ?>
        </tbody>
    </table>
</section>