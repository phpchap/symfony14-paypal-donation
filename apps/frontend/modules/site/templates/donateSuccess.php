<?php include_partial('header'); ?>
<div class="container">
  <?php include_partial('navigation'); ?>  
  <ul class="breadcrumb">
    <li><a href="<?php echo url_for("@home"); ?>">Home</a><span class="divider">/</span></li>
    <li class="active"><a href="">Donate</a> <span class="divider">/</span></li>
  </ul>
  <div class="row">
    <div class="span4">
      <h2>Donate to Help Kev Recover</h2>
      <form class="well" method="POST">
        <?php if(empty($error_ar['donation'])) { ?>
          <label>Donation Amount *</label>
          <span class="add-on">&euro;</span>
          <input class="span3" id="appendedPrependedInput" placeholder="Please enter donation amount…" size="5" type="text" name="donation">
          <span class="add-on">.00</span>        
          <span class="help-block">Please enter the donation in whole numbers (e.g. 50)</span>        
        <?php } else { ?> 
          <div class="control-group error">
            <label class="control-label" for="inputError">Donation Amount *</label>
            <div class="controls">
            <span class="add-on">&euro;</span>
            <input class="span3" id="inputError" placeholder="Please enter donation amount…" size="5" type="text" name="donation">
            <span class="add-on">.00</span>        
            <span class="help-inline"><?php echo $error_ar['donation'];?></span>
          </div>
          </div>
        <?php } ?>
        <div class="control-group">
          <label class="control-label" for="textarea">Add a Donation Message</label>
          <div class="controls">
            <textarea class="input-xlarge" name="donationMessage" id="textarea" rows="3"></textarea>
          </div>
        </div>
        <label class="checkbox">
          <input name="anonymous" type="checkbox">Make my donation anonymous
          <span class="help-block">Your name wont appear on the donation list</span>
        </label>  
        <button type="submit" class="btn-large btn-success">Donate via PayPal to Help Kev Recover</button>
      </form>
    </div>
    <div class="span8">
      <h2>Total Donations: &euro;<?php echo number_format($total_donations, 2);?></h2>      
      <?php include_partial('donations', array('donations' => $pager->getResults())); ?>
      <?php if ($pager->haveToPaginate()): ?>
        <div class="pagination">
          <a href="<?php echo url_for('@donate') ?>?page=1">
            first page
          </a>
          <?php foreach ($pager->getLinks() as $page): ?>
            <?php if ($page == $pager->getPage()): ?>
              <a href=""><?php echo $page ?></a>
            <?php else: ?>
              <a href="<?php echo url_for('@donate') ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
            <?php endif; ?>
          <?php endforeach; ?>
          <a href="<?php echo url_for('@donate') ?>?page=<?php echo $pager->getLastPage() ?>">
          last page
          </a>
        </div>
      <?php endif; ?>
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