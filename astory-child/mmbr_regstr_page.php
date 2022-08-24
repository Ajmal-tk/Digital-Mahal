<?php
/**
 * @package cbusiness-investment
 */


 /* Template Name: member_register_page */ 

get_header(); 
if ( is_front_page() && !is_home() ) {
    $cbusiness_investment_site_main = "sitefull";
    }
    else
    {
      $cbusiness_investment_site_main = "site-main";      
    }
?>
<div id="content" class="container">
     <div class="page_content">
        <div class="<?php echo esc_html($cbusiness_investment_site_main);?>">
        	 <div class="blog-post">
					<?php
                    if ( have_posts() ) :
                        
                        while ( have_posts() ) : the_post();
                        ?>   
						<div class="pageheading"><h1><?php the_title(); ?></h1></div>
						<div class="pagecontent">  
					    
							<?php the_content();?> 
					
					<div class="wp-block">  <!-- class="wp-block-columns" 
				    <p>Click To</p>
					<a href="default.asp" target="_blank">Register House</a>   -->

<?php

global $wpdb;

		//$memberhousedet = $wpdb->get_results("SELECT * FROM wp_fluentform_entry_details WHERE field_name in ('house_no','house_name','house_ownr') GROUP BY id HAVING count(field_name)=1 ORDER BY submission_id");  -> TRASHED VALUES AVOIDED
		
		$memberhousedet = $wpdb->get_results("SELECT * FROM wp_fluentform_entry_details WHERE field_name in ('house_no','house_name','house_ownr') and submission_id NOT IN (SELECT id FROM `wp_fluentform_submissions` where status='trashed' and form_id=6) GROUP BY id HAVING count(field_name)=1 ORDER BY submission_id");
		  foreach($memberhousedet as $housedet){
			 //echo '<br/>'; 
			 $hstblsbvlidary[]= $housedet -> submission_id;
			 
			  $housetblid= $housedet -> id;
			  $housedetsbmsnval= $housedet -> submission_id;
			  $housedetres= $housedet -> field_name;
			  $housedetval= $housedet -> field_value ;
			$housedetvals[] = array($housetblid,$housedetsbmsnval,$housedetres, $housedetval);
			//$housedetvals[]= array('id'=>$housetblid,'sbval'=>$housedetsbmsnval,'fieldname'=>$housedetres,'value'=>$housedetval);
			//echo '<br/>';
		  }
		  $distnctsbvals=array_unique($hstblsbvlidary); 
		    //print_r($housedetvals);
			
			$cntoftothusdet=count($housedetvals);
		     $cntofdstnctentry=count($distnctsbvals);
			 $rstarykeyvals=array_values($distnctsbvals);
			 //print_r($rstarykeyvals);
			  
			 for($i=0;$i<$cntofdstnctentry;$i++){
											
				 // $rstarykeyvals[$i];  
				 $cnt=0;
				
				 while($cnt<$cntoftothusdet){
					  
					 if($rstarykeyvals[$i]==$housedetvals[$cnt][1]){
					 //echo '<br/>';
					 //echo $housedetvals[$cnt][1].' , '.$housedetvals[$cnt][2].' , '.$housedetvals[$cnt][3];
				
					$hsdetcmbndary[$housedetvals[$cnt][1]][$housedetvals[$cnt][2]]=$housedetvals[$cnt][3];
					
					 					
				 }
				 $cnt++;
				 }
				 //
				 
				 
			 }
			// print_r($rstarykeyvals);
			//$hsdetcmbndary[204]['house_no']['house_name'];
			// echo $hsdetcmbndary[204]['house_no'].' - '.$hsdetcmbndary[204]['house_name'];
			
			$ic=0;
			
			while($ic<$cntofdstnctentry){
			 
			  $housnonnamepasngary[] = $hsdetcmbndary[$rstarykeyvals[$ic]]['house_no'].' - '.$hsdetcmbndary[$rstarykeyvals[$ic]]['house_name'];
			  
			  if (isset($hsdetcmbndary[$rstarykeyvals[$ic]]['house_ownr'])){
				 
				  $housownernmpsngary[$hsdetcmbndary[$rstarykeyvals[$ic]]['house_no'].' - '.$hsdetcmbndary[$rstarykeyvals[$ic]]['house_name']]=$hsdetcmbndary[$rstarykeyvals[$ic]]['house_ownr'];
			  }else{
					 $housownernmpsngary[$hsdetcmbndary[$rstarykeyvals[$ic]]['house_no'].' - '.$hsdetcmbndary[$rstarykeyvals[$ic]]['house_name']]='-';
			  }
			 
			 $ic++;	
			}
			
			 //print_r($housownernmpsngary);print_r($housnonnamepasngary);  // -> This array has to be passed to jQ for populate in dropdown   
			 
				
			
			
			$encodedpasableary = json_encode($housnonnamepasngary);
			$hsownrjsnary = json_encode($housownernmpsngary);
			
			// echo $hsownrjsnary;
			echo '<div class="wp-block-columns">';
			
			
			//$unq_mem_id=$_POST['unq_id'];  $mem_id=$_POST['mem_id'];
			
			
			echo do_shortcode( '[fluentform id="7"]' );
	 
			echo '</div>';
	
		 ?>
		 <style>
			
			}
		 </style>
		  <script>
	jQuery(document).ready(function($){
		
		var jsonhsvals = <?php echo $encodedpasableary; ?>;
		var jsnhsownrvals = <?php echo $hsownrjsnary; ?>;
		
		//var housdetvals = $.parseJSON(jsonhsvals.value);
		//JSON.stringify(myobject); 
		console.log(jsonhsvals);
		$cntofhousdetary=jsonhsvals.length;
		for(i=0; i<$cntofhousdetary; i++) {
		$('#ff_7_house_name_select').append("<option value='"+jsonhsvals[i]+"'>"+jsonhsvals[i]+"</option>");   
		
        }
		
		//alert(jsonhsvals.length);
		
		$("#ff_7_housownr").prop('readonly', true);
		
		//var conceptName = $('#aioConceptName :selected').text();
			$('#ff_7_house_name_select').change(function(){
				//alert('dropdown value changed !!!'); alert($(this).val()); 
				     var slctd_housenonam=$(this).val();  
					 $("#ff_7_housownr").val(jsnhsownrvals[slctd_housenonam]);
					
					
					
						 
			   });
		});   
		
		
		 </script>   
	<?php	 
		
		
		?>
			
		</div>
			</div>			
			
			<div>
                            <?php
                            wp_link_pages( array(
                            'before' => '<div class="page-links">' . __( 'Pages:', 'cbusiness-investment' ),
                            'after'  => '</div>',
                            ) );
                            ?>
                        </div>
						 <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
						<?php if ( comments_open() || get_comments_number() ) :
						comments_template();
						endif;?>
                        <?php endwhile;
                    endif;
                    ?>
					
					
					
                    </div><!--blog-post -->
             </div><!--col-md-8-->
             <?php if ( !is_front_page()) {?>
                <?php //get_sidebar();?>
            <?php }?>
        <div class="clear"></div>
		</div>
		
    <!-- </div> row -->
</div><!-- container -->
<?php get_footer(); ?>

	
		
				