<?php

require_once dirname(__FILE__).'/../lib/orderGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/orderGeneratorHelper.class.php';

/**
 * order actions.
 *
 * @package    paypal_shop
 * @subpackage order
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orderActions extends autoOrderActions
{  
  private $csvfilname = "";
  
  public function executeExport(sfWebRequest $request)
  {
    // output the CSV forcing the browser to download the file
    $filename = sfConfig::get('sf_data_dir').sfConfig::get('app_csv_export_path').time().".csv";
    $content = OrderTable::getExportCsvContent("all", $filename);
    
    $this->getResponse()->setContentType('application/octet-stream');
    $this->getResponse()->setHttpHeader('Content-Length', strlen($content));
    $this->getResponse()->setHttpHeader('Content-Disposition', sprintf('attachment; filename="orders-%s.csv"', date('Y-m-d-H-i-s')));
    return $this->renderText($content);
  }
  
  public function getOrderExportFields()
  {
    $fields[] = 'processed';
    $fields[] = 'orderhash';
    $fields[] = 'email';
    $fields[] = 'payerid';
    $fields[] = 'payerstatus';
    $fields[] = 'firstname';
    $fields[] = 'lastname';
    $fields[] = 'countrycode';
    $fields[] = 'shiptoname';
    $fields[] = 'shiptostreet';
    $fields[] = 'shiptocity'; 
    $fields[] = 'shiptostate';
    $fields[] = 'shiptozip';
    $fields[] = 'shiptocountrycode';
    $fields[] = 'shiptocountryname'; 
    $fields[] = 'sellernote'; 
    $fields[] = 'addressstatus'; 
    $fields[] = 'quantity';  
    $fields[] = 'shipping';
    $fields[] = 'eggprice'; 
    $fields[] = 'total'; 
    $fields[] = 'status'; 
    $fields[] = 'created_at';
    $fields[] = 'updated_at';
    
    return $fields;
  }
  
  
  public function getFileName() 
  {
    
  }
  
  /**
   * Converts an array to CSV text
   *
   * @param array The data
   *
   * @return string the CSV formatted text
   */
  protected function getCsvText($data)
  {
    // $filename = tempnam(sys_get_temp_dir(), 'tf');
    if($this->csvfilname=="") {
      $this->filename = sfConfig::get('sf_data_dir').sfConfig::get('app_csv_export_path').time().".csv";
    }

    $fh = fopen($this->filename, 'w');

    foreach($data as $line)
    {
      fputcsv($fh, $line);
    }

    fclose($fh);
    $csv = file_get_contents($this->filename);
    
    //unlink($filename);
    return $csv;
  }

  /**
   * 
   * @param array $data
   * @param array $fields
   * @return array 
   */
  public function getDataRow($data, $fields)
  {
    if(count($fields)>0) {
      foreach($fields as $field) {
        $rowData[] = $data->$field;        
      }
      return $rowData;      
    } else {
      return false;
    }
  }
  
   /**
   * Generates a CSV export for the selected fields.
   *
   * The form needs to be validated in order to produce any content.
   *
   * @param OrderExportForm $form The form
   *
   * @return string The content of the CSV export
   */
  protected function getExportCsvContent()
  {
    $retval = '';
    $data   = array();
    $labels = array();

    $orders = $this->getExportOrders();
    if($orders != false) {
      
      $fields = $this->getOrderExportFields();
      
      $csvData[] = $fields;
      
      foreach($orders as $order) {
        // get the csv list
        $csvData[] = $this->getDataRow($order, $fields);
        // update the order to be processed..
        $order->processed="yes";
        $order->save();
      }
      
      $retval = $this->getCsvText($csvData);
      return $retval;
      
    } else {
      die('there are no orders to export with processed="no"');
    }
  }

  /**
   * Returns the orders for the export.
   *
   * @param OrderExportForm $form The order export form
   *
   * @return Doctrine_Collection
   */
  protected function getExportOrders($form = null)
  {
    $orders = OrderTable::getAllUnprocessedOrders();
    if(count($orders)>0) {
      return $orders;
    } else {
      return false;
    }
  } 
}
