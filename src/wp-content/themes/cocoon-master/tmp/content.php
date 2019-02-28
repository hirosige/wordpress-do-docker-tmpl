<?php //投稿・固定ページ本文
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
if ( !defined( 'ABSPATH' ) ) exit; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article') ?> itemscope="itemscope" itemprop="blogPost" itemtype="https://schema.org/BlogPosting">
  <?php
  if ( have_posts() ) {
    while ( have_posts() ) {
      the_post(); ?>

      <?php //タイトル上の広告表示
      if (is_ad_pos_above_title_visible() && is_all_adsenses_visible()){
        get_template_part_with_ad_format(get_ad_pos_above_title_format(), 'ad-above-title', is_ad_pos_above_title_label_visible());
      }; ?>

      <?php //投稿タイトル上ウイジェット
      if ( is_single() && is_active_sidebar( 'above-single-content-title' ) ): ?>
        <?php dynamic_sidebar( 'above-single-content-title' ); ?>
      <?php endif; ?>

      <header class="article-header entry-header">
        <h1 class="entry-title" itemprop="headline">
          <?php
          if (is_wpforo_plugin_page()) {
            echo wp_get_document_title();
          } else {
            the_title();
          }
           ?>
        </h1>

        <?php //タイトル下の広告表示
        if (is_ad_pos_below_title_visible() && is_all_adsenses_visible()){
          get_template_part_with_ad_format(get_ad_pos_below_title_format(), 'ad-below-title', is_ad_pos_below_title_label_visible());
        }; ?>

        <?php //投稿タイトル下ウイジェット
        if ( is_single() && is_active_sidebar( 'below-single-content-title' ) ): ?>
          <?php dynamic_sidebar( 'below-single-content-title' ); ?>
        <?php endif; ?>

        <?php //アイキャッチ挿入
        get_template_part('tmp/eye-catch'); ?>

        <?php //SNSシェアボタン
        if (is_sns_top_share_buttons_visible())
          get_template_part_with_option('tmp/sns-share-buttons', SS_TOP); ?>


        <?php //投稿日と更新日テンプレート
        get_template_part('tmp/date-tags'); ?>


         <?php //本文上の広告表示
        if (is_ad_pos_content_top_visible() && is_all_adsenses_visible()){
          get_template_part_with_ad_format(get_ad_pos_content_top_format(), 'ad-content-top', is_ad_pos_content_top_label_visible());
        }; ?>

        <?php //投稿本文上ウイジェット
        if ( is_single() && is_active_sidebar( 'single-content-top' ) ): ?>
          <?php dynamic_sidebar( 'single-content-top' ); ?>
        <?php endif; ?>

        <?php //固定ページ本文上ウイジェット
        if ( is_page() && is_active_sidebar( 'page-content-top' ) ): ?>
          <?php dynamic_sidebar( 'page-content-top' ); ?>
        <?php endif; ?>

      </header>

      <div class="entry-content cf<?php echo get_additional_entry_content_classes(); ?>" itemprop="mainEntityOfPage">
      <?php //記事本文の表示
        the_content(); ?>
      </div>

      <?php //マルチページ用のページャーリンク
      get_template_part('tmp/pager-page-links'); ?>

      <footer class="article-footer entry-footer">

        <?php //投稿本文下ウイジェット
        if ( is_single() && is_active_sidebar( 'single-content-bottom' ) ): ?>
          <?php dynamic_sidebar( 'single-content-bottom' ); ?>
        <?php endif; ?>

        <?php //固定ページ本文下ウイジェット
        if ( is_page() && is_active_sidebar( 'page-content-bottom' ) ): ?>
          <?php dynamic_sidebar( 'page-content-bottom' ); ?>
        <?php endif; ?>

        <?php //カテゴリー・タグ
        get_template_part('tmp/categories-tags'); ?>

        <?php //本文下の広告表示
        if (is_ad_pos_content_bottom_visible() && is_all_adsenses_visible()){
          //レスポンシブ広告のフォーマットにrectangleを指定する
          get_template_part_with_ad_format(get_ad_pos_content_bottom_format(), 'ad-content-bottom', is_ad_pos_content_bottom_label_visible());
        }; ?>

        <?php //SNSシェアボタン上の広告表示
        if (is_ad_pos_above_sns_buttons_visible() && is_all_adsenses_visible()){
          get_template_part_with_ad_format(get_ad_pos_above_sns_buttons_format(), 'ad-above-sns-buttons', is_ad_pos_above_sns_buttons_label_visible());
        }; ?>

        <?php //投稿SNSボタン上ウイジェット
        if ( is_single() && is_active_sidebar( 'above-single-sns-buttons' ) ): ?>
          <?php dynamic_sidebar( 'above-single-sns-buttons' ); ?>
        <?php endif; ?>

        <?php //固定ページSNSボタン上ウイジェット
        if ( is_page() && is_active_sidebar( 'above-page-sns-buttons' ) ): ?>
          <?php dynamic_sidebar( 'above-page-sns-buttons' ); ?>
        <?php endif; ?>

        <?php //SNSシェアボタン
        if (is_sns_bottom_share_buttons_visible())
          get_template_part_with_option('tmp/sns-share-buttons', SS_BOTTOM); ?>

        <?php //SNSフォローボタン
        if (is_sns_follow_buttons_visible())
          get_template_part('tmp/sns-follow-buttons'); ?>

        <?php //SNSシェアボタン上の広告表示
        if (is_ad_pos_below_sns_buttons_visible() && is_all_adsenses_visible()){
          get_template_part_with_ad_format(get_ad_pos_below_sns_buttons_format(), 'ad-below-sns-buttons', is_ad_pos_below_sns_buttons_label_visible());
        }; ?>

        <?php //投稿SNSボタン下ウイジェット
        if ( is_single() && is_active_sidebar( 'below-single-sns-buttons' ) ): ?>
          <?php dynamic_sidebar( 'below-single-sns-buttons' ); ?>
        <?php endif; ?>

        <?php //固定ページSNSボタン下ウイジェット
        if ( is_page() && is_active_sidebar( 'below-page-sns-buttons' ) ): ?>
          <?php dynamic_sidebar( 'below-page-sns-buttons' ); ?>
        <?php endif; ?>

        <?php //投稿者等表示用のテンプレート
        get_template_part('tmp/footer-meta'); ?>

        <!-- publisher設定 -->
        <?php
        $home_image_url = get_amp_logo_image_url();
        $size = get_image_width_and_height($home_image_url);
        $width = isset($size['width']) ? $size['width'] : 600;
        $height = isset($size['height']) ? $size['height'] : 60;

        $sizes = calc_publisher_image_sizes($width, $height);
        $width = $sizes ? $sizes['width'] : 600;
        $height = $sizes ? $sizes['height'] : 60;
         ?>
        <div class="publisher" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
            <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
              <img src="<?php echo $home_image_url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="">
              <meta itemprop="url" content="<?php echo $home_image_url; ?>">
              <meta itemprop="width" content="<?php echo $width; ?>">
              <meta itemprop="height" content="<?php echo $height; ?>">
            </div>
            <div itemprop="name"><?php bloginfo('name'); ?></div>
        </div>
      </footer>

    <?php
    } // end while
  } //have_posts end if ?>
</article>
