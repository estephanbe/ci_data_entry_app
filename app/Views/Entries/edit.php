<div id="uae-single-update" class="w-100">
    <div class="row">
        <div class="col-12 col-md-6 order-1 order-md-0 d-flex justify-content-center align-items-center justify-content-md-start mb-5">
            <?= form_open('entries/update_entry/' . $entry['id'], array('class' => 'w-75 needs-validation', 'enctype' => "multipart/form-data"), array('id' => $entry['id'])) ?>
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="co-name" class="form-label">الإسم</label>
                <input type="text" class="form-control" id="co-name" name="name" value="<?= set_value('name', $entry['name']) ?>">
            </div>
            <div class="mb-3">
                <label for="co-country" class="form-label">البلد</label>
                <input type="text" class="form-control" id="co-country" name="country" value="<?= set_value('country', $entry['country']) ?>">
            </div>
            <div class="mb-3">
                <label for="co-nationality" class="form-label">الجنسية</label>
                <input type="text" class="form-control" id="co-nationality" name="nationality" value="<?= set_value('nationality', $entry['nationality']) ?>">
            </div>
            <div class="mb-3">
                <label for="co-occupation" class="form-label">المهنة</label>
                <input type="text" class="form-control" id="co-occupation" name="occupation" value="<?= set_value('occupation', $entry['occupation']) ?>">
            </div>
            <div class="mb-5">
                <label for="co-photo" class="form-label">الصورة</label>
                <input class="form-control form-control-lg" id="co-photo" name="photo_url" type="file" onchange="readURL(this);" value="">
            </div>

            <?php if (isset($validation)) : ?>
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="d-grid gap-4">
                <button type="submit" id="single-update-form-submit" class="btn btn-block btn-warning btn-lg">تحديث</button>
            </div>
            </form>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-center align-items-center order-0 order-md-1">
            <div class="uae-image-wrapper m-4">
                <?php
                $image_url = '';
                if (empty($entry['photo_url']))
                    $image_url = base_url('assets/images/image_placeholder.webp');
                else
                    $image_url = $entry['photo_url'];

                echo img(array(
                    'src' => $image_url,
                    'id' => 'aue-single-add-img',
                    'class' => 'img-thumbnail',
                    'alt' => $entry['name']
                ));
                ?>
            </div>
        </div>
    </div>
</div>