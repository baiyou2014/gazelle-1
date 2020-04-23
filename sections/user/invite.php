<?php
if (isset($_GET['userid']) && check_perms('users_view_invites')) {
    if (!is_number($_GET['userid'])) {
        error(403);
    }

    $UserID=$_GET['userid'];
    $Sneaky = true;
} else {
    if (!$UserCount = $Cache->get_value('stats_user_count')) {
        $DB->query("
      SELECT COUNT(ID)
      FROM users_main
      WHERE Enabled = '1'");
        list($UserCount) = $DB->next_record();
        $Cache->cache_value('stats_user_count', $UserCount, 0);
    }

    $UserID = $LoggedUser['ID'];
    $Sneaky = false;
}

list($UserID, $Username, $PermissionID) = array_values(Users::user_info($UserID));

$DB->query("
  SELECT InviteKey, Email, Expires
  FROM invites
  WHERE InviterID = '$UserID'
  ORDER BY Expires");
$Pending = $DB->to_array();

$OrderWays = array('username', 'email', 'joined', 'lastseen', 'uploaded', 'downloaded', 'ratio');

if (empty($_GET['order'])) {
    $CurrentOrder = 'id';
    $CurrentSort = 'desc';
    $NewSort = 'asc';
} else {
    if (in_array($_GET['order'], $OrderWays)) {
        $CurrentOrder = $_GET['order'];
        if ($_GET['sort'] === 'asc' || $_GET['sort'] === 'desc') {
            $CurrentSort = $_GET['sort'];
            $NewSort = ($_GET['sort'] === 'asc' ? 'desc' : 'asc');
        } else {
            error(404);
        }
    } else {
        error(404);
    }
}

switch ($CurrentOrder) {
  case 'username':
    $OrderBy = "um.Username";
    break;
  case 'email':
    $OrderBy = "um.Email";
    break;
  case 'joined':
    $OrderBy = "ui.JoinDate";
    break;
  case 'lastseen':
    $OrderBy = "um.LastAccess";
    break;
  case 'uploaded':
    $OrderBy = "um.Uploaded";
    break;
  case 'downloaded':
    $OrderBy = "um.Downloaded";
    break;
  case 'ratio':
    $OrderBy = "(um.Uploaded / um.Downloaded)";
    break;
  default:
    $OrderBy = "um.ID";
    break;
}

$CurrentURL = Format::get_url(array('action', 'order', 'sort'));

$DB->query("
  SELECT
    ID,
    Email,
    Uploaded,
    Downloaded,
    JoinDate,
    LastAccess
  FROM users_main AS um
    LEFT JOIN users_info AS ui ON ui.UserID = um.ID
  WHERE ui.Inviter = '$UserID'
  ORDER BY $OrderBy $CurrentSort");

$Invited = $DB->to_array();

$JSIncludes = '';
if (check_perms('users_mod') || check_perms('admin_advanced_user_search')) {
    $JSIncludes = 'invites';
}

View::show_header('Invites', $JSIncludes);
?>
<div class="thin">
  <div class="header">
    <h2><?=Users::format_username($UserID, false, false, false)?>
      &gt; Invites</h2>
    <div class="linkbox">
      <a href="user.php?action=invitetree<?php if ($Sneaky) {
    echo '&amp;userid='.$UserID;
} ?>" class="brackets">Invite tree</a>
    </div>
  </div>
  <?php if ($UserCount >= USER_LIMIT && !check_perms('site_can_invite_always')) { ?>
  <div class="box pad notice">
    <p>Because the user limit has been reached you are unable to send invites at this time.</p>
  </div>
  <?php }

/*
  Users cannot send invites if they:
    - Are on ratio watch
    - Have disabled leeching
    - Have disabled invites
    - Have no invites (Unless have unlimited)
    - Cannot 'invite always' and the user limit is reached
*/

$DB->query("
  SELECT can_leech
  FROM users_main
  WHERE ID = $UserID");
list($CanLeech) = $DB->next_record();

if (!$Sneaky
  && !$LoggedUser['RatioWatch']
  && $CanLeech
  && empty($LoggedUser['DisableInvites'])
  && ($LoggedUser['Invites'] > 0 || check_perms('site_send_unlimited_invites'))
  && ($UserCount <= USER_LIMIT || USER_LIMIT === 0 || check_perms('site_can_invite_always'))
  ) { ?>
  <div class="box pad">
    <p>
    Do not trade or sell invites under any circumstances.
    Do not send an invite to anyone who has previously had a <?=SITE_NAME?> account.
    Please direct them to <code>#disabled</code> on Slack if they wish to reactivate their account.
    </p>

    <p>
    You may invite anyone so long as you and they both lack malicious intent, but keep in mind that you are responsible for anyone you invite.
    If you invite someone you don't know well and they surprise you by breaking the rules or being a generally poor user, you will likely end up punished for it.
    For that reason, we stongly recommend you only invite people you personally know and trust.
</p>

      <p><strong>Do not send an invite if you have not read or do not understand the information above.</strong></p>
  </div>
  <div class="box box2">
    <form class="send_form pad" name="invite" action="user.php" method="post">
      <input type="hidden" name="action" value="take_invite" />
      <input type="hidden" name="auth"
        value="<?=$LoggedUser['AuthKey']?>" />
      <div class="field_div">
        <div class="label"><strong>Email Address</strong></div>
        <div class="input">
          <input type="email" name="email" size="60" />
          <input type="submit" value="Invite" />
        </div>
      </div>
      <?php if (check_perms('users_invite_notes')) { ?>
      <div class="field_div">
        <div class="label"><strong>Staff Note</strong></div>
        <div class="input">
          <input type="text" name="reason" size="60" maxlength="255" />
        </div>
      </div>
      <?php } ?>
    </form>
  </div>

  <?php
} elseif (!empty($LoggedUser['DisableInvites'])) { ?>
  <div class="box pad" style="text-align: center;">
    <strong class="important_text">Your invites have been disabled. Please read <a
        href="wiki.php?action=article&amp;name=cantinvite">this article</a> for more information.</strong>
  </div>
  <?php
} elseif ($LoggedUser['RatioWatch'] || !$CanLeech) { ?>
  <div class="box pad" style="text-align: center;">
    <strong class="important_text">You may not send invites while on Ratio Watch or while your leeching privileges are
      disabled. Please read <a href="wiki.php?action=article&amp;name=cantinvite">this article</a> for more
      information.</strong>
  </div>
  <?php
}

if (!empty($Pending)) {
    ?>
  <h3>Pending Invites</h3>
  <div class="box">
    <table width="100%">
      <tr class="colhead">
        <td>Email Address</td>
        <td>Expires In</td>
        <td>Delete Invite</td>
      </tr>
      <?php
  foreach ($Pending as $Invite) {
      list($InviteKey, $Email, $Expires) = $Invite;
      $Email = apcu_exists('DBKEY') ? Crypto::decrypt($Email) : '[Encrypted]'; ?>
      <tr class="row">
        <td><?=display_str($Email)?>
        </td>
        <td><?=time_diff($Expires)?>
        </td>
        <td><a
            href="user.php?action=delete_invite&amp;invite=<?=$InviteKey?>&amp;auth=<?=$LoggedUser['AuthKey']?>"
            onclick="return confirm('Are you sure you want to delete this invite?');">Delete invite</a></td>
      </tr>
      <?php
  } ?>
    </table>
  </div>
  <?php
}
?>

  <h3>Invitee List</h3>
  <div class="box">
    <table width="100%" , class="invite_table">
      <tr class="colhead">
        <td><a
            href="user.php?action=invite&amp;order=username&amp;sort=<?=(($CurrentOrder == 'username') ? $NewSort : 'desc')?>&amp;<?=$CurrentURL ?>">Username</a>
        </td>
        <td><a
            href="user.php?action=invite&amp;order=email&amp;sort=<?=(($CurrentOrder == 'email') ? $NewSort : 'desc')?>&amp;<?=$CurrentURL ?>">Email</a>
        </td>
        <td><a
            href="user.php?action=invite&amp;order=joined&amp;sort=<?=(($CurrentOrder == 'joined') ? $NewSort : 'desc')?>&amp;<?=$CurrentURL ?>">Joined</a>
        </td>
        <td><a
            href="user.php?action=invite&amp;order=lastseen&amp;sort=<?=(($CurrentOrder == 'lastseen') ? $NewSort : 'desc')?>&amp;<?=$CurrentURL ?>">Last
            Seen</a></td>
        <td><a
            href="user.php?action=invite&amp;order=uploaded&amp;sort=<?=(($CurrentOrder == 'uploaded') ? $NewSort : 'desc')?>&amp;<?=$CurrentURL ?>">Uploaded</a>
        </td>
        <td><a
            href="user.php?action=invite&amp;order=downloaded&amp;sort=<?=(($CurrentOrder == 'downloaded') ? $NewSort : 'desc')?>&amp;<?=$CurrentURL ?>">Downloaded</a>
        </td>
        <td><a
            href="user.php?action=invite&amp;order=ratio&amp;sort=<?=(($CurrentOrder == 'ratio') ? $NewSort : 'desc')?>&amp;<?=$CurrentURL ?>">Ratio</a>
        </td>
      </tr>
      <?php
  foreach ($Invited as $User) {
      list($ID, $Email, $Uploaded, $Downloaded, $JoinDate, $LastAccess) = $User;
      $Email = apcu_exists('DBKEY') ? Crypto::decrypt($Email) : '[Encrypted]'
?>
      <tr class="row">
        <td><?=Users::format_username($ID, true, true, true, true)?>
        </td>
        <td><?=display_str($Email)?>
        </td>
        <td><?=time_diff($JoinDate, 1)?>
        </td>
        <td><?=time_diff($LastAccess, 1); ?>
        </td>
        <td><?=Format::get_size($Uploaded)?>
        </td>
        <td><?=Format::get_size($Downloaded)?>
        </td>
        <td><?=Format::get_ratio_html($Uploaded, $Downloaded)?>
        </td>
      </tr>
      <?php
  } ?>
    </table>
  </div>
</div>
<?php View::show_footer();
