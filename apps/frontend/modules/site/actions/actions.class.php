<?php

/**
 * site actions.
 *
 * @package    paypal_shop
 * @subpackage site
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class siteActions extends sfActions
{
  public function preExecute()
  {
  }
  /**
   * homepage
   * @param sfWebRequest $request 
   */
  public function executeHome(sfWebRequest $request) 
  {
    $this->donations = DonationTable::getSuccessfulDonations(3);
    $this->total_donationsResult = DonationTable::getAllTotalDonations();
    if(!empty($this->total_donationsResult[0][0])) {
      $this->total_donations = $this->total_donationsResult[0][0];
    } else {
      $this->total_donations = "0.00";
    }
  }
  
  /**
   * donate
   * @param sfWebRequest $request 
   */
  public function executeDonate(sfWebRequest $request) 
  {   
    // init error array
    $this->error_ar = array();
    
    /*$this->donations = DonationTable::getSuccessfulDonations(7);*/
    $this->total_donationsResult = DonationTable::getAllTotalDonations();
    if(!empty($this->total_donationsResult[0][0])) {
      $this->total_donations = $this->total_donationsResult[0][0];
    } else {
      $this->total_donations = "0.00";
    }


    $this->pager = new sfDoctrinePager('Donation', 7);
    $this->pager->setQuery(DonationTable::getSuccessfulDonationsQuery(7));
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
    
    // form has been posted
    if($request->isMethod('post')) {
      
      // unset the order id and email
      if(!empty($_SESSION['donation_id'])) {
        $_SESSION['donation_id'] = "";
        unset($_SESSION['donation_id']);
      }
      
      // unset the order id and email
      if(!empty($_SESSION['donation_hash'])) {
        $_SESSION['donation_hash'] = "";
        unset($_SESSION['donation_hash']);
      }
            
      // unset the order id and email
      if(!empty($_SESSION['donationTotal'])) {
        $_SESSION['donationTotal'] = "";
        unset($_SESSION['donationTotal']);
      }
      // unset the order id and email
      if(!empty($_SESSION['donationMessage'])) {
        $_SESSION['donationMessage'] = "";
        unset($_SESSION['donationMessage']);
      }
      // unset the order id and email
      if(!empty($_SESSION['anonymous'])) {
        $_SESSION['anonymous'] = "";
        unset($_SESSION['anonymous']);
      }
      
      $options = array('sandbox' => sfConfig::get('app_paypal_sandbox'));

      // make the paypal express checkout request and save the returned token
      // to the order's transid attribute and then redirect the user to paypal
      $form = new sfPayPalSetExpressCheckoutForm(array(), $options);

      if (sfConfig::get('app_paypal_sandbox' != 'true')) {
        // we need to disable the URL validation because the TLD does not pass the check
        $form->setValidator('RETURNURL', new sfValidatorString(array('max_length' => 2048)));
        $form->setValidator('CANCELURL', new sfValidatorString(array('max_length' => 2048)));
      }
      $donation = $_POST['donation'];
      // not a number 
      if($donation == "") {
        $this->error_ar['donation'] = "Please enter a donation amount";
      }
      
      // not a number 
      if(!ctype_digit($donation)) {
        $this->error_ar['donation'] = "Donation is not a whole number (e.g. 50)";
      }
      
      // not a positive number
      if($donation < 0) {
        $this->error_ar['donation'] = "Donation must be a positive number (e.g. 50)";
      }
      
      // not a positive number
      if($donation < 0) {
        $this->error_ar['donation'] = "Donation must be a positive number (e.g. 50)";
      }      
      
      // anonymous is set
      if(!empty($_POST['anonymous']) && $_POST['anonymous'] == 'on') {
        $anonymous = '1';
      } else {
        $anonymous = '0';
      }
      
      // donationMessage is set
      if(!empty($_POST['donationMessage'])) {
        $donationMessage = addslashes($_POST['donationMessage']);
      } else {
        $donationMessage = "";
      }
      
      // calculate the total
      $preTotal = $_POST['donation'];
      $total = $this->formatTotal($preTotal);
            
      // no errors continue
      if(count($this->error_ar)==0) {
        
        $options = array('sandbox' => sfConfig::get('app_paypal_sandbox'));

        // add this stuff to session
        $_SESSION['donationTotal'] = $total;
        $_SESSION['donationMessage'] = $donationMessage;
        $_SESSION['anonymous'] = $anonymous;
                
        // make the paypal express checkout request and save the returned token
        // to the order's transid attribute and then redirect the user to paypal
        $form = new sfPayPalSetExpressCheckoutForm(array(), $options);

        if (sfConfig::get('app_paypal_sandbox' != 'true')) {
          // we need to disable the URL validation because the TLD does not pass the check
          $form->setValidator('RETURNURL', new sfValidatorString(array('max_length' => 2048)));
          $form->setValidator('CANCELURL', new sfValidatorString(array('max_length' => 2048)));
        }

        // get the quantity and shipping 
        $formValues = array(
          'USER' => sfConfig::get('app_paypal_user'),
          'PWD' => sfConfig::get('app_paypal_pwd'),
          'SIGNATURE' => sfConfig::get('app_paypal_signature'),
          'RETURNURL' => $this->generateUrl('payPalConfirmation', array(), true),
          'CANCELURL' => $this->generateUrl('payPalCancel', array(), true),
          'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
          'PAYMENTREQUEST_0_ITEMAMT' => $total,       
          'PAYMENTREQUEST_0_AMT' => $total ,  
          'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR',
          'LOCALECODE' => 'GB',
          'L_PAYMENTREQUEST_0_NAME0' => sfConfig::get('app_product_name'),
          'L_PAYMENTREQUEST_0_DESC0' => sfConfig::get('product_description'),
          'L_PAYMENTREQUEST_0_AMT0' => $total,
          'L_PAYMENTREQUEST_0_QTY0' => 1,
          'ALLOWNOTE' => '0',
          'AMT' => $total,
          'DESC' =>  sfConfig::get('product_description'),
          'NOSHIPPING' => 1
        );

        $form->bind($formValues);

        if ($form->isValid()) {
          $response = '';
          if ($form->processRequest($response)) {           
            $this->redirect($form->getRedirectUrl($response['TOKEN']));
          } else {            
            // init error array
            $this->error_ar['api_error'] = 'Error contacting PayPal';
          }
        } else {
          // init error array
          $this->error_ar['api_error'] = 'Error contacting PayPal';        
        }  
      }
    }
  }
  
  /**
   * donate success
   * @param sfWebRequest $request 
   */
  public function executeDonateConfirm(sfWebRequest $request) 
  { 

  }

  /**
   * donate failure
   * @param sfWebRequest $request 
   */
  public function executeDonateCancel(sfWebRequest $request) 
  {        
    $this->redirect("/");
  }  
  
  /**
   * about kev
   * @param sfWebRequest $request 
   */
  public function executeAboutKev(sfWebRequest $request) 
  {    
  }  

  /**
   * events 
   * @param sfWebRequest $request 
   */
  public function executeEvents(sfWebRequest $request) 
  {    
  }    
  
  /**
   * where donations go 
   * @param sfWebRequest $request 
   */
  public function executeWhereDonationsGo(sfWebRequest $request) 
  {    
  }      
  
  /**
   * format the total so its to two decimal places
   * @param float $total
   * @return decimal 
   */
  public function formatTotal($total)
  {    
      if (stripos($total,".") !== false) {        
        $precision = 2;
        $cleanTotal = round((float) $total, (int) $precision);
        list($a, $b) = explode('.', $cleanTotal);
        if (strlen($b) < $precision) $b = str_pad($b, $precision, '0', STR_PAD_RIGHT);
        $amount = $precision ? "$a.$b" : $a;
        echo $amount;
        die;
      } else { // do whatever you want with values that do not have a float
        $amount = $total.".00";
      } 
      return $amount;
  }
  
  /**
   * paypal order has completed
   * @param sfWebRequest $request 
   */
  public function executePayPalConfirmation(sfWebRequest $request) 
  {    
    // unset the order id and emailprin    
    if(empty($_SESSION['donation_hash'])) {
          
      // Obtain the token from PayPal.
      if(!array_key_exists('token', $_REQUEST)) {
        exit('Token is not received.');
      }

      // Set request-specific fields.
      $token = urlencode(htmlspecialchars($_REQUEST['token']));    

      // get the express checkout details
      $options = array('sandbox' => sfConfig::get('app_paypal_sandbox'));

      $form = new sfPayPalGetExpressCheckoutDetailsForm(array(), $options);
      $form->bind(array('USER' => sfConfig::get('app_paypal_user'), 
                        'PWD' => sfConfig::get('app_paypal_pwd'), 
                        'SIGNATURE' => sfConfig::get('app_paypal_signature'), 
                        'TOKEN' => $token));

      if (!$form->isValid()) {
        $this->error_ar['api_error'] = "Error with PayPal"; 
      }

      $checkout_details = array();

      if (!$form->processRequest($checkout_details)) {
          // failed to get the checkout details
          $this->error_ar['api_error'] = "Error getting checkout details";
      }

      // confirm the order payment with PayPal to process the payment transaction
      $form = new sfPayPalDoExpressCheckoutPaymentForm(array(), $options);
      $form->bind(array('USER' => sfConfig::get('app_paypal_user'), 
                        'PWD' => sfConfig::get('app_paypal_pwd'), 
                        'SIGNATURE' => sfConfig::get('app_paypal_signature'), 
                        'TOKEN' => $checkout_details['TOKEN'], 
                        'PAYERID' => $checkout_details['PAYERID'], 
                        'PAYMENTREQUEST_0_AMT' => $checkout_details['PAYMENTREQUEST_0_AMT'], 
                        'PAYMENTREQUEST_0_CURRENCYCODE' => $checkout_details['PAYMENTREQUEST_0_CURRENCYCODE'], 
                        'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale'));

      if (!$form->isValid()) {
          // the PayPal request message is not valid
          // failed to get the checkout details
          $this->error_ar['api_error'] = "Form validation error";
      }
      
      // create new donation
      $donation = new Donation();       
      
      // set the details of the order
      $donation->processed = "no";
      $donation->donationhash = substr(md5(time()), 0, 8);
      $donation->email = $checkout_details['EMAIL'];
      $donation->payerid = $checkout_details['PAYERID'];
      $donation->payerstatus = $checkout_details['PAYERSTATUS'];
      $donation->firstname = $checkout_details['FIRSTNAME'];
      $donation->lastname = $checkout_details['LASTNAME'];
      $donation->countrycode = $checkout_details['COUNTRYCODE'];
      $donation->shiptoname = $checkout_details['SHIPTONAME'];    
      $donation->shiptostreet = $checkout_details['SHIPTOSTREET']; 
      if(!empty($checkout_details['SHIPTOSTREET2'])) {
        $donation->shiptostreet2 = $checkout_details['SHIPTOSTREET2'];              
      }
      if(!empty($checkout_details['SHIPTOPHONENUM'])) {
        $donation->shiptophonenum = $checkout_details['SHIPTOPHONENUM'];
      }
      $donation->shiptocity = $checkout_details['SHIPTOCITY'];    
      $donation->shiptostate = $checkout_details['SHIPTOSTATE'];
      $donation->shiptozip = $checkout_details['SHIPTOZIP'];
      $donation->shiptocountrycode = $checkout_details['SHIPTOCOUNTRYCODE'];
      $donation->shiptocountryname = $checkout_details['SHIPTOCOUNTRYNAME'];
      if(!empty($checkout_details['PAYMENTREQUEST_0_NOTETEXT'])) {
        $donation->sellernote = $checkout_details['PAYMENTREQUEST_0_NOTETEXT'];             
      }
      $donation->addressstatus = $checkout_details['ADDRESSSTATUS']; 
      /*$donation->quantity = $checkout_details['L_PAYMENTREQUEST_0_QTY0'];*/   
      $donation->shipping = $checkout_details['PAYMENTREQUEST_0_SHIPPINGAMT']; 
      $donation->eggprice = sfConfig::get('app_egg_price'); 
      $donation->total = $_SESSION['donationTotal']; 
      $donation->donationmessage = $_SESSION['donationMessage']; 
      $donation->anonymous = $_SESSION['anonymous'];

      $response = '';

      if ($form->processRequest($response)) {

        // the payment is successful
        $donation->status = 'Successful';
        
        $body = '';
        foreach($donation->toArray() as $field => $value) {
          if(strlen($value)>0) {
            $body .= $field.': '.$value."\r\n";          
          }
        }

        // send an email to the affiliate
        $message = $this->getMailer()->compose(
          array('phpchap@gmail.com' => 'Justen'),
          "phpchap@gmail.com",
          "Donation for Kev",
          $body
        );

        // send the message
        $this->getMailer()->send($message);
        
      } else {
        // the payment failed
        $donation->status = 'Failed';
      }
      
error_log('::DONATION LOG::');
error_log(print_r($donation->toArray(), true));
      // save the order..
      $donation->save();
      $_SESSION['donation_hash'] = $donation->getDonationhash();
      
    } else {
      
    }
    $this->donations = DonationTable::getSuccessfulDonations();
    $this->total_donationsResult = DonationTable::getAllTotalDonations();
    if(!empty($this->total_donationsResult[0][0])) {
      $this->total_donations = $this->total_donationsResult[0][0];
    } else {
      $this->total_donations = "0.00";
    }
  }
  
  /**
   * paypal order has been cancelled
   * @param sfWebRequest $request 
   */
  public function executePayPalCancel(sfWebRequest $request) 
  {
    // redirect back to the homepage
    $this->redirect("/");
  }
}