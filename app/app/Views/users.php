<div id="aue-users-table" class="m-5 mt-3">
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">إسم المستخدم</th>
                    <th scope="col">الإسم الظاهر</th>
                    <th scope="col">الدور</th>
                    <th scope="col" class="uae-single-action-header">
                        <a href="<?= base_url() . '/users/new' ?>" class="btn btn-success btn-sm">
                            إضافة مستخدم
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $value) : ?>
                    <tr>
                        <td><?= $value['username']; ?></td>
                        <td><?= $value['display_name']; ?></td>
                        <td><?= $value['is_admin'] ? "مدير" : "مشاهد"; ?></td>
                        <td class="uae-single-action">
                            <a href="<?= base_url() . '/users/edit/?user_id=' . $value['id'] ?>" class="uae-user-action-btn btn btn-warning btn-sm">
                                تعديل البيانات
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>