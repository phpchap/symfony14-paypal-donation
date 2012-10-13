<?php

class sendOrderEmailTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'project';
    $this->name             = 'send-order-email';
    $this->briefDescription = 'process todays CSV and send to the fulfilment and admin peeps';
    $this->detailedDescription = <<<EOF
The [sendOrderEmail|INFO] task does things.
Call it with:

  [php symfony sendOrderEmail|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // build the CSV
    if(is_writable("/mnt/paypal_shop".$options['env']."/data/csvexport/")) {
      $filename ="/mnt/paypal_shop".$options['env']."/data/csvexport/".time().".csv";    
    } else {
      $filename = "/tmp/".time().".csv";
    }

    $content = OrderTable::getExportCsvContent("processed", $filename);
   
    // create a context, and load the helper
    $context = sfContext::createInstance($this->configuration);
    $this->configuration->loadHelpers('Partial');

    $fulfilmentPeeps = SiteSettingTable::getSettingBySlug("fulfilment-email-addresses");    
    
    // more than one?
    if(stripos($fulfilmentPeeps,",")!==false) {
      $fulEmailExploredAr = explode(",", $fulfilmentPeeps);
      foreach($fulEmailExploredAr as $key => $explodedEmail) {
        $fulEmailAr[] = trim($explodedEmail);
      }
    } else {
      $fulEmailAr[] = $fulfilmentPeeps;
    }

    $adminPeeps = SiteSettingTable::getSettingBySlug("order-copy-email-addresses");    
    
    // more than one?
    if(stripos($adminPeeps,",")!==false) {
      $adminEmailExplodedAr = explode(",", $adminPeeps);
      foreach($adminEmailExplodedAr as $key => $explodedEmail) {
        $adminEmailAr[] = trim($explodedEmail); 
      }
    } else {
      $adminEmailAr[] = $adminPeeps;
    }
    
    $emailAr = array_merge($fulEmailAr, $adminEmailAr);
        
    if(count($emailAr)>0) {
      // create the message
      $message = $this->getMailer()->compose('csvexport@regaleggcups.com', $emailAr, 'Daily Regal CSV Orders')->attach(Swift_Attachment::fromPath($filename));

      // generate HTML part
      $context->getRequest()->setRequestFormat('html');
      $html  = "please find attached the orders for today";
      $message->setBody($html, 'text/html');

      // send the message
      $this->getMailer()->send($message);
    }  
  }
}
