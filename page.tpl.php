<?php
/*$page['help']: Dynamic help text, mostly for admin pages.
$page['highlighted']: Items for the highlighted content region.
$page['content']: The main content of the current page.
$page['sidebar_first']: Items for the first sidebar.
$page['sidebar_second']: Items for the second sidebar.
$page['header']: ONLY for Slider.
$page['footer']:*/
?>

<!-- container -->
<div id="container">

	<div id="header">
		<div class="header mainpage clearfix">
		<div class="logozone">
			<div class="left">
				<a href ="/"><img src="/sites/all/themes/ptt/img/logo.png"></a>
			</div>
			<div class="center">
				<?php print render($page['head_menu']); ?>
			</div>
			<div class="right"></div>
		</div>
		</div>
		<div class="subheader mainpage clearfix">
			<div class="headzone">
			<?php print render($page['header']); ?>
			</div>
		</div><!-- subheader -->
	</div><!-- header -->

	<div id="middle">

			<div class="bg-breadcrumb <?php print $green; print $front; ?>">
				<div class="mainpage clearfix">
					<div class="head-info">
						<div class="country">
              <?php if ($page['head_country']){
                print render($page['head_country']);
              } ?>
						</div>
		      <div class="preface">
              <?php print render($page['preface']) ?>
          </div>
						<?php if ($display_breadcrumb) { print($breadcrumb); } ?>
					</div>
				</div>
			</div><!-- bg-breadcrumb -->

		<div class="mainpage clearfix">
			<div class="maincontent clearfix">
				<div class="contentleft">
				<?php print $messages; ?>
				<?php if ($tabs = render($tabs)){ ?>
					<div class="tabs"><?php print $tabs; ?></div>
				<?php }?>
				<?php print render($page['help']); ?>
				<?php if ($action_links){ ?>
					<ul class="action-links"><?php print render($action_links); ?></ul>
				<?php } ?>

				<?php if(!$is_front) { print render($page['content']); } ?>
				<?php print render($page['content_bottom']); ?>
				</div>
				<div class="contentright">
					<?php print render($page['sidebar_first']); ?>
					<?php print render($page['sidebar_second']); ?>
				</div>
			</div><!-- maincontent clearfix -->
		</div><!-- mainpage clearfix -->

	 </div><!-- middle -->

	<div id="footer">
		<div class="mainpage">
			<?php print render($page['footer']); ?>
			<?php print render($page['bottom']); ?>
      <div class="footer-right" style="float:right; margin-top: 3px;">
      <a href="http://www.borsch.net/" target="_blank" style="font-size: 12px;opacity:0.4;">by BORSCH.NET</a>
      </div>
		</div>
	</div><!-- footer -->

</div><!-- container -->
