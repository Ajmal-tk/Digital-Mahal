<?php
/**
 * @package cbusiness-investment
 */


 /* Template Name: member_fee_enter_form */ 

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
					
					
					<div class="wp-block">  <!-- class="wp-block-columns" -->


<?php

global $wpdb;

	 if (!empty($_POST["unq_id"])) {
		 $unq_mem_id=$_POST['unq_id'];
		 $mem_id=$_POST['mem_id'];
		 $m_name=$_POST['mem_name']; 
		}
		
		 $memberfeedtlres = $wpdb->get_results("SELECT id,form_id,serial_number,response,user_id,status,user_id,updated_at 
		  FROM wp_fluentform_submissions where form_id=2 and response like '%".$m_name."%' and status=('unread' or 'read') and status != 'trashed'");
		 
		  
		  //print_r($memberfeedtlres); class='wp-block-table is-style-stripes'
			
			echo "<figure >
			      <p class='headline'>Current Fee Details of  ".$m_name."</p>";
				
			/*	echo "<table class='tablepress' >
				<thead><tr>
				<th>Member Id</th>
				
				<th>Member Name</th>
				<th>Entry Srl_No</th>
				
				</tr></thead><tbody>";  */ //table commented out
				 $itr=0;
				 $aryadd=[];
				 $montharray=[]; 
				 $mnthyrstring=[];
				 $yrmnthmulti=[];
		  foreach($memberfeedtlres as $feedetset){
			 
			
			 
			$memfeedet= $feedetset -> response;
			
			$jsondcdres=json_decode($memfeedet, true);
			
		  echo '<p hidden> Entry id '.$feedetset ->id.' year of payment: '.$jsondcdres['year_select'].' </p>';
			//echo count($memberfeedtlres).'  is the result count';
            //print_r( $jsondcdres);
			//echo 'unique reg no. : '.$jsondcdres['unq_tble_id'].' mid : '.$jsondcdres['membr_id'].' //mname : '.$jsondcdres['membr_nam'].' '; 
			
			if(($jsondcdres['unq_tble_id']==$unq_mem_id) && ($mem_id==$jsondcdres['membr_id']) && ($jsondcdres['membr_nam']==$m_name)){
				//echo 'Condition checked as same id !!!';
			
				
			 $feepaidmonths =count($jsondcdres['months_select']);
		//	 echo "<tr><td>".$mem_id."</td><td>".$m_name."</td>";
		//	 echo "<td>".$feedetset->serial_number."</td></tr>";
			//echo "<tr><td colspan='2'>".$jsondcdres['year_select']."</td></tr><tr>";
			
			
			 $yrvar=$jsondcdres['year_select'];
			 $yeararry[]=$jsondcdres['year_select'];
			 
			
			$mnths='';
			$mnthc=0;
			
			
			while($mnthc < $feepaidmonths){
			   // echo "<td>".$jsondcdres['months_select'][$mnthc]."</td>";
			  //$mnths=$jsondcdres['months_select'][$mnthc];
			  //if($mnths=='')$mnths= $jsondcdres['months_select'][$mnthc];else
			     $mnths=$mnths.','.$jsondcdres['months_select'][$mnthc];
				$withyear= $yrvar.$mnths;
						$multiyrmonthary = array($yrvar,$mnths);
			 
			 $mnthc++;
			}
			 
				   
			   array_push($montharray,$mnths);
			   array_push($mnthyrstring,$withyear);
			   
			   array_push($yrmnthmulti,$multiyrmonthary);
			
			 //echo $yrvar. '=> '.$mnths;
			 $aryadd[$itr]=array($yrvar=>$mnths);
			 
			 
			//$yrmnthcmbnd=array($yrvar=>$mnths);
				
			
			//echo "</tr>";
			 $itr++;
			 
					}
					else {
						echo 'User Identification Failed !';
						 }		
				
			 
		    }        // for each loop ending
			
					// echo "</tbody> </table>";
			
			//print_r($mnthyrstring);
			$cntofyrmnthmltiary= count($yrmnthmulti);
			
			//echo $yrmnthmulti[1][1];
			
			
			echo '<div class="feedets_div">
				<p>Fee Paid Details</p>
				<p>Name :'.$m_name.' </p>';
				//<p>Unique Mem Reg Entry : $unq_mem_id</p>
				echo '<p>Member Reg Id :'.$mem_id.'</p>';
				
				
				
				
					$unq_yr_ary=array_unique($yeararry);
					//print_r($yeararry);
					$unq_yr_ordr = array_values($unq_yr_ary);
					//print_r($unq_yr_ordr);
					$distnct_year_count=count($unq_yr_ordr);
					$totmnthyr=count($mnthyrstring);
					$it=0;
					echo '<div class="mnthfeedet">';
					
			while($distnct_year_count>$it)
			{
				
				echo '<p> Fee Paid Year: '. $unq_yr_ordr[$it].'</p>';    //--- contain distinct year
				echo '<p>Fee Paid Months : ';
				//echo $unq_yr_ordr[$it] .' year months are : ';
				//$paidmonth=[];
			 for($c=0;$c<$totmnthyr;$c++){ 
				 $trimedyear = substr($mnthyrstring[$c],0,4); 
					// HERE WE GET A YEAR
				 if($unq_yr_ordr[$it]==$trimedyear){
					 // IN EACH LOOP WE GET CORRESPONDING MONTHS
					 // compare with  $unq_yr_ordr[$it], if same take into same array !!!
					
					 $trimedmonths = substr($mnthyrstring[$c],5);
					 
					 echo $trimedmonths;
					 echo ',';
					 
					 
					 //echo ' # '.$unq_yr_ordr[$it].' __ '.$trimedmonths.' * ';  -> this contains same //year and its months
					 //array_push($paidmonth,$trimedmonths);
					 
					 //$paidmonth=array($trimedmonths);
					 $feeperiod[]=array($unq_yr_ordr[$it],$trimedmonths);
					
				    } 
					
				 
				 
				//echo $mnthyrstring[$c];   
				
				}
				echo '</p>';
				$it++;
				//echo '<tr/>';
			} 
			$paidyrnmnths=json_encode($feeperiod);
			//  print_r($feeperiod);
			$testfeeyr=$feeperiod;
			$tfc=count($testfeeyr);
			
			/*  YEAR CONSOLIDATING FOR LOOP IN CONSTRUCTION !!!!!! 
			
			for($ci=0;$ci<$tfc;$ci++){
				
			  $yrtst[]=$testfeeyr[$ci][0];
			  
				
			}
			*/
			
			
			
			echo '</div>';
			
			echo '<br/>';
			//print_r($yrmnthmulti);
			echo '<br/>';
			//echo implode(" ",$montharray);
			echo '<div class="wp-block-columns">';
			
			
			//$unq_mem_id=$_POST['unq_id'];  $mem_id=$_POST['mem_id'];
			
			
			echo do_shortcode( '[fluentform id="2"]' );
	 
			echo '</div>';
	
	 
	// add_action('fluentform_loaded', function ()
	    function my_cutomfunction()
		{
		   // Do your stuffs here ,  echo 'form loaded';
		   
		   $unq_mem_id=$_POST['unq_id'];
		   $mem_id=$_POST['mem_id'];
		   $m_name=$_POST['mem_name'];
		  
		};
		
		
		 
		 ?>
		 <style>
			.feedets_div{
			text-align:left;
			font-size:large;
			color: #02092e;
			margin-left: 25%;
			background: #ede5e1;
			padding: 20px;
					}	
			.headline{
				text-align:center;
				font-size: x-large;
				color: black;
				text-decoration: underline;
				
			}	
			.mnthfeedet{
				margin-bottom: 15px;
				color: #012402;
				font-weight: bold;
			}
		 </style>
		  <script>
	jQuery(document).ready(function($){
		
		//$memnm=$('#ff_2_membr_nam').val();
		//alert($memnm);
		$('input[name="unq_tble_id"]').val(<?php echo "'".$unq_mem_id."'"; ?>);
		$('#ff_2_membr_id').val(<?php echo "'".$mem_id."'"; ?>);
		$('#ff_2_membr_nam').val(<?php echo "'".$m_name."'"; ?>);
		
		
		$('#ff_2_membr_id').attr('readonly', true);
		$('#ff_2_membr_nam').attr('readonly', true);
			//$('#test').addClass('input-disabled');
		
		// Fee calculation funciton    
		
		$('.months_selection').click(function(){
			
			//var numberNotChecked = $('input:checkbox:not(":checked")').length;
			var numberOfChecked = $('input:checkbox:checked').length;
			//alert(numberOfChecked);
			$monthly_fee_amount=100;
			$total_paying_fee=100*numberOfChecked; 
			$('#ff_2_tot_fee').val($total_paying_fee);
			
			});
			
			
			 $('#ff_2_year_select').change(function(){
				      
					  $('#ff_2_tot_fee').val('');
				     //alert('dropdown value changed !!!');
				     // alert($(this).val());
					 var slctd_year=$(this).val();
					 //alert($paidyrnmnths);
					 var paidyrmnths = <?php echo json_encode($feeperiod); ?>;
					 //alert(paidyrmnths);
					 console.log(paidyrmnths);
					 var yrmnths='';
					 for(var i=0; i<paidyrmnths.length; i++){
						    //alert(paidyrmnths[i][0]);  // year
							//alert(paidyrmnths[i][1]);  // months
							if(paidyrmnths[i][0]==slctd_year){
								//alert('year match found' );
								if(yrmnths==''){
									yrmnths=yrmnths+paidyrmnths[i][1];
									}
								else
									yrmnths=yrmnths+','+paidyrmnths[i][1];
							
							}
							
						}
						 //console.log(' months are : '+yrmnths);
						  //$(".ff-el-form-check-input").removeAttr("disabled");
						  $(".ff-el-form-check-input").removeAttr("disabled");
							 if(yrmnths==''){
								 console.log('no corresponding month : '+paidmnths);
							 }else{
								 
								var paidmnths = yrmnths.split(',');
								console.log('months are : '+paidmnths);
								console.log('count of months are : '+paidmnths.length);
								var sl_mnth=paidmnths.length;
								var mi=0;
								while(mi<sl_mnth){
									//alert(paidmnths[mi]);
									$("input[value="+paidmnths[mi]+"]").attr('disabled', 'disabled');
									mi++;
								}
								
								
								//$("input[value=January").attr("disabled", "disabled");
							 }
						 
						 
						
						  //$(".months_select[]").attr("disabled", "disabled");
						
			   });
			
			
			
			
			$('#fluentform_2').submit(function(){
				
				//alert('reg button clicked' );
				 var c = confirm("You are Submitting Fee Details !\n Verify and Click OK to Continue?");
				return c; //you can just return c because it will be true or false
			});
		  
		 
		  
			
		});   
		
		
		 </script>   
	<?php	 
		
		echo '</figure>';
		//}, 10, 0);
		
		
		add_action('fluentform_loaded', 'my_cutomfunction',10, 0);  
		do_action('fluentform_loaded');
		
		
	   
				
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

	
		
				