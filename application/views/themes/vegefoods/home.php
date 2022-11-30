<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<section id="home-section" class="hero">
  <div class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(<?php echo get_theme_uri('images/bg_1.jpg'); ?>);">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

          <div class="col-md-12 ftco-animate text-center">
            <h1 class="mb-2">Pelopor Dessert No #1<br>di Indonesia </h1>
            <h2 class="subheading mb-4">Anda Kenyang, Anda Puas, Kami Senang!</h2>
            <p><a href="#products" class="btn btn-primary">Belanja Sekarang</a></p>
          </div>

        </div>
      </div>
    </div>

    <div class="slider-item" style="background-image: url(<?php echo get_theme_uri('images/bg_2.jpg'); ?>);">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

          <div class="col-sm-12 ftco-animate text-center">
            <h1 class="mb-2">100% Pemanis Alami*
</h1>
            <h2 class="subheading mb-4">*Kecuali Kamu, Manis Tapi Tak Untukku</h2>
            <p><a href="#products" class="btn btn-primary">Belanja Sekarang</a></p>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row no-gutters ftco-services">
      <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
            <span class="flaticon-shipped"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Gratis Ongkir</h3>
            <span>Belanja minimal Rp <?php echo format_rupiah(get_settings('min_shop_to_free_shipping_cost')); ?></span>
          </div>
        </div>
      </div>
      <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
            <span class="flaticon-diet"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Selalu Segar</h3>
            <span>Diproduksi dari bahan pilihan</span>
          </div>
        </div>
      </div>
      <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
            <span class="flaticon-award"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Kualitas Terbaik</h3>
            <span>Diolah oleh Pâtissier terbaik</span>
          </div>
        </div>
      </div>
      <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
            <span class="flaticon-customer-service"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Bantuan</h3>
            <span>Bantuan 24/7 Selalu Online</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="ftco-section" id='products'>
  <div class="container">
    <div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-center ftco-animate">
        <span class="subheading" >Produk Terbaru</span>
        <h2 class="mb-4"><?php echo get_store_name(); ?></h2>
        <p><?php echo get_settings('store_tagline'); ?></p>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <?php if (count($products) > 0) : ?>
        <?php foreach ($products as $product) :
                if($product->stock>0&&$product->is_available==1): ?>
          <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
              <a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku . '/'.'#produk'); ?>" class="img-prod">
                <img class="img-fluid" src="<?php echo base_url('assets/uploads/products/' . $product->picture_name); ?>" alt="<?php echo $product->name; ?>">
                <?php if ($product->current_discount > 0) : ?>
                  <span class="status"><?php echo count_percent_discount($product->current_discount, $product->price, 0); ?>%</span>
                <?php endif; ?>
                <div class="overlay"></div>
              </a>
              <div class="text py-3 pb-4 px-3 text-center">
                <h3><a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku . '/'.'#produk'); ?>"><?php echo $product->name; ?></a></h3>
                <div class="d-flex">
                  <div class="pricing">
                    <p class="price">
                      <?php if ($product->current_discount > 0) : ?>
                        <span class="mr-2 price-sale">Rp <?php echo format_rupiah($product->price - $product->current_discount); ?></span><br><span class="mr-2 price-dc">Rp <?php echo format_rupiah($product->price); ?></span>
                      <?php else : ?>
                        <span class="mr-2"><span class="price-sale">Rp <?php echo format_rupiah($product->price - $product->current_discount); ?></span>
                        <?php endif; ?>
                    </p>
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
      <?php else : ?>
      <?php endif; ?>

    </div>
  </div>
</section>

<section class="ftco-section img" style="background-image: url(<?php echo get_theme_uri('images/bg_3.jpg'); ?>);">
  <div class="container">
    <div class="row justify-content-end">
      <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">
      <?php if($best_deal->current_discount>0):?>
        <span class="subheading">Produk dengan Harga Terbaik</span>
        <h2 class="mb-4">Deal of the day</h2>
        <p><?php echo $best_deal->description; ?></p>
        <h3><a href="<?php echo site_url('shop/product/' . $best_deal->id . '/' . $best_deal->sku . '/'.'#produk'); ?>"><?php echo $best_deal->name; ?></a></h3>
        <span class="price">Rp <?php echo format_rupiah($best_deal->price); ?> <a href="<?php echo site_url('shop/product/' . $best_deal->id . '/' . $best_deal->sku . '/'.'#produk'); ?>">sekarang hanya Rp <?php echo format_rupiah($best_deal->price - $best_deal->current_discount); ?></a></span>
      <?php else: ?>
        <span class="subheading">Produk Hari Ini</span>
        <h2 class="mb-4">Today's Product</h2>
        <p><?php echo $best_deal->description; ?></p>
        <h3><a href="<?php echo site_url('shop/product/' . $best_deal->id . '/' . $best_deal->sku . '/'.'#produk'); ?>"><?php echo $best_deal->name; ?></a></h3>
        <span class="price">Rp <?php echo format_rupiah($best_deal->price); ?></span>
      <?php endif;?>
      </div>
    </div>
  </div>
</section>
