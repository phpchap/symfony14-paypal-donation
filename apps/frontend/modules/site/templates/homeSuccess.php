<?php include_partial('header'); ?>
<div class="container">
  <?php include_partial('navigation'); ?>  
  <div class="row">
    <div class="span3">
      <ul class="thumbnails">
        <li class="span3">
          <div class="thumbnail">
            <img src="/images/kev_and_marc_520_458.jpg" alt="pic of kev and marc">
            <h5>Kev and Marc in Amsterdam</h5>
          </div>
        </li>             
      </ul>      
    </div>    
    <div class="span3">
      <p>On Thursday June 7th, Kevin left Ireland along with his brother Marc, and a number of friends and headed for Poznan to watch Ireland play their first match in Euro 2012.</p>
      <p>They had a stop over in Amsterdam and in the early hours of Saturday morning Kevin unfortunately had an accident and fell into a canal in the Klovenirsburgwal area of the city. He was rushed to hospital where he remained in a very critical condition.</p>
      <p><a target="_blank" href="<?php echo url_for("@about_kev");?>">read more about Kev</a></p>
    </div>
    <div class="span6">
      <h2>Total Donations: &euro;<?php echo number_format($total_donations, 2);?></h2>      
      <?php include_partial('donations', array('donations' => $donations)); ?>
    <div class="clearfix">&nbsp;</div>
      <a class="btn-large btn-success" data-toggle="dropdown" href="<?php echo url_for("@donate"); ?>">Donate to Help Kev Recover</a>
    </div>
  </div>
  <div class="row">
    <div class="span6">      
      <div class="fb-comments" data-href="<?php echo sfConfig::get('app_facebook_page_url');?>" data-num-posts="2" data-width="570"></div>
    </div>
    <div class="span6">
       <div class="fb-like-box" data-href="<?php echo sfConfig::get('app_facebook_page_url');?>" data-width="570" data-show-faces="true" data-stream="false" data-header="true"></div>
    </div>
  </div>
<?php include_partial('footer'); ?>