<?php
/**
 * @package cbusiness-investment
 */


 /* Template Name: marriage_certificate_pdf  */ 
  ob_start();
get_header(); 
if ( is_front_page() && !is_home() ) {
    $cbusiness_investment_site_main = "sitefull";
    }
    else
    {
      $cbusiness_investment_site_main = "site-main";      
    }
	//require_once ( WP_PLUGIN_DIR.'/tcpdf-wrapper/lib/tcpdf/tcpdf.php' )
	//require_once('C:\xampp\htdocs\wordpress\wp-content\plugins\tcpdf-wrapper\lib\tcpdf\tcpdf.php');
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

<?php 



	global $wpdb;      
	
		if (!empty($_POST["srl_no"])) {
		   $srl_no=$_POST['srl_no'];
		   $mhl_mem=$_POST['mhl_mem']; 
		   $hus_nm=$_POST['hus_nam'];
		   $wf_nm=$_POST['wif_nam'];
		  
		

		  $mrgcrtvals = $wpdb->get_results("SELECT id,form_id,serial_number,response,user_id,status,user_id,updated_at 
		  FROM wp_fluentform_submissions where form_id=3 and serial_number=".$srl_no." and status=('unread' or 'read') and status != 'trashed'");
		  
		  foreach($mrgcrtvals as $crtres)
			{
			
			
			$unqtblid= $crtres->id;
			$mrgcrtsrlno= $crtres->serial_number;
			//$resval[]= $crtres->response;
			
			$crtres_vals=$crtres->response;
			
			$jsondataval = $crtres_vals;
			$jsndcd_res= json_decode($jsondataval,true);
			//print_r($after_jsndecd); // results in array form
		
			$mhl_mbrid = $jsndcd_res['mem_id'];
			$mhl_mmbr_nm = $jsndcd_res['mahal_member'];
			$hus_nm = $jsndcd_res['hus_name'];
			$wif_nm = $jsndcd_res['wife_name'];
			if(($srl_no!=$mrgcrtsrlno)&&($mhl_mem!=$mrgcrtsrlno)&&($hus_nm!=$mrgcrtsrlno)&&($wf_nm!=$mrgcrtsrlno)){
				
				echo 'Invalid user values ! Please Check & Try Again';
           
			}  //validation failed
			else{  //validation success
				
				
				
				$mhlmbr_reltn = $jsndcd_res['relation_dd'];
						$mhl_mry_prsn = $jsndcd_res['marrying_person'];
						if($mhlmbr_reltn=='Other'){
							$mhlmbr_reltn = $jsndcd_res['other_relation'];
						}
						else
							$mhlmbr_reltn = $jsndcd_res['relation_dd'];
			
							$hus_wif = $jsndcd_res['bridegroom'];
							
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
							$witns_nm = $jsndcd_res['witness_name'];
							$signr_nm = $jsndcd_res['registrar_name'];
							//$rmrks = $jsndcd_res['remarks']
							
							
	// ----------------- PDF Generating Code----------------------------//						
							
			//============================================================+

//============================================================+

/**

 */

// Include the main TCPDF library (search for installation path).

				//require_once('tcpdf.php');
				
require_once('../Digitalmahal/wp-content/plugins/tcpdf-wrapper/lib/tcpdf/tcpdf.php');
//require_once('https://digitalmahal.co/Digitalmahal/wp-content/plugins/tcpdf-wrapper/lib/tcpdf/tcpdf.php');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ajmal');
		$pdf->SetTitle($hus_nm.' Marriage Certificate');
$pdf->SetSubject('Marriage Certificate');
$pdf->SetKeywords('Marriage Certificate, PDF, print, Certificate, copy');



// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
/*
$html = <<<EOD
<h1  style="text-align:center">Marriage Certificate</h1>

<p>This is Marriage Certificate of $hus_nm		 $wif_nm</p>
<p>Please check the source code documentation and other examples for further information.</p>

EOD;

*/

$html = '<h2  style="text-align:center">Marriage Certificate</h2>
<p>This is to certify that Mr. '.$hus_nm.' Son of '.$husfthr_nm.', '.$hushous_nm.' at '.$hus_plc.'   Married with Mrs. '.$wif_nm.' Daughter of '.$wif_fthr_nm.',  '.$wif_hous_nm.' at '. $wif_plc.'.</p> <br/>
<p>Witness Name : '.$witns_nm.'</p> <br/><br/><br/><br/><br/><br/>  
<p style="text-align:right;">Registrar/Signatory Name : '.$signr_nm.'</p> 
';



// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.



   ob_end_clean();



$pdf->Output('marriage certificate.pdf', 'I');

//============================================================+
// END OF FILE
//============================================

				
							
							
							
							
// ----------------- PDF Generating Code Ends Here--------------//							
							
							

				
				
			}  //validation success part
			
			
			
			} //loop to get values
			
	} 

		else
			{
				echo 'Values not posted ';
			}	
			
			
			






get_footer(); ?>

	

	<script>
	   jQuery(document).ready(function($){
		 
		   
			/
			
		   });
		
		</script>
		
				