<?php
/**
 * @package cbusiness-investment
 */


 /* Template Name: marriage_record_view */ 

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
					
					<div class="wp-block">
					


		<?php    //wp-block-columns

		global $wpdb;

     
	 
				
		  $mrrgetblrslt = $wpdb->get_results("SELECT id,form_id,serial_number,response,user_id,status,user_id,updated_at 
		  FROM wp_fluentform_submissions where form_id=3 and status=('unread' or 'read') and status != 'trashed'");
				
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
				 <h3 style='color:#002408;'>Marriage Details of Mahal</h3>
				 </caption>
				<thead><tr>
				
				<th>Srl No.</th>
				<th>Marriying Person of Mahal</th>
				<th>Mahal Member Name</th>
				<th>Relation</th>
				<th>Husband Or Wife </th>
				<th>Husband Name</th>
				<th>Wife Name</th>
				<th>Date of Mrg</th>
				<th>Place of Mrg</th>
				<th>Hus_Fathername</th>
				<th>Hus_Mothername</th>
				<th>Hus_housename</th>
				<th>Hus_Place</th>
				<th>Wife_Fathername</th>
				<th>Wife_Mothername</th>
				<th>Wife_housename</th>
				<th>Wife_Place</th>
				<th>Hus Mob_No</th>
				<th>Witness</th>
				<th>Registrar</th>
				<th>Remarks</th>
				
				</tr></thead>";	

			foreach($mrrgetblrslt as $resset)
			{
			
			
			$unqtblid[]= $resset->id;
			$idnum[]= $resset->serial_number;
			//$resval[]= $resset->response;
			
			$res_vals=$resset->response;
			//print_r($sep_res_vals);  //$split_to_array = explode(',"', $sep_res_vals);
			
			$jsondataval = $res_vals;
			$jsndcd_res= json_decode($jsondataval,true);
			//print_r($after_jsndecd); // results in array form
			$mrgtbl_unq_id_val= $resset->id; 
			$mrgtbl_srlno= $resset->serial_number;
			
			$mhl_mbrid = $jsndcd_res['mem_id'];
			$mhl_mmbr_nm = $jsndcd_res['mahal_member'];
			
			$mhlmbr_reltn = $jsndcd_res['relation_dd'];
			$mhl_mry_prsn = $jsndcd_res['marrying_person'];
			if($mhlmbr_reltn=='Other'){
				$mhlmbr_reltn = $jsndcd_res['other_relation'];
			}
			else
				$mhlmbr_reltn = $jsndcd_res['relation_dd'];
			
			$hus_wif = $jsndcd_res['bridegroom'];
			$hus_nm = $jsndcd_res['hus_name'];
			$wif_nm = $jsndcd_res['wife_name'];
			$dom = $jsndcd_res['DOM'];
			$wed_vnu = $jsndcd_res['wed_place'];
			$husfthr_nm = $jsndcd_res['hus_fathername'];
			$husmthr_nm = $jsndcd_res['hus_mother'];
		    $hushous_nm = $jsndcd_res['hus_housname'];
			
			$hus_plc = $jsndcd_res['hus_place'];
			$wif_fthr_nm = $jsndcd_res['wife_father_name'];
			$wif_mthr_nm = $jsndcd_res['wife_mother'];
			$wif_hous_nm = $jsndcd_res['wife_house_name'];
			$wif_plc = $jsndcd_res['wife_place'];
			$hus_mobno = $jsndcd_res['hus_mob_no'];
			$witns_nm = $jsndcd_res['witness_name'];
			$signr_nm = $jsndcd_res['registrar_name'];
			$rmrks = $jsndcd_res['remarks']; 

           /*  
			<input type='hidden' name='unq_id' placeholder='uniq_id' id=unqid_".$mem_unq_id_val." value=".$mem_unq_id_val.">
			<input type='hidden' name='mem_id' placeholder='mem_id' id=memid_".$mem_unq_id_val." value=".$mem_id_val.">
			<input type='hidden' name='mem_name' placeholder='mem_name' id=mnm_".$mem_unq_id_val." value=".$mem_name_val.">  */

        //<td>".$othr_rltn."</td>
		
		
		   echo "
			<tr>
			
			<td>".$mrgtbl_srlno."</td>
			<td>".$mhl_mry_prsn."</td>
			<td>".$mhl_mmbr_nm."</td>
			<td>".$mhlmbr_reltn."</td>
			<td>".$hus_wif."</td>
			<td>".$hus_nm."</td>
			<td>".$wif_nm."</td>
			<td>".$dom."</td>
			<td>".$wed_vnu."</td>
			<td>".$husfthr_nm."</td>
			<td>".$husmthr_nm."</td>
			<td>".$hushous_nm."</td>
			<td>".$hus_plc."</td>
			<td>".$wif_fthr_nm."</td>
			<td>".$wif_mthr_nm."</td>
			<td>".$wif_hous_nm."</td>
			<td>".$wif_plc."</td>
			<td>".$hus_mobno."</td>
			<td>".$witns_nm."</td>
			<td>".$signr_nm."</td>
			<td>".$rmrks."</td>
			
		</tr>
		";  
			}
		
		/* 
			
		echo "<tr><td colspan='5'>
		<form method='post' id='margentrypstfrm' method=post action='http://localhost/wordpress/marriage-register-table/'>
		
		<input type='text' name='unq_id' id='unq_id' class='getmemval' required/> 
		<input type='text' name='mem_id' id='mem_id' class='getmemval' required/>
		<input type='text' name='mem_name' id='mem_name' class='getmemval' required/>
		<input type='submit' id='mrgdetbtn' name='entrmrgdet' class='fee_entry_btn' value='Enter Marriage Details'>
		</td>
		</tr> </form>";  */
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
					  background-color: #033225de;
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
		
				