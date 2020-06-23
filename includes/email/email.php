<?php
class Service_Send_Email {

  private $name,
          $email,
          $message,
          $subject,
          $url,
          $body,
          $sender,
          $recipients;

  public function __construct( $add_hooks = false ) {
    if ( $add_hooks ) {
      add_filter( 'ath_send_email', array( $this, 'send_email' ) );
    }
  }

  public function send_email() {

    $this->name         = !empty( $_POST['form_name'] )    ? $_POST['form_name'] : '';
    $this->email        = !empty( $_POST['form_email'] )   ? $_POST['form_email'] : '';
    $this->message      = !empty( $_POST['form_message'] ) ? $_POST['form_message'] : '';
    $this->subject      = !empty( $_POST['form_subject'] ) ? $_POST['form_subject'] : '';
    $this->page         = $_POST['form_page'];
    $this->url          = $_SERVER['HTTP_HOST'];
    $this->sender       = $this->email;
    $this->body         = implode( '<br>',
      array(
        'De: ' . implode( ' - ', array_filter( array( $this->name, $this->email ) ) ),
        'Assunto: ' . $this->subject . '<br>',
        'Corpo da mensagem:',
        nl2br( $this->message ),
        '--<br><br>',
        'Este e-mail foi enviado de um formulário em ' . $this->url,
      )
    );

    $this->name = $this->name ? $this->name : get_bloginfo( 'name', 'display' );

    
    // /*
    //  *
    //  * RECIPIENTS
    //  *
    //  */


    if( have_rows('form_recipients',$this->page) ):
      while ( have_rows('form_recipients',$this->page) ) : the_row();
        $email = get_sub_field('email');
        if ( $email ) {
          $recipients[] = $email;
        }
      endwhile;
    endif;
    
  
    // /*
    //  *
    //  * SEND MAIL
    //  *
    //  */

     if ( !empty($recipients) ) {
      $headers = array(
        'Content-Type: text/html; charset: UTF-8;',
        'From: ' . $this->name . ' <' . $this->sender . '>',
        'Reply-To: ' . $this->email,
      );
      $return = wp_mail( $recipients, $this->subject, $this->body, $headers );
      echo $return == false ? 0 : 1;
    }else{
      echo 0;
    }
  
  }

}