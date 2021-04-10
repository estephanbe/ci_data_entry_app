<div class="row m-0 h-100" id="aue-login">
    <div class="col p-0 text-center d-flex justify-content-center align-items-center display-none">
        <?= img(array(
            'src' => 'assets/images/login.svg',
            'class' => 'w-100'
        )) ?>
    </div>
    <div class="col p-0 bg-custom d-flex justify-content-center align-items-center flex-column w-100">
        <div class="row text-center mb-5">
            <h1>نظام الإستمارة الإلكترونية</h1>
        </div>
        <?php echo form_open('login/authenticate', array('class' => 'w-50 needs-validation')) ?>
        <div class="mb-3">
            <div class="d-flex flex-nowrap">
                <div class="ps-2 d-flex justify-content-center align-items-center">
                    <i class="bi bi-person"></i>
                </div>
                <input type="text" class="form-control" id="login-username" placeholder="إسم المستخدم" name="username" required>
            </div>
        </div>
        <div class="mb-3">
            <div class="d-flex flex-nowrap">
                <div class="ps-2 d-flex justify-content-center align-items-center">
                    <i class="bi bi-lock"></i>
                </div>
                <input type="password" class="form-control" id="login-password" placeholder="كلمة المرور" name="password" required>
            </div>
        </div>
        <?php if (isset($validation)) : ?>
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <?= $validation->listErrors() ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="d-flex justify-content-center align-items-center w-100">
            <button type="submit" class="btn btn-custom btn-lg btn-block mt-3 me-5 w-50">دخول</button>
        </div>
        </form>
    </div>
</div>