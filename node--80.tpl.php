<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
	<?php 
		//global $language;
		//$lang = $language->language;
	?>
	<?php 
		$string1 = 'Max product is 10';
		$string1 = 'Your New Product: ';
		$string2 = 'has been added';
		$string3 = 'This product is already added';
		$string4 = 'Check' ; 
		$string5 = 'Remove'	;
		$string_code = 'Code';
		$string_title = 'Title';
		$string_price = 'Price';
		$form_action = '/inquiry';
		$submit_value = 'Send enquiry';
		$noproduct = 'Sorry, Your cart is empty';	
	?>

	<?php
		//Option check
		//1 add = add new item to basket
		//2 remove + target to remove = remove item on target(code)
		//3 reset = reset basket
		
		if($_GET['option']=="add"){
			$code = $_POST['code'];
			$title = $_POST['title'];
			$price = $_POST['price'];
			$url = $_POST['url'];
			//check : has code? or not
			if($code){
				//check : is already added?
				for($k=0;$k<count($_SESSION['basket']);$k++){
						if($code==$_SESSION['basket'][$k]['code']){
							$basketcheck = "hasbeenadded";
						}
				}
				$tempindex = count($_SESSION['basket']);
				//max product = 10
				if($tempindex >= 10){
					print $string0;
				}
				//!=already added
				else if($basketcheck!="hasbeenadded"){
					$currentindex = count($_SESSION['basket']);
					$_SESSION['basket'][$currentindex]['code'] = $code;
					$_SESSION['basket'][$currentindex]['price'] = $price;
					$_SESSION['basket'][$currentindex]['title'] = $title;
					$_SESSION['basket'][$currentindex]['url'] = $url;
					print '<div class="item-added">';
						//print '<div class="code">';
						//		print 'item : '.$code;
						//print '</div>';
						print '<div class="title">';
								print $string1 . '<span>' . $title . '</span>' ;
						print '</div>';
						print '<div class="confirm-msg">';
								print $string2;
						print '</div>';

					print '</div>';
				//already added
				}else{
					print $string3;
				}
			}		
		}else if($_GET['option']=='remove'){
				//create new temp array with out remove-code
				$target=$_GET['target'];
				$k=0;
				for($j=0;$j<count($_SESSION['basket']);$j++){
					if($target!=$_SESSION['basket'][$j]['code']){
						$temp['basket'][$k]['code']=$_SESSION['basket'][$j]['code'];
						$temp['basket'][$k]['title']=$_SESSION['basket'][$j]['title'];
						$temp['basket'][$k]['price']=$_SESSION['basket'][$j]['price'];
						$temp['basket'][$k]['url']=$_SESSION['basket'][$j]['url'];	
						$k++;
					}
					
				}
				$_SESSION['basket']=$temp['basket'];
				
		
		}else if($_GET['option']=='reset'){
				$_SESSION['basket']=="";
				unset($_SESSION['basket']);
		}

		// if the basket is not empty, print the selected products in the basket.
		if(count($_SESSION['basket'])!= 0){
			print '<div class="all-basket">';
			print '<table class="basket">';
				print '<tr>';
					print '<th>' . $string_title . '</th>';
					print '<th>' . $string_price . '</th>';
					print '<th></th>';
					print '<th></th>';
				print '</tr>';
			for($i=0;$i<count($_SESSION['basket']); $i++){
				if(($i%2)==0){
					//print '<div class="odd">';
					print '<tr class="odd">';
				}else{
					//print '<div class="even">';
					print '<tr class="even">';
				}

				print '<td><div class="title">';
					print '<a>' . $_SESSION['basket'][$i]['title'] . '</a>';
				print '</div></td>';

				print '<td><div class="price">';
					print '<a>' . $_SESSION['basket'][$i]['price'] . '</a>';
				print '</div></td>';

				print '<td><div class="show">';
					print '<a href="' . $_SESSION['basket'][$i]['url'] . '">' . $string4 . '</a>';
				print '</div></td>';					

				print '<td><div class="action">';
					print '<a href="/basket?option=remove&target=' . $_SESSION['basket'][$i]['code'] . '">' . $string5 . '</a>';
				print '</div></td>';					

				print '</tr>';	
			}
		print '</table></div>';
		}
		
	?>
	<?php if(count($_SESSION['basket'])!=0) { ?>
			<form method="get" action="<?php print $form_action; ?>"> 
				<?php for($i=0;$i<count($_SESSION['basket']); $i++){ ?>
					<input type="hidden" name="info<?php print ($i+1)?>" value="code : <?php print $_SESSION['basket'][$i]['code'].' Title : '.$_SESSION['basket'][$i]['title'].'  price : '.$_SESSION['basket'][$i]['price']; ?>" />
					<!--<input type="hidden" name="info<?php print ($i+1)?>" value="code : <?php print $_SESSION['basket'][$i]['code']; ?>" />-->
				<?php } ?>			
				<input type="submit" value="<?php print $submit_value; ?>"/>
			</form>
	<?php }else{ ?>
		<h2><?php print $noproduct; ?></h2>
	<?php } ?>
</div>
