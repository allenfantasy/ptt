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

		<?php if($content['body']['#object']->field_duration['und'][0]['value']) { ?>
		<?php // && $content['body']['#object']->field_country['und'][0]['taxonomy_term']->name != 'Special') ?>
		<div class="info1">
			<b class="label">Duration :</b> <?php echo $content['body']['#object']->field_duration['und'][0]['value']; ?> <?php echo $content['body']['#object']->field_durartion_unit['und'][0]['taxonomy_term']->name; ?>
		</div>
		<?php } ?>

		<?php if($content['body']['#object']->field_price['und'][0]['value']) { ?>
		<div class="info2">
			<b class="label">Price :</b> <?php echo $content['body']['#object']->field_price['und'][0]['value']; ?> <?php echo $content['body']['#object']->field_currency['und'][0]['taxonomy_term']->name; ?>
		</div>
		<?php } ?>

		<?php if($content['body']['#object']->field_language_offer['und'][0]['value']) { ?>
		<div class="info3">
			<b class="label">Language :</b>
			<?php echo $content['body']['#object']->field_language_offer['und'][0]['value']; ?>
		</div>
		<?php } ?>

		<?php if($content['body']['#object']->field_start['und'][0]['value']) { ?>
		<div class="info4">
			<b class="label">Start :</b>
			<?php echo $content['body']['#object']->field_start['und'][0]['value'];  ?>
		</div>
		<?php } ?>

		<?php if($content['body']['#object']->field_destination['und'][0]['value']) { ?>
		<div class="info5">
			<b class="label">Destination :</b>
			<?php echo $content['body']['#object']->field_destination['und'][0]['value']; ?>
		</div>
		<?php } ?>

		<div class="info6">
			<b class="label">General Information</b>
			<br/>
			<?php echo $content['body']['#object']->field_info['und'][0]['value']; ?>
		</div>

		<div class="to-buy">
			<form action="/basket?option=add" method="post">
				<input type="hidden" name="code" value="<?php echo $content['body']['#object']->field_code['und'][0]['value'];?>" />
				<input type="hidden" name="price" value="<?php echo $content['body']['#object']->field_price['und'][0]['value']; ?> <?php echo $content['body']['#object']->field_currency['und'][0]['taxonomy_term']->name; ?>"/>
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

		<?php if($content['body']['#object']->field_duration['und'][0]['value']) { ?>
		<?php //if($content['body']['#object']->field_country['und'][0]['taxonomy_term']->name != 'Special') { ?>
		<div class="info1">
			<b class="label">Dauer :</b> <?php echo $content['body']['#object']->field_duration['und'][0]['value']; ?> <?php echo $content['body']['#object']->field_durartion_unit['und'][0]['taxonomy_term']->name; ?>
		</div>
		<?php } ?>

		<?php if($content['body']['#object']->field_price['und'][0]['value']) { ?>
		<div class="info2">
			<b class="label">Preis :</b> <?php echo $content['body']['#object']->field_price['und'][0]['value']; ?> <?php echo $content['body']['#object']->field_currency['und'][0]['taxonomy_term']->name; ?>
		</div>
		<?php } ?>

		<?php if($content['body']['#object']->field_language_offer['und'][0]['value']) { ?>
		<div class="info3">
			<b class="label">Sprache :</b>
			<?php
					$language_value = $content['body']['#object']->field_language_offer['und'][0]['value'];
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
			?>
		</div>
		<?php } ?>

		<?php if($content['body']['#object']->field_start['und'][0]['value']) { ?>
		<div class="info4">
			<b class="label">Start :</b>
			<?php	echo $content['body']['#object']->field_start['und'][0]['value']; ?>
		</div>
		<?php } ?>
	
		<?php if($content['body']['#object']->field_destination['und'][0]['value']) { ?>
		<div class="info5">
			<b class="label">Ziel :</b>
			<?php echo $content['body']['#object']->field_destination['und'][0]['value']; ?>
		</div>
		<?php } ?>

		<div class="info6">
			<b class="label">Hinweise</b>
			<br/>
			<?php echo $content['body']['#object']->field_info['und'][0]['value']; ?>
		</div>

		<div class="to-buy">
			<form action="/de/korb?option=add" method="post">
				<input type="hidden" name="code" value="<?php echo $content['body']['#object']->field_code['und'][0]['value'];?>" />
				<input type="hidden" name="price" value="<?php echo $content['body']['#object']->field_price['und'][0]['value']; ?> <?php echo $content['body']['#object']->field_currency['und'][0]['taxonomy_term']->name; ?>"/>
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
				<span>Produkt ist schon </span><a href="/de/korb">auf Warenkorb</a>	
				<?php } ?>
			</form>
		</div>
		<?php //print_r($content); ?>
	</div>
<?php } ?>

