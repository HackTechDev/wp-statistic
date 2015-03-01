<?php
function displayStatistic() {
global $wpdb;
$rows = $wpdb->get_results("
                    SELECT post_title, post_date 
                    FROM wp_posts
                    WHERE post_type = 'post'
                    ");

?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/css/style-admin.css" rel="stylesheet" />
<div class="wrap">
<h2>Statistic</h2>
<?php
foreach ($rows as $row ){
    echo $row->post_title . " " . $row->post_date . "<br/>";
}
?>
</div>
<?php
}
?>
