<?php

View::show_header('Connectability Checker');
?>
<div class="thin">
  <div class="header">
    <h2>
      <a
        href="user.php?id=<?=$LoggedUser['ID']?>"><?=$LoggedUser['Username']?></a>
      › Connectability Checker
    </h2>
  </div>

  <!-- <div class="linkbox"></div> -->
  <div class="box pad">
    This page has been disabled because the results have been inaccurate.
    Try a smarter and more reliable service like
    <a href="https://www.canyouseeme.org" target="_blank">CanYouSeeMe.org</a>.
  </div>
</div>
<?php
View::show_footer();
