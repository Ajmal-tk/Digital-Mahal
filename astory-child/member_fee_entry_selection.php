<?php
/**
 * @package cbusiness-investment
 */


 /* Template Name: member_select_fee_entry */ 

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
					
					
					
					<div class="wp-block-columns">
					


<?php

global $wpdb;

     
	 
				
		  $memberstblrslt = $wpdb->get_results("SELECT id,form_id,serial_number,response,user_id,status,user_id,updated_at 
		  FROM wp_fluentform_submissions where form_id=4 and status=('unread' or 'read') and status != 'trashed'");
				
			//$idnum = []; 
			/* <th>Is Married</th>
				<th>Spouse Name</th>
				<th>Father Name</th>
				<th>Mother Name</th>
				<th>Is_Child</th>
				<th>Childs num	</th>
				<th>Child Names</th>
				<th>Email</th>
				<th>Remarks</th> */
				
		echo "<figure class='wp-block-table is-style-stripes'>
				
				<table class='tablepress' >
				<thead><tr>
				<th>Member Id</th>
				<th>Member Name</th>
				
				<th>House Name</th>
				<th>Mobile Number</th>
				<th></th>
				</tr></thead>";	

			foreach($memberstblrslt as $rowset)
			{
			//array_push($userarray, $rowset['id']);
			$idnum[]= $rowset->serial_number;
			//$resval[]= $rowset->response;
			
			$sep_res_vals=$rowset->response;
			//print_r($sep_res_vals);  //$split_to_array = explode(',"', $sep_res_vals);
			
			$jsondatares = $sep_res_vals;
			$after_jsndecd= json_decode($jsondatares,true);
			//print_r($after_jsndecd); // results in array form
	$mem_unq_id_val= $rowset->id; 
	$mem_id_val= $rowset->serial_number;
	$mem_name_val = $after_jsndecd['memname']['first_name'];

	
	$housename_val = $after_jsndecd['housename'];

	$mobilnum_val = $after_jsndecd['mobilenumber'];
	
	//echo $mem__unq_id_val;  unique id of table
	
	
		
	/*
					$married_chk = $after_jsndecd['married'];

					if($married_chk=='No')
					{
					$spouse_val='Nill';
					}
					elseif($married_chk=='Yes'){

					$spouse_val = $after_jsndecd['spousename'];
					}

					$father_val = $after_jsndecd['fathername'];

					$mother_val = $after_jsndecd['mothername'];

					$hav_childs_chk = $after_jsndecd['childs'];


					if($hav_childs_chk=='no')
					{
					$num_childs=0;
					$childs_name = 'Nill';

					}
					elseif($hav_childs_chk=='yes'){

					$num_childs = $after_jsndecd['childs_count'];

					$childs_name = $after_jsndecd['childnames'];
					}

					$email_val = $after_jsndecd['emailid'];

					$rmrks_val = $after_jsndecd['remarks'];


	echo " <br/>";
		echo $mem_name_val;
	echo " <br/>";
	echo $married_chk;
	*/ 
		
				
			echo "<tbody>
			<td>".$mem_id_val."</td>
			<td>".$mem_name_val."</td>
			
			
	
	<td>".$housename_val."</td>
	
	<td>".$mobilnum_val."</td> 
	<td>
		<form method='post' method=post action='https://digitalmahal.co/annual-fees-entering-form/'> 
		<input type='hidden' name='unq_id' id=unqid_".$mem_unq_id_val." value=".$mem_unq_id_val.">
		<input type='hidden' name='mem_id' id=memid_".$mem_unq_id_val." value=".$mem_id_val.">
		<input type='hidden' name='mem_name' id=mnm_".$mem_unq_id_val." value=".$mem_name_val.">
		<input type='submit' name='Enter Fee' class='fee_entry_btn' id=".$mem_unq_id_val." value='Enter Fee'>
		</form>
		</td>";
			}	
		echo "</tbody>	
			</table>
			</figure> ";	
		
			
										/*    
										
    <td>".$married_chk."</td><td>".$spouse_val."</td><td>".$father_val."</td><td>".$mother_val."</td>

										<td>".$hav_childs_chk."</td><td>".$num_childs."</td><td>".$childs_name."</td>
										<td>".$email_val."</td><td>".$rmrks_val."</td>
										
							 */
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
                <?php get_sidebar();?>
            <?php }?>
        <div class="clear"></div>
		</div>
		
    <!-- </div> row -->
</div><!-- container -->

<?php get_footer(); ?>

	<script>
	   //jQuery(document).ready(function($){
		 
		   //$(".fee_entry_btn").on("click", function(e){  });    });
		
		</script>
		
				