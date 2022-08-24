<?php /* Template Name: wp_marriage_det_table_code */ 

global $wpdb;

     //echo " wb table access code php file   <br/> ";
   //$helloworld_id = $wpdb->get_var("SELECT `wife_name` FROM marriage_details WHERE 	id = '2'");
     //echo $helloworld_id;

		//$table_name = $wpdb->prefix .'mahal_membership';

			$resultset = $wpdb->get_results("SELECT * FROM marriage_details ");
			//print_r($results);
			
			 foreach($resultset as $row)
				{
					//echo $row->member_name. '   ';
			$mahal_mem_marriage_data[]=array(
			
											'memmrrgid' => $row->id,
											'mrrghsbndnm' => $row->husband_name,
											'mrrgwfnm' => $row->wife_name,
											'mrrghousnm' => $row->house_name,
											'mrrgfthrnm' => $row->hus_father_name,
											'domrrg' => $row->marriage_date,
											'plcmrrg' => $row->venue,
											'mrrgwitn' => $row->witness,
											'mrrgprsdnt' => $row->registrar,
											'mrrgrmrk' => $row->remarks
					);
				
				}
				$memdet_jsn=json_encode($mahal_mem_marriage_data);
				print_r($memdet_jsn); //echo $row->member_name;
				

?>