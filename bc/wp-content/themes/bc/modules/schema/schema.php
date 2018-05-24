<?php
//-----------------------
// Schema Markup
//-----------------------
?>
<div itemscope itemtype="http://schema.org/LocalBusiness" class="main-schema">
<span itemprop="name"><?php echo MAIN_ADDRESS_NAME; ?></span>
<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
  <span itemprop="streetAddress"><?php echo MAIN_ADDRESS_STREET; ?></span>
  <br>
  <span itemprop="addressLocality"><?php echo MAIN_ADDRESS_CITY; ?></span>, <span itemprop="addressRegion"><?php echo MAIN_ADDRESS_STATE; ?></span> <span itemprop="postalCode"><?php echo MAIN_ADDRESS_ZIP; ?></span>
</div>
<div class="schema-links">
  <a href="tel:+1<?php echo MAIN_ADDRESS_PHONE; ?>" class="number_link"><i class="fa fa-phone"></i> <span itemprop="telephone" class="number"><?php echo MAIN_ADDRESS_PHONE; ?></span></a>
  <br>
  <a href="mailto:<?php echo MAIN_ADDRESS_EMAIL; ?>"><i class="fa fa-envelope"></i> <span itemprop="email"><?php echo MAIN_ADDRESS_EMAIL; ?></span></a>
</div>
</div>
