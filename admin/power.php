<?php
// Load the language support
require_once('config/language.php');
// Load the Pi-Star Release file
$pistarReleaseConfig = '/etc/pistar-release';
$configPistarRelease = array();
$configPistarRelease = parse_ini_file($pistarReleaseConfig, true);
// Load the Version Info
require_once('config/version.php');

// Sanity Check that this file has been opened correctly
if ($_SERVER["PHP_SELF"] == "/admin/power.php") {
  // Sanity Check Passed.
  header('Cache-Control: no-cache');
  session_start();
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" lang="en">
  <head>
    <meta name="robots" content="index" />
    <meta name="robots" content="follow" />
    <meta name="language" content="English" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="Author" content="Andrew Taylor (MW0MWZ)" />
    <meta name="Description" content="Pi-Star Power" />
    <meta name="KeyWords" content="Pi-Star" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="pragma" content="no-cache" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <meta http-equiv="Expires" content="0" />
    <title>Pi-Star - <?php echo $lang['digital_voice']." ".$lang['dashboard']." - ".$lang['power'];?></title>
    <link rel="stylesheet" type="text/css" href="/css/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/pistar-css.php" />

    <style type="text/css">
    .logo{
    text-align: center;
	  font-size: 12px;
    }
    </style>

  </head>
  <body>
      <div class="container">

      <div class="logo">
      <a href="http://associacioader.com" target="_blank"><img src="images/Logo_Ader.png" width="130" alt=""/></a>


      <div class="header">
	  <div style="font-size: 12px; text-align: left; padding-left: 8px; float: left; color:#ff0;">Hostname: ADER</div><div style="font-size: 12px; text-align: right; padding-right: 12px;color:#ff0;">Versión:<?php echo $configPistarRelease['Pi-Star']['Version']?> / by EA7EE</div>
    <h1 style="color: #ff0;">REINICIAR / APAGAR</h1>
	      <p>
		  <div class="navbar">
		      <a class="menuconfig" href="/admin/configure.php"><?php echo $lang['configuration'];?></a>
		      <a class="menubackup" href="/admin/config_backup.php"><?php echo $lang['backup_restore'];?></a>
		      <a class="menuupdate" href="/admin/update.php"><?php echo $lang['update'];?></a>
		      <a class="menuadmin" href="/admin/"><?php echo $lang['admin'];?></a>
		      <a class="menudashboard" href="/"><?php echo $lang['dashboard'];?></a>
		  </div>
	      </p>
	  </div>
  <div class="contentwide">
<?php if (!empty($_POST)) { ?>
  <table width="100%">
  <tr><th colspan="2"><?php echo $lang['power'];?></th></tr>
  <?php
        if ( escapeshellcmd($_POST["action"]) == "reboot" ) {
                echo '<tr><td colspan="2" style="background: #000000; color: #00ff00;"><br /><br />El comando de reinicio ha sido enviado a su Pi,
                        <br />espere 50 segundos para que se reinicie.<br />
                        <br />Será redirigido de nuevo al
                        <br />Dashboard automáticamente en 50 segundos.<br /><br /><br />
                        <script language="JavaScript" type="text/javascript">
                                setTimeout("location.href = \'/index.php\'",50000);
                        </script>
                        </td></tr>';
                system('sudo mount -o remount,ro / > /dev/null &');
                exec('sleep 5 && sudo shutdown -r now > /dev/null &');
                };
        if ( escapeshellcmd($_POST["action"]) == "shutdown" ) {
                echo '<tr><td colspan="2" style="background: #000000; color: #00ff00;"><br /><br />Se ha enviado el comando de apagado a su Pi,
                        <br />  espere 30 segundos para que se apague por completo<br />antes de quitar la energía.<br /><br /><br /></td></tr>';
                system('sudo mount -o remount,ro / > /dev/null &');
                exec('sleep 5 && sudo shutdown -h now > /dev/null &');
                };
  ?>
  </table>
<?php } else { ?>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <table width="100%">
  <tr>
    <th colspan="2"><?php echo $lang['power'];?></th>
  </tr>
  <tr>
    <td align="center">
      Reiniciar Raspberry<br />
      <button style="border: none; background: none;" name="action" value="reboot"><img src="/images/reboot.png" border="0" alt="Reboot" /></button>
    </td>
    <td align="center">
      Apagar Raspberry<br />
      <button style="border: none; background: none;" name="action" value="shutdown"><img src="/images/shutdown.png" border="0" alt="Shutdown" /></button>
    </td>
  </tr>
  </table>
  </form>
<?php } ?>
  </div>
  <div class="footer">
  Pi-Star web config, &copy; Andy Taylor (MW0MWZ) 2014-<?php echo date("Y"); ?>.<br />
  Need help? Click <a style="color: #ffffff;" href="https://www.facebook.com/groups/pistarusergroup/" target="_new">here for the Support Group</a><br />
  or Click <a style="color: #ffffff;" href="https://forum.pistar.uk/" target="_new">here to join the Support Forum</a><br />
  <a style="color: #ff0;" href="http://www.associacioader.com" target="_new">Dashboard editado por EA3EIZ</a>
  </div>
  </div>
  </body>
  </html>
<?php
}
?>
