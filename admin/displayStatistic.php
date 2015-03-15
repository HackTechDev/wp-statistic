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
    <table style="border=none;" cellspacing="0" cellpadding="0">
<?php
$tempYear = 0;
$tempMonth = 0;

$totalPostMonth = 0;

$countPost = 0;

$yearChange = 0;

$tdYearBackgroundColor = "#C0C0C0";
$tdYearPostBackgroundColor = "#D3D3D3";

foreach ( $rows as $row ){
    $line = "<tr>";
    list($day, $month, $year) = explode("/", $row->datePost);

    if( $year != $tempYear ) {

	if( $tdYearBackgroundColor == "#D3D3D3") {
	    $tdYearBackgroundColor = "#C0C0C0";
	} else {
	   $tdYearBackgroundColor = "#D3D3D3";
	}

        $line .= "<td style='width: 40px;background-color: $tdYearBackgroundColor'><a target='_blank' href='/statistique/?yearstat=$year'>$year</a></td>"; 
    } else {
        if( $month != $tempMonth ) {
            $line .= "<td style='width: 40px;background-color: $tdYearBackgroundColor'><a target='_blank' href='/statistique/?yearstat=$year'>$year</a></td>";
        } else {
            $line .= "<td style='width: 40px;background-color: $tdYearBackgroundColor'></td>";
        }
    }
    $tempYear = $year;

    if( $month != $tempMonth ) {
        $line .= "<td style='width: 40px'><a target='_blank' href='/statistique/?monthstat=$month&yearstat=$year'>$month</a></td>"; 
        $displaySubTotalMonth = true;
    } else {
        $line .= "<td style='width: 40px'></td>";
    }
    $tempMonth = $month;

    $line .= "<td style='width: 40px'><a target='_blank' href='/statistique/?daystat=$day&monthstat=$month&yearstat=$year'>$day</a></td><td>";
    $line .= "<b style='color:red;'>" . $row->nbPost . "</b>";
    $line .= "</td><td style='width: 40px'></td></tr>";

    $totalPostMonth += $row->nbPost . " " ;

    if( $displaySubTotalMonth == true ) {
        if ( $countPost != 0 ) {
            $totalPostMonth -= $row->nbPost;

	    $tdYearPostBackgroundColor = "#2F4F4F" ;
	
            echo "<td style='width: 40px;background-color: $tdYearPostBackgroundColor'> </td> 
		  <td style='width: 40px;background-color: $tdYearPostBackgroundColor'> </td> 
		  <td style='width: 40px;background-color: $tdYearPostBackgroundColor'> </td> 
		  <td style='width: 40px;background-color: $tdYearPostBackgroundColor'> </td> 
		  <td style='color: black;width: 40px;background-color: $tdYearPostBackgroundColor'>$totalPostMonth</td>";

            $totalPostMonth = $row->nbPost;
        }
        echo $line; // database row / Current row
        $displaySubTotalMonth = false;
    } else {
        echo $line;
    }

    $countPost++;
}
echo "<td style='width: 40px;background-color: $tdYearPostBackgroundColor'> </td> 
      <td style='width: 40px;background-color: $tdYearPostBackgroundColor'> </td> 
      <td style='width: 40px;background-color: $tdYearPostBackgroundColor'> </td> 
      <td style='width: 40px;background-color: $tdYearPostBackgroundColor'> </td> 
      <td style='color: black;background-color: $tdYearPostBackgroundColor'>$totalPostMonth</td>";

?>
</table>
</div>
<?php
}
?>
