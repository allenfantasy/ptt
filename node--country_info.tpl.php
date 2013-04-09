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
		<!--<div class="info1">
			<b class="label">Duration :</b> <?php// echo $content['body']['#object']->field_duration['und'][0]['value']; ?> <?php // echo $content['body']['#object']->field_durartion_unit['und'][0]['taxonomy_term']->name; ?>
		</div>
		<div class="info2">
			<b class="label">Price :</b> <?php // echo $content['body']['#object']->field_price['und'][0]['value']; ?> <?php // echo $content['body']['#object']->field_currency['und'][0]['taxonomy_term']->name; ?>
		</div>
		<div class="info3">
			<b class="label">Language :</b>
			<?php /*
				for($i = 0; $i < count($content['body']['#object']->field_language_offer['und']); $i++){
					echo $content['body']['#object']->field_language_offer['und'][$i]['value'];
					if(($i+1)!=count($content['body']['#object']->field_language_offer['und'])){
					echo ' , ';
					}
				} */
			?>
		</div>
		<div class="info4">
			<b class="label">General Information</b>
			<br/>
			<?php // echo $content['body']['#object']->field_info['und'][0]['value']; ?>
		</div>
		<div class="to-buy">
		</div>-->

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
		<!--<div class="info1">
			<b class="label">Dauer :</b> <?php // echo $content['body']['#object']->field_duration['und'][0]['value']; ?> <?php // echo $content['body']['#object']->field_durartion_unit['und'][0]['taxonomy_term']->name; ?>
		</div>
		<div class="info2">
			<b class="label">Preis :</b> <?php // echo $content['body']['#object']->field_price['und'][0]['value']; ?> <?php // echo $content['body']['#object']->field_currency['und'][0]['taxonomy_term']->name; ?>
		</div>
		<div class="info3">
			<b class="label">Sprache :</b>
			<?php /*
				for($i = 0; $i < count($content['body']['#object']->field_language_offer['und']); $i++){
					echo $content['body']['#object']->field_language_offer['und'][$i]['value'];
					if(($i+1)!=count($content['body']['#object']->field_language_offer['und'])){
					echo ' , ';
					}
				} */
			?>
		</div>
		<div class="info4">
			<b class="label">Hinweise</b>
			<br/>
			<?php //echo $content['body']['#object']->field_info['und'][0]['value']; ?>
		</div>
		<div class="to-buy">
			<form action="/content/basket?option=add" method="post">
				<input type="hidden" name="code" value="<?php // echo $content['body']['#object']->field_code['und'][0]['value'];?>" />
				<input type="hidden" name="price" value="<?php // echo $content['body']['#object']->field_price['und'][0]['value']; ?> <?php // echo $content['body']['#object']->field_currency['und'][0]['taxonomy_term']->name; ?>"/>
				<input type="hidden" name="title" value="<?php // echo $content['body']['#object']->title; ?>"/>
				<input type="hidden" name="url" value="<?php // echo $variables['node_url']; ?>" />
				<input type="submit" value="add to basket" />
			</form>
		</div> -->

	</div>
<?php } ?>

