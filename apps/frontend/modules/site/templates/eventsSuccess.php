<?php include_partial('header'); ?>
<div class="container">
  <?php include_partial('navigation'); ?>  
  <ul class="breadcrumb">
    <li><a href="<?php echo url_for("@home"); ?>">Home</a><span class="divider">/</span></li>
    <li class="active"><a href="">Events</a> <span class="divider">/</span></li>
  </ul>
  <div class="row">
    <div class="span6">
      <h2>Event One</h2>
      <ul class="thumbnails">
        <li class="span3">
          <a href="#" class="thumbnail">
            <img src="http://placehold.it/360x268" alt="">
          </a>
        </li>
        <li class="span3">
          <h3>Event One Name</h3>
          <p>Event Details</p>
          <p><a href="#" target="_blank">link to facebook event one page</a></p>
        </li>
      </ul>
    </div>
    <div class="span6">
      <h2>Event Two</h2>
      <ul class="thumbnails">
        <li class="span3">
          <a href="#" class="thumbnail">
            <img src="http://placehold.it/360x268" alt="">
          </a>
        </li>
        <li class="span3">
          <h3>Event Name</h3>
          <p>Event Details</p>
          <p><a href="#" target="_blank">link to facebook event one page</a></p>
        </li>
      </ul>
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