<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <h1><?= lang('shopping_cart') ?></h1>
    <hr>
    <?php
    if ($cartItems['array'] == null) {
        ?>
        <div class="alert alert-info"><?= lang('no_products_in_cart') ?></div>
    <?php } else { ?>
        <div class="table-responsive">
            <table class="table table-bordered table-products">
                <thead>
                    <tr>
                        <th><?= lang('product') ?></th>
                        <th><?= lang('title') ?></th>
                        <th><?= lang('quantity') ?></th>
                        <th><?= lang('price') ?></th>
                        <th><?= lang('total') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems['array'] as $item) { ?>
                        <tr>
                            <td class="relative">
                                <input type="hidden" name="product_id[]" value="<?= $item['product_id'] ?>">
                                <input type="hidden" name="quantity[]" value="<?= $item['num_added'] ?>">
                                <img class="product-image" src="<?= base_url('/attachments/shop_images/' . $item['image']) ?>" alt="">
                                <a href="<?= base_url('home/removeFromCart?delete-product=' . $item['product_id'] . '&back-to=shopping-cart') ?>" class="btn btn-xs btn-danger remove-product">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            </td>
                            <td><a href="<?= base_url($item['url']) ?>"><?= $item['title'] ?></a></td>
                            <td>
                                <a class="btn btn-xs btn-primary refresh-me add-to-cart" data-id="<?= $item['product_id'] ?>" href="javascript:void(0);">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </a>
                                <span class="quantity-num">
                                    <?= $item['num_added'] ?>
                                </span>
                                <a class="btn  btn-xs btn-danger" onclick="removeProduct(<?= $item['product_id'] ?>, true)" href="javascript:void(0);">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </a>
                            </td>
                            <td><?= $item['price'] . $currency ?></td>
                            <td><?= $item['sum_price'] . $currency ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4" class="text-right"><?= lang('total') ?></td>
                        <td><?= $cartItems['finalSum'] . $currency ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="<?= $lang_url ?>" class="btn btn-primary pull-left"><span class="glyphicon glyphicon-circle-arrow-left"></span> <?= lang('back_to_shop') ?></a>
            <a class="btn btn-primary pull-right" href="<?= $lang_url . '/checkout' ?>"><?= lang('checkout') ?> <i class="fa fa-credit-card-alt" aria-hidden="true"></i></a>
        </div>
    <?php } ?>
</div>
<?php
if ($this->session->flashdata('deleted')) {
    ?>
    <script>
        $(document).ready(function () {
            ShowNotificator('alert-danger', '<?= $this->session->flashdata('deleted') ?>');
        });
    </script>
<?php } ?>