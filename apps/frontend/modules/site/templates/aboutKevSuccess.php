<?php include_partial('header'); ?>
<div class="container">
  <?php include_partial('navigation'); ?>  
  <ul class="breadcrumb">
    <li><a href="<?php echo url_for("@home"); ?>">Home</a><span class="divider">/</span></li>
    <li class="active"><a href="">About Kev</a> <span class="divider">/</span></li>
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
      <h2>About Kev</h2>
      <p>On Thursday June 7th, Kevin left Ireland along with his brother Marc, and a number of friends and headed for Poznan to watch Ireland play their first match in Euro 2012.</p>
      <p>They had a stop over in Amsterdam and in the early hours of Saturday morning Kevin unfortunately had an accident and fell into a canal in the Klovenirsburgwal area of the city. He was rushed to hospital where he remained in a very critical condition.</p>
      <p>Thankfully Kevin is making a fantastic recovery and continues to improve daily. Those fortunate enough to know Kevin understand that his love for his family and friends is evident in all that he does. His joy of life and light hearted personality draw people of all kinds to him.</p>
      <p>Many people have asked if they could donate money to help Kevin on his road to recovery, which may be both long and difficult at times.</p> 
      <p>Any and all donations are greatly appreciated. Please <a href="<?php echo url_for("@donate");?>">show your support</a> for an amazing person.</p>
      <h2>Kev in the news</h2>
      <p>Kev's <a href="
 http://www.leinsterleader.ie/news/local/clane-man-critical-after-canal-accident-1-3940943" target="_blank">canal accident</a> was featured on the Leinster Leader website</p>
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
