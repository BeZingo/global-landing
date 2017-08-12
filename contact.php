<?php

/*if(isset($_POST['btnsubmit'])) {*/

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "info@kuwaitbc.ae";
    $email_subject = "Inquiry from Global Village - Kuwaiti Pavillion";

    function died($error) {
        // your error code can go here
        //echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        //echo "These errors appear below.<br/><br/>";
        echo $error;
        //echo "Please go back and fix these errors.<br/><br/>";
        die();
    }


    // validation expected data exists
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    $string_exp = "/^[A-Za-z .'-]+$/";
    $name = $_POST['name']; // required
    $business_name = $_POST['business_name']; // required
    $position = $_POST['position']; // required
    $email = $_POST['email']; // not required
    $phone = $_POST['phone']; // required
    $website = $_POST['website']; // required


  /*if(empty($_POST['name']) || empty($_POST['business_name']) || empty($_POST['position']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['website'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
  }else */
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.';
    died($error_message);
  }
  else if(!preg_match($string_exp,$business_name)) {

    $error_message .= 'The Business Name you entered does not appear to be valid.';
    died($error_message);
  }
  else if(empty($_POST['position'])){
    $error_message .= 'The position you entered does not appear to be valid.';
    died($error_message);
  }
  else if(!preg_match($email_exp,$email)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.';
    died($error_message);
  }
  else if(empty($_POST['phone'])){
    $error_message .= 'The phone you entered does not appear to be valid.';
    died($error_message);
  }
  else if(strlen($website) < 2) {
    $error_message .= 'The Website you entered do not appear to be valid.';
    died($error_message);
  }else if(strlen($error_message) > 0) {
    died($error_message);
  }
  else
  {

    $email_message = "Form details below.\n\n";


    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }



    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Business Name: ".clean_string($business_name)."\n";
    $email_message .= "Position: ".clean_string($position)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Telephone: ".clean_string($phone)."\n";
    $email_message .= "Website: ".clean_string($website)."\n";

// create email headers
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);

died('Thank you for contacting us. We will be in touch with you very soon.');
}
?>


<?php

/*}
else{
  echo "string";
}*/

?>
