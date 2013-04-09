<?php
// $Id: node.tpl.php,v 1.4.2.1 2009/08/10 10:48:33 goba Exp $

/**
 * @file node.tpl.php
 *
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $picture: The authors picture of the node output from
 *   theme_user_picture().
 * - $date: Formatted creation date (use $created to reformat with
 *   format_date()).
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $submitted: themed submission information output from
 *   theme_node_submitted().
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $teaser: Flag for the teaser state.
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 */
?>
<?php
	$thank_msg = 'Vielen Dank!<br/>Wir werden Sie so schnell wie m&ouml;glich informieren';
	$print_text = 'Drucken';
	$page_not_found = 'Seite wurde nicht gefunden';

	include_once(drupal_get_path('module', 'webform') .'/includes/webform.submissions.inc');
	$nid = arg(1); // need to hard-code nid if this is a custom page
	$sid = $_GET['sid'];
	$submission = webform_get_submission($nid, $sid);

	$infos_name = $submission->data[1]['value'][0];	
	$infos_email = $submission->data[2]['value'][0];
	$infos[0]= $submission->data[3]['value'][0];
	$infos[1] = $submission->data[4]['value'][0];
	$infos[2] = $submission->data[5]['value'][0];
	$infos[3] = $submission->data[6]['value'][0];
	$infos[4] = $submission->data[7]['value'][0];
	$infos[5] = $submission->data[8]['value'][0];
	$infos[6] = $submission->data[9]['value'][0];
	$infos[7] = $submission->data[10]['value'][0];
	$infos[8] = $submission->data[11]['value'][0];
	$infos[9] = $submission->data[12]['value'][0];

?>

<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?> clear-block">
	<?php if ($submission->remote_addr==$_SERVER['REMOTE_ADDR']){?>
  		<div class="content">
			<!--<pre>
				<?php //print_r($submission); ?>
			</pre>-->
			<h2><?php print $thank_msg; ?></h2>
			<div class="name">
				<label>Name : </label><?php print $infos_name; ?><br/>
			</div>
			<div class="email">
				<label>Email : </label><?php print $infos_email; ?><br/>
			</div>
			<div class="basket">
				<label>Produkte : </label><br />
				<?php 
					for($i = 0 ; $i <count($_SESSION['basket']) ; $i++){
						print '<span>' .  $_SESSION['basket'][$i]['title'] . '</span>' ;
						print '<span class="price">' . 'preis : '. $_SESSION['basket'][$i]['title'] . '</span>' . '<br/>';
					} 
				?>
			</div>

			<?php unset($_SESSION['basket']); ?>

			<div class="print-confirm">
				<a HREF="javascript:window.print()"><?php print $print_text; ?></a>	
			</div>
  		</div>
	<?php }else{ ?>
		<div class="content">
			<h2><?php print $page_not_found; ?></h2>
		</div>
	<?php } ?> 
	<pre>
		<?php //print $_SERVER['REMOTE_ADDR']; ?>
		<?php //print_r ($submission); ?>
	</pre>
	<?php print $picture ?>

	<?php if (!$page): ?>
	  <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
	<?php endif; ?>

	<div class="meta">
		<?php if ($submitted): ?>
	   		<span class="submitted"><?php print $submitted ?></span>
  		<?php endif; ?>

  		<?php if ($terms): ?>
    		<div class="terms terms-inline"><?php //print $terms ?></div>
  		<?php endif;?>
  	</div>

	<?php // print $links; ?>
</div>







