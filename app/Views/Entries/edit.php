<div id="uae-single-add" class="w-100">
    <div class="row">
        <div class="col-12 col-md-6 order-1 order-md-0 d-flex justify-content-center align-items-center justify-content-md-start mb-5">
            <form class="w-75">
                <div class="mb-3">
                    <label for="co-name" class="form-label">الإسم</label>
                    <input type="text" class="form-control" id="co-name" name="co-name" value="<?php echo $entry['name']; ?>">
                </div>
                <div class="mb-3">
                    <label for="co-country" class="form-label">البلد</label>
                    <input type="text" class="form-control" id="co-country" name="co-country" value="<?php echo $entry['country']; ?>">
                </div>
                <div class="mb-3">
                    <label for="co-nationality" class="form-label">الجنسية</label>
                    <input type="text" class="form-control" id="co-nationality" name="co-nationality" value="<?php echo $entry['nationality']; ?>">
                </div>
                <div class="mb-3">
                    <label for="co-occupation" class="form-label">المهنة</label>
                    <input type="text" class="form-control" id="co-occupation" name="co-occupation" value="<?php echo $entry['occupation']; ?>">
                </div>
                <div class="mb-5">
                    <label for="co-photo" class="form-label">الصورة</label>
                    <input class="form-control form-control-lg" id="co-photo" name="co-photo" type="file" onchange="readURL(this);" value="<?php echo $entry['photo_url']; ?>">
                </div>

                <div class="d-grid gap-4">
                    <button type="submit" class="btn btn-block btn-warning btn-lg">تحديث</button>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-center align-items-center order-0 order-md-1">
            <div class="uae-image-wrapper m-4">
                <?php
                echo img(array(
                    'src' => $entry['photo_url'],
                    'class' => 'img-thumbnail',
                    'id' => 'aue-single-add-img',
                    'alt' => 'placeholder'
                ));
                ?>
            </div>
        </div>
    </div>
</div>