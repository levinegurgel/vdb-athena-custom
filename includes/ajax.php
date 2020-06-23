<?php
class ATH_Ajax {

  public function __construct( $add_filters = false ) {
    if ( $add_filters ) {
      add_action( 'wp_ajax_nopriv_ath-esp-form-submit', array( $this, 'esp_form_submit' ) );
      add_action( 'wp_ajax_ath-esp-form-submit', array( $this, 'esp_form_submit' ) );

      add_action( 'wp_ajax_nopriv_ath-infinite-scroll', array( $this, 'infinite_scroll' ) );
      add_action( 'wp_ajax_ath-infinite-scroll', array( $this, 'infinite_scroll' ) );

      add_action( 'wp_ajax_nopriv_ath-infinite-scroll-comments', array( $this, 'infinite_scroll_comments' ) );
      add_action( 'wp_ajax_ath-infinite-scroll-comments', array( $this, 'infinite_scroll_comments' ) );

      add_action( 'wp_ajax_nopriv_ath-pagination-content', array( $this, 'pagination_content' ) );
      add_action( 'wp_ajax_ath-pagination-content', array( $this, 'pagination_content' ) );

      add_action( 'wp_ajax_nopriv_ath-search', array( $this, 'search' ) );
      add_action( 'wp_ajax_ath-search', array( $this, 'search' ) );

      add_action( 'wp_ajax_nopriv_ath-contact', array( $this, 'contact' ) );
      add_action( 'wp_ajax_ath-contact', array( $this, 'contact' ) );

      add_action( 'wp_ajax_nopriv_ath-capture', array( $this, 'capture' ) );
      add_action( 'wp_ajax_ath-capture', array( $this, 'capture' ) );

      add_filter( 'ath-onboard', array( $this, 'ath_onboard' ), 10, 2 );
      add_action( 'wp_ajax_nopriv_ath-onboard', array( $this, 'ajax_ath_onboard' ) );
      add_action( 'wp_ajax_ath-onboard', array( $this, 'ajax_ath_onboard' ) );
    }
  }


  /*
   *
   * NONCE
   *
   */

  private function verify_nonce() {
    $nonce = $_POST['nonce'];
    if ( ! wp_verify_nonce( $nonce, 'ath-ajax-superdupermegapower-nonce' ) ) {
      exit( 'Ação não permitida' );
    }
  }


  /*
   *
   * FORM SUBMIT
   *
   */

  public function esp_form_submit() {
    $this->verify_nonce();

    // header ( 'Content-Type: application/json; charset=utf-8' );
    require 'vendor/mailchimp/mailchimp-subscribe.php';

    exit;
  }


  /*
   *
   * INFINITE SCROLL
   *
   */

  public function infinite_scroll() {
    if ( isset( $_POST['card'], $_POST['hook'], $_POST['args'] ) ) {
      $this->pagination_content();
    }

    $this->verify_nonce();

    global $post;
    $post->featured = false;

    if ( ! empty( $_POST['featured'] ) ) {
      $post->featured = explode( ',', $_POST['featured'] );
    }

    ob_start();
    get_template_part( 'template-parts/ath-archive', 'cards' );
    $output = ob_get_flush();

    if ( ! empty( $output ) ) {
      get_template_part( 'template-parts/ath-archive', 'banner' );
    }

    exit;
  }


  /*
   *
   * SCROLL COMMENTS
   *
   */

  public function infinite_scroll_comments() {
    $this->verify_nonce();

    if ( isset( $_POST['post_id'], $_POST['page'] ) && $_POST['page'] > 0 ) {
      global $post;
      $post = (int) $_POST['post_id'];
      $page = (int) $_POST['page'];

      wp_list_comments( array(
        'avatar_size'   => 70,
        'style'         => 'div',
        'format'        => 'html5',
        'callback'      => 'ath_comment',
        'end-callback'  => 'end_ath_comment',
        'reply_text'    => 'Responder',
        'page'          => $page,
        'per_page'      => get_option( 'comments_per_page', 10 ),
      ) );
    }

    exit;
  }


  /*
   *
   * PAGINATION CONTENT
   *
   */

  public function pagination_content() {
    $this->verify_nonce();

    if ( isset( $_POST['card'], $_POST['hook'], $_POST['args'] ) ) {
      $cards = apply_filters( 'get_' . $_POST['hook'], $_POST['args'] );
      if ( $cards ) {
        global $post;
        foreach ( $cards as $card ) {
          $post->card = $card;
          get_template_part( 'template-parts/ath-card', $_POST['card'] );
        }
      }
    }

    exit;
  }


  /*
   *
   * SEARCH
   *
   */

  public function search() {
    $this->verify_nonce();
    // get_template_part( 'includes/parts/ath', 'overlay' );
    get_template_part( 'template-parts/ath', 'overlay' );
    exit;
  }


  /*
   *
   * CONTACT
   *
   */

  public function contact(){
    // $this->verify_nonce();
    $mail = new Service_Send_Email( 'add_hooks' );
    $mail->send_email();
    exit;
  }


  /*
   *
   * ONBOARD
   *
   */

  public function ath_onboard($option){
    return update_option('ath-onboard',$option);
  }

  public function ajax_ath_onboard() {
    if (empty( $_POST['option'] ) || empty( $_POST['nonce'] ) || !ath_verify_nonce($_POST['nonce']) ) {
      echo 'error';
    }
    echo $this->ath_onboard($_POST['option']);
    exit;
  }


  /*
   *
   * CAPTURE
   *
   */

  public function capture(){

    global $ath_options;

    $arr = array();
    parse_str($_POST['data'], $arr);

  
    // $fields_string = "";
    // $data   = $_POST['form_data'];
    // $action = $_POST['form_action'];
    // $object = $_POST['form_object'];
    // parse_str($data, $arr);
    // unset($arr['action']);

    // print_r($arr);
    // die();


    /*
     *
     * MAILCHIMP
     *
     */

    if($arr['capture-service'] == 1){
        
        $email        = $arr['EMAIL'];
        $email_hash   = md5($email);
        $list         = $arr['list'];
        $interests    = array();
        $merge_fields = $arr['fields'] ? array('merge_fields' => $arr['fields']) : array();

        if ($arr['groups']) {
          foreach ($arr['groups'] as $group) {
            $interests['interests'][$group] = true;
          }
        }

        if(!empty($ath_options['int-mailchimp'])){
          
          // MailChimp constructor begin
          $mc = new MailChimp();
          $mc->setApiKey($ath_options['int-mailchimp']);
          
          $user = array(
            'email_address' => $email,
            'status'        => $arr['double'] == 1 ? 'pending' : 'subscribed',
          );

          if(isset($arr['FNAME'])){
            $user['merge_fields']['FNAME'] = $arr['FNAME'];
          }

          $user_was   = array_merge($user, $interests);
          $user_wasnt = array_merge($user_was, $merge_fields);

          $consult = json_decode(json_encode($mc->get('/lists/' . $list . '/members/' . $email_hash)));

          if ($consult->status == 404) {
            $result = $mc->post('/lists/' . $list . '/members', $user_wasnt);
          } else {
            if ($consult->status == 'unsubscribed') {
              $user_was['status'] = 'pending';
            }
            $result = $mc->patch('/lists/' . $list . '/members/' . $email_hash, $user_was);
          }

          // echo json_encode($result);
          // die();
          if($result['status'] == 'subscribed' or $result['status'] == 'pending'){
            $result = true;
          }else{
            $result = false;
          }

        }else{
          $result = false;
        }//empty mailchimp api-key

    }

    
    /*
     *
     * ACTIVE CAMPAIGN
     *
     */ 

    if($arr['capture-service'] == 2){

      $api_url   = $ath_options['int-ac-url'];
      $api_token = $ath_options['int-ac-token'];
      $ac = new ActiveCampaign($api_url,$api_token);
      $list_id = (int) $arr['list'];
      $tags = '';
      
      if (!(int)$ac->credentials_test()) {
        $result = false;
      }

      if ($arr['tags']) {
        foreach ($arr['tags'] as $k => $v) {
          $total = count($arr['tags']);
          $tags .= $v . ($k == ($total - 1) ? '':',');
        }
      }

      $contact = array(
        "email" => $arr['email'],
        // "first_name" => "",
        // "last_name"  => "",
        "tags" => $tags,
        "p[{$list_id}]" => $list_id,
        "status[{$list_id}]" => 1, // "Active" status
      );

      if(isset($arr['name'])){
        $contact['first_name'] = $arr['name'];
      }

      $contact_sync = $ac->api("contact/sync", $contact);
      if (!(int)$contact_sync->success) {
        // echo $contact_sync->error;
        $result = false;
      }else{
        $result = true;
      }

    }


    /*
     *
     * CONVERT KIT
     *
     */

    if($arr['capture-service'] == 3){

      $api_key = $ath_options['int-ck-api'];
      $api_secret = $ath_options['int-ck-secret'];
      $list_id = (int) $arr['list'];
      $tags = array();

      // Tags
      if ($arr['tags']) {
        foreach ($arr['tags'] as $k => $v) {
          array_push($tags,(int) $v);
        }
      }

      //Campos
      $args = array(
        'email'=> $arr['email'],
        'tags'=> $tags
      );

     if(isset($arr['name'])){
        $args['name'] = $arr['name'];
      }

      if(!empty($list_id)){

        $ck = new \ConvertKit_API\ConvertKit_API($api_key, $api_secret);
        $r  = $ck->form_subscribe($list_id,$args);
        if(array_key_exists('subscription',$r)){
          $result = true;
        }else{
          $result = false;
        }
      }else{
        $result = false;
      }

    }


    /*
     *
     * MAUTIC
     *
     */

    if($arr['capture-service'] == 5){

      $opts = array('http' =>
          array(
              'method'  => 'POST',
              'header'  => 'Content-type: application/x-www-form-urlencoded',
              'content' => http_build_query($arr)
          )
      );
      $context  = stream_context_create($opts);
      $mautic   = $ath_options['int-mautic'];
      $result = file_get_contents($mautic.'/form/submit', false, $context);
    }


  /*
   *
   * GET RESPONSE
   *
   */

    if($arr['capture-service'] == 6){

      $apiKey = $ath_options['int-gr-api'];

      if(!empty($apiKey)){
        
        $api   = new GetResponse($apiKey);
        $args  = array();
        $args['email'] = $arr['email'];
        $args['campaign']['campaignId'] = $arr['list'];  
        
        if(isset($arr['name'])){
          $args['name'] = $arr['name'];
        }

        $resp = $api->addContact($args);
        
        if($resp == 202){
          $result = true;
        }else{
          $result = false;
        }

      }else{
        $result = false;
      }

    }


  /*
   *
   * MAILERLITE
   *
   */

    if($arr['capture-service'] == 7){

      $api_key = $ath_options['int-ml-api'];
      $groups = array();

      // Grupos
      if ($arr['groups']) {
        foreach ($arr['groups'] as $k => $v) {
          array_push($groups,(int) $v);
        }
      }
      
      if(!empty($groups)){
        $mls =  new ML_Subscribers( $api_key );
        $lead = array('name'=>$arr['name'],'email'=>$arr['email']);
        foreach ($groups as $k => $v) {
          $resp = json_decode($mls->setGroupId($v)->add($lead, 1));
          if(array_key_exists('id',$resp)){
            $result = true;
          }else{
            $result = false;
          }
        }
      }else{
        $result = false;
      }

      $result = true;

    }


  /*
   *
   * RDSTATION
   *
   */

    if($arr['capture-service'] == 8){

      $args  = array();
      $token_private = $ath_options['int-rdstation'];
      $token_public  = $ath_options['int-rdstation-public']; 
      $RD = new RDStationAPI($token_private,$token_public);

      $args['identificador'] = $arr['identifier'];
      if(isset($arr['name'])){
        $args['name'] = $arr['name'];
      }

      $return = $RD->sendNewLead($arr['email'],$args);

      if($return == 1 or $return == true){
        $result = true;
      }else{
        $result = false;
      }

    }

    

  /*
   *
   * EGOI
   *
   */

    if($arr['capture-service'] == 9){

      $post = '';
      $data = array(
        'key' => urldecode($ath_options['int-egoi']),
        'email'=> urlencode($arr['email']),
        'list'=> urlencode((int) $arr['list'])
      );

      if(isset($arr['name'])){
        $data['name'] = $arr['name'];
      }

      foreach($data as $key=>$value){
        $post .= $key.'='.$value.'&';
      }

      $post = rtrim($post,'&');
      $curl = curl(get_bloginfo('url').'/wp-content/themes/'. ath_theme('folder') .'/includes/vendor/egoi/init.php',$post);

      if($curl == 1){
        $result = true;
      }else{
        $result = false;
      }

    }

    

  /*
   *
   * SENDINBLUE
   *
   */

    if($arr['capture-service'] == 10){

      $apiKey = $ath_options['int-sendinblue'];
      $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', $apiKey);
      $apiInstance = new SendinBlue\Client\Api\ContactsApi(new GuzzleHttp\Client(),$config);

      $newContact = new SendinBlue\Client\Model\CreateContact();
      $newContact['listIds'] = array((int) $arr['list']);
      $newContact['email'] = $arr['email'];

      if(isset($arr['name'])){
        $newContact['attributes'] = array("NOME" => $arr['name']);
      }

      try{
          $result = $apiInstance->createContact($newContact);
          if(isset($result['id'])){
            $result = true;
          }else{
            $result = false;
          }
      } catch (Exception $e){
          // echo 'Exception when calling ContactsApi->createContact: ', $e->getMessage(), PHP_EOL;
          $result = false;
      }

    }



  /*
   *
   * CAMPAIGN MONITOR
   *
   */

    if($arr['capture-service'] == 11){

      $auth = array('api_key' => $ath_options['int-cmonitor']);
      $wrap = new CS_REST_Subscribers($arr['list'],$auth);
      $arguments = array(
          'EmailAddress' => $arr['email'],
          'ConsentToTrack' => 'Yes'
      );

      if(isset($arr['name'])){
        $arguments['Name'] = $arr['name'];
      }   
      $newContact = $wrap->add($arguments);
      
      if(is_string($newContact->response)){
        if($newContact->response == $arr['email']){
          $result = true;
        }else{
          $result = false;
        }
      }else{
        $result = false;
      }

    }


    if($result != false){
      echo ( isset($arr['redirect']) ? $arr['redirect'] : 1 );
    }else{
      echo 0;
    }

    exit;


  }//capture



}

new ATH_Ajax( 'add_filters' );