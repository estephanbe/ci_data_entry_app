<div id="uae-single-entry">
    <div class="row mb-3">
        <div id="uae-single-actions" class="col-12 col-md-4 d-flex justify-content-center justify-content-md-start align-items-center">
            <button type="button" class="btn btn-success btn-lg" onclick="window.print();">
                طباعة
            </button>
            
            <a type="button" href="<?= base_url('entries/' . $entry['id'] . '/edit'); ?>" class="btn btn-warning btn-lg ms-3 me-3">
                تعديل
            </a>
            <button type="button" class="btn btn-danger btn-lg" onclick="deleteSingleEntry(<?= $entry['id'] . ', \'' . $entry['name'] . '\'' ?>);">
                حذف
            </button>
        </div>
    </div>
    <div class="row w-100">
        <div class="col-12 col-md-4 d-flex align-items-center justify-content-center justify-content-start justify-content-md-start ">
            <table class="table w-auto">
                <tbody>
                    <tr>
                        <th scope="row">
                            الإسم:
                            </td>
                        <td>
                            <?php echo $entry['name']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span><strong>البلد:</strong></span>
                        </td>
                        <td>
                            <?php echo $entry['country']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span><strong>الجنسية:</strong></span>
                        </td>
                        <td>
                            <?php echo $entry['nationality']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span><strong>المهنة:</strong></span>
                        </td>
                        <td>
                            <?php echo $entry['occupation']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12 col-md-8 d-flex justify-content-center justify-content-start justify-content-md-start pt-4 pt-md-0">
            <div class="uae-single-img-wrapper">
                <?php
                $image_url = '';
                if (empty($entry['photo_url']))
                    $image_url = base_url('assets/images/image_placeholder.webp');
                else
                    $image_url = $entry['photo_url'];

                echo img(array(
                    'src' => $image_url,
                    'class' => 'img-thumbnail',
                    'alt' => $entry['name']
                ));
                ?>
            </div>
        </div>

    </div>
</div>