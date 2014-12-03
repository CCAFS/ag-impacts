<?php
register_sidebar();

register_sidebar(array(
  'name' => 'Secundario',
  'id' => 'secundario'
        )
);

register_nav_menu('main-menu', 'Zona Header');
register_nav_menu('menu-regitred', 'Menu user');

function my_custom_login_logo() {
  echo '
	<style type="text/css">
	.login h1 a {
	background-image:url(' . get_bloginfo('template_directory') . '/img/ag-logo.png) !important;
	background-size: 300px 150px;
	height: 150px;
        width: 320px;
        background-color:#477129}
    </style>';
}

add_action('login_head', 'my_custom_login_logo');

function loginpage_custom_link() {
  return get_bloginfo('url');
}

add_filter('login_headerurl', 'loginpage_custom_link');

function change_title_on_logo() {
  return 'Back to ' . get_bloginfo('name');
}

add_filter('login_headertitle', 'change_title_on_logo');

function login_redirect() {
  wp_redirect(get_bloginfo('url'));
}

add_action('wp_login', 'login_redirect', 10, 2);

//add_filter( 'authenticate', 'myplugin_auth_signon');
//function myplugin_auth_signon( $user, $username, $password ) {
//     wp_redirect(get_bloginfo('url'));
//}

function validDoi($doi) {
  // Initialize options for REST interface
  $adb_url = "http://dx.doi.org/";
  $adb_option_defaults = array(
    CURLOPT_URL => $adb_url . $doi,
    CURLOPT_HEADER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 2,
    CURLOPT_HTTPHEADER => array('Accept: application/unixref+xml'),
    CURLOPT_FOLLOWLOCATION => true
  );

// ArangoDB REST function.
// Connection are created demand and closed by PHP on exit.
//  function adb_rest($method, $uri, $querry = NULL, $json = NULL, $options = NULL) {
//    global $adb_url, $adb_handle, $adb_option_defaults;
  // Connect 
  if (!isset($adb_handle))
    $adb_handle = curl_init();

  curl_setopt_array($adb_handle, $adb_option_defaults);

  // send request and wait for responce
//    $responce = json_decode(curl_exec($adb_handle), true);
  $responce = curl_exec($adb_handle);

//    echo "Responce from DB: \n";
//    echo $responce;

  return($responce);
}

add_action('show_user_profile', 'add_institute');
add_action('edit_user_profile', 'add_institute');

function add_institute($user) {
  ?>
  <h3>Institute info</h3>

  <table class="form-table">
    <tr>
      <th><label for="user_inst">Institute</label></th>
      <td><input type="text" name="user_inst" value="<?php echo esc_attr(get_the_author_meta('user_inst', $user->ID)); ?>" class="regular-text" /></td>
    </tr>
  </table>
  <?php
}

add_action( 'personal_options_update', 'save_institute' );
add_action( 'edit_user_profile_update', 'save_institute' );

function save_institute( $user_id )
{
    update_user_meta( $user_id,'user_inst', sanitize_text_field( $_POST['user_inst'] ) );
}

add_action('show_user_profile', 'reward_sys');
add_action('edit_user_profile', 'reward_sys');

function reward_sys($user) {
  ?>
  <h3>Rewards</h3>

  <table class="form-table">
    <tr>
      <th><label for="gold">Gold</label></th>
      <th><label for="silver">Silver</label></th>
      <th><label for="bronze">Bronze</label></th>
    </tr>
    <tr>
      <td><label for="gold"><?php echo (get_the_author_meta('gold', $user->ID))?esc_attr(get_the_author_meta('gold', $user->ID)):0; ?></label></td>
      <td><label for="silver"><?php echo (get_the_author_meta('silver', $user->ID))?esc_attr(get_the_author_meta('silver', $user->ID)):0; ?></label></td>
      <td><label for="bronze"><?php echo (get_the_author_meta('bronze', $user->ID))?esc_attr(get_the_author_meta('bronze', $user->ID)):0; ?></label></td>
    </tr>
  </table>
  <?php
}
