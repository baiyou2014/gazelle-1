<?php

enforce_login();

// Include the header
if (!$UserCount = $Cache->get_value('stats_user_count')) {
    $DB->query("
      SELECT COUNT(ID)
      FROM users_main
      WHERE Enabled = '1'");
    list($UserCount) = $DB->next_record();
    $Cache->cache_value('stats_user_count', $UserCount, 0); // Infinite cache
}

$DonorPerms = Permissions::get_permissions(DONOR);
View::show_header('Donate');
?>

<div class="thin">
  <span class="donation_info_title">
    <?= SITE_NAME ?> budget breakdown
  </span>

  <div class="box pad donation_info">
    <p>
      <?= SITE_NAME ?> has no advertisements, is not sponsored, and
      provides its services free of charge.
      For these reasons, its main income source is voluntary user donations.
      Supporting <?= SITE_NAME ?> is and will always remain
      voluntary.
      If you're financially able, please help pay its bills by donating.
      We use the donations to cover the costs of running the site, tracker, and IRC network.
    </p>

    <p>
      No staff member or other individual responsible for the site's operation personally profits from user donations.
      As a donor, your financial support is exclusively applied to operating costs.
      By donating to <?= SITE_NAME ?>, you're helping to defray the
      recurring costs of necessary information services.
    </p>

    <p>
      <?= SITE_NAME ?> currently operates on a shoestring budget.
      The costs of running the site, and all its technical and legal infrastructure, are minimal by design.
      Keeping costs in a range that I can pay out of pocket helps ensure the site doesn't depend on donations to exist.
      Please find a detailed site budget below.
    </p>

    <ul>
      <li>
        <strong>Tracker Server.</strong>
        We currently use one budget VPS at 2.50€ per month, and can add more at the same price as needed.
      </li>

      <li>
        <strong>Seedbox Server.</strong>
        A dedicated seedbox from <a href="https://pulsedmedia.com/clients/aff.php?aff=1275" target="_blank">Pulsed Media
          (affiliate link)</a> costs 75€ per year.
        Please see the <a href="/user.php?id=28">seedbox user account stats</a>.
      </li>

      <li>
        <strong>Domain Name.</strong>
        The site domain name costs $15 per year. The SSL certificate is gratis.
      </li>

      <li>
        <strong>Parent Company.</strong>
        <a href="https://wyobiz.wyo.gov/Business/FilingDetails.aspx?eFNum=002156042142181219185041207069159249164249226198"
          target="_blank">Omics Tools LLC</a>
        is <?=SITE_NAME?>'s parent company.
        It costs $100 per year in filing fees plus $125 per year for resident agent services.
        The resident agent may cost $50 in subsequent years but I wanted to do it right the first time.
      </li>
    </ul>
  </div>

  <span class="donation_info_title">
    How to donate to <?= SITE_NAME ?>
  </span>

  <div class="box pad donation_info">
    <p>
      <?= SITE_NAME ?> accepts donations on a tactful array of
      platforms.
      We also accept <strong>tax-deductible donations</strong> on behalf of the
      <a href="https://www.boslab.org/donate" target="_blank">Boston Open Science Laboratory (BosLab)</a>,
      a registered 501c3.
      Please use the memo field on BosLab's PayPal form to credit your <?= SITE_NAME ?> account.
      <strong>From: your username on <?= SITE_NAME ?>'s behalf, CC:
        ohm at biotorrents dot de.</strong>
    </p>

    <p>
      Unlike affiliate donations to BosLab, where the funds are beyond my control, direct donations are used exclusively
      for <?= SITE_NAME ?>'s operating costs.
      Please see <a href="https://www.patreon.com/biotorrents" target="_blank"><?= SITE_NAME ?>'s Patreon</a> for a detailed overview of funding
      goals.
      There are some benefits to donating that culmulate with each tier pledged.
      Each tier's awards include those already listed.
    </p>

    <p style="margin: 2em 0;">
      <a href="https://www.patreon.com/bePatron?u=27142321" data-patreon-widget-type="become-patron-button">Become a
        Patron!</a>
      <script async src="https://c6.patreon.com/becomePatronButton.bundle.js"></script>
    </p>

    <ul>
      <li><strong>Bronze.</strong> A donor badge and forum access for your user account on the BioTorrents.de website
      </li>
      <li><strong>Silver.</strong> Unlimited API calls to the BioTorrents.de database</li>
      <li><strong>Gold.</strong> Monthly Skype calls to discuss wetlab and software ideas.
        My expertise includes fungal biotechnology, nonprofit administration, and LEMP+ development</li>
      <!--
        <li><strong>Sponsor a Seedbox.</strong> Shell access to, and share ratio credit from, a seedbox that I manage on your behalf.
          Please understand that network services beyond the scope of seedbox administration should be negotiated separately</li>
        -->
    </ul>

    <p>
      I also accept private donations of cash and cash equivalents, including <strong>Bitcoin</strong> and other
      cryptocurrencies.
      Besides gift transactions sent to my personal <strong>PayPal</strong> account, I'll also accept <strong>USPS money
        orders</strong> in the mail.
      I can generate unique cryptocurrency addresses for donations in Bitcoin, Litecoin, Curecoin, and Namecoin.
      Please use <a href="https://pgp.mit.edu/pks/lookup?op=get&search=0x760EBED7CFE266D7" target="_blank">GPG key
        760EBED7CFE266D7</a> if you desire.
    </p>
  </div>

  <span class="donation_info_title">
    Donate time and expertise instead
  </span>

  <div class="box pad donation_info">
    <p>
      <?=SITE_NAME?> understands that not everyone who wants to help
      may feel comfortable donating.
      Please consider getting involved with development and the <?=SITE_NAME?> community instead.
      Note that Donor Points are only awarded for monetary transactions and not volunteer work.
      There are many ways to provide alternative support, use your imagination!
    </p>

    <ul>
      <li>
        Contributing issues and pull requests to the
        <a href="https://git.oppaiti.me/biotorrents/Gazelle" target="_blank">Git repo</a>
      </li>

      <li>
        Following and retweeting the
        <a href="https://twitter.com/biotorrents" target="_blank">Twitter account</a>
      </li>

      <li>
        Using the Twitter hashtag
        <a href="https://twitter.com/hashtag/P2Pbio" target="_blank">#P2Pbio</a>
      </li>

      <li>Citing <?=SITE_NAME?> in your research
        <br /><br />
        <pre>
@misc{ biotorrents,
  author = {Omics Tools LLC},
  title  = {Serving P2P biology data on Debian 9 with BitTorrent},
  year   = {2020},
  url    = \href{https://pjc.is/biotorrents/announcement}{biotorrents/announcement},
  note   = {Online; accessed <?=date('Y-m-d')?>},
}
        </pre>
      </li>

      <li>
        Making artwork, icons, and media to advertise the site and replace the emoji
      </li>

      <li>
        Asking friends in academic, industry, and the media to consider the project
      </li>
    </ul>
  </div>

  <span class="donation_info_title">
    What donating means for your account
  </span>

  <div class="box pad donation_info">
    <p>
      Please remember that when you make a donation, you aren't "purchasing" Donor Ranks, invites, or any <?= SITE_NAME ?>-specific benefit.
      When donating, you're helping <?= SITE_NAME ?> pay its bills,
      and your donation should be made in this spirit.
      The <?= SITE_NAME ?> staff does its best to recognize our
      financial supporters in a fair and fun way,
      but all donor perks are subject to change or cancellation at any time, without notice.
    </p>

    <p>
      Any donation or contribution option listed above gives you the opportunity to receive Donor Points.
      Donor Points are awarded at a rate of one point per transaction, regardless of the amount.
      After acquiring your first Donor Point, your account will unlock Donor Rank #1.
      This rank will last forever, and you'll receive the below perks when you unlock it.
    </p>

    <ul>
      <li>Our eternal love, as represented by the heart you get next to your name</li>
      <li><a href="/wiki.php?action=article&amp;id=8">Inactivity</a> timer immunity</li>
      <li>Access to the <a href="/user.php?action=notify">notifications system</a></li>
      <li>Two <a href="/user.php?action=invite">invites</a></li>
      <li><a href="/collages.php">Collage</a> creation privileges</li>
      <li>Personal collage creation privileges</li>
      <li>One additional personal collage</li>
      <li>A warm, fuzzy feeling</li>
    </ul>

    <p>What you won't receive for donating:</p>

    <ul>
      <li>Immunity from the rules</li>
      <li>Additional upload credit</li>
    </ul>
  </div>

</div>
<!-- END Donate -->
<?php View::show_footer();
