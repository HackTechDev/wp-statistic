<?php
function displayStatistic() {
global $wpdb;
$rows = $wpdb->get_results("
    SELECT COUNT(*) AS nbPost, DATE_FORMAT(`post_date` , '%d/%m/%Y') AS datePost
    FROM wp_posts
    WHERE post_type = 'post'
    GROUP BY DATE(post_date)
                    ");

?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/css/style-admin.css" rel="stylesheet" />
<div class="wrap">
<h2>Statistic</h2>
<?php
foreach ($rows as $row ){
    echo $row->nbPost . " " . $row->datePost . "<br/>";
}
?>
</div>
<?php
}
?>
