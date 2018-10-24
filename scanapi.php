<?php
require ('restapi.php');
$check = true;

while ($check) {
  $input =$_POST['search'];

  for ($counter = 0; $counter < count($metadata); $counter++) {
    $symbol = $metadata[$counter]->{'symbol'};

    if ($input == $symbol) {
      $title = $metadata[$counter]->{'name'};
      $symbol = $metadata[$counter]->{'symbol'};
      $price_currency = $metadata[$counter]->{'price'}->{'currency'};
      $price_amount = $metadata[$counter]->{'price'}->{'amount'};
      $percent_change = $metadata[$counter]->{'percent_change'};
      $volume = $metadata[$counter]->{'volume'};

      $check = false;
      break;
    } else {
      continue;
    }
  }
  if ($counter == count($metadata)) {
    $check = false;
    // $title = 'NONE';
    echo "<script type='text/javascript'>alert('Sorry but the Stock that you searched is not supported here.')</script>";
    header("refresh:0;url=market.php");
  }
  
  
}
?>