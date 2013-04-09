<?php if ($content['body']['#object']->language=="en") {?>
	<div id="node-<?php print $node->nid; ?>" class="prodoct-page <?php print $classes; ?>"<?php print $attributes; ?>>
		<div class="page-header">
			<?php print render($content['field_image']); ?>
		</div>
		<div class="title">
			<h3><?php echo $content['body']['#object']->title; ?></h3>
		</div>		
		<div class="content">
			<?php echo $content['body']['#object']->body['und'][0]['value']; ?>
		</div>	
		<div class="info1">
			<b class="label">Location :</b> <?php echo $content['body']['#object']->field_location['und'][0]['value']; ?>
		</div>
		<div class="info2">
			<b class="label">Price :</b> <?php echo $content['body']['#object']->field_price['und'][0]['value']; ?> <?php echo $content['body']['#object']->field_currency['und'][0]['taxonomy_term']->name; ?> <?php echo $content['body']['#object']->field_price_unit['und'][0]['taxonomy_term']->name; ?>
		</div>
		<div class="info3">
			<b class="label">Language :</b> 
			<?php
				for($i = 0; $i < count($content['body']['#object']->field_language_offer['und']); $i++){
					echo $content['body']['#object']->field_language_offer['und'][$i]['value'];
					if(($i+1)!=count($content['body']['#object']->field_language_offer['und'])){
					echo ' , ';
					}
				}
			?>
		</div>
		<div class="info4">
			<?php if($content['body']['#object']->field_info['und'][0]['value']) {?>
				<b class="label">General Information</b>
				<br/>
				<?php echo $content['body']['#object']->field_info['und'][0]['value']; ?>
			<?php } ?>
		</div>
		<div class="info5">
			<?php if($content['body']['#object']->field_class['und'][0]['value']) {?>
				<b class="label">Class : </b><?php echo $content['body']['#object']->field_class['und'][0]['value']; ?>
			<?php } ?>
		</div>
		<?php //print_r($content); ?>
		<div class="to-buy">
			<form action="/basket?option=add" method="post">
				<input type="hidden" name="code" value="<?php echo $content['body']['#object']->field_code['und'][0]['value'];?>" />
				<input type="hidden" name="price" value="<?php echo $content['body']['#object']->field_price['und'][0]['value']; ?> <?php echo $content['body']['#object']->field_currency['und'][0]['taxonomy_term']->name; ?> <?php echo $content['body']['#object']->field_price_unit['und'][0]['taxonomy_term']->name; ?>"/>
				<input type="hidden" name="title" value="<?php echo $content['body']['#object']->title; ?>"/>
				<input type="hidden" name="url" value="<?php echo $variables['node_url']; ?>" />
				<?php
					$code = $content['body']['#object']->field_code['und'][0]['value'];
					$check = false;
					for($k=0;$k<count($_SESSION['basket']);$k++){
						if($code==$_SESSION['basket'][$k]['code']){
						  	$check = true;
						}
					}
				?>
				<?php if (!$check) { ?>
				<input type="submit" value="> To Infobasket" />
				<?php } else { ?>
				<span>This product is in </span><a href="/basket">your basket</a>
				<?php } ?>
			</form>
		</div>

	</div>
<?php }else{ ?>
	<div id="node-<?php print $node->nid; ?>" class="prodoct-page <?php print $classes; ?>"<?php print $attributes; ?>>
		<div class="page-header">
			<?php print render($content['field_image']); ?>
		</div>
		<div class="title">
			<h3><?php echo $content['body']['#object']->title; ?></h3>
		</div>			
		<div class="content">
			<?php echo $content['body']['#object']->body['und'][0]['value']; ?>
		</div>	
		<div class="info1">
			<b class="label">Ort :</b> <?php echo $content['body']['#object']->field_location['und'][0]['value']; ?>
		</div>
		<div class="info2">
			<b class="label">Preis :</b> <?php echo $content['body']['#object']->field_price['und'][0]['value']; ?> <?php echo $content['body']['#object']->field_currency['und'][0]['taxonomy_term']->name; ?> <?php echo $content['body']['#object']->field_price_unit['und'][0]['taxonomy_term']->name; ?>
		</div>
		<div class="info3">
			<b class="label">Sprache :</b> 
			<?php
				//for($i = 0; $i < count($content['body']['#object']->field_language_offer['und']); $i++){
					$language_value =  $content['body']['#object']->field_language_offer['und'][0]['value'];
					switch($language_value) {
					case 'German':
						$language_value = 'Deutsch';
						break;
					case 'English':
						$language_value = 'Englisch';
						break;
					case 'Neutral':
						$language_value = 'Neutral';
						break;
					}
					echo $language_value;	

				//	if(($i+1)!=count($content['body']['#object']->field_language_offer['und'])){
				//	echo ' , ';
				//	}
				//}
			?>
		</div>
		<div class="info4">
			<?php if($content['body']['#object']->field_info['und'][0]['value']) { ?>
				<b class="label">Hinweise</b>
				<br/>
				<?php echo $content['body']['#object']->field_info['und'][0]['value']; ?>
			<?php } ?>
		</div>
		<div class="info5">
			<?php if($content['body']['#object']->field_class['und'][0]['value']) { ?>
				<b class="label">Klasse :</b> <?php echo $content['body']['#object']->field_class['und'][0]['value']; ?>
			<?php } ?>
		</div>

		<div class="to-buy">
			<form action="/de/korb?option=add" method="post">
				<input type="hidden" name="code" value="<?php echo $content['body']['#object']->field_code['und'][0]['value'];?>" />
				<input type="hidden" name="price" value="<?php echo $content['body']['#object']->field_price['und'][0]['value']; ?> <?php echo $content['body']['#object']->field_currency['und'][0]['taxonomy_term']->name; ?> <?php echo $content['body']['#object']->field_price_unit['und'][0]['taxonomy_term']->name; ?>"/>
				<input type="hidden" name="title" value="<?php echo $content['body']['#object']->title; ?>"/>
				<input type="hidden" name="url" value="<?php echo $variables['node_url']; ?>" />
				<?php
					$code = $content['body']['#object']->field_code['und'][0]['value'];
					$check = false;
					for($k=0;$k<count($_SESSION['basket']);$k++){
						if($code==$_SESSION['basket'][$k]['code']){
						  	$check = true;
						}
					}
				?>
				<?php if (!$check) { ?>
				<input type="submit" value="> In den Infokorb" />
				<?php } else { ?>
				<span>Product ist schon </span><a href="/de/korb">auf_Warenkorb</a>
				<?php } ?>
			</form>
		</div>

	</div>
<?php } ?>
