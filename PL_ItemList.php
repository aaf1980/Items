<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

include 'template/header.php';
include 'config/config.php';
include 'config/functions.php';

    //для панингации для LIMIT в запросе selectReference 
	if (isset($_GET['Pos'])) {
	  $pos = clearHttp($_GET['Pos']);  	
	} else {
	  $pos = 0; 
	}	
	
	//основной запрос скрипта
	$whs = '';
	$itemStatus = '';
	$photoStatus = '';
	$itemName = '';
	$etimClass = '';
	$person = '';
	$zcv = '';
	
	$fldNames = array('BrandId', 'Reference', 'Family', 'FullRef');	
	    
    foreach ($fldNames as $fld) {
		if (!empty($_REQUEST[$fld])) {
            $selectParameter = clearHttp($_REQUEST[$fld]);
			//echo $selectParameter;
		    $whs .= " AND a.$fld = '$selectParameter'";	
		}				
	 }	
	 unset($fld);
	 
	 if (!empty($_REQUEST['ItemStatus'])) {
		   $statusIms = clearHttp($_REQUEST['ItemStatus']);
		   if ($statusIms == 111) {
			   $statusIms = 0;
		   }
		   //echo $statusIms;
		   $itemStatus .= " AND a.ItemStatus = $statusIms";	
	 }
	 
	 if (!empty($_REQUEST['PhotoStatus'])) {
		   $statusFhoto = clearHttp($_REQUEST['PhotoStatus']); 
		   if ($statusFhoto == 111) {
			   $statusFhoto = 0;
		   }
		   //echo $statusFhoto;
		   $photoStatus .= " AND a.PhotoStatus = $statusFhoto";	
	 }
	 
	 if (!empty($_REQUEST['ItemName'])) {
		 $itemName .= " AND a.ItemName LIKE '%".$_REQUEST['ItemName']."%'";
	 }
	 
	 if (!empty($_REQUEST['EtimClass'])) {
		 $etimClass .= "AND NOT EXISTS (SELECT v.ParamValCode 
		                                FROM PL_ItemParamsVals AS v 
                                        WHERE v.Reference = a.Reference 
						                AND v.ParamNo = 'RefGroupId' 
						                AND v.ParamValCode <> '')"; //без ORDER BY Reference
	 }
	 
	 if (!empty($_REQUEST['ResponsiblePerson'])) {
		 $zcv = ", RespPersons AS p";
		 $person .= "AND a.Family = p.Param1 AND p.ObjId='FAM' AND Description LIKE '%".$_REQUEST['ResponsiblePerson']."%' ";
	 }
	//====================главный запрос=============================================================	
	$selectReference = "SELECT a.Reference FROM PL_Items AS a $zcv WHERE 1=1 $whs $itemStatus $photoStatus $itemName $etimClass $person LIMIT $pos, 20";
	//echo $selectReference;
	$queriMainReference = mysqli_query(connect(), $selectReference);		
	//===============================================================================================		
?>

<!--Начало фильтра-->
<table>
<tr>
<td>
<div id="left-menu">
<!-- Кнопка активации -->
<label class="btn" for="modal-1">Меню</label>
<!-- Модальное окно -->
<div class="modal">
  <input class="modal-open" id="modal-1" type="checkbox" hidden>
  <div class="modal-wrap" aria-hidden="true" role="dialog">
    <label class="modal-overlay" for="modal-1"></label>
    <div class="modal-dialog">
      <div class="modal-header">
        <h2>Меню</h2>
        <label class="btn-close" for="modal-1" aria-hidden="true">×</label>
      </div>
      <div class="modal-body">        
	  <p><a href="PL_ItemList.php">Товары</a></p>
      <p><a href="PL_OutputViewList.php">Табличный вид </a></p>
	  <p><a href="PL_FamilyList.php"> Фамилии</a></p>
	  <p><a href="Admin.php">Admin-Items </a></p>
      <p><a href="Reports.php">Отчеты </a></p>	     
	  <p><a href="FrmUpload_ItemXML.php">Загрузка XML параметров</a></p>
      <p><a href="../admin_opers_panel.php">Admin</a></p> 
      <p><a href="../authorization.php">Login</a></p> 	 
	  <p><a href="../logout.php">LogOut</a></p> 
      </div>
      <div class="modal-footer">
        <label class="btn btn-primary" for="modal-1">Закрыть</label>
      </div>
    </div>
  </div>
</div>
<hr>
<form id="filter_items" method="POST" action="PL_ItemList.php">	      
  <input class="btn" type="submit" value="Найти">
</form>
</div>
</td>


<td>
  <ol class="form_poisk">
	<?php   
		foreach ($fldNames as $fld) {    
			echo "<li><input type=\"text\" name=\"$fld\" form=\"filter_items\" placeholder=\"$fld\"></li>";	   	 	
		}
		unset($fld);		
	?>	
  </ol>  
</td> 
 
<td>
 <ol class="form_poisk" start="5">
 <li>
   <input type="text" name="ItemName" form="filter_items" placeholder="Наименование товара"> 
 </li>     
 <li>     
   <input type="text" name="ResponsiblePerson" form="filter_items" placeholder="Ответственный">	 
 </li>  
 
  <li>
	<select  name="ItemStatus" form="filter_items">
	 <option selected disabled>Статус IMS</option>
	 <option value="111">Новый</option>
	 <option value="5">Есть тариф</option>
	 <option value="10">Проверен</option>		
	 <option value="15">Набор товаров</option>
	 <option value="20" >Устаревший</option>
	 <option value="30">Закрыт</option>
	 <option value="40">Удалить</option>		
   </select>
  </li>	
  
   <li>
	<select  name="PhotoStatus" form="filter_items">
	 <option selected disabled>Статус Foto</option>
	 <option value="111">Нет фото</option>
	 <option value="10">Загружено</option>
	 <option value="20">Сделать фото</option>		
	 <option value="40">фото ОK</option>			
   </select>
   <input type="checkbox" name="EtimClass" id="classetim" form="filter_items">
     <label for="classetim"><b>Etim no</b></label>	 
   </li>       
 </ol> 
</td>
</tr>
</table>
<!--Конец фильтра -->
<!--Основная таблица-->
<table>
  <tr class="header">
   <td bgcolor="#BDBDBD"><span>Бренд</span></td> 
   <td bgcolor="#BDBDBD"><span>Артикул</span></td> 
   <td bgcolor="#BDBDBD"><span>Бренд-Артикул</span></td>
   <td bgcolor="#BDBDBD"><span>Наименование</span></td>
   <td bgcolor="#BDBDBD"><span>Семейство</span></td> 
   <td bgcolor="#BDBDBD"><span>Статус<br>IMS</span></td>
   <td bgcolor="#BDBDBD"><span>Статус<br>фото</span></td>
   <td bgcolor="#BDBDBD"><span>Есть тариф</span></td> 
   <td bgcolor="#BDBDBD"><span>Класс ETIM</span></td>
   <td bgcolor="#BDBDBD"><span>Параметров</span></td>
   <td bgcolor="#BDBDBD"><span>Заполнено</span></td>
   <td bgcolor="#BDBDBD"><span>Ответственный</span></td>
  </tr>
<?php  	   		 
	$refValue = array();
    $reference = array();	
	$familyValue = array();
    $statusIms = array();
    $etim = array();
  	$parameter = array();
	$filledParameter = array();
	$responsible = array();
	$n = 0;	
	
	for ($i = 0; $i < mysqli_num_rows($queriMainReference); $i++) {	
	
		$refValue = mysqli_fetch_array($queriMainReference);
		$reference = mysqli_fetch_array(getReferense($refValue['Reference']));
		$familyValue = mysqli_fetch_array(getSeriaName($refValue['Reference']));
		$statusIms = mysqli_fetch_array(getStatusIms($refValue['Reference']));
		$etim = mysqli_fetch_array(getEtim($refValue['Reference']));
		$parameter = mysqli_fetch_array(getParameter($refValue['Reference']));
		$filledParameter = mysqli_fetch_array(getFilledParameter($refValue['Reference']));
		$responsible = mysqli_fetch_array(responsible($refValue['Reference']));
        $classType = ''; 
        $n++;		
		if ($n == 2) {
			$n = 0;
			$classType = 'class="even"';
		} 		
?>  
	<tr <?= $classType?>>
      <td><?= $reference['BrandId'] ?></td>
	  <td><a  target="_blank" href="PL_ItemFrm.php?Reference=<?= $reference['Reference'] ?>"><?= $reference['Reference'] ?></a></td>
      <td><?= $reference['FullRef'] ?></td>
	  <td><?= $reference['ItemName'] ?></td>
	  <td>[<?= $familyValue['FamilyNo'] ?>]<?= $familyValue['FamilyName'] ?>[DAS<?= $familyValue['DAS'] ?>,PL<?= $familyValue['PL'] ?>]</td>
	  <td><?= $statusIms['EnumDescription'] ?></td>
	  <td><?= $statusIms['FotoDescription'] ?></td>
	  <td><?= getTarif($refValue['Reference']) ?></td>
	  <td>
	   <?php
	    if (!empty($etim['ID'])) {
		   echo '['.$etim['ID'].']<br>';             		  
		   if (mb_strlen($etim['TextVal'], 'UTF-8') > 45) {
			  $etim['TextVal'] = mb_substr($etim['TextVal'], 0, 25, 'UTF-8');				
		   }
		   echo $etim['TextVal'];
	    }
	   ?>
	  </td>
	  <td><?= $parameter['CNT'] ?></td>
	  <td><?= $filledParameter['CNT'] ?></td>
	  <td><?= $responsible['Description'] ?></td>
	</tr>    
<?php } 
include 'panning/plitemlist_pan.php';
?>	
</table>

</body>

