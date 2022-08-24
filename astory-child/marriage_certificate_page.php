<?php
/**
 * @package cbusiness-investment
 */


 /* Template Name: marriage_certificate_page  */ 

get_header(); 
if ( is_front_page() && !is_home() ) {
    $cbusiness_investment_site_main = "sitefull";
    }
    else
    {
      $cbusiness_investment_site_main = "site-main";      
    }
	//require ( WP_PLUGIN_DIR.'/tcpdf-wrapper/lib/tcpdf/tcpdf.php' )
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
				<th>Husband Name</th>
				<th>Wife Name</th>
				<th>Date of Mrg</th>
				<th>Place of Mrg</th>
				
				<th>Marriying Person of Mahal</th>
				<th>Relation with Mahal Member</th>
				<th></th>
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
		

           /*  
			<input type='hidden' name='unq_id' placeholder='uniq_id' id=unqid_".$mem_unq_id_val." value=".$mem_unq_id_val.">
			<input type='hidden' name='mem_id' placeholder='mem_id' id=memid_".$mem_unq_id_val." value=".$mem_id_val.">
			<input type='hidden' name='mem_name' placeholder='mem_name' id=mnm_".$mem_unq_id_val." value=".$mem_name_val.">  */

        //<td>".$othr_rltn."</td> 
		/*<td>".$mhl_mry_prsn."</td>
		
		<td>".$mhlmbr_reltn."</td>
		<td>".$husfthr_nm."</td>  <td>".$hus_wif."</td>
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
			<td>".$rmrks."</td> */
		   echo "
			<tr>
			
			<td>".$mrgtbl_srlno."</td>
			<td>".$hus_nm."</td>
			<td>".$wif_nm."</td>
			<td>".$dom."</td>
			<td>".$wed_vnu."</td>
			<td>".$mhl_mmbr_nm."</td>
			<td>".$mhl_mmbr_nm."  ".$mhlmbr_reltn."  ".$mhl_mry_prsn."  (".$hus_wif.")</td>
			<td>
			<form method='post' id='margentrypstfrm' method=post action='https://digitalmahal.co/print-marriage-certificate/'>
		
			<input type='text' name='srl_no' id='srl_no' class='getvals' value=".$mrgtbl_srlno." required/> 
			<input type='text' name='mhl_mem' id='mhl_mem' class='getvals' value=".$mhl_mmbr_nm." required/>
			<input type='text' name='hus_nam' id='hus_nam' class='getvals' value=".$hus_nm." required/>
			<input type='text' name='wif_nam' id='wif_nam' class='getvals' value=".$wif_nm." required/>
			<input type='submit' id='crtfctbtn' name='gnrtmrgbtn' class='marg_crtfct_btn' value='Print Marriage Certificate'>
			 </form>
			</td>
		</tr>
		";  
			}
			
			
		/* 
		
			<button class='marg_crtfct_btn'>Print Marriage Certificate</button>		
			
		echo "<tr><td colspan='5'>
		<form method='post' id='margentrypstfrm' method=post action='http://localhost/wordpress/marriage-register-table/'>
		
		<input type='text' name='unq_id' id='unq_id' class='getvals' required/> 
		<input type='text' name='mem_id' id='mem_id' class='getvals' required/>
		<input type='text' name='mem_name' id='mem_name' class='getvals' required/>
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
					  background-color:#061b4ade;
					  color: white;
					}
					
		 #crtfctbtn	{background-color:#34000e;}
		 #crtfctbtn:hover {background-color:#00b548d9;}
		 
		 
		 .site-main{
					width:100%;
					}
					
		.getvals{
			display:none;
		}	
		
		 .marg_crtfct_btn {
		  display: inline-block;
		 
		  font-size: 16px;
		  cursor: pointer;
		  text-align: center;
		  text-decoration: none;
		  outline: none;
		  color: #fff;
		  background-color:#240113;
		  border: none;
		  border-radius: 5px;
		  box-shadow: 4px 4px 2px 0px #999;
		 }

		 .marg_crtfct_btn:hover {background-color:#950000;}

		 .marg_crtfct_btn:active {
		  background-color: #084613;
		  box-shadow: 0 5px #666;
		  transform: translateY(4px);
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
		
				