<?php
/*
Template Name: Statistic Page
*/
?>
 
<?php get_header(); ?>
<?php
$dayParam = get_query_var('daystat'); 
$monthParam = get_query_var('monthstat'); 
$yearParam = get_query_var('yearstat');

//echo "d=" . $dayParam . " m=" . $monthParam . " y=" . $yearParam;

?>
<div id="blog">
<?php if( have_posts() ) { ?>
     <?php while( have_posts() ) { 
	      the_post(); ?>
          <div class="post">
               <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<br/>
               <div class="entry">	
                    <?php
                    $current_date ="";
                    $count_posts = wp_count_posts();
                    $nextpost = 0;
                    $published_posts = $count_posts->publish;
                    $myposts = get_posts(array('posts_per_page'=>$published_posts));
               	    foreach($myposts as $post) {
                         $nextpost++;
                         setup_postdata($post);
                         $date = get_the_date("F Y"); 
			 $dateMonthName = get_the_date("F");
			 $dateDay = get_the_date("j");
			 $dateMonth = get_the_date("n");
			 $dateYear = get_the_date("Y");


			 if( $dateDay == $dayParam && $dateMonth == $monthParam && $dateYear == $yearParam) {
				 if($current_date != $date) {
				      if($nextpost>1) { 
					   echo "</ol>";
				      } ?>
					<br/>
				      <strong><?php echo  $dateDay . " " . $dateMonthName . " " . $dateYear;?></strong>
				      <br/>
					<br/>	
					   <ol>
				      <?php $current_date =$date;
				 } ?>

				 <li>
					<?php echo $dateDay . " " . $dateMonthName . " " . $dateYear; ?>&nbsp;<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>
			 <?php } 
			
			 if( empty($dayParam)) {
			     if( $dateMonth == $monthParam && $dateYear == $yearParam) {
				 if($current_date != $date) {
				      if($nextpost>1) { 
					   echo "</ol>";
				      } ?>
					<br/>
				      <strong><?php echo ucfirst($dateMonthName) . " " . $dateYear;?></strong>
				      <br/>
					<br/>	
					   <ol>
				      <?php $current_date =$date;
				 } ?>

				 <li>
					<?php echo $dateDay . " " . $dateMonthName . " " . $dateYear; ?>&nbsp;<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>
			 <?php 
                             } 
			  }
		
			 if( empty($dayParam) && empty($monthParam) ) {
			     if( $dateYear == $yearParam) {
				 if($current_date != $date) {
				      if($nextpost>1) { 
					   echo "</ol>";
				      } ?>
					<br/>
				      <strong><?php echo $dateYear;?></strong>
				      <br/>
					<br/>	
					   <ol>
				      <?php $current_date =$date;
				 } ?>

				 <li>
					<?php echo $dateDay . " " . $dateMonthName . " " . $dateYear; ?>&nbsp;<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>
			 <?php 
                             } 
			  }
		

                    }

		    wp_reset_postdata(); ?>
                    </ol>
              </div>
          </div>
     <?php } ?>
<?php } ?>
</div>
 
<?php get_sidebar(); ?>
<div style = "clear:both"></div>	
<?php get_footer(); ?>
