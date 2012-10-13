<?php

/**
 * sfPayPalGetExpressCheckoutDetailsForm
 *
 * @package sfPayPalExpressCheckoutPlugin
 * @author  Stanislav Petrov <s.e.petrov@gmail.com>
 * @version $Id$
 */
class sfPayPalGetExpressCheckoutDetailsForm extends BasesfPayPalExpressCheckoutForm
{
  /**
   * The request method.
   *
   * @var string Defaults to 'GetExpressCheckoutDetails'.
   */
  protected static $_method = 'GetExpressCheckoutDetails';

  public function configure()
  {
    $this->widgetSchema['TOKEN']    = new sfWidgetFormInputHidden();
    $this->validatorSchema['TOKEN'] = new sfValidatorString(array('min_length' => 20, 'max_length' => 20));
  }

  /**
   * @see BasesfPayPalExpressCheckoutForm
   */
  protected function getMethod()
  {
    return self::$_method;
  }
}
