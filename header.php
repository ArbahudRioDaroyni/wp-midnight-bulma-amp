<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "header" tag.
 *
 * @link https://github.com/ArbahudRioDaroyni/
 * @package WP Midnight Bulma AMP
 * @subpackage WP Midnight Bulma AMP
 */
  
?>
<!doctype html>
<html ⚡ lang="<?php bloginfo( 'language' ); ?>" data-theme="dark">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta content="text/html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Hack, Cheat, Slot, Aplikasi, APK, MOD">
	  <meta name='author' content='<?php bloginfo( 'name' ); ?>' />
    <!-- google-site-verification -->
    <!-- <meta name="google-site-verification" content="1GS5b8XueaIk5rOTEhD8hwGXIfoZfAtK2KTCJlkJNDY"> -->

    <!-- start wp_head -->
    <?php wp_head(); ?>
    <!-- end wp_head -->

    <!-- script amp project main -->
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <!-- amp-ads -->
    <!-- <script async custom-element="amp-auto-ads" src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js"></script>
    <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3780041077137992"
    crossorigin="anonymous"></script> -->
    <!-- amp-image-lightbox -->
    <script async custom-element="amp-image-lightbox" src="https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js"></script>
    <!-- amp-form -->
    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <!-- amp-mustache -->
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
    <!-- if file post-type amp-script -->
    <?= (is_singular('file')) ? '<script async custom-element="amp-script" src="https://cdn.ampproject.org/v0/amp-script-0.1.js"></script>' : '' ?>
    <!-- if file post-type amp-bind -->
    <script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>

    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <style amp-custom>
      @import url('<?= get_template_directory_uri() ?>/assets/midnight-bulma/css/midnight-bulma.min.css');
    </style>
  </head>
  <body>
    <!-- <amp-auto-ads type="adsense" data-ad-client="ca-pub-3780041077137992" class="i-amphtml-layout-container" i-amphtml-layout="container"></amp-auto-ads> -->
    <!-- START: header -->
    <header>
      <!-- START: navbar -->
      <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
          <a class="navbar-item" href="<?php bloginfo( 'url' ); ?>">
            <img src="<?= get_template_directory_uri() ?>/assets/images/logo-jejak-cyber.png" alt="<?php bloginfo( 'name' ); ?>" width="146" height="27">
          </a>
          <a
            role="button"
            class="navbar-burger has-text-light"
            aria-label="menu"
            aria-expanded="false"
            data-target="navbarBasicExample"
            on="tap:AMP.setState({ navbarActive: !navbarActive })"
            [class]="navbarActive ? 'is-active navbar-burger has-text-light' : 'navbar-burger has-text-light'">
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
          </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu" [class]="navbarActive ? 'is-active navbar-menu' : 'navbar-menu'">
          <div class="navbar-end">
            <?php $categories = get_categories( ['orderby' => 'id', 'order' => 'DESC'] );
            foreach( $categories as $category ) : ?>
              <li class="is-flex is-align-content-center" <?php if (is_category()) {
                  echo (get_the_category()[0]->slug == $category->slug) ? 'class="active"' : '' ;
              } ?> >
                <a href="<?= esc_url( get_category_link( $category->term_id ) ) ?>" class="navbar-item"><?= esc_html( $category->name ) ?></a>
              </li>
            <?php endforeach; ?>

            <!-- <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link">
                More
              </a>

              <div class="navbar-dropdown">
                <a class="navbar-item">
                  About
                </a>
                <a class="navbar-item is-selected">
                  Jobs
                </a>
                <a class="navbar-item">
                  Contact
                </a>
                <hr class="navbar-divider">
                <a class="navbar-item">
                  Report an issue
                </a>
              </div>
            </div> -->
          </div>

          <!-- <div class="navbar-end">
            <div class="navbar-item">
              <div class="buttons">
                <a class="button is-primary">
                  <strong>Sign up</strong>
                </a>
                <a class="button is-light">
                  Log in
                </a>
              </div>
            </div>
          </div> -->
        </div>
      </nav>
      <!-- END: navbar -->
    </header>
    <!-- END: header -->