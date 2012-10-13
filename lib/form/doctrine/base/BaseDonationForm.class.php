<?php

/**
 * Donation form base class.
 *
 * @method Donation getObject() Returns the current form's model object
 *
 * @package    paypal_shop
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDonationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'processed'         => new sfWidgetFormInputText(),
      'donationhash'      => new sfWidgetFormInputText(),
      'email'             => new sfWidgetFormInputText(),
      'payerid'           => new sfWidgetFormInputText(),
      'payerstatus'       => new sfWidgetFormInputText(),
      'firstname'         => new sfWidgetFormInputText(),
      'lastname'          => new sfWidgetFormInputText(),
      'countrycode'       => new sfWidgetFormInputText(),
      'shiptoname'        => new sfWidgetFormInputText(),
      'shiptostreet'      => new sfWidgetFormInputText(),
      'shiptostreet2'     => new sfWidgetFormInputText(),
      'shiptocity'        => new sfWidgetFormInputText(),
      'shiptostate'       => new sfWidgetFormInputText(),
      'shiptozip'         => new sfWidgetFormInputText(),
      'shiptophonenum'    => new sfWidgetFormInputText(),
      'shiptocountrycode' => new sfWidgetFormInputText(),
      'shiptocountryname' => new sfWidgetFormInputText(),
      'sellernote'        => new sfWidgetFormInputText(),
      'donationmessage'   => new sfWidgetFormInputText(),
      'anonymous'         => new sfWidgetFormInputCheckbox(),
      'addressstatus'     => new sfWidgetFormInputText(),
      'quantity'          => new sfWidgetFormInputText(),
      'shipping'          => new sfWidgetFormInputText(),
      'eggprice'          => new sfWidgetFormInputText(),
      'total'             => new sfWidgetFormInputText(),
      'status'            => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'processed'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'donationhash'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'payerid'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'payerstatus'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'firstname'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'lastname'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'countrycode'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'shiptoname'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'shiptostreet'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'shiptostreet2'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'shiptocity'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'shiptostate'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'shiptozip'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'shiptophonenum'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'shiptocountrycode' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'shiptocountryname' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'sellernote'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'donationmessage'   => new sfValidatorPass(array('required' => false)),
      'anonymous'         => new sfValidatorBoolean(array('required' => false)),
      'addressstatus'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'quantity'          => new sfValidatorPass(array('required' => false)),
      'shipping'          => new sfValidatorNumber(array('required' => false)),
      'eggprice'          => new sfValidatorNumber(array('required' => false)),
      'total'             => new sfValidatorNumber(array('required' => false)),
      'status'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('donation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Donation';
  }

}
