        <?php if ($segments[0] !== 'login') : ?>
            </div>
        <?php endif; ?>

        <script>
            var baseUrl = "<?= base_url(); ?>/";
            <?php if (isset($entries_count)): ?>
                var totalEntries = <?= $entries_count ?>;
            <?php endif; ?>
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        
        <?php if ($segments[0] !== 'users') : ?>
            <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
            <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
        <?php endif; ?>

        <?php
        echo script_tag('assets/js/main.js');
        ?>
        </body>

        </html>