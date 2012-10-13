<?php include_partial('header'); ?>
<div class="container">
  <?php include_partial('navigation'); ?>  
  <ul class="breadcrumb">
    <li><a href="<?php echo url_for("@home"); ?>">Home</a><span class="divider">/</span></li>
    <li class="active"><a href="">Where Donations Go</a> <span class="divider">/</span></li>
  </ul>
  <div class="row">
    <div class="span6">
      <h2>Pictures of Kev</h2>
      <ul class="thumbnails">
        <li class="span4">
          <a href="#" class="thumbnail">
            <img src="/images/kev_and_marc_368_268.jpg" alt="">
          </a>
        </li>
        <li class="span2">
          <a href="#" class="thumbnail">
            <img src="/images/kev1_160_120.jpg" alt="">
          </a>
        </li>
        <li class="span2">
          <a href="#" class="thumbnail">
            <img src="/images/kev2_160_120.jpg" alt="">
          </a>
        </li>
        <li class="span2">
          <a href="#" class="thumbnail">
            <img src="/images/kev3_160_120.jpg" alt="">
          </a>
        </li>
        <li class="span2">
          <a href="#" class="thumbnail">
            <img src="/images/kev_ju_becks.jpg" alt="Kev with cousins Justen and Becky">
          </a>
        </li>
        <li class="span2">
          <a href="#" class="thumbnail">
            <img src="/images/kev_ju_becks2.jpg" alt="">
          </a>
        </li>
      </ul>
    </div>
    <div class="span6">
      <h2>Where Donations Go</h2>
      <p>Kev's family has setup a special fund raising account with AIB, all of the paypal donations are linked to this account. If you use your debit card on Paypal they charge 3.4% for the transaction, however if you use your Paypal Balance there is no cost for the transaction. All of your donation amount will into this special fund raising account which will help Kev recover from his accident.</p>
      <h3>Online Donation</h3>
      <p>If you would like to make an online donation using PayPal, please click <a href="<?php echo url_for("@donate");?>">here</a></p>
      <h3>Direct Bank Transfer</h3>
      <p>Cash or cheques can be deposited in any AIB branch to the following account details:</p>
      <p>
        <ul>
          <li>Bank Account Name: <strong>Kevin Behans Fund Raising Account</strong></li>          
          <li>Bank Name: <strong>AIB</strong></li>
          <li>Bank Sort Code: <strong>93-35-62</strong>
          <li>Bank Account Number: <strong>28978007</strong></li>          
        </ul>
      </p>
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