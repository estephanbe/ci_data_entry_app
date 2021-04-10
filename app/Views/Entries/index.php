<div class="me-5 ms-5" id="uae-action-main-header">
    <div class="row align-items-center">
        <form class="d-flex flex-wrap col-12 col-sm-8">
            <button class="btn btn-outline-success" type="submit">إبحث</button>
            <div class="d-flex">
                <span class="uae-search-seperator">في</span>
                <select name="search-type" id="aue-search-type" class="me-2 form-select w-75">
                    <option value="">الأسماء</option>
                    <option value="">البلدان</option>
                    <option value="">الجنسيات</option>
                    <option value="">المِهن</option>
                </select>
                <span class="uae-search-seperator">عن</span>
            </div>
            <div class="d-flex">
                <input class="form-control me-0 me-md-2 w-100 mt-3 mt-md-0" type="search" placeholder="كلمة البحث" aria-label="Search">
            </div>
        </form>
        <div id="group-action-btns-wrapper" class="col-12 col-sm-4 mt-3 mt-sm-0">
            <div id="group-action-btns" class="d-flex justify-content-end">
                <select name="search-type" id="aue-num-of-entries" class="ms-2 form-select" title="عدد المتعاونين في كل صفحة">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="all">الكل</option>
                </select>
                <button type="button" id="uae-group-action-print" class="uae-action-btn btn btn-secondary btn-sm">
                    طباعة
                </button>
                <a href="" id="uae-group-action-excel" class="uae-action-btn btn btn-secondary btn-sm me-2">
                    Excel
                </a>


            </div>
        </div>
    </div>
</div>

<div id="aue-main-table" class="m-5 mt-3">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" id="uae-select-all-wrapper">
                    <input class="form-check-input" type="checkbox" value="" id="uae-select-all">
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
                <tr>
                    <td scope="row" class="uae-select-wrapper">
                        <input class="form-check-input uae-select" type="checkbox" value="">
                    </td>
                    <td><?php echo $value['name']; ?></td>
                    <td><?php echo $value['country']; ?></td>
                    <td><?php echo $value['nationality']; ?></td>
                    <td><?php echo $value['occupation']; ?></td>
                    <td class="uae-single-action">
                        <a href="<?php echo base_url('entries/' . $value['id']) ?>" class="uae-action-btn badge rounded-pill bg-success">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="<?php echo base_url('entries/' . $value['id'] . '/edit'); ?>" class="uae-action-btn badge rounded-pill bg-warning">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a href="" class="uae-action-btn badge rounded-pill bg-danger">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>