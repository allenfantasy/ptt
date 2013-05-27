		<link rel="stylesheet" type="text/css" href="/sites/all/themes/ptt/css/jquery.kwicks.css" />
		<script src="/sites/all/themes/ptt/js/jquery-1.8.1.min.js" type="text/javascript"></script>
		<script src="/sites/all/themes/ptt/js/jquery.easing.1.3.js" type="text/javascript"></script>
		<script src="/sites/all/themes/ptt/js/jquery.kwicks.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$().ready(function() {
				$('.kwicks').kwicks({
					size: 190,
					maxSize: 850,
					spacing: 0,
					behavior: 'menu'
				});
			});
		</script>
<?php


for ($i=0;$i<5;$i++){
	$infos[$i]['body']=$variables['view']->style_plugin->rendered_fields[$i]['body'];
	$infos[$i]['bild']=$variables['view']->style_plugin->rendered_fields[$i]['field_image'];
	$infos[$i]['link']=$variables['view']->style_plugin->rendered_fields[$i]['field_linl'];
}
?>

		<div class="kwick-page">
			<ul class="kwicks kwicks-horizontal kwicks-processed" >
			<?php for($j=0; $j<=4; $j++) { ?>
				<li id="panel-<?php print $j+1; ?>">
					<div class="kwick-einz">
            <div class="kwick-einz-bild">
              <a href=<?php print $infos[$j]['link']; ?>><?php print $infos[$j]['bild']; ?></a>
            </div>
						<div class="klick-einz-text">
							<?php print $infos[$j]['body']; ?>
            </div>
          </div>
				</li>
			<?php } ?>
      </ul>
		</div>
