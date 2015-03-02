<?php
function displayStatistic() {
    global $wpdb;
    $rows = $wpdb->get_results("
        SELECT COUNT(*) AS nbPost, DATE_FORMAT(`post_date` , '%d/%m/%Y') AS datePost
        FROM wp_posts
        WHERE post_type = 'post' AND post_status = 'publish'
        GROUP BY DATE(post_date)
    ");

?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/css/style-admin.css" rel="stylesheet" />
<div class="wrap">
<h2>Post Statistic</h2>
    <table border="1">
<?php
$tempYear = 0;
$tempMonth = 0;

$totalPostMonth = 0;

$countPost = 0;

foreach ($rows as $row ){
    $line = "<tr>";
    list($day, $month, $year) = explode("/", $row->datePost);

    if( $year != $tempYear) {
        $line .= "<td>$year</td>"; 
    } else {
        $line .= "<td border=0></td>";
    }
    $tempYear = $year;

    if( $month != $tempMonth) {
        $line .= "<td>$month</td>"; 
        $displaySubTotalMonth = true;
    } else {
        $line .= "<td border=0></td>";
    }
    $tempMonth = $month;

    $line .= "<td>$day</td><td>";
    $line .= "<b style='color:red;'>" . $row->nbPost . "</b>";
    $line .= "</td><td></td></tr>";

    $totalPostMonth += $row->nbPost . " " ;

    if($displaySubTotalMonth == true) {
        if ($countPost != 0 ) {
            $totalPostMonth -= $row->nbPost;    
            echo "<td></td> <td></td> <td></td> <td></td> <td style='color:blue;'>$totalPostMonth</td>";
            $totalPostMonth = $row->nbPost;
        }
        echo $line;
        $displaySubTotalMonth = false;
    } else {
        echo $line;
    }

    $countPost++;
}
//$totalPostMonth = $row->nbPost;
echo "<td></td> <td></td> <td></td> <td></td> <td style='color:blue;'>$totalPostMonth</td>";
?>
</table>
</div>
<?php
}
?>
