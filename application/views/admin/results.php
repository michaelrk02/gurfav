<div class="m-2">
    <div class="m-2">
        <table class="table table-striped table-hover">
            <tr>
                <th>Kategori</th>
                <th>Nama guru</th>
                <th>Skor</th>
            </tr>
            <?php foreach ($winners as $id => $winner) { ?>
                <tr>
                    <td><?php echo $categories[$id]; ?></td>
                    <td><?php echo $winner['name']; ?></td>
                    <td><?php echo $winner['score']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="m-2">
        <a href="<?php echo site_url('admin/logout'); ?>" class="btn btn-error">Keluar</a>
    </div>
</div>
