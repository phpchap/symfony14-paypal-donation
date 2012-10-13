<?php

/**
 * BasesfPayPalExpressCheckoutForm
 *
 * @package sfPayPalExpressCheckoutPlugin
 * @author  Stanislav Petrov <s.e.petrov@gmail.com>
 * @version $Id$
 */
abstract class BasesfPayPalExpressCheckoutForm extends BaseForm {
  /**
   * The PayPal API version.
   *
   * @var string
   */

  const VERSION = '64.0';

  /**
   * The PayPal API URLs.
   *
   * @var array
   */
  protected $_request_url = array(
      'sandbox' => 'https://api-3t.sandbox.paypal.com/nvp',
      'prod' => 'https://api-3t.paypal.com/nvp'
  );

  public function setup() {
    $this->disableCSRFProtection();

    foreach (array('USER', 'PWD', 'SIGNATURE') as $name) {
      $this->widgetSchema[$name] = new sfWidgetFormInputHidden();
      $this->validatorSchema[$name] = new sfValidatorString();
    }

    $this->mergePostValidator(new sfValidatorCallback(array(
      'callback' => array(__CLASS__, 'postValidate'),
      'arguments' => array('method' => $this->getMethod())
    )));
    $this->widgetSchema->setNameFormat('%s');
  }

  /**
   * Returns the details for ExpressCheckout request.
   *
   * @return array on success, boolean FALSE on failure
   */
  public static function getExpressCheckoutDetails($token) {
    
    return $this->sendRequest(array('METHOD' => 'GetExpressCheckoutDetails',
                                    'TOKEN' => $token), 
                                    $this->getRequestUrl());
  }

  /**
   * Proceeds with the request.
   *
   * @param resource $response the response from PayPal
   *
   * @return boolean TRUE if the payment is successful, FALSE otherwise
   */
  public function processRequest(&$response = '') {
    if (!$this->isValid()) {
      throw new sfException(sprintf('%s can not proceed with the payment if the form is not valid.', __METHOD__));
    }

    $is_successful = false;
    
    if (false !== $response = $this->sendRequest($this->getValues(), $this->getRequestUrl())) {
      $response = $this->decodeRespose($response);
      error_log('Logging paypal gateaway reponse');
      error_log(print_r($response, true));
      error_log(print_r($this->getValues(), true));
      $is_successful = (isset($response['ACK']) && ($response['ACK'] == 'Success' || $response['ACK'] == 'SuccessWithWarning'));
    }
    return $is_successful;
  }

  /**
   * Adds the PayPal API version and method if missing.
   *
   * @param sfValidatorBase $validator
   * @param array $values
   * @param array $arguments
   *
   * @return array
   */
  public static function postValidate(sfValidatorBase $validator, $values, $arguments = array()) {
    if (!isset($arguments['method'])) {
      throw new InvalidArgumentException(sprintf('%s requires $arguments[method] parameter.', __METHOD__));
    }

    // add the request method
    $values['METHOD'] = $arguments['method'];

    // add the api version
    $values['VERSION'] = self::VERSION;

    // fix the format of the amount fields
    foreach ($values as $k => $v) {
      if (preg_match('/^PAYMENTREQUEST_(\d)_AMT$/', $k, $matches)) {
        $values[$k] = number_format($v, 2);
      }
    }


    return $values;
  }

  /**
   * Returns the request method.
   *
   * @return string
   */
  abstract protected function getMethod();

  /**
   * Returns the PayPal API URL.
   *
   * @return string
   */
  public function getRequestUrl() {
    if($this->getOption('sandbox') == "true") {
      $env = "sandbox";
    } else {
      $env = "prod";
    }    
    return $this->_request_url[$env];
  }

  /**
   * Sends a POST request to URl and returns the response.
   *
   * @param mixed $request the request parameters
   * @param string $url the URL
   *
   * @return string the response or boolean FALSE on failure
   */
  protected function sendRequest($request, $url) {
    if (is_array($request)) {
      $request = http_build_query($request);
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $response = curl_exec($ch);
    curl_close($ch);
    $this->logMessage(sprintf('Request URL: %s; Request data: %s; Response content: %s;', $url, $request, false === $response ? sprintf('FALSE; cURL error: (%d) %s', curl_errno($ch), curl_error($ch)) : $response), false === $response ? 'err' : 'info');
    return $response;
  }

  /**
   * Decodes PayPal response.
   *
   * @param string $response The response
   *
   * @return array
   */
  protected function decodeRespose($response) {
    $retval = array();
    $intial = 0;

    while (strlen($response)) {
      //postion of Key
      $keypos = strpos($response, '=');
      //position of value
      $valuepos = strpos($response, '&') ? strpos($response, '&') : strlen($response);

      // getting the Key and Value values and storing in a Associative Array
      $keyval = substr($response, $intial, $keypos);
      $valval = substr($response, $keypos + 1, $valuepos - $keypos - 1);

      //decoding the respose
      $retval[urldecode($keyval)] = urldecode($valval);
      $response = substr($response, $valuepos + 1, strlen($response));
    }

    return $retval;
  }

  /**
   * Logs a message.
   */
  protected function logMessage($message, $priority = 'info') {
    if (sfConfig::get('sf_logging_enabled')) {
      sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent(null, 'application.log', array($message, 'priority' => constant('sfLogger::' . strtoupper($priority)))));
    }
    error_log($message);
  }
}