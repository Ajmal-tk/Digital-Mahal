<?php
/**
 * @package cbusiness-investment
 */


 /* Template Name: member_payment_details */ 

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
					
					


<?php   //<div class="wp-block-columns">

global $wpdb;

     
	 
				
		  $memberstblrslt = $wpdb->get_results("SELECT id,form_id,serial_number,response,user_id,status,updated_at 
		  FROM wp_fluentform_submissions where form_id=2 and status=('unread' or 'read') and status != 'trashed'");
				
			//$idnum = []; 
			/* <th>Is Married</th>
				<th>Spouse Name</th>
				<th>Father Name</th>
				<th>Mother Name</th>
				<th>Is_Child</th>
				<th>Childs num	</th>
				<th>Child Names</th>
				<th>Email</th>
				<th>Remarks</th> 
				<th>House Name</th>
				<th>Mobile Number</th>
				*/
				
		echo "<figure class='wp-block-table is-style-stripes'>
			<p align='center' hidden> Payment Details</p>
			
				<table class='tablepress' id='memfeedettbl'>
				<tr><th colspan='3'>Member Details</th><th colspan='5'>Payment Details</th></tr>
				<tr>
				<th>Serial No.</th>
				<th>Member Id</th>
				<th>Member Name</th>
				
				<th colspan='4'>Payment Year, Months & Amount</th>
				</tr>
				<tr><td colspan='3'></td>
				<td class='yrhd'>2018</td><td class='yrhd'>2019</td><td class='yrhd'>2020</td><td class='yrhd'>2021</td><td class='yrhd'>2022</td></tr>
				";	
			$iter=0;
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
	
	$entry_srl_no= $rowset->serial_number;
	$entry_srl_nos[]= $rowset->serial_number;
	$mem_reg_id= $after_jsndecd['membr_id'];
	$mem_reg_ids[]= $after_jsndecd['membr_id'];
	
	$mem_name_val = $after_jsndecd['membr_nam'];
	$mem_names[] = $after_jsndecd['membr_nam'];
	$unq_tbl_id = $after_jsndecd['unq_tble_id'];
	
	$unq_tbl_ids[] = $after_jsndecd['unq_tble_id'];
	$year_values[] = $after_jsndecd['year_select'];
	$year_val= $after_jsndecd['year_select'];
	$pymnt_mnth = $after_jsndecd['months_select'];
	$pyd_amnt = $after_jsndecd['tot_fee'];
	
	 $jstmnthinstrng= implode(",",$pymnt_mnth);
	 //print_r($jstmnthinstrng);
	
	$resarray[] = array(
		$iter=> array(
		'reg_val'=>$mem_reg_id,
		'srl_no'=>$entry_srl_no,
        'name' =>$mem_name_val,
		
		'pyear' =>$year_val,
		//'pmnth' =>$pymnt_mnth,
		'pmnth' =>$jstmnthinstrng,
		'pamnt' =>$pyd_amnt,
		
        )
   
		);
		
		//print_r($resarray);
				
			/*echo "<tr>
			
			<td>".$entry_srl_no."</td>
			<td>".$mem_reg_id."</td>
			<td>".$mem_name_val."</td>
			
			
	
	<td></td>
	
	<td></td>"; */ //<td>Jan,Feb,Mar,Apr,May</td>
	
	 $mnthinstrng= implode(",",$pymnt_mnth);
	 
	
			$yrvsmnth[$mem_reg_id][$year_val][$iter]=array($mnthinstrng,$pyd_amnt);
			
			//$memfeepaidamnt[$mem_reg_id][$year_val][$iter]=$pyd_amnt;
			/*	$yrvsmnth[][]=array();
			if (array_key_exists(0,$yrvsmnth[$mem_reg_id][$year_val]))
			{
				$yrvsmnth[$mem_reg_id][$year_val][$iter]=array($mnthinstrng);
			}
			else{
				  $yrvsmnth[$mem_reg_id][$year_val]=array($mnthinstrng);
			}
				*/
	
	
				$iter++;
			
					
			
			 $yrvsmnth[$mem_reg_id][$year_val]=array_values($yrvsmnth[$mem_reg_id][$year_val]);
			
			
			}
			//print_r($yrvsmnth[24][2018]);
			//print_r($yrvsmnth);  echo '<br/>';
			//echo $yrvsmnth[24][2018];
			//print_r($memfeepaidamnt);
			//echo $yrvsmnth[27][2018][2][0];  --> last entry of month of mem id 27 , year 2018
			
			//echo $yrvsmnth[27][2018][2][1];  --> fee of last entry month of mem id 27 , year 2018
			
			//echo '<br/>'; print_r(array_values($yrvsmnth[24][2018]));

			//print_r($yrvsmnth[24][2018]);
			



			
				//	echo "</tr>	</table> </figure> ";	
		
		//print_r($mem_reg_ids);
		$distinct_mem_reg_ids=array_values((array_unique($mem_reg_ids)));
		sort($distinct_mem_reg_ids);
		//print_r($distinct_mem_reg_ids);  // -> Now disting reg id in sorted array.
		$no_mems= count($distinct_mem_reg_ids);
		$no_srlnos= count($entry_srl_nos);
		$distinct_year_vals=array_values((array_unique($year_values)));
		sort($distinct_year_vals);
		$no_years= count($distinct_year_vals);
		//print_r ($distinct_year_vals); // -> Now distinct year sorted array.
		//echo $resarray[2][2]['name'];
		
		
		
		$mc=0;
		
			while($mc<$no_mems){
				$yi=0;
				while($yi<$no_years){ 
				
				$valitr=0;
				  
				  
				   
					
				for($i=0;$i<$no_srlnos;$i++){
				
					$memnamvl=$resarray[$i][$i]['name'];
					$idval=$resarray[$i][$i]['reg_val'];
					$yrval = $resarray[$i][$i]['pyear'];
					
				  if($distinct_mem_reg_ids[$mc]==$resarray[$i][$i]['reg_val']){
					if($distinct_year_vals[$yi]==$resarray[$i][$i]['pyear']){
					
					
						
					//echo $idval.' '.$yrval.' <br/>';
					
					//echo $resarray[$i][$i]['reg_val'].' - '.$resarray[$i][$i]['pyear'];
					$cntofyrvals= count($yrvsmnth[$resarray[$i][$i]['reg_val']][$resarray[$i][$i]['pyear']]);
					
					
					
					while($valitr<$cntofyrvals){
						
						//echo $valitr;
						echo '<tr>';
						echo '<td></td><td>'.$idval.'</td><td>'.$memnamvl.'</td>';
					
						
						if($yrval=='2018'){
							echo '<td>'.$yrvsmnth[$idval][$yrval][$valitr][0].' - '.$yrvsmnth[$idval][$yrval][$valitr][1].'</td>';
						}
						else{
							echo '<td></td>';
						}
						if($yrval=='2019'){
							echo '<td>'.$yrvsmnth[$idval][$yrval][$valitr][0].' - '.$yrvsmnth[$idval][$yrval][$valitr][1].'</td>';
						}
						else{
							echo '<td></td>';
						}
						if($yrval=='2020'){
							echo '<td>'.$yrvsmnth[$idval][$yrval][$valitr][0].' - '.$yrvsmnth[$idval][$yrval][$valitr][1].'</td>';
						}
						else{
							echo '<td></td>';
						}
						if($yrval=='2021'){
							echo '<td>'.$yrvsmnth[$idval][$yrval][$valitr][0].' - '.$yrvsmnth[$idval][$yrval][$valitr][1].'</td>';
						}
						else{
							echo '<td></td>';
						}
						if($yrval=='2022'){
						echo '<td>'.$yrvsmnth[$idval][$yrval][$valitr][0].' - '.$yrvsmnth[$idval][$yrval][$valitr][1].'</td>';
						}
						else{
							echo '<td></td>';
						}
						echo '</tr>';
						
						//echo '<td>'.$yrvsmnth[$idval][$yrval][$valitr][1].'</td>';
					/*	
				    echo $yrvsmnth[$idval][$yrval][$valitr][0];
					echo ' - ';
					echo $yrvsmnth[$idval][$yrval][$valitr][1];
					echo  '<br/>'; 	
					  */
					$valitr++;	
					}
					
					
					
					
					/*
					echo "<tr><td>".$resarray[$i][$i]['reg_val']."</td>
							  <td>".$resarray[$i][$i]['name']."</td>
							  <td>".$resarray[$i][$i]['reg_val']."</td>
					</tr>";  */
					/*  one by one ordered list of members
					echo '<br/>';
					echo $resarray[$i][$i]['reg_val'];
					echo '<br/>';
					echo $resarray[$i][$i]['srl_no'];
					echo '<br/>';
					echo $resarray[$i][$i]['name'];
					echo '<br/>';
					echo $resarray[$i][$i]['pyear'];
					echo '<br/>';
					//echo $resarray[$i][$i]['pmnth'];
					echo $mnthsinstring= implode(",",$resarray[$i][$i]['pmnth']);

					//print_r($resarray[$i][$i]['pmnth']);
					//echo '<br/>';
					echo $resarray[$i][$i]['pamnt'];
					
					echo '<br/>';
					echo '<br/>';
					echo '<br/>';
					
					*/
					
					
									}	
							}
				
				}
				
				$yi++;}
				$mc++;
				
			}
			
			echo "</table> </figure> ";	
			
			//print_r($yrlyfeedet);
			
			echo " <style>
				#memfeedettbl{
				border: 1px solid black;
				padding :15px;
				font-size: 15px;
				color:black;
				} 
				tr:nth-child(even) {
				  background-color: #b3496266;
				}

				th:nth-child(even),td:nth-child(even) {
				  background-color: #eb55af70;
				}
				th, td {
					  padding: 5px;
					}
				.yrhd{
					font-weight: 900;
					color:#00041a;
				}
				</style>"
			 ;
		
		
										
	?>		
	
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
<style>
.site-main{
	width:100%;
}

		#memfeedettbl{
			
			font-family: Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}
		#memfeedettbl td, #memfeedettbl th {
			  border: 1px solid #ddd;
			  padding: 8px;
			}
		#memfeedettbl tr:nth-child(even){background-color: #f2f2f2;}

		#memfeedettbl tr:hover {background-color: #ddd;}
		#memfeedettbl th {
					  padding-top: 12px;
					  padding-bottom: 12px;
					  text-align: left;
					  background-color: #580010de;
					  color: white;
					}
</style>
<?php get_footer(); ?>
