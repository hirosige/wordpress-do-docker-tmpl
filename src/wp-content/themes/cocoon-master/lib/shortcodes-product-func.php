<?php //商品リンク関数
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
if ( !defined( 'ABSPATH' ) ) exit;

//httpコンテンツの取得
if ( !function_exists( 'get_http_content' ) ):
function get_http_content($url){
  try {
    $ch = curl_init();
    curl_setopt_array($ch, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
    ));
    $body = curl_exec($ch);
    $errno = curl_errno($ch);
    $error = curl_error($ch);
    curl_close($ch);
    if (CURLE_OK !== $errno) {
      throw new RuntimeException($error, $errno);
    }
    return $body;
  } catch (Exception $e) {
    return false;
    //echo $e->getMessage();
  }
}
endif;

//シンプルなアソシエイトURLの作成
if ( !function_exists( 'get_amazon_associate_url' ) ):
function get_amazon_associate_url($asin, $associate_tracking_id = null){
  $base_url = 'https://'.__( 'www.amazon.co.jp', THEME_NAME ).'/exec/obidos/ASIN';
  $associate_url = $base_url.'/'.$asin.'/';
  if (!empty($associate_tracking_id)) {
    $associate_url .= $associate_tracking_id.'/';
  }
  $associate_url = esc_url($associate_url);
  return $associate_url;
}
endif;

//Amazon検索用のURLを生成する
if ( !function_exists( 'get_amazon_search_url' ) ):
function get_amazon_search_url($keyword, $associate_tracking_id = null){
  $res = 'https://'.__( 'www.amazon.co.jp', THEME_NAME ).'/gp/search?keywords='.urlencode($keyword);
  if ($associate_tracking_id) {
    $res .= '&tag='.$associate_tracking_id;
  }
  return $res;
}
endif;

//もしもアフィリエイトでAmazon検索用のURLを生成する
if ( !function_exists( 'get_moshimo_amazon_search_url' ) ):
function get_moshimo_amazon_search_url($keyword, $moshimo_amazon_id){
  return 'https://af.moshimo.com/af/c/click?a_id='.$moshimo_amazon_id.'&p_id=170&pc_id=185&pl_id=4062&url='.urlencode(get_amazon_search_url($keyword));
}
endif;

//楽天アフィリエイト検索用のURL生成
if ( !function_exists( 'get_rakuten_affiliate_search_url' ) ):
function get_rakuten_affiliate_search_url($keyword, $rakuten_affiliate_id){
  return 'https://hb.afl.rakuten.co.jp/hgc/'.$rakuten_affiliate_id.'/?pc=https%3A%2F%2Fsearch.rakuten.co.jp%2Fsearch%2Fmall%2F'.urlencode($keyword).'%2F-%2Ff.1-p.1-s.1-sf.0-st.A-v.2%3Fx%3D0%26scid%3Daf_ich_link_urltxt%26m%3Dhttp%3A%2F%2Fm.rakuten.co.jp%2F';;
}
endif;

//楽天検索用のURL生成
if ( !function_exists( 'get_rakuten_search_url' ) ):
function get_rakuten_search_url($keyword){
  return 'https://search.rakuten.co.jp/search/mall/'.urlencode($keyword).'/';
}
endif;

//もしもアフィリエイトの楽天検索用のURL生成
if ( !function_exists( 'get_moshimo_rakuten_search_url' ) ):
function get_moshimo_rakuten_search_url($keyword, $moshimo_rakuten_id){
  return 'https://af.moshimo.com/af/c/click?a_id='.$moshimo_rakuten_id.'&p_id=54&pc_id=54&pl_id=616&url='.urlencode(get_rakuten_search_url($keyword));
}
endif;

//バリューコマースのYahoo!検索用のURL生成
if ( !function_exists( 'get_valucomace_yahoo_search_url' ) ):
function get_valucomace_yahoo_search_url($keyword, $sid, $pid){
  return 'https://ck.jp.ap.valuecommerce.com/servlet/referral?sid='.$sid.'&pid='.$pid.'&vc_url=http%3A%2F%2Fsearch.shopping.yahoo.co.jp%2Fsearch%3Fp%3D'.urlencode($keyword);
}
endif;

//Yahoo!ショッピング検索用のURL生成
if ( !function_exists( 'get_yahoo_search_url' ) ):
function get_yahoo_search_url($keyword){
  return 'https://search.shopping.yahoo.co.jp/search?p='.urlencode($keyword);
}
endif;

//もしもアフィリエイトのYahoo!ショッピング検索用のURL生成
if ( !function_exists( 'get_moshimo_yahoo_search_url' ) ):
function get_moshimo_yahoo_search_url($keyword, $moshimo_yahoo_id){
  return 'https://af.moshimo.com/af/c/click?a_id='.$moshimo_yahoo_id.'&p_id=1225&pc_id=1925&pl_id=18502&url='.urlencode(get_yahoo_search_url($keyword));
}
endif;

//長い文字列だった場合MD5ハッシュにする
if ( !function_exists( 'get_long_str_to_md5_hash' ) ):
function get_long_str_to_md5_hash($str, $length = 50){
  if (strlen($str) > $length) {
    $str = md5($str);
  }
  return $str;
}
endif;

//Amazon APIキャッシュIDの取得
if ( !function_exists( 'get_amazon_api_transient_id' ) ):
function get_amazon_api_transient_id($asin){
  return TRANSIENT_AMAZON_API_PREFIX.get_long_str_to_md5_hash($asin);
}
endif;

//Amazon APIバックアップキャッシュIDの取得
if ( !function_exists( 'get_amazon_api_transient_bk_id' ) ):
function get_amazon_api_transient_bk_id($asin){
  return TRANSIENT_BACKUP_AMAZON_API_PREFIX.get_long_str_to_md5_hash($asin);
}
endif;

//楽天APIキャッシュIDの取得
if ( !function_exists( 'get_rakuten_api_transient_id' ) ):
function get_rakuten_api_transient_id($id){
  return TRANSIENT_RAKUTEN_API_PREFIX.get_long_str_to_md5_hash($id);
}
endif;

//楽天APIバックアップキャッシュIDの取得
if ( !function_exists( 'get_rakuten_api_transient_bk_id' ) ):
function get_rakuten_api_transient_bk_id($id){
  return TRANSIENT_BACKUP_RAKUTEN_API_PREFIX.get_long_str_to_md5_hash($id);
}
endif;

//Amazonインプレッションタブの取得
if ( !function_exists( 'get_moshimo_amazon_impression_tag' ) ):
function get_moshimo_amazon_impression_tag(){
  $moshimo_amazon_id  = trim(get_moshimo_amazon_id());
  return '<img src="https://i.moshimo.com/af/i/impression?a_id='.$moshimo_amazon_id.'&p_id=170&pc_id=185&pl_id=4062" width="1" height="1" style="border:none;">';
}
endif;

//楽天インプレッションタブの取得
if ( !function_exists( 'get_moshimo_rakuten_impression_tag' ) ):
function get_moshimo_rakuten_impression_tag(){
  $moshimo_rakuten_id  = trim(get_moshimo_rakuten_id());
  return '<img src="https://i.moshimo.com/af/i/impression?a_id='.$moshimo_rakuten_id.'&p_id=54&pc_id=54&pl_id=616" width="1" height="1" style="border:none;">';
}
endif;

//バリューコマースYahoo!インプレッションタブの取得
if ( !function_exists( 'get_valucomace_yahoo_impression_tag' ) ):
function get_valucomace_yahoo_impression_tag(){
  //Yahoo!バリューコマースSID
  $sid = trim(get_yahoo_valuecommerce_sid());
  //Yahoo!バリューコマースPID
  $pid = trim(get_yahoo_valuecommerce_pid());
  return '<img src="https://ad.jp.ap.valuecommerce.com/servlet/gifbanner?sid='.$sid.'&pid='.$pid.'" width="1" height="1" border="0">';
}
endif;

//Yahoo!インプレッションタブの取得
if ( !function_exists( 'get_moshimo_yahoo_impression_tag' ) ):
function get_moshimo_yahoo_impression_tag(){
  $moshimo_yahoo_id  = trim(get_moshimo_yahoo_id());
  return '<img src="https://i.moshimo.com/af/i/impression?a_id='.$moshimo_yahoo_id.'&p_id=1225&pc_id=1925&pl_id=18502" width="1" height="1" style="border:none;">';
}
endif;

//アディショナルボタンタグの作成
if ( !function_exists( 'get_additional_button_tag' ) ):
function get_additional_button_tag($btn_url, $btn_text, $btn_tag, $name = 'btnex'){
  //ボタンの作成
  $button_tag = null;
  if (($btn_text && $btn_url) || $btn_tag) {
    if ($btn_tag) {
      $button_link = htmlspecialchars_decode($btn_tag);
    } else {
      $button_link = '<a href="'.esc_attr($btn_url).'" target="_blank" rel="nofollow">'.esc_html($btn_text).'</a>';
    }

    $button_tag =
      '<div class="shoplinkbtn shoplink'.esc_attr($name).'">'.
      $button_link.
      '</div>';
  }
  return $button_tag;
}
endif;

//検索ボタンの作成
if ( !function_exists( 'get_search_buttons_tag' ) ):
function get_search_buttons_tag($args){
  extract($args);

  $buttons_tag = null;
  if ($keyword) {

    //ボタン1の作成
    $button1_tag = get_additional_button_tag($btn1_url, $btn1_text, $btn1_tag, 'btn1');

    //Amazonボタンの取得
    $amazon_btn_tag = null;
    $is_moshimo_amazon = $moshimo_amazon_id && is_moshimo_affiliate_link_enable();
    if (is_amazon_search_button_visible() && $amazon) {
      $amazon_url = get_amazon_search_url($keyword, $associate_tracking_id);
      if ($is_moshimo_amazon) {
        $amazon_url = get_moshimo_amazon_search_url($keyword, $moshimo_amazon_id);
      }
      //Amazon商品リンクで詳細ページを表示する場合
      if ($amazon_page_url && is_amazon_button_search_to_detail()) {
        $amazon_url = $amazon_page_url;
      }
      //インプレッションタグ
      $amazon_impression_tag = null;
      if ($is_moshimo_amazon) {
        $amazon_impression_tag = get_moshimo_amazon_impression_tag();
      }
      $amazon_btn_tag =
        '<div class="shoplinkamazon">'.
          '<a href="'.$amazon_url.'" target="_blank" rel="nofollow">'.get_amazon_search_button_text().$amazon_impression_tag.'</a>'.
        '</div>';
    }

    //楽天ボタンの取得
    $rakuten_btn_tag = null;
    $is_moshimo_rakuten = $moshimo_rakuten_id && is_moshimo_affiliate_link_enable();
    if (($rakuten_affiliate_id || $is_moshimo_rakuten) && is_rakuten_search_button_visible() && $rakuten) {
      //$rakuten_url = 'https://hb.afl.rakuten.co.jp/hgc/'.$rakuten_affiliate_id.'/?pc=https%3A%2F%2Fsearch.rakuten.co.jp%2Fsearch%2Fmall%2F'.urlencode($keyword).'%2F-%2Ff.1-p.1-s.1-sf.0-st.A-v.2%3Fx%3D0%26scid%3Daf_ich_link_urltxt%26m%3Dhttp%3A%2F%2Fm.rakuten.co.jp%2F';
      $rakuten_url = get_rakuten_affiliate_search_url($keyword, $rakuten_affiliate_id);
      //もしもアフィリエイトIDがある場合
      if ($is_moshimo_rakuten) {
        $rakuten_url = get_moshimo_rakuten_search_url($keyword, $moshimo_rakuten_id);
      }
      //楽天商品リンクで詳細ページを表示する場合
      if ($rakuten_page_url && is_rakuten_button_search_to_detail()) {
        $rakuten_url = $rakuten_page_url;
      }
      //インプレッションタグ
      $rakuten_impression_tag = null;
      if ($is_moshimo_rakuten) {
        $rakuten_impression_tag = get_moshimo_rakuten_impression_tag();
      }
      $rakuten_btn_tag =
        '<div class="shoplinkrakuten">'.
          '<a href="'.$rakuten_url.'" target="_blank" rel="nofollow">'.get_rakuten_search_button_text().$rakuten_impression_tag.'</a>'.
        '</div>';
    }
    //Yahoo!ボタンの取得
    $yahoo_tag = null;
    $is_moshimo_yahoo = $moshimo_yahoo_id && is_moshimo_affiliate_link_enable();
    if ((($sid && $pid) || $is_moshimo_yahoo) && is_yahoo_search_button_visible() && $yahoo) {
      //$yahoo_url = 'https://ck.jp.ap.valuecommerce.com/servlet/referral?sid='.$sid.'&pid='.$pid.'&vc_url=http%3A%2F%2Fsearch.shopping.yahoo.co.jp%2Fsearch%3Fp%3D'.$keyword;
      $yahoo_url = get_valucomace_yahoo_search_url($keyword, $sid, $pid);
      //もしもアフィリエイトIDがある場合
      if ($is_moshimo_yahoo) {
        $yahoo_url = get_moshimo_yahoo_search_url($keyword, $moshimo_yahoo_id);
      }
      //インプレッションタグ
      if ($is_moshimo_yahoo) {//もしもアフィリエイトが有効な場合
        $yahoo_impression_tag = get_moshimo_yahoo_impression_tag();
      } else {
        $yahoo_impression_tag = get_valucomace_yahoo_impression_tag();
      }

      $yahoo_tag =
        '<div class="shoplinkyahoo">'.
          '<a href="'.$yahoo_url.'" target="_blank" rel="nofollow">'.get_yahoo_search_button_text().$yahoo_impression_tag.'</a>'.
        '</div>';
    }

    //ボタン2の作成
    $button2_tag = get_additional_button_tag($btn2_url, $btn2_text, $btn2_tag, 'btn2');
    //ボタン3の作成
    $button3_tag = get_additional_button_tag($btn3_url, $btn3_text, $btn3_tag, 'btn3');

    //ボタンコンテナ
    $buttons_tag =
      '<div class="amazon-item-buttons product-item-buttons">'.
        $button1_tag.
        $amazon_btn_tag.
        $rakuten_btn_tag.
        $yahoo_tag.
        $button2_tag.
        $button3_tag.
      '</div>';
  }
  return apply_filters( 'get_search_buttons_tag', $buttons_tag );
}
endif;

//キャッシュの削除リンク作成
if ( !function_exists( 'get_cache_delete_tag' ) ):
function get_cache_delete_tag($mode = 'amazon', $id){
  switch ($mode) {
    case 'rakuten':
    $url = add_query_arg(array('page' => 'theme-cache', 'cache' => 'rakuten_id_cache', 'id' => $id, HIDDEN_DELETE_FIELD_NAME => wp_create_nonce('delete-cache')), admin_url().'admin.php');
      break;
    default:
      $url = add_query_arg(array('page' => 'theme-cache', 'cache' => 'amazon_asin_cache', 'asin' => $id, HIDDEN_DELETE_FIELD_NAME => wp_create_nonce('delete-cache')), admin_url().'admin.php');
      break;
  }
  $cache_delete_tag = null;
  if (is_user_administrator()) {
    $cache_delete_tag = '<a href="'.$url.'" class="cache-delete-link" target="_blank" rel="nofollow"'.ONCLICK_DELETE_CONFIRM.'>'.__( 'キャッシュ削除', THEME_NAME ).'</a>';
  }
  return $cache_delete_tag;
}
endif;

//商品リンク説明文タグ
if ( !function_exists( 'get_item_price_tag' ) ):
function get_item_price_tag($price, $date = null){
  $item_price_tag = null;
  if ($price) {
    $date_tag = null;
    if ($date) {
      $date_tag = '<span class="acquired-date">'.__( '（', THEME_NAME ).esc_html($date).__( '時点', THEME_NAME ).__( '）', THEME_NAME ).'</span>';
    }
    $item_price_tag = '<div class="product-item-price">'.
      '<span class="item-price">'.esc_html($price).'</span>'.
      $date_tag.
    '</div>';
  }
  return apply_filters('get_item_price_tag', $item_price_tag);
}
endif;

//商品リンク説明文タグ
if ( !function_exists( 'get_item_description_tag' ) ):
function get_item_description_tag($description){
  $description_tag = null;
  if ($description) {
    $description_tag = '<div class="product-item-description">'.esc_html($description).'</div>';
  }
  return apply_filters('get_item_description_tag', $description_tag);
}
endif;

//管理者情報タグ
if ( !function_exists( 'get_product_item_admin_tag' ) ):
function get_product_item_admin_tag($cache_delete_tag, $affiliate_rate_tag = null){
  $tag = null;
  if (is_user_administrator()) {
    $tag = '<div class="product-item-admin">'.
              $cache_delete_tag.
              $affiliate_rate_tag.
            '</div>';
  }
  return $tag;
}
endif;


//Amazon商品紹介リンクを外枠で囲む
if ( !function_exists( 'wrap_product_item_box' ) ):
function wrap_product_item_box($message, $type = 'amazon', $cache_delete_tag = null){
  if ($cache_delete_tag) {
    $cache_delete_tag = get_product_item_admin_tag($cache_delete_tag);
  }
  return '<div class="product-item-box '.$type.'-item-box no-icon product-item-error cf"><div>'.$message.'</div>'.$cache_delete_tag.'</div>';
}
endif;

//楽天の画像サイズ取得
if ( !function_exists( 'get_rakuten_image_size' ) ):
function get_rakuten_image_size($url){
  preg_match('{ex=(\d+)x(\d+)}i', $url, $m);
  if ($m[1] && $m[2]) {
    $sizes = array();
    $sizes['width'] =  intval($m[1]);
    $sizes['height'] =  intval($m[2]);
    return $sizes;
  }
}
endif;

//楽天APIで商品情報が取得できなかった際のデフォルトリンク作成
if ( !function_exists( 'get_default_rakuten_link_tag' ) ):
function get_default_rakuten_link_tag($rakuten_affiliate_id, $id, $keyword){
  $search_keyword = $id;
  if ($keyword) {
    $search_keyword = $keyword;
  }
  $rakuten_url = get_rakuten_affiliate_search_url(urlencode($search_keyword), $rakuten_affiliate_id);
  $tag = '<a href="'.$rakuten_url.'" target="_blank">'.__( '楽天で商品を見る', THEME_NAME ).'</a>';
  return apply_filters('get_default_rakuten_link_tag', $tag);
}
endif;

if ( !function_exists( 'get_rakuten_error_message_tag' ) ):
function get_rakuten_error_message_tag($link, $admin_message, $cache_delete_tag = null){
  $error_message = $link;
  if (is_user_administrator()) {
    $error_message .= '<br><br>'.get_message_box_tag($admin_message, 'warning-box fz-14px');
  }
  return wrap_product_item_box($error_message, 'rakuten', $cache_delete_tag);
}
endif;
