<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="hero-wrap hero-bread" style="background-image: url('<?php echo get_theme_uri('images/bg_2.jpg'); ?>');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><?php echo anchor(base_url(), 'Home'); ?></span>
                    <span class="mr-2"><?php echo anchor('browse', 'Produk'); ?></span>
                    <span><?php echo $product->name; ?></span></p>
                <h1 class="mb-0 bread"><?php echo $product->name; ?></h1>
            </div>
        </div>
    </div>
</div>

<?php
$carts=[];
$itemDiCart=0;
foreach ($this->cart->contents() as $items)
{
    $carts[$items['rowid']]['id'] = $items['id'];
    $carts[$items['rowid']]['name'] = $items['name'];
    $carts[$items['rowid']]['qty'] = $items['qty'];
    $carts[$items['rowid']]['price'] = $items['price'];
    $carts[$items['rowid']]['subtotal'] = $items['subtotal'];

    if($product->id==$items['id']){
        $itemDiCart=$items['qty'];
    }
   
}
$itemBisaBeli = (($product->stock))-$itemDiCart;
//echo (($product->stock)).$itemDiCart;
//echo (($product->stock))-$itemDiCart;
echo "<div id='produk'></div>";
?>

<input type="hidden" id="maxQuantity" name="maxQuantity" class='maxQuantity' value="<?php echo $itemBisaBeli;?>"  >
<input type="hidden" id="itemBisaBeli" name="itemBisaBeli" value="<?php echo $itemBisaBeli;?>">
<section class="ftco-section" id='produk'>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="<?php echo base_url('assets/uploads/products/' . $product->picture_name); ?>" class="image-popup"><img src="<?php echo base_url('assets/uploads/products/' . $product->picture_name); ?>" class="img-fluid" alt="<?php echo $product->name; ?>"></a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3><?php echo $product->name; ?></h3>
  
                <p class="price">
                    <?php if ($product->current_discount > 0) : ?>
                        <span class="mr-2 price-dc"><strike><small>Rp <?php echo format_rupiah($product->price); ?></small></strike></span>
                        <span class="price-sale text-success">Rp <?php echo format_rupiah($product->price - $product->current_discount); ?></span>
                    <?php else : ?>
                        <span>Rp <?php echo format_rupiah($product->price); ?></span>
                    <?php endif; ?>
                </p>
                <p><?php echo $product->description; ?></p>
                <div class="row mt-4">
                    <div class="w-100"></div>
                    <div class="input-group col-md-6 d-flex mb-3">
                        <span class="input-group-btn mr-2">
                            <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                <i class="ion-ios-remove"></i>
                            </button>
                        </span>
                        <input type="number" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="<?php echo $itemBisaBeli;?>" readonly>
                        <span class="input-group-btn ml-2">
                            <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                <i class="ion-ios-add"></i>
                            </button>
                        </span>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <p style="color: #000;"><?php echo $product->stock; ?> <?php echo $product->product_unit; ?> <span style="color: #bbb;">Tersedia</span></p>


                    </div>
                    <div class="rating d-flex">
                </div>
                </div>
                <p><a href="#" id='inputButton' class="btn btn-black btn-sm py-3 px-5 add-cart cart-btn" data-sku="<?php echo $product->sku; ?>" data-name="<?php echo $product->name; ?>" data-price="<?php echo ($product->current_discount > 0) ? ($product->price - $product->current_discount) : $product->price; ?>" data-id="<?php echo $product->id; ?>" >Add to Cart</a></p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Produk Lain</span>
                <h2 class="mb-4">Produk lain yang terkait</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php if (count($related_products) > 0) : ?>
                <?php foreach ($related_products as $product) :
                        if($product->stock>0): ?>
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku . '/'.'#produk'); ?>" class="img-prod"><img class="img-fluid" src="<?php echo base_url('assets/uploads/products/' . $product->picture_name); ?>" alt="<?php echo $product->name; ?>">
                                <?php if ($product->current_discount > 0) : ?>
                                    <span class="status"><?php echo count_percent_discount($product->current_discount, $product->price); ?>%</span>
                                <?php endif; ?>
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><?php echo anchor('shop/product/' . $product->id . '/' . $product->sku . '/'.'#produk', $product->name); ?></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price">
                                            <?php if ($product->current_discount > 0) : ?>
                                                <span class="mr-2 price-dc">Rp <?php echo format_rupiah($product->price); ?></span>
                                                <span class="price-sale">Rp <?php echo format_rupiah($product->price - $product->current_discount); ?></span></p>
                                    <?php else : ?>
                                        <span class="price-sale">Rp <?php echo format_rupiah($product->price); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku . '/'.'#produk'); ?>" class="buy-now d-flex justify-content-center align-items-center text-center">
                                            <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>

<script>
    $(document).ready(function() {

        var quantitiy = 0;
        $('.quantity-right-plus').click(function(e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());
            var maxQuantity = parseInt($('#maxQuantity').val());

            // If is not undefined
            if (quantity < maxQuantity) {
                $('#quantity').val(quantity + 1);
                $('.cart-btn').attr('data-qty', quantity + 1);
            }
            // Increment

        });

        $('.quantity-left-minus').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            // Increment
            if (quantity > 1) {
                $('#quantity').val(quantity - 1);
                $('.cart-btn').attr('data-qty', quantity - 1);
            }
        });
        


    });
    

 
</script> 