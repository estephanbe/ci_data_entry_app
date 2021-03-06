<div class="me-5 ms-5" id="uae-action-main-header">
    <div class="row align-items-center">
        <?= form_open('/', array('class' => 'd-flex flex-wrap align-items-stretch col-12 col-lg-8', 'method' => 'GET')) ?>
        <button class="btn btn-outline-success" type="submit">إبحث</button>
        <span class="uae-search-seperator">في</span>
        <div class="d-flex">
            <select name="search_filter" id="aue-search-type" class="me-2 form-select w-75">
                <option value="name">الأسماء</option>
                <option value="country">البلدان</option>
                <option value="nationality">الجنسيات</option>
                <option value="occupation">المِهن</option>
            </select>
            <span class="uae-search-seperator">عن</span>
        </div>
        <div id="uae-main-search-wrapper" class="d-flex w-100 mt-3 mt-md-0 me-md-2">
            <input class="form-control w-100" name="search_term" type="search" placeholder="كلمة البحث" aria-label="Search">
        </div>
        </form>
        <div id="group-action-btns-wrapper" class="col-12 col-lg-4 mt-3 mt-lg-0">
            <div id="group-action-btns" class="d-flex justify-content-start justify-content-lg-end flex-wrap">
                <button type="button" id="uae-group-action-print" class="uae-action-btn btn btn-secondary">
                    طباعة
                </button>
                <a href="#" id="uae-group-action-excel" class="uae-action-btn btn btn-secondary me-2">
                    Excel
                </a>
                <?php if (!$is_search) : ?>
                    <select name="search-type" id="aue-num-of-entries" class="form-select me-2" title="عدد المتعاونين في كل صفحة">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="all">الكل</option>
                    </select>
                <?php else : ?>
                    <a href="<?= base_url(); ?>" class="btn btn-secondary me-2">
                        عودة إلى القائمة الرئيسية
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12 d-flex justify-content-start justify-content-lg-end align-items-center">
            عدد جميع المتعاونين:
            <strong class="me-2">
                <?= $entries_count ?>
            </strong>
        </div>
    </div>
</div>

<div id="aue-main-table" class="m-5 mt-3 table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" id="uae-select-all-wrapper">
                    <input class="form-check-input" type="checkbox" id="uae-select-all">
                </th>
                <th scope="col">الإسم</th>
                <th scope="col">البلد</th>
                <th scope="col">الجنسية</th>
                <th scope="col">المهنة</th>
                <th scope="col" class="uae-single-action-header"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entries as $value) : ?>
                <tr class="uae-select-row" data-id="<?= $value['id'] ?>" id="uae-table-single-entry-<?= $value['id'] ?>">
                    <td scope="row" class="uae-select-wrapper">
                        <input class="form-check-input uae-select" type="checkbox">
                    </td>
                    <td><?= $value['name'] ?></td>
                    <td><?= $value['country'] ?></td>
                    <td><?= $value['nationality'] ?></td>
                    <td><?= $value['occupation'] ?></td>
                    <td class="uae-single-action">
                        <a href="<?= base_url('entries/' . $value['id']) ?>" class="uae-action-btn badge rounded-pill bg-success">
                            <i class="bi bi-eye"></i>
                        </a>
                        <?php if (session()->get('is_admin')) : ?>
                            <a href="<?= base_url('entries/' . $value['id'] . '/edit'); ?>" class="uae-action-btn badge rounded-pill bg-warning">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a href="#" onclick="deleteEntryTable(<?= $value['id'] ?>, '<?= $value['name'] ?>')" class="uae-action-btn uae-action-btn-delete badge rounded-pill bg-danger">
                                <i class="bi bi-trash"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php if (!$is_search) : ?>
    <div class="row m-5" id="uae-main-page-pages-nav">
        <div class="col-6 col-lg-4 d-flex justify-content-start align-items-center order-1 order-lg-0">
            <button class="btn btn-primary btn-lg" id="uae-prev-btn">الصفحة السابقة</button>
        </div>
        <div id="uae-page-number-wrapper" class="col-12 col-lg-4 d-flex flex-wrap justify-content-center align-items-center order-0 order-lg-1 mb-3 mb-lg-0">
            <div>
                صفحة رقم
                <span id="uae-page-number" class="me-2 ms-2"></span>
            </div>
            <div>
                من أصل
                <span class="me-2 ms-2" id="uae-page-total-number"></span>
            </div>
        </div>
        <div class="col-6 col-lg-4 d-flex justify-content-end align-items-center order-2 order-lg-2">
            <button class="btn btn-primary btn-lg" id="uae-next-btn">الصفحة التالية</button>
        </div>
    </div>
<?php endif; ?>