<div id="uae-user-single-add" class="w-100">
    <div class="row">
        <div class="col-12 col-md-6 order-1 order-md-0 d-flex justify-content-center align-items-center justify-content-md-start mb-5">
            <?php echo form_open('users/update', array('class' => 'w-75 needs-validation'), array('id' => $user['id'])) ?>
            <div class="mb-3">
                <label for="co-username" class="form-label">إسم المستخدم</label>
                <input type="text" class="form-control" id="co-username" name="username" value="<?= set_value('username', $user['username']) ?>">
            </div>
            <div class="mb-3">
                <label for="co-display_name" class="form-label">الإسم الكامل</label>
                <input type="text" class="form-control" id="co-display_name" name="display_name" value="<?= set_value('display_name', $user['display_name']) ?>">
            </div>
            <div class="mb-3">
                <label for="co-password" class="form-label">كلمة المرور</label>
                <input type="password" class="form-control" id="co-password" name="password" value="<?= set_value('password') ?>">
                <div class="d-flex justify-content-end">
                    <i class="bi bi-eye-fill uae-toggle-pass"></i>
                </div>
            </div>
            <div class="mb-3">
                <label for="co-passwordconfirm" class="form-label">إعادة كلمة المرور</label>
                <input type="password" class="form-control" id="co-passwordconfirm" name="passwordconfirm" value="<?= set_value('password') ?>">
                <div class="d-flex justify-content-end">
                    <i class="bi bi-eye-fill uae-toggle-pass"></i>
                </div>
            </div>
            <div class="mb-5">
                <label for="co-is_admin" class="form-label">الدور</label>
                <select class="form-select" name="is_admin" id="co-is_admin">
                    <option value="1" <?= $user['is_admin'] ? 'selected' : '' ?>>مدير</option>
                    <option value="0" <?= $user['is_admin'] ? '' : 'selected' ?>>مشاهد</option>
                </select>
            </div>

            <?php if (isset($validation)) : ?>
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="d-grid gap-4">
                <button type="submit" class="btn btn-block btn-warning btn-lg">تحديث</button>
            </div>
            </form>
        </div>
    </div>
</div>