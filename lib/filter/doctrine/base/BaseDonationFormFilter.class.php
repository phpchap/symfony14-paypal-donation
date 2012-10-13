<?php

/**
 * Donation filter form base class.
 *
 * @package    paypal_shop
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDonationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'processed'         => new sfWidgetFormFilterInput(),
      'donationhash'      => new sfWidgetFormFilterInput(),
      'email'             => new sfWidgetFormFilterInput(),
      'payerid'           => new sfWidgetFormFilterInput(),
      'payerstatus'       => new sfWidgetFormFilterInput(),
      'firstname'         => new sfWidgetFormFilterInput(),
      'lastname'          => new sfWidgetFormFilterInput(),
      'countrycode'       => new sfWidgetFormFilterInput(),
      'shiptoname'        => new sfWidgetFormFilterInput(),
      'shiptostreet'      => new sfWidgetFormFilterInput(),
      'shiptostreet2'     => new sfWidgetFormFilterInput(),
      'shiptocity'        => new sfWidgetFormFilterInput(),
      'shiptostate'       => new sfWidgetFormFilterInput(),
      'shiptozip'         => new sfWidgetFormFilterInput(),
      'shiptophonenum'    => new sfWidgetFormFilterInput(),
      'shiptocountrycode' => new sfWidgetFormFilterInput(),
      'shiptocountryname' => new sfWidgetFormFilterInput(),
      'sellernote'        => new sfWidgetFormFilterInput(),
      'donationmessage'   => new sfWidgetFormFilterInput(),
      'anonymous'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'addressstatus'     => new sfWidgetFormFilterInput(),
      'quantity'          => new sfWidgetFormFilterInput(),
      'shipping'          => new sfWidgetFormFilterInput(),
      'eggprice'          => new sfWidgetFormFilterInput(),
      'total'             => new sfWidgetFormFilterInput(),
      'status'            => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'processed'         => new sfValidatorPass(array('required' => false)),
      'donationhash'      => new sfValidatorPass(array('required' => false)),
      'email'             => new sfValidatorPass(array('required' => false)),
      'payerid'           => new sfValidatorPass(array('required' => false)),
      'payerstatus'       => new sfValidatorPass(array('required' => false)),
      'firstname'         => new sfValidatorPass(array('required' => false)),
      'lastname'          => new sfValidatorPass(array('required' => false)),
      'countrycode'       => new sfValidatorPass(array('required' => false)),
      'shiptoname'        => new sfValidatorPass(array('required' => false)),
      'shiptostreet'      => new sfValidatorPass(array('required' => false)),
      'shiptostreet2'     => new sfValidatorPass(array('required' => false)),
      'shiptocity'        => new sfValidatorPass(array('required' => false)),
      'shiptostate'       => new sfValidatorPass(array('required' => false)),
      'shiptozip'         => new sfValidatorPass(array('required' => false)),
      'shiptophonenum'    => new sfValidatorPass(array('required' => false)),
      'shiptocountrycode' => new sfValidatorPass(array('required' => false)),
      'shiptocountryname' => new sfValidatorPass(array('required' => false)),
      'sellernote'        => new sfValidatorPass(array('required' => false)),
      'donationmessage'   => new sfValidatorPass(array('required' => false)),
      'anonymous'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'addressstatus'     => new sfValidatorPass(array('required' => false)),
      'quantity'          => new sfValidatorPass(array('required' => false)),
      'shipping'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'eggprice'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'status'            => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('donation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Donation';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'processed'         => 'Text',
      'donationhash'      => 'Text',
      'email'             => 'Text',
      'payerid'           => 'Text',
      'payerstatus'       => 'Text',
      'firstname'         => 'Text',
      'lastname'          => 'Text',
      'countrycode'       => 'Text',
      'shiptoname'        => 'Text',
      'shiptostreet'      => 'Text',
      'shiptostreet2'     => 'Text',
      'shiptocity'        => 'Text',
      'shiptostate'       => 'Text',
      'shiptozip'         => 'Text',
      'shiptophonenum'    => 'Text',
      'shiptocountrycode' => 'Text',
      'shiptocountryname' => 'Text',
      'sellernote'        => 'Text',
      'donationmessage'   => 'Text',
      'anonymous'         => 'Boolean',
      'addressstatus'     => 'Text',
      'quantity'          => 'Text',
      'shipping'          => 'Number',
      'eggprice'          => 'Number',
      'total'             => 'Number',
      'status'            => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
