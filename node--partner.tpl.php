<?php //if ($content['body']['#object']->language=="en") {?>
	<div id="node-<?php print $node->nid; ?>" class="partner-page <?php print $classes; ?>"<?php print $attributes; ?>>
		<div class="title">
			<h3><?php echo $content['body']['#object']->title; ?></h3>
		</div>			
		<div class="content">
			<!--<div class="value">-->
			<?php echo $content['body']['#object']->body['und'][0]['value']; ?>
			<!--</div>-->
		</div>
		<div class="affiliate">
			<?php $value = html_entity_decode($content['body']['#object']->field_affiliate_code['und'][0]['value']); ?>
			<?php //$value = $content['body']['#object']->field_affiliate_code['und'][0]['value']; ?>
			<?php echo $value; ?>
		</div>	
		
		<?php if ($content['body']['#object']->field_iframe_links['und'][0]['value']) { ?>
			<?php if( substr_count($content['body']['#object']->field_iframe_links['und'][0]['value'], 'script')) { ?>
				<div class="iframe"?>
					<?php print $content['body']['#object']->field_iframe_links['und'][0]['value']; ?>
				</div>
			<?php } else { ?>
				<div class="iframe">
					<iframe src='<?php print $content['body']['#object']->field_iframe_links['und'][0]['value']?>' ></iframe>
					<?php //print $content['body']['#object']->field_iframe_links['und'][0]['value'] ?>		
				</div>
			<?php } ?>
		<?php } ?>
	</div>
<?php //}else{ ?>
<?php //} ?>
