    <?php if(count($donations) > 0) { ?>
      <table class="table table-bordered table-striped">        
        <thead>
          <tr>
            <th>Name</th>
            <th>Message</th>
            <th>Amount</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($donations as $donation) { ?>
          <tr>
            <td>
              <?php if($donation->anonymous != 1) { ?>
                <?php echo $donation->firstname;?> <?php echo $donation->lastname;?>
              <?php } else { ?>
                Anonymous
              <?php } ?>
            </td>
            <td><?php echo $donation->donationmessage;?></td>
            <td>&euro;<?php echo $donation->total;?></td>
            <td><?php echo $donation->created_at;?></td>            
          </tr>
        <?php } ?>
        </tbody>
      </table>
    <?php } else { ?>
      <p>No Donations yet, be the first to donate!</p>
    <?php } ?>