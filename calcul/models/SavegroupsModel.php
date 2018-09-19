<?php  
class SavegroupsModel 
{
	public function saveGroups($entity_code, $id_product) {		
		for ($i = 0; $i < count($id_product); $i++) {	
			$insert_card = "INSERT INTO card (entity_code, id_product) VALUES ({$entity_code}, {$id_product[$i]})"; 
			ConnectBD::getConnect()->query($insert_card);
		}	
		for ($i = 0; $i < count($id_product); $i++) {	
			$insert_koef = "INSERT INTO koef (entity_code, id_product) VALUES ({$entity_code}, {$id_product[$i]})";
			ConnectBD::getConnect()->query($insert_koef);
		}
	}	
}
