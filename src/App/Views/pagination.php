<section class="container pagination">

    <div class="d-flex-r" class="pagination">

        <?php if ($data['current_page'] > 1) : ?>
            <a href="?page=<?php echo $data['current_page'] - 1; ?>" class="pagination-btn"> <i class="fa fa-angle-double-left" style="font-size:22px"></i> </a>
        <?php endif; ?>

        <?php for ($page = 1; $page <= $data['total_pages']; $page++) : ?>
            <a href="?page=<?php echo $page; ?>" class="<?php if ($data['current_page'] == $page) {
                                                            echo 'active';
                                                        } else {
                                                            echo '';
                                                        } ?>">
                <?php echo $page; ?>
            </a>
        <?php endfor; ?>

        <?php if ($data['current_page'] < $data['total_pages']) : ?>
            <a href="?page=<?php echo $data['current_page'] + 1; ?>" class="pagination-btn"> <i class="fa fa-angle-double-right" style="font-size:22px"></i> </a>
        <?php endif; ?>

    </div>

</section>