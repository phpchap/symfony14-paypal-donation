<?php

/**
 * sfPayPalSetExpressCheckoutForm
 *
 * @package sfPayPalExpressCheckoutPlugin
 * @author  Stanislav Petrov <s.e.petrov@gmail.com>
 * @version $Id$
 */
class sfPayPalSetExpressCheckoutForm extends BasesfPayPalExpressCheckoutForm
{
  /**
   * The request method.
   *
   * @var string Defaults to 'SetExpressCheckout'.
   */
  protected static $_method = 'SetExpressCheckout';

  /**
   * The PayPal redirect URLs.
   *
   * @var array
   */
  protected $_redirect_url = array(
		'sandbox' => 'https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=',
		'prod'    => 'https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='
  );

  public function configure()
  {
    if (null !== $this->getOption('payment_requests'))
    {
      if ( ! preg_match('/^\d$/', $this->getOption('payment_requests')))
      {
        throw new InvalidArgumentException(sprintf('%s expects unsingned integer for "payment_requests" option.', get_class($this)));
      }

      if (1 != $this->getOption('payment_requests'))
      {
        throw new InvalidArgumentException(sprintf('%s does not implement the functionality for multiple payment requests.', get_class($this)));
      }

      if ($this->getOption('payment_requests') < 1 || $this->getOption('payment_requests') > 10)
      {
        throw new InvalidArgumentException(sprintf('%s expects "payment_requests" option in the range 1 - 10.', get_class($this)));
      }
    }

    $this->widgetSchema['RETURNURL']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['RETURNURL'] = new sfValidatorAnd(array(
      new sfValidatorString(array('max_length' => 2048)),
      new sfValidatorUrl(array('protocols' => array('http', 'https')))
    ));

    $this->widgetSchema['CANCELURL']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['CANCELURL'] = new sfValidatorAnd(array(
      new sfValidatorString(array('max_length' => 2048)),
      new sfValidatorUrl(array('protocols' => array('http', 'https')))
    ));

    $this->widgetSchema['NOSHIPPING']    = new sfWidgetFormInputHidden(array('default' => '1'));
    $this->validatorSchema['NOSHIPPING'] = new sfValidatorChoice(array('required' => false, 'choices' => array(
      '0', // PayPal displays the shipping address on the PayPal pages
      '1', // PayPal does not display shipping address fields whatsoever
      '2', // If you do not pass the shipping address, PayPal obtains it from the buyer’s account profile
    )));

    $this->widgetSchema['LOCALECODE']    = new sfWidgetFormInputHidden(array('default' => 'GB'));
    $this->validatorSchema['LOCALECODE'] = new sfValidatorChoice(array('required' => false, 'choices' => array(
      'AU', // Australia
      'AT', // Austria
      'BE', // Belgium
      'CA', // Canada
      'CH', // Switzerland
      'CN', // China
      'DE', // Germany
      'ES', // Spain
      'GB', // United Kingdom
      'FR', // France
      'IT', // Italy
      'NL', // Netherlands
      'PL', // Poland
      'US', // United States
    )));

    
    $this->widgetSchema['L_PAYMENTREQUEST_0_NAME0']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['L_PAYMENTREQUEST_0_NAME0'] = new sfValidatorPass();

    $this->widgetSchema['L_PAYMENTREQUEST_0_DESC0']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['L_PAYMENTREQUEST_0_DESC0'] = new sfValidatorPass();

    $this->widgetSchema['L_PAYMENTREQUEST_0_AMT0']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['L_PAYMENTREQUEST_0_AMT0'] = new sfValidatorPass();
    
    $this->widgetSchema['L_PAYMENTREQUEST_0_QTY0']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['L_PAYMENTREQUEST_0_QTY0'] = new sfValidatorPass();

    $this->widgetSchema['PAYMENTREQUEST_0_ITEMAMT']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['PAYMENTREQUEST_0_ITEMAMT'] = new sfValidatorPass();
    
    $this->widgetSchema['PAYMENTREQUEST_0_SHIPPINGAMT']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['PAYMENTREQUEST_0_SHIPPINGAMT'] = new sfValidatorPass();

    $this->widgetSchema['PAYMENTREQUEST_0_AMT']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['PAYMENTREQUEST_0_AMT'] = new sfValidatorPass();
    
    $this->widgetSchema['PAYMENTREQUEST_0_CURRENCYCODE']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['PAYMENTREQUEST_0_CURRENCYCODE'] = new sfValidatorPass();

    $this->widgetSchema['PAYMENTREQUEST_0_PAYMENTACTION']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['PAYMENTREQUEST_0_PAYMENTACTION'] = new sfValidatorPass();
    
    $this->widgetSchema['ALLOWNOTE']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['ALLOWNOTE'] = new sfValidatorPass();
    
    $this->widgetSchema['AMT']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['AMT'] = new sfValidatorPass();

    $this->widgetSchema['DESC']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['DESC'] = new sfValidatorPass();
  }

  /**
   * Returns the PayPal redirect URL.
   *
   * @param string $token the PayPal response token
   *
   * @return string
   */
  public function getRedirectUrl($token)
  {
    if($this->getOption('sandbox') == "true") {
      $env = "sandbox";
    } else {
      $env = "prod";
    }
    $url = $this->_redirect_url[$env].urlencode($token);
    return $url;
  }

  /**
   * @see BasesfPayPalExpressCheckoutForm
   */
  protected function getMethod()
  {
    return self::$_method;
  }
}
