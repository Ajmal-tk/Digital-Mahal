<?php
/**
 * @package cbusiness-investment
 */


 /* Template Name: marriage_entry_member_selection */ 

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
					
					
					
					<div class="wp-block">
					


		<?php    //wp-block-columns

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
				
		echo "<figure class='wp-block-table is-style-stripes' >
				
				<table class='tablepress' id='mrgentrytbl'>
				<p></p>
				 <caption>
				 <h3 style='color:#002408'>Choose Mahal Member Related with Marrying Person</h3>
				 </caption>
				<thead><tr>
				<th></th>
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
			$mem_unq_id_val= $rowset->id; 
			$mem_id_val= $rowset->serial_number;
			$mem_name_val = $after_jsndecd['memname']['first_name'];

			
			$housename_val = $after_jsndecd['housename'];

			$mobilnum_val = $after_jsndecd['mobilenumber'];
			
			//echo $mem__unq_id_val;  unique id of table
			
	
		
	
		
				
			echo "
			<tr>
			<td>
			 
			 <input type='radio' id='memslct".$mem_unq_id_val."' class='memslct' name='slctdmem' value=".$mem_unq_id_val.">
			  
			<input type='hidden' name='unq_id' placeholder='uniq_id' id=unqid_".$mem_unq_id_val." value=".$mem_unq_id_val.">
			<input type='hidden' name='mem_id' placeholder='mem_id' id=memid_".$mem_unq_id_val." value=".$mem_id_val.">
			<input type='hidden' name='mem_name' placeholder='mem_name' id=mnm_".$mem_unq_id_val." value=".$mem_name_val."> 
			
			</td>
			<td>".$mem_id_val."</td>
			<td>".$mem_name_val."</td>
			
			
			<td>".$housename_val."</td>
			
			<td>".$mobilnum_val."</td> 
			
		
		</tr>
		";
			}
		/* echo "<tr>
		<td colspan='3'>Specify Relationship : 
		<select name='relationship' id='relation' class='relationshp'>
		<option value='Self'>Self</option>
		<option value='Son'>Son</option>
		<option value='Daughter'>Daughter</option>
		<option value='Brother'>Brother</option>
		<option value='Other'>Other</option>
		</select>
		<input type='text' name='othr_rltn' id='spcfyrltn' class='spcfyrltnshp' value=''>
		</td>
		";  */
			
		echo "<tr><td colspan='5'>
		<form method='post' id='margentrypstfrm' method=post action='http://localhost/wordpress/marriage-register-table/'>
		
		<input type='text' name='unq_id' id='unq_id' class='getmemval' required/> 
		<input type='text' name='mem_id' id='mem_id' class='getmemval' required/>
		<input type='text' name='mem_name' id='mem_name' class='getmemval' required/>
		<input type='submit' id='mrgdetbtn' name='entrmrgdet' class='fee_entry_btn' value='Enter Marriage Details'>
		</td>
		</tr> </form>";
		echo "
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
                <?php //get_sidebar();?>
            <?php }?>
        <div class="clear"></div>
		</div>
		
    <!-- </div> row -->
</div><!-- container   -->

<?php get_footer(); ?>

	<style>
		#mrgentrytbl{
			
			font-family: Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}
		#mrgentrytbl td, #mrgentrytbl th {
			  border: 1px solid #ddd;
			  padding: 8px;
			}
		#mrgentrytbl tr:nth-child(even){background-color: #f2f2f2;}

		#mrgentrytbl tr:hover {background-color: #ddd;}
		#mrgentrytbl th {
					  padding-top: 12px;
					  padding-bottom: 12px;
					  text-align: left;
					  background-color: #123629;
					  color: white;
					}
					
		 #mrgdetbtn	{background-color:#34000e;}
		 #mrgdetbtn:hover {background-color:#00b548d9;}
		 
		 
		 .site-main{
					width:100%;
					}
					
		.getmemval{
			display:none;
		}			
		
	</style>

	<script>
	   jQuery(document).ready(function($){
		 
		   
			//$('.relationshp').on('change', function() {});
			
			
			$('.memslct').on('click', function() {
				var idvalgot=this.value;
				//alert(idvalgot);
				//unqid_  memid_  mnm_
				var unqidres=$("#unqid_"+idvalgot).val();
				var memidres=$("#memid_"+idvalgot).val();
				var mnmres=$("#mnm_"+idvalgot).val();
				//alert(unqidres);  alert(memidres); alert(mnmres);
				  
				$("#unq_id").val(unqidres);
				$("#mem_id").val(memidres);
				$("#mem_name").val(mnmres);
			
			});
			
			
			$('#mrgdetbtn').on('click', function() {
				//alert( this.value );
				
				
				
			});
			
			
			
		   });
		
		</script>
		
				