<?php

/**
 * BaseDonation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $processed
 * @property string $donationhash
 * @property string $email
 * @property string $payerid
 * @property string $payerstatus
 * @property string $firstname
 * @property string $lastname
 * @property string $countrycode
 * @property string $shiptoname
 * @property string $shiptostreet
 * @property string $shiptostreet2
 * @property string $shiptocity
 * @property string $shiptostate
 * @property string $shiptozip
 * @property string $shiptophonenum
 * @property string $shiptocountrycode
 * @property string $shiptocountryname
 * @property string $sellernote
 * @property text $donationmessage
 * @property boolean $anonymous
 * @property string $addressstatus
 * @property int $quantity
 * @property decimal $shipping
 * @property decimal $eggprice
 * @property decimal $total
 * @property string $status
 * 
 * @method string   getProcessed()         Returns the current record's "processed" value
 * @method string   getDonationhash()      Returns the current record's "donationhash" value
 * @method string   getEmail()             Returns the current record's "email" value
 * @method string   getPayerid()           Returns the current record's "payerid" value
 * @method string   getPayerstatus()       Returns the current record's "payerstatus" value
 * @method string   getFirstname()         Returns the current record's "firstname" value
 * @method string   getLastname()          Returns the current record's "lastname" value
 * @method string   getCountrycode()       Returns the current record's "countrycode" value
 * @method string   getShiptoname()        Returns the current record's "shiptoname" value
 * @method string   getShiptostreet()      Returns the current record's "shiptostreet" value
 * @method string   getShiptostreet2()     Returns the current record's "shiptostreet2" value
 * @method string   getShiptocity()        Returns the current record's "shiptocity" value
 * @method string   getShiptostate()       Returns the current record's "shiptostate" value
 * @method string   getShiptozip()         Returns the current record's "shiptozip" value
 * @method string   getShiptophonenum()    Returns the current record's "shiptophonenum" value
 * @method string   getShiptocountrycode() Returns the current record's "shiptocountrycode" value
 * @method string   getShiptocountryname() Returns the current record's "shiptocountryname" value
 * @method string   getSellernote()        Returns the current record's "sellernote" value
 * @method text     getDonationmessage()   Returns the current record's "donationmessage" value
 * @method boolean  getAnonymous()         Returns the current record's "anonymous" value
 * @method string   getAddressstatus()     Returns the current record's "addressstatus" value
 * @method int      getQuantity()          Returns the current record's "quantity" value
 * @method decimal  getShipping()          Returns the current record's "shipping" value
 * @method decimal  getEggprice()          Returns the current record's "eggprice" value
 * @method decimal  getTotal()             Returns the current record's "total" value
 * @method string   getStatus()            Returns the current record's "status" value
 * @method Donation setProcessed()         Sets the current record's "processed" value
 * @method Donation setDonationhash()      Sets the current record's "donationhash" value
 * @method Donation setEmail()             Sets the current record's "email" value
 * @method Donation setPayerid()           Sets the current record's "payerid" value
 * @method Donation setPayerstatus()       Sets the current record's "payerstatus" value
 * @method Donation setFirstname()         Sets the current record's "firstname" value
 * @method Donation setLastname()          Sets the current record's "lastname" value
 * @method Donation setCountrycode()       Sets the current record's "countrycode" value
 * @method Donation setShiptoname()        Sets the current record's "shiptoname" value
 * @method Donation setShiptostreet()      Sets the current record's "shiptostreet" value
 * @method Donation setShiptostreet2()     Sets the current record's "shiptostreet2" value
 * @method Donation setShiptocity()        Sets the current record's "shiptocity" value
 * @method Donation setShiptostate()       Sets the current record's "shiptostate" value
 * @method Donation setShiptozip()         Sets the current record's "shiptozip" value
 * @method Donation setShiptophonenum()    Sets the current record's "shiptophonenum" value
 * @method Donation setShiptocountrycode() Sets the current record's "shiptocountrycode" value
 * @method Donation setShiptocountryname() Sets the current record's "shiptocountryname" value
 * @method Donation setSellernote()        Sets the current record's "sellernote" value
 * @method Donation setDonationmessage()   Sets the current record's "donationmessage" value
 * @method Donation setAnonymous()         Sets the current record's "anonymous" value
 * @method Donation setAddressstatus()     Sets the current record's "addressstatus" value
 * @method Donation setQuantity()          Sets the current record's "quantity" value
 * @method Donation setShipping()          Sets the current record's "shipping" value
 * @method Donation setEggprice()          Sets the current record's "eggprice" value
 * @method Donation setTotal()             Sets the current record's "total" value
 * @method Donation setStatus()            Sets the current record's "status" value
 * 
 * @package    paypal_shop
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDonation extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('donations');
        $this->hasColumn('processed', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('donationhash', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('payerid', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('payerstatus', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('firstname', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('lastname', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('countrycode', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('shiptoname', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('shiptostreet', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('shiptostreet2', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('shiptocity', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('shiptostate', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('shiptozip', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('shiptophonenum', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('shiptocountrycode', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('shiptocountryname', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('sellernote', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('donationmessage', 'text', null, array(
             'type' => 'text',
             ));
        $this->hasColumn('anonymous', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('addressstatus', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('quantity', 'int', 11, array(
             'type' => 'int',
             'length' => 11,
             ));
        $this->hasColumn('shipping', 'decimal', 4, array(
             'type' => 'decimal',
             'scale' => 2,
             'unsigned' => true,
             'length' => 4,
             ));
        $this->hasColumn('eggprice', 'decimal', 4, array(
             'type' => 'decimal',
             'scale' => 2,
             'unsigned' => true,
             'length' => 4,
             ));
        $this->hasColumn('total', 'decimal', 4, array(
             'type' => 'decimal',
             'scale' => 2,
             'unsigned' => true,
             'length' => 4,
             ));
        $this->hasColumn('status', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}