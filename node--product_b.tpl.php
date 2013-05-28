<?php
  // produkt variables:
  $produkt_object = $content['body']['#object'];
  $lang = $produkt_object->language;

  $custom = array();

  $custom['title'] = $produkt_object->title;
  $custom['body'] = $produkt_object->body['und'][0]['value'];

  $custom['location'] = $produkt_object->field_location['und'][0]['value'];
  $custom['price'] = $produkt_object->field_price['und'][0]['value']
    . " " . $produkt_object->field_currency['und'][0]['taxonomy_term']->name
    . " " . $produkt_object->field_price_unit['und'][0]['taxonomy_term']->name;

  $custom['language'] = "";
  if ($produkt_object->field_language_offer['und'][0]['value']) {
    foreach($produkt_object->field_language_offer['und'] as $lang_offer) {
      if($lang == 'en') { // EN
        $custom['language'] .= $lang_offer['value'] . " ";
      }
      else { // DE
        $language_value = $lang_offer['value'];
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
			  $custom['language'] .=  $language_value . " ";
      }
    }
  }

  $custom['info'] = $produkt_object->field_info['und'][0]['value'];
  $custom['class'] = $produkt_object->field_class['und'][0]['value'];

  $custom['code'] = $produkt_object->field_code['und'][0]['value'];
?>

<?php if ($content['body']['#object']->language=="en") {?>
	<div id="node-<?php print $node->nid; ?>" class="prodoct-page <?php print $classes; ?>"<?php print $attributes; ?>>
		<div class="page-header">
			<?php print render($content['field_image']); ?>
		</div>
		<div class="title">
			<h3><?php echo $custom['title']; ?></h3>
		</div>
		<div class="content">
			<?php echo $custom['body']; ?>
		</div>

		<div class="info1">
    <?php if($custom['location']) { ?>
			<b class="label">Location :</b> <?php echo $custom['location']; ?>
    <?php } ?>
		</div>

		<div class="info2">
    <?php if($custom['price']) { ?>
			<b class="label">Price :</b> <?php echo $custom['price']; ?>
    <?php } ?>
		</div>

		<div class="info3">
    <?php if($custom['language']) { ?>
			<b class="label">Language :</b> <?php echo $custom['language']; ?>
    <?php } ?>
		</div>

		<div class="info4">
			<?php if($custom['info']) { ?>
				<b class="label">General Information</b><br/><?php echo $custom['info']; ?>
			<?php } ?>
		</div>

		<div class="info5">
      <?php if($custom['class']) { ?>
        <b class="label">Class : </b><?php echo $custom['class']; ?>
			<?php } ?>
		</div>

		<?php //print_r($content); ?>
		<div class="to-buy">
			<form action="/en/basket?option=add" method="post">
        <input type="hidden" name="code" value="<?php echo $custom['code']; ?>"/>
        <input type="hidden" name="price" value="<?php echo $custom['price']; ?>"/>
				<input type="hidden" name="title" value="<?php echo $custom['title']; ?>"/>
				<input type="hidden" name="url" value="<?php echo $variables['node_url']; ?>" />
				<?php
          // Risk: two products may have same code, which would cause missing order.
					$check = false;
					for($k=0;$k<count($_SESSION['basket']);$k++){
						if($custom['code']==$_SESSION['basket'][$k]['code']){
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
			<h3><?php echo $custom['title']; ?></h3>
		</div>
		<div class="content">
			<?php echo $custom['body']; ?>
		</div>

		<div class="info1">
    <?php if ($custom['location']) { ?>
			<b class="label">Ort :</b> <?php echo $custom['location']; ?>
    <?php } ?>
		</div>

		<div class="info2">
    <?php if ($custom['price']) { ?>
      <b class="label">Preis :</b> <?php echo $custom['price']; ?>
    <?php } ?>
		</div>

		<div class="info3">
      <?php if($custom['language']) { ?>
			<b class="label">Sprache :</b> <?php echo $custom['language']; ?>
      <?php } ?>
		</div>

		<div class="info4">
			<?php if($custom['info']) { ?>
				<b class="label">Hinweise</b> <br/>
				<?php echo $custom['info']; ?>
			<?php } ?>
		</div>

		<div class="info5">
      <?php if($custom['class']) { ?>
        <b class="label">Klasse :</b> <?php echo $custom['class']; ?>
			<?php } ?>
		</div>

		<div class="to-buy">
			<form action="/de/korb?option=add" method="post">
				<input type="hidden" name="code" value="<?php echo $custom['code']; ?>" />
        <input type="hidden" name="price" value="<?php echo $custom['price']; ?>"/>
				<input type="hidden" name="title" value="<?php echo $custom['title']; ?>"/>
				<input type="hidden" name="url" value="<?php echo $variables['node_url']; ?>" />
				<?php
          // Risk: two products may have same code, which would cause missing order.
					$check = false;
					for($k=0;$k<count($_SESSION['basket']);$k++){
						if($custom['code']==$_SESSION['basket'][$k]['code']){
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
