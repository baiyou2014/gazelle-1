<?php

View::show_header('Login');
?>

<p style="text-align: center;">
  A platform to share <strong>biological sequence</strong><br />
  and <strong>medical imaging</strong> data<?=($Attempts > 0) ? '' : '<sup>1</sup>'?>
</p>

<p id="no-cookies" class="hidden warning">You appear to have cookies disabled.</p>

<?php
if (!$Banned) { ?>

<form class="auth_form" name="login" id="loginform" method="post" action="login.php">

  <?php
  if (isset($Err)) { ?>

  <p class="warning">
    <?=$Err?>
  </p>

  <?php
  } ?>

  <?php
  if ($Attempts > 0) { ?>

  <div class="notice">
    <p>
      You have
      <span class="info"><?=(6 - $Attempts)?></span>
      attempts remaining.
    </p>

    <p>
      <strong>You'll be banned for 6 hours after your login attempts run out!</strong>
    </p>
  </div>

  <?php } ?>

  <table class="layout" width="250px">
    <tr>
      <td colspan="2">
        <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" name="username"
          id="username" class="inputtext" required="required" maxlength="20" pattern="[A-Za-z0-9_?]{1,20}"
          autofocus="autofocus" placeholder="Username" size="40" autocomplete="username" />
      </td>
    </tr>

    <tr>
      <td>
        <input type="password" minlength="15" name="password" id="password" class="inputtext" required="required"
          maxlength="307200" pattern=".{15,307200}" placeholder="Password" autocomplete="current-password" />
      </td>
      <td>
        <input type="text" name="twofa" id="twofa" class="inputtext" maxlength="6" pattern="[0-9]{6}"
          inputmode="numeric" placeholder="2FA" size="6" title="Leave blank if you have not enabled 2FA"
          autocomplete="one-time-code" />
      </td>
    </tr>

    <tr>
      <td colspan="2">
        <input type="submit" name="login" value="Log In" class="submit" />
      </td>
    </tr>
  </table>
</form>

<?php
} else { ?>
<p class="warning">You are banned from logging in for a few hours.</p>
<?php
  }

if ($Attempts > 0) { ?>

<p>
  Forgot your password?
  <a href="login.php?act=recover" class="tooltip" title="Recover your password">Reset it here!</a>
</p>

<?php
} else {
    print_r('
      <p>
        1.
        &hellip;and
        graphs,
        scalars,
        vectors,
        patterns,
        constraints,
        models,
        and more.
    ');

    /*
    print_r('
      <p>
        1.
        &hellip;and
        <strong>graphs</strong> and
        <strong>scalars</strong> and
        <strong>vectors</strong>
        <br /> and
        <strong>patterns</strong> and
        <strong>constraints</strong> and
        <strong>models</strong>
        <br /> and
        much more.
      ');
      */
}

View::show_footer();
