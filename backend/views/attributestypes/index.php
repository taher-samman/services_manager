<?php
$types = $model->find()->all();
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Html</th>
            <th scope="col">Options</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($types as $key => $type) { ?>
            <tr>
                <th scope="row"><?= $type->id ?></th>
                <td><?= $type->name ?></td>
                <td><?= $type->html_value ?></td>
                <td><?= $type->has_options ?></td>
            </tr>
        <?php }
        ?>
    </tbody>
</table>