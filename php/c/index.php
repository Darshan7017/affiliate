<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../db.php";

$offerid = isset($_GET['o']) ? (int)$_GET['o'] : 0;
$userid = isset($_GET['a']) ? mysqli_real_escape_string($conn, $_GET['a']) : '';
$aff_click_id = isset($_GET['aff_click_id']) ? mysqli_real_escape_string($conn, $_GET['aff_click_id']) : '';
$sub_aff_id = isset($_GET['sub_aff_id']) ? mysqli_real_escape_string($conn, $_GET['sub_aff_id']) : '';
$ip = $_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");  // Assuming `$date` is missing
include('../db.php');

// Fetch offer details
$sql2 = "SELECT * FROM offer WHERE id=?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $offerid);
$stmt2->execute();
$resultset2 = $stmt2->get_result();
$a = $resultset2->fetch_assoc();

// Fetch existing conversion records
$sql = "SELECT * FROM conversions WHERE offerid=? AND ip=? AND `lead`=1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $offerid, $ip);
$stmt->execute();
$resultset = $stmt->get_result();
$row = $resultset->num_rows;

$sql1 = "SELECT * FROM conversions WHERE offerid=? AND `lead`=1 AND aff_click_id=?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("is", $offerid, $aff_click_id);
$stmt1->execute();
$resultset1 = $stmt1->get_result();
$row1 = $resultset1->num_rows;

if ($row == 0 && $row1 == 0) {
    // Check if there are no existing conversions for the IP
    $sql3 = "SELECT * FROM conversions WHERE offerid=? AND ip=?";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bind_param("is", $offerid, $ip);
    $stmt3->execute();
    $resultset3 = $stmt3->get_result();
    $row3 = $resultset3->num_rows;

    if ($row3 == 0) {
        // Insert new conversion record
        $sql4 = "INSERT INTO conversions (tid, aff_click_id, sub_aff_id, ip, offerid, userid, `lead`, date) 
                VALUES (UUID(), ?, ?, ?, ?, ?, '0', ?)";
        $stmt4 = $conn->prepare($sql4);
        $stmt4->bind_param("ssssss", $aff_click_id, $sub_aff_id, $ip, $offerid, $userid, $date);
        $stmt4->execute();
    }

    // Fetch the inserted conversion record
    $sql5 = "SELECT * FROM conversions WHERE offerid=? AND ip=?";
    $stmt5 = $conn->prepare($sql5);
    $stmt5->bind_param("is", $offerid, $ip);
    $stmt5->execute();
    $resultset5 = $stmt5->get_result();
    $re = $resultset5->fetch_assoc();
    $tid = $re['tid'];

    // Fetch the redirect link from the offer
    $sql6 = "SELECT * FROM offer WHERE id=?";
    $stmt6 = $conn->prepare($sql6);
    $stmt6->bind_param("i", $offerid);
    $stmt6->execute();
    $resultset6 = $stmt6->get_result();
    $re6 = $resultset6->fetch_assoc();
    $link = $re6['link'];

    // Generate redirect link with the unique tid
    $redirect_link = str_replace('{tid}', $tid, $link);
    echo '<script>window.location="' . $redirect_link . '"</script>';
} else {
    echo "Already Completed";
}
?>