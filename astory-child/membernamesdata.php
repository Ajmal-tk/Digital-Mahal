<?php
/**
 * @package cbusiness-investment
 */


 /* Template Name: member_data_show */ 

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
					
					
				<!--	<div class="wp-block-columns">  -->


<?php

global $wpdb;

     
	 
				
		  $memberstblrslt = $wpdb->get_results("SELECT id,form_id,serial_number,response,user_id,status,user_id,updated_at 
		  FROM wp_fluentform_submissions where form_id=7 and status=('unread' or 'read') and status != 'trashed'");
				
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
				<table class='tablepress' id='memnameview' >
				<thead><tr>
				<th>Member Id</th>
				<th>Member Name</th>
				
				<th>House Name</th>
				<th>Mobile Number</th>
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
	
	$mem_id_val= $rowset->serial_number;
	$mem_name_val = $after_jsndecd['memname']['first_name'];

	
	$housename_val = $after_jsndecd['housename'];

	$mobilnum_val = $after_jsndecd['mobilenumber'];

	
		
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
	
	<td>".$mobilnum_val."</td> ";
			}	
		echo "</tbody>	
			</table>
			</figure> ";	
		
			
										/*
										<td>".$married_chk."</td>
			
			<td>".$spouse_val."</td>
	
	<td>".$father_val."</td>
	
	<td>".$mother_val."</td>
	
	<td>".$hav_childs_chk."</td>
	
	<td>".$num_childs."</td>
	
	<td>".$childs_name."</td>
	<td>".$email_val."</td>
	
	<td>".$rmrks_val."</td>
										
										
										
								echo " <br/>";
								echo $spouse_val;
								echo " <br/>";
								echo $father_val;
								echo " <br/>";
								echo $mother_val;
								echo " <br/>";
								echo $hav_childs_chk;
								echo " <br/>";
								echo $num_childs;
								echo " <br/>";
								echo $childs_name;
								echo " <br/>";
								echo $housename_val;
								echo " <br/>";
								echo $mobilnum_val;
								echo " <br/>";
								echo $email_val;
								echo " <br/>";
								echo $rmrks_val;   */
	?>		
	  <!-- </div>  -->
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

	<style>
		#memnameview{
			
			font-family: Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}
		#memnameview td, #mrgentrytbl th {
			  border: 1px solid #ddd;
			  padding: 8px;
			}
		#memnameview tr:nth-child(even){background-color: #f2f2f2;}

		#memnameview tr:hover {background-color: #ddd;}
		#memnameview th {
					  padding-top: 12px;
					  padding-bottom: 12px;
					  text-align: left;
					  background-color: #123629;
					  color: white;
					}
					
		
		
	</style>
