<div id="aue-users-table" class="m-5 mt-3">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">إسم المستخدم</th>
                <th scope="col">كلمة المرور</th>
                <th scope="col">الإسم الظاهر</th>
                <th scope="col" class="uae-single-action-header"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $value) : ?>
                <tr>
                    <td><?php echo $value['username']; ?></td>
                    <td><?php echo $value['password']; ?></td>
                    <td><?php echo $value['display_name']; ?></td>
                    <td class="uae-single-action">
                        <button class="uae-user-action-btn btn btn-warning btn-sm">
                            تحديث كلمة المرور
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="passwordUpdate" tabindex="-1" aria-labelledby="passwordUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title" id="passwordUpdateLabel">تحديث كلمة المرور</h5>
            </div>
            <div class="modal-body">
                <form id="uae-pass-submission-form" class="needs-validation">
                    <div class="mb-3">
                        <label for="uae-pass" class="col-form-label">كلمة المرور الجديدة</label>
                        <input type="text" class="form-control" id="uae-pass" name="uae-pass" required>
                    </div>
                    <div class="mb-3">
                        <label for="uae-pass-again" class="col-form-label">كلمة المرور مرة أخرى</label>
                        <input type="text" class="form-control" id="uae-pass-again" name="uae-pass-again" required>
                    </div>
                    <div id="uae-pass-validation-error-empty" class="alert alert-danger d-none" role="alert">
                        إحدى الحقول فارغ!
                    </div>
                    <div id="uae-pass-validation-error" class="alert alert-danger d-none" role="alert">
                        الحقلين غير متطابقين!
                    </div>
                    <button id="uae-form-submit-btn" type="submit" class="btn btn-success">تحديث</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                </form>
            </div>
        </div>
    </div>
</div>