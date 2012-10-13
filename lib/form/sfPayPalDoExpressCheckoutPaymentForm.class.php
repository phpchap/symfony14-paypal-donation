<?php

/**
 * sfPayPalDoExpressCheckoutPaymentForm
 *
 * @package sfPayPalExpressCheckoutPlugin
 * @author  Stanislav Petrov <s.e.petrov@gmail.com>
 * @version $Id$
 */
class sfPayPalDoExpressCheckoutPaymentForm extends BasesfPayPalExpressCheckoutForm
{
  /**
   * The request method.
   *
   * @var string Defaults to 'DoExpressCheckoutPayment'.
   */
  protected static $_method = 'DoExpressCheckoutPayment';

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

    
    $this->widgetSchema['TOKEN']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['TOKEN'] = new sfValidatorString(array('min_length' => 20, 'max_length' => 20));

    $this->widgetSchema['PAYERID']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['PAYERID'] = new sfValidatorString(array('min_length' => 13, 'max_length' => 13));

    for ($i = 0, $j = $this->getOption('payment_requests', 1); $i < $j; $i++)
    {
      $this->widgetSchema['PAYMENTREQUEST_'.$i.'_AMT']    = new sfWidgetFormInputHidden();
      $this->validatorSchema['PAYMENTREQUEST_'.$i.'_AMT'] = new sfValidatorAnd(array(
        new sfValidatorRegex(array('pattern' => '/^\d{1,5}\.\d{2}$/'), array('invalid' => 'The amount must be in format X.XX')),
        new sfValidatorNumber(array('min' => 0, 'max' => 10000))
      ));

      $ci = new sfCultureInfo();
      $this->widgetSchema['PAYMENTREQUEST_'.$i.'_CURRENCYCODE']    = new sfWidgetFormInputHidden(array('default' => 'GBP'));
      $this->validatorSchema['PAYMENTREQUEST_'.$i.'_CURRENCYCODE'] = new sfValidatorChoice(array(
        'required' => false,
        'choices' => array_keys($ci->getCurrencies())
      ));

      $this->widgetSchema['PAYMENTREQUEST_'.$i.'_PAYMENTACTION']    = new sfWidgetFormInputHidden(array('default' => 'Sale'));
      $this->validatorSchema['PAYMENTREQUEST_'.$i.'_PAYMENTACTION'] = new sfValidatorChoice(array('choices' => array(
        'Sale',
        'Authorization',
        'Order'
      )));
    }
  }

  /**
   * @see BasesfPayPalExpressCheckoutForm
   */
  protected function getMethod()
  {
    return self::$_method;
  }
}
