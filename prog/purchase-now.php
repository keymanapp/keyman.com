<?php
  $promotion = 'InstantBuy';
  $productID = '12';
  $seatCount = '1';
  $link = 'http://testsite.tavultesoft.local/buy/addtocart.php?OnlineProductId='.$productID.'&SeatCount='.$seatCount.'&Promotion='.$promotion;
  header('Location: '.$link);
?>