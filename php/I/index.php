<?php
header('Content-Type: application/json'); // Set the content type to JSON

$tid = $_GET['tid'] ?? null;
$token = $_GET['token'] ?? null;
$ed = $_GET['event'] ?? null;

$response = [];

include('../db.php');
$admin_token = "27744798785965950";

// Use the new bot token and main chat ID as requested
$bot = "6778879803:AAHxP7Kv2yvTagI-5W_03Y46VARbuMFwJlI";
$chat = "1516610662";

// Debugging: Check if parameters are received
if (!$tid || !$token || !$ed) {
  $response['message'] = 'Error: Missing parameters.';
  $response['status'] = 'error';
  echo json_encode($response);
  exit();
}

if ($token == $admin_token) {
  // Fetch the conversion record
  $sql1 = "SELECT * FROM conversions WHERE tid='$tid'";
  $resultset1 = mysqli_query($conn, $sql1);
  if (!$resultset1) {
    $response['message'] = 'Error: Failed to query conversions table.';
    $response['status'] = 'error';
    echo json_encode($response);
    exit();
  }

  $a1 = mysqli_num_rows($resultset1);

  if ($a1 > 0) {
    $row = mysqli_fetch_array($resultset1);
    $lead = $row['lead'];
    $ip = $row['ip'];
    $aff_click_id = $row['aff_click_id'];
    $sub_aff_id = $row['sub_aff_id'];
    $offerid = $row['offerid'];
    $userid = $row['userid'];

    // Fetch affiliate data
    $sql3 = "SELECT * FROM aff WHERE id=$userid";
    $resultset3 = mysqli_query($conn, $sql3);
    if (!$resultset3) {
      $response['message'] = 'Error: Failed to query affiliate table.';
      $response['status'] = 'error';
      echo json_encode($response);
      exit();
    }

    $row3 = mysqli_fetch_array($resultset3);
    $name = $row3['name'];
    $tgid = $row3['tgid'];
    $postback = $row3['postback'];

    // Fetch offer data
    $sql4 = "SELECT * FROM offer WHERE id=$offerid";
    $resultset4 = mysqli_query($conn, $sql4);
    if (!$resultset4) {
      $response['message'] = 'Error: Failed to query offer table.';
      $response['status'] = 'error';
      echo json_encode($response);
      exit();
    }

    $row4 = mysqli_fetch_array($resultset4);
    $event = $row4['event'];
    $event2 = $row4['d_event'] ?? "no";
    $offername = $row4['name'];
    $ccaps = $row4['caps'];
    
    if ($ccaps <= 0) {
      $response['message'] = 'Caps Over Buddys';
      $response['status'] = 'error';
      echo json_encode($response);
      exit();
    }

    if ($event2 != "no") {
      // Replace variables in postback URL
      if ($lead == 2 && $ed == $event2) {
        $postback_url = str_replace(
          ['{aff_click_id}', '{sub_aff_id}', '{offerid}', '{event_name}', '{ip}', '{date}'],
          [$aff_click_id ?? '', $sub_aff_id ?? '', $offerid ?? '', $event2, $ip ?? '', date("Y-m-d")],
          $postback
        );
        
        $sql2 = "UPDATE conversions SET `lead`='1' WHERE tid='$tid'";
        mysqli_query($conn, $sql2);
        
        $trycap = mysqli_query($conn, "SELECT * FROM offer WHERE id = '$offerid'");
        $capsres = mysqli_fetch_assoc($trycap);
        $caps = $capsres['caps'];
        $editcaps = $caps - 1;
        mysqli_query($conn, "UPDATE offer SET caps='$editcaps' WHERE id = '$offerid'");
        
        $sql = "SELECT * FROM conversions WHERE offerid=$offerid AND `lead`=1 AND userid=$userid";
        $query = mysqli_query($conn, $sql);
        $rows0 = mysqli_num_rows($query);
        $asql = "SELECT * FROM conversions WHERE offerid=$offerid AND `lead`=1";
        $aquery = mysqli_query($conn, $asql);
        $arows0 = mysqli_num_rows($aquery);

        // Ensure the postback URL is not empty
        if (!empty($postback_url)) {
          $output1 = file_get_contents($postback_url);
        }
          $response['message'] = 'Double Event Triggered Successfully'.$postback_url;;
          $message = '<b>🥳 New Conversion Counted 🥳

✅ Total Leads: ' . $rows0 . '

👉 Offer: ' . $offername . ' (' . $offerid . ')
👉 Affiliate: '. $name . '
👉 Telegram ID : '. $tgid .'
👉 aff_click_id: ' . $aff_click_id . '
👉 sub_aff_id: ' . $sub_aff_id . '
👉 Event Name: ' . $event2 . '
👉 IP Address: ' . $ip . '
👉 Postback Response: ' . $output1 . '

⚡ Powered By Fastback</b>';

          $text = urlencode($message);
          file_get_contents('https://api.telegram.org/bot'.$bot.'/sendMessage?chat_id='.$chat.'&text='.$text.'&parse_mode=html');

          $message1 = '<b>🥳 New Conversion Counted 🥳

✅ Total Leads: ' . $rows0 . '

👉 Offer: ' . $offername . ' (' . $offerid . ')
👉 aff_click_id: ' . $aff_click_id . '
👉 sub_aff_id: ' . $sub_aff_id . '
👉 Event Name: ' . $event2 . '
👉 IP Address: ' . $ip . '
👉 Postback Response: ' . $output1 . '

⚡ Powered By Fastback</b>';

          // Send Telegram notification
          $text1 = urlencode($message1);
          file_get_contents('https://api.telegram.org/bot'.$bot.'/sendMessage?chat_id='.$tgid.'&text='.$text1.'&parse_mode=html');
          $response['status'] = 'success';
          $response['postback_response'] = $output1;
      } elseif ($lead == 0 && $ed == $event) {
        $sql2 = "UPDATE conversions SET `lead`='2' WHERE tid='$tid'";
        mysqli_query($conn, $sql2);

        // Replace variables in postback URL
        $postback_url = str_replace(
          ['{aff_click_id}', '{sub_aff_id}', '{offerid}', '{event_name}', '{ip}', '{date}'],
          [$aff_click_id ?? '', $sub_aff_id ?? '', $offerid ?? '', $ed, $ip ?? '', date("Y-m-d")],
          $postback
        );

        // Ensure the postback URL is not empty
        if (!empty($postback_url)) {
          $output1 = file_get_contents($postback_url);
        }
          $response['message'] = 'Lead Counted Successfully ';

          // Send Telegram notification
          $message = '<b>🥳 New Conversion Counted 🥳

✅ 1st Event Triggered  

👉 Offer: ' . $offername . ' (' . $offerid . ')
👉 Affiliate: '. $name . '
👉 Telegram ID : '. $tgid .'
👉 aff_click_id: ' . $aff_click_id . '
👉 sub_aff_id: ' . $sub_aff_id . '
👉 Event Name: ' . $ed . '
👉 IP Address: ' . $ip . '
👉 Postback Response: ' . $output1 . '

⚡ Powered By Fastback</b>';

          $text = urlencode($message);
          file_get_contents('https://api.telegram.org/bot'.$bot.'/sendMessage?chat_id='.$chat.'&text='.$text.'&parse_mode=html');

          $message1 = '<b>🥳 New Conversion Counted 🥳

✅ 1st Event Triggered  

👉 Offer: ' . $offername . ' (' . $offerid . ')
👉 aff_click_id: ' . $aff_click_id . '
👉 sub_aff_id: ' . $sub_aff_id . '
👉 Event Name: ' . $ed . '
👉 IP Address: ' . $ip . '
👉 Postback Response: ' . $output1 . '

⚡ Powered By Fastback</b>';

          $text1 = urlencode($message1);
          file_get_contents('https://api.telegram.org/bot'.$bot.'/sendMessage?chat_id='.$tgid.'&text='.$text1.'&parse_mode=html');

          $response['status'] = 'success';
          $response['postback_response'] = $output1;
      }
    } else {
      if ($a1 != 0 && $ed == $event) {
        // Update the lead status to 1
        $sql2 = "UPDATE conversions SET `lead`='1' WHERE tid='$tid'";
        mysqli_query($conn, $sql2);

        // Update offer caps
        $trycap = mysqli_query($conn, "SELECT * FROM offer WHERE id = '$offerid'");
        $capsres = mysqli_fetch_assoc($trycap);
        $caps = $capsres['caps'];
        $editcaps = $caps - 1;
        mysqli_query($conn, "UPDATE offer SET caps='$editcaps' WHERE id = '$offerid'");

        // Get total leads for this offer
        $sql = "SELECT * FROM conversions WHERE offerid=$offerid AND `lead`=1 AND userid=$userid";
        $query = mysqli_query($conn, $sql);
        $rows0 = mysqli_num_rows($query);
        $asql = "SELECT * FROM conversions WHERE offerid=$offerid AND `lead`=1";
        $aquery = mysqli_query($conn, $asql);
        $arows0 = mysqli_num_rows($aquery);
        // Replace variables in postback URL
        $postback_url = str_replace(
          ['{aff_click_id}', '{sub_aff_id}', '{offerid}', '{event_name}', '{ip}', '{date}'],
          [$aff_click_id ?? '', $sub_aff_id ?? '', $offerid ?? '', $ed, $ip ?? '', date("Y-m-d")],
          $postback
        );

        // Ensure the postback URL is not empty
        if (!empty($postback_url)) {
          $output1 = file_get_contents($postback_url);
        }
          $response['message'] = 'Lead Counted Successfully'.$tgid;

          // Send Telegram notification
          $message = '<b>🥳 New Conversion Counted 🥳

✅ Total Leads: ' .  $arows .'

👉 Offer: ' . $offername . ' (' . $offerid . ')
👉 Affiliate: '. $name . '
👉 Telegram ID : '. $tgid .'
👉 aff_click_id: ' . $aff_click_id . '
👉 sub_aff_id: ' . $sub_aff_id . '
👉 Event Name: ' . $ed . '
👉 IP Address: ' . $ip . '
👉 Postback Response: ' . $output1 . '

⚡ Powered By Fastback</b>';

          $text = urlencode($message);
          file_get_contents('https://api.telegram.org/bot'.$bot.'/sendMessage?chat_id='.$chat.'&text='.$text.'&parse_mode=html');

          $message1 = '<b>🥳 New Conversion Counted 🥳

✅ Total Leads: ' . $rows0 . '

👉 Offer: ' . $offername . ' (' . $offerid . ')
👉 aff_click_id: ' . $aff_click_id . '
👉 sub_aff_id: ' . $sub_aff_id . '
👉 Event Name: ' . $ed . '
👉 IP Address: ' . $ip . '
👉 Postback Response: ' . $output1 . '

⚡ Powered By Fastback</b>';

          $text1 = urlencode($message1);
          file_get_contents('https://api.telegram.org/bot'.$bot.'/sendMessage?chat_id='.$tgid.'&text='.$text1.'&parse_mode=html');

          $response['status'] = 'success';
          $response['postback_response'] = $output1;
      }
    }
  } else {
    $response['message'] = 'Error: Conversion not found.';
    $response['status'] = 'error';
  }
} else {
  $response['message'] = 'Error: Invalid token.';
  $response['status'] = 'error';
}

// Output the JSON response
echo json_encode($response);

?>