<?php
/**
 * @package cbusiness-investment
 */


 /* Template Name: marriage_det_enter_form */ 

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
		
		/*
		$memberfeedtlres = $wpdb->get_results("SELECT id,form_id,serial_number,response,user_id,status,user_id,updated_at 
		 FROM wp_fluentform_submissions where form_id=2 and response like '%".$m_name."%' and status=('unread' or 'read') and status != 'trashed'");
		 
		 */
		 
		  
		  //print_r($memberfeedtlres); class='wp-block-table is-style-stripes'
			
		
			
			echo '<div class="wp-block-columns">';
			
			
			//$unq_mem_id=$_POST['unq_id'];  $mem_id=$_POST['mem_id'];
			
			
			//echo do_shortcode( '[fluentform id="3"]' );
			
			
	 
			echo '</div>';
	
	 

		
		 
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
			.mahal_related{
				background: #d1b70029;
				color: black;
			}
			.hus_wife_related{
				
				padding-top: 25px;
				border-top: 5px solid #000010;
			}
		 </style>
		  <script>
	jQuery(document).ready(function($){
		
		
		//$('input[name="unq_tble_id"]').val(<?php //echo "'".$unq_mem_id."'"; ?>);
		$('#ff_3_mem_id').val(<?php echo "'".$mem_id."'"; ?>);
		$('#ff_3_mahal_member').val(<?php echo "'".$m_name."'"; ?>);
		//$memnm=$('#ff_3_mahal_member').val();
		 //alert('script section');
		
		$('#ff_3_mem_id').attr('readonly', true);
		$('#ff_3_mahal_member').attr('readonly', true);
		
		
		  //$('.huswifediv').hide();
		  $('.spcifyrelation').hide();
		
	
		$("#ff_3_relation_dd").change(function(){ 
		
			if(($("#ff_3_relation_dd").val()=='Self')||($("#ff_3_relation_dd").val()=='Son')){   //alert($("#ff_3_relation_dd").val());    
			//alert('selected others');
			 $('#ff_3_bridegroom').val('Husband');
			 $('#ff_3_bridegroom').attr('readonly', true);
			
			 $('.spcifyrelation').hide();
			}
			else if($("#ff_3_relation_dd").val()=='Daughter'){
				$('#ff_3_bridegroom').val('Wife');
				$('#ff_3_bridegroom').attr('readonly', true);
			}
			
			else if($("#ff_3_relation_dd").val()=='Other'){
				$('#ff_3_bridegroom').val('');
				$('#ff_3_bridegroom').attr('readonly', false);
				$('.spcifyrelation').show();
			}
			else{
				
		        $('.spcifyrelation').hide();
			}
		});  
		
	
	
		});   
		
		
		 </script>   
	
			
		</div>
		<?php the_content();?>
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

	
		
				