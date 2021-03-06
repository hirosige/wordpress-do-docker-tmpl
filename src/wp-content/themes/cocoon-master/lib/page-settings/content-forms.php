<?php /**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
if ( !defined( 'ABSPATH' ) ) exit; ?>

<div class="metabox-holder">

<!-- 本文行間 -->
<div id="entry-content-page" class="postbox">
  <h2 class="hndle"><?php _e( '本文行間設定', THEME_NAME ) ?></h2>
  <div class="inside">

    <p><?php
      _e( '本文の行の高さや余白の設定です。', THEME_NAME );
      echo get_help_page_tag('https://wp-cocoon.com/body-margin/'); ?>
    </p>

    <table class="form-table">
      <tbody>
        <!-- 本文余白  -->
        <tr>
          <th scope="row" style="width: 100px;">
            <?php generate_label_tag('', __('本文余白', THEME_NAME) ); ?>
          </th>
          <td>
            <div class="col-2">
              <div style="min-width: 270px;">
              <?php
              generate_label_tag(OP_ENTRY_CONTENT_LINE_HIGHT, '行の高さ');
              generate_range_tag(OP_ENTRY_CONTENT_LINE_HIGHT, get_entry_content_line_hight(), 1, 4, 0.1);
              generate_tips_tag(__( 'line-hightで、行の高さを指定します。1にすると文字列と同等の高さになります。', THEME_NAME ));
              echo '<br>';
              echo '<br>';

              generate_label_tag(OP_ENTRY_CONTENT_MARGIN_HIGHT, '行の余白（単位：em）');
              generate_range_tag(OP_ENTRY_CONTENT_MARGIN_HIGHT, get_entry_content_margin_hight(), 0.1, 4, 0.1);
              generate_tips_tag(__( '行間の余白の高さを設定します。1emは、フォントサイズ（font-size）と同等の高さになります。フォントサイズが18pxの場合は余白も18pxになります。', THEME_NAME ));
             ?>
              </div>
              <div style="width: auto">
                <?php get_template_part('tmp/font-preview'); ?>
              </div>
            </div>
          </td>
        </tr>

      </tbody>
    </table>

  </div>
</div>

<!-- 外部リンク -->
<div id="external-link" class="postbox">
  <h2 class="hndle"><?php _e( '外部リンク設定', THEME_NAME ) ?></h2>
  <div class="inside">

    <p><?php _e( '外部リンク動作の設定です。外部ブログカードにも適用されます。', THEME_NAME ) ?></p>

    <table class="form-table">
      <tbody>

        <!-- 外部リンクの開き方 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_EXTERNAL_LINK_OPEN_TYPE, __('外部リンクの開き方', THEME_NAME) ); ?>
          </th>
          <td>
            <?php
            $options = array(
              'default' => __( '変更しない', THEME_NAME ),
              'blank' => __( '新しいタブで開く（_blank）', THEME_NAME ),
              'self' => __( '同じタブで開く（_self）', THEME_NAME ),
            );
            generate_selectbox_tag(OP_EXTERNAL_LINK_OPEN_TYPE, $options, get_external_link_open_type());
            generate_tips_tag(__( '本文内の外部リンクをどのように開くか。', THEME_NAME ));
            ?>
          </td>
        </tr>

        <!-- フォロータイプ -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_EXTERNAL_LINK_FOLLOW_TYPE, __('フォロータイプ', THEME_NAME) ); ?>
          </th>
          <td>
            <?php
            $options = array(
              'default' => __( '変更しない', THEME_NAME ),
              'nofollow' => __( 'フォローしない（nofollow）', THEME_NAME ),
              'follow' => __( 'フォローする（follow）', THEME_NAME ),
            );
            generate_selectbox_tag(OP_EXTERNAL_LINK_FOLLOW_TYPE, $options, get_external_link_follow_type());
            generate_tips_tag(__( '本文内の外部リンクのフォロー状態を設定します。', THEME_NAME ));
            ?>
          </td>
        </tr>

        <!-- 追加rel属性 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_EXTERNAL_LINK_NOOPENER_ENABLE, __('追加rel属性', THEME_NAME) ); ?>
          </th>
          <td>
            <?php
            generate_checkbox_tag(OP_EXTERNAL_LINK_NOOPENER_ENABLE, is_external_link_noopener_enable(), __( 'noopenerを追加', THEME_NAME ));
            generate_tips_tag(__( 'rel属性にnoopenerを追加します。', THEME_NAME ));
            generate_checkbox_tag(OP_EXTERNAL_LINK_NOREFERRER_ENABLE, is_external_link_noreferrer_enable(), __( 'noreferrerを追加', THEME_NAME ));
            generate_tips_tag(__( 'rel属性にnoreferrerを追加します。', THEME_NAME ));
            generate_checkbox_tag(OP_EXTERNAL_LINK_EXTERNAL_ENABLE, is_external_link_external_enable(), __( 'externalを追加', THEME_NAME ));
            generate_tips_tag(__( 'rel属性にexternalを追加します。', THEME_NAME ));
            ?>
          </td>
        </tr>

        <!-- アイコン表示 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_EXTERNAL_LINK_ICON_VISIBLE, __('アイコン表示', THEME_NAME) ); ?>
          </th>
          <td>
            <?php
            generate_checkbox_tag(OP_EXTERNAL_LINK_ICON_VISIBLE , is_external_link_icon_visible(), __( 'アイコンの表示', THEME_NAME ));
            generate_tips_tag(__( '外部リンクの右部にFont Awesomeアイコンを表示するか。', THEME_NAME ));
            ?>
          </td>
        </tr>

        <!-- アイコン -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_EXTERNAL_LINK_ICON, __('アイコン', THEME_NAME) ); ?>
          </th>
          <td>
            <?php
            $options = array(
              'fa-external-link' => __( '&#xf08e', THEME_NAME ),
              'fa-link' => __( '&#xf0c1', THEME_NAME ),
              'fa-level-up' => __( '&#xf148', THEME_NAME ),
              'fa-share' => __( '&#xf064', THEME_NAME ),
              'fa-share-square-o' => __( '&#xf045', THEME_NAME ),
              'fa-share-square' => __( '&#xf14d', THEME_NAME ),
              'fa-sign-out' => __( '&#xf08b', THEME_NAME ),
              'fa-plane' => __( '&#xf072', THEME_NAME ),
              'fa-rocket' => __( '&#xf135', THEME_NAME ),
            );

            generate_selectbox_tag(OP_EXTERNAL_LINK_ICON, $options, get_external_link_icon(),__( 'アイコンフォント', THEME_NAME ) , true);
            generate_tips_tag(__( '外部リンクの右部に表示するFont Awesomeアイコンを設定します。', THEME_NAME ));
            ?>
          </td>
        </tr>

      </tbody>
    </table>

  </div>
</div>



<!-- 内部リンク -->
<div id="internal-link" class="postbox">
  <h2 class="hndle"><?php _e( '内部リンク設定', THEME_NAME ) ?></h2>
  <div class="inside">

    <p><?php _e( '内部リンク動作の設定です。内部ブログカードにも適用されます。', THEME_NAME ) ?></p>

    <table class="form-table">
      <tbody>

        <!-- 内部リンクの開き方 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_INTERNAL_LINK_OPEN_TYPE, __('内部リンクの開き方', THEME_NAME) ); ?>
          </th>
          <td>
            <?php
            $options = array(
              'default' => __( '変更しない', THEME_NAME ),
              'blank' => __( '新しいタブで開く（_blank）', THEME_NAME ),
              'self' => __( '同じタブで開く（_self）', THEME_NAME ),
            );
            generate_selectbox_tag(OP_INTERNAL_LINK_OPEN_TYPE, $options, get_internal_link_open_type());
            generate_tips_tag(__( '本文内の内部リンクをどのように開くか。', THEME_NAME ));
            ?>
          </td>
        </tr>

        <!-- フォロータイプ -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_INTERNAL_LINK_FOLLOW_TYPE, __('フォロータイプ', THEME_NAME) ); ?>
          </th>
          <td>
            <?php
            $options = array(
              'default' => __( '変更しない', THEME_NAME ),
              'nofollow' => __( 'フォローしない（nofollow）', THEME_NAME ),
              'follow' => __( 'フォローする（follow）', THEME_NAME ),
            );
            generate_selectbox_tag(OP_INTERNAL_LINK_FOLLOW_TYPE, $options, get_internal_link_follow_type());
            generate_tips_tag(__( '本文内の内部リンクのフォロー状態を設定します。', THEME_NAME ));
            ?>
          </td>
        </tr>

        <!-- 追加rel属性 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_INTERNAL_LINK_NOOPENER_ENABLE, __('追加rel属性', THEME_NAME) ); ?>
          </th>
          <td>
            <?php
            generate_checkbox_tag(OP_INTERNAL_LINK_NOOPENER_ENABLE, is_internal_link_noopener_enable(), __( 'noopenerを追加', THEME_NAME ));
            generate_tips_tag(__( 'rel属性にnoopenerを追加します。', THEME_NAME ));
            generate_checkbox_tag(OP_INTERNAL_LINK_NOREFERRER_ENABLE, is_internal_link_noreferrer_enable(), __( 'noreferrerを追加', THEME_NAME ));
            generate_tips_tag(__( 'rel属性にnoreferrerを追加します。', THEME_NAME ));
            ?>
          </td>
        </tr>

        <!-- アイコン表示 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_INTERNAL_LINK_ICON_VISIBLE, __('アイコン表示', THEME_NAME) ); ?>
          </th>
          <td>
            <?php
            generate_checkbox_tag(OP_INTERNAL_LINK_ICON_VISIBLE , is_internal_link_icon_visible(), __( 'アイコンの表示', THEME_NAME ));
            generate_tips_tag(__( '内部リンクの右部にFont Awesomeアイコンを表示するか。', THEME_NAME ));
            ?>
          </td>
        </tr>

        <!-- アイコン -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_INTERNAL_LINK_ICON, __('アイコン', THEME_NAME) ); ?>
          </th>
          <td>
            <?php
            $options = array(
              'fa-external-link' => __( '&#xf08e', THEME_NAME ),
              'fa-link' => __( '&#xf0c1', THEME_NAME ),
              'fa-level-up' => __( '&#xf148', THEME_NAME ),
              'fa-share' => __( '&#xf064', THEME_NAME ),
              'fa-share-square-o' => __( '&#xf045', THEME_NAME ),
              'fa-share-square' => __( '&#xf14d', THEME_NAME ),
              'fa-sign-out' => __( '&#xf08b', THEME_NAME ),
              'fa-sign-in' => __( '&#xf090', THEME_NAME ),
              'fa-plane' => __( '&#xf072', THEME_NAME ),
              'fa-rocket' => __( '&#xf135', THEME_NAME ),
            );

            generate_selectbox_tag(OP_INTERNAL_LINK_ICON, $options, get_internal_link_icon(),__( 'アイコンフォント', THEME_NAME ) , true);
            generate_tips_tag(__( '内部リンクの右部に表示するFont Awesomeアイコンを設定します。', THEME_NAME ));
            ?>
          </td>
        </tr>

      </tbody>
    </table>

  </div>
</div>



<!-- テーブル -->
<div id="table" class="postbox">
  <h2 class="hndle"><?php _e( 'テーブル設定', THEME_NAME ) ?></h2>
  <div class="inside">

    <p><?php _e( 'テーブル動作の設定です。', THEME_NAME ) ?></p>

    <table class="form-table">
      <tbody>

        <!-- レスポンシブテーブル -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_RESPONSIVE_TABLE_ENABLE, __('レスポンシブテーブル', THEME_NAME) ); ?>
          </th>
          <td>
            <?php
            generate_checkbox_tag(OP_RESPONSIVE_TABLE_ENABLE , is_responsive_table_enable(), __( '横幅の広いテーブルは横スクロール', THEME_NAME ));
            generate_tips_tag(__( '端末幅より広いテーブルが表示されるときは、テーブルを横スクロールして崩れないようにします。', THEME_NAME ));
            ?>
          </td>
        </tr>

      </tbody>
    </table>

  </div>
</div>



<!-- 投稿情報表示 -->
<div id="table" class="postbox">
  <h2 class="hndle"><?php _e( '投稿情報表示設定', THEME_NAME ) ?></h2>
  <div class="inside">

    <p><?php _e( '投稿・固定ページの関連情報の表示に関する設定です。', THEME_NAME ) ?></p>

    <table class="form-table">
      <tbody>

        <!-- 投稿関連情報の表示 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag('', __('投稿関連情報の表示', THEME_NAME) ); ?>
          </th>
          <td>
            <?php
            generate_checkbox_tag(OP_POST_DATE_VISIBLE , is_post_date_visible(), __( '投稿日の表示', THEME_NAME ));
            echo '<br>';
            generate_checkbox_tag(OP_POST_UPDATE_VISIBLE , is_post_update_visible(), __( '更新日の表示', THEME_NAME ));
            echo '<br>';
            generate_checkbox_tag(OP_POST_AUTHOR_VISIBLE , is_post_author_visible(), __( '投稿者名の表示', THEME_NAME ));
            generate_tips_tag(__( '投稿・固定ページの関連情報を表示するかどうか。構造化データエラーになるのを防ぐためCSSで非表示化されます。', THEME_NAME ));
            ?>
          </td>
        </tr>

      </tbody>
    </table>

  </div>
</div>



</div><!-- /.metabox-holder -->
