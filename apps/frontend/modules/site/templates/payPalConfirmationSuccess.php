<?php include_partial('header'); ?>
<div class="container">
  <?php include_partial('navigation'); ?>  
  <ul class="breadcrumb">
    <li><a href="<?php echo url_for("@home"); ?>">Home</a><span class="divider">/</span></li>
    <li class="active"><a href="">Thanks</a> <span class="divider">/</span></li>
  </ul>
  <div class="row">
    <div class="span4">
      <h2>Thanks for your donation!</h2>
      <p>Your donation will help Kev with his recovery.. thank you!</p>
     </div>
    <div class="span8">
      <h2>Total Donations: &euro;<?php echo number_format($total_donations, 2);?></h2>      
      <?php include_partial('donations', array('donations' => $donations)); ?>
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
</div>
<?php include_partial('footer'); ?>