<?php
/**
 * This is the main/default page template.
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://manual.b2evolution.net/Skins_2.0}
 *
 * It is used to display the blog when no specific page template is available to handle the request.
 *
 * @package evoskins
 * @subpackage integral
 *
 * Skin made by Larry Nieves, aka El Cardenalero, aka El Liberal Venezolano
 * aka 315Web <lnieves@315-web.com>
 * Design by Free CSS Templates
 * http://www.freecsstemplates.org
 * Released for free under a Creative Commons Attribution 2.5 License
 */

if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

// This is the main template; it may be used to display very different things.
// Do inits depending on current $disp:
skin_init( $disp );


// -------------------------- HTML HEADER INCLUDED HERE --------------------------
skin_include( '_html_header.inc.php' );
// Note: You can customize the default HTML header by copying the
// _html_header.inc.php file into the current skin folder.
// -------------------------------- END OF HEADER --------------------------------
?>
<div id="header"><!-- Begins header -->

<?php
/* "Page Top" Container embedded here
 * Display container and contents
 */
skin_container( NT_( 'Page Top' ), array( // The following params will be used as defaults for widgets included in this container:
	'block_start' => 					'<div class="$wi_class$">',
	'block_end' => 						'</div>',
	'block_display_title' =>	false,
	'list_start' =>						'<ul id="menu">',
	'list_end' =>							'</ul>',
	'item_start' =>						'<li>',
	'item_end'	=>						'</li>',
) ) ;
				if ( true /* change to false to hide the blog list */ ) { ?>
				<?php
				  // START OF BLOG LIST
				  skin_widget( array(
						'widget' => 'colls_list_public',
						'block_start' => '',
						'block_end' => '',
						'block_display_title' => false,
	'list_start' =>						'<ul id="menu">',
	'list_end' =>							'</ul>',
	'item_start' =>						'<li>',
	'item_end'	=>						'</li>',
						'item_selected_start' => '<span class="selected">',
						'item_selected_end' => '</span>',
					  ) );
				?>
				<?php } 
/* Ends "Page Top" Container
 */
?>
<div id="search">
	  <?php 
	  skin_widget( array(
		// CODE for the widget:
		'widget' => 'coll_search_form',
		// Optional display params
		'block_start' => '',
		'block_end' => '',
		'block_display_title' => false,
		'disp_search_options' => 0,
		'search_class' => 'extended_search_form',
		'use_search_disp' => 0,
	) );
	?>
	</div>
</div><!-- Ends header -->

<div id="content"><!-- Begins content -->
	<div id="colOne"><!-- Begins colOne -->
    <div id="logo"><!-- Begins logo -->
      <h1><?php blog_home_link( '', '', $Blog->get_name() ); ?></h1>
      <h2><?php $Blog->tagline( ) ; ?></h2>
    </div><!-- ends logo -->
<?php
/* "Sidebar" Container embedded here
 * Display container and contents
 */
skin_container( NT_( 'Sidebar' ), array( // The following params will be used as defaults for widgets included in this container:
	'block_start' => 					'<div class="bSideItem $wi_class$">',
	'block_end' => 						'</div>',
	'block_title_start' =>		'<h3>',
	'block_title_end' =>			'</h3>',
	'list_start' =>						'<ul class="bottom">',
	'list_end' =>							'</ul>',
	'item_start' =>						'<li>',
	'item_end'	=>						'</li>',
) ) ;
/* Ends "Sidebar" Container
 */
?>
	<p class="center"><!-- Please help us promote b2evolution and leave this link on your blog. --><a href="http://b2evolution.net/" title="b2evolution: next generation blog software"><img src="../../rsc/img/powered-by-b2evolution-120t.gif" alt="powered by b2evolution free blog software" title="b2evolution: next generation blog software" width="120" height="32" border="0" /></a></p>
	</div><!-- Ends colOne -->

<!-- =================================== START OF MAIN AREA =================================== -->
	<div id="colTwo"><!-- Begins colTwo -->
	<?php
		// ------------------------- MESSAGES GENERATED FROM ACTIONS -------------------------
		messages( array(
				'block_start' => '<div class="action_messages">',
				'block_end'   => '</div>',
			) );
		// --------------------------------- END OF MESSAGES ---------------------------------
	?>

	<?php
		// ------------------- PREV/NEXT POST LINKS (SINGLE POST MODE) -------------------
		item_prevnext_links( array(
				'block_start' => '<table class="prevnext_post"><tr>',
				'prev_start'  => '<td>',
				'prev_end'    => '</td>',
				'next_start'  => '<td class="right">',
				'next_end'    => '</td>',
				'block_end'   => '</tr></table>',
			) );
		// ------------------------- END OF PREV/NEXT POST LINKS -------------------------
	?>

	<?php
		// ------------------------ TITLE FOR THE CURRENT REQUEST ------------------------
		request_title( array(
				'title_before'=> '<h2>',
				'title_after' => '</h2>',
				'title_none'  => '',
				'glue'        => ' - ',
				'title_single_disp' => false,
				'format'      => 'htmlbody',
			) );
		// ----------------------------- END OF REQUEST TITLE ----------------------------
	?>

	<?php
		// -------------------- PREV/NEXT PAGE LINKS (POST LIST MODE) --------------------
		mainlist_page_links( array(
				'block_start' => '<p class="center">'.T_('Pages:').' <strong>',
				'block_end' => '</strong></p>',
			) );
		// ------------------------- END OF PREV/NEXT PAGE LINKS -------------------------
	?>

	<?php
		// --------------------------------- START OF POSTS -------------------------------------
		// Display message if no post:
		display_if_empty();

		while( $Item = & mainlist_get_item() )
		{	// For each blog post, do everything below up to the closing curly brace "}"
		?>

		<?php
			// ------------------------------ DATE SEPARATOR ------------------------------
			$MainList->date_if_changed( array(
					'before'      => '<h2>',
					'after'       => '</h2>',
					'date_format' => '#',
				) );
		?>

			<div id="<?php $Item->anchor_id() ?>" class="bPost bPost<?php $Item->status_raw() ?> box" lang="<?php $Item->lang() ?>">

			<?php
				$Item->locale_temp_switch(); // Temporarily switch to post locale (useful for multilingual blogs)
			?>

				<div class="bSmallHead"><!-- begins bSmallHead -->
				<?php
				// Permalink:
					$Item->permanent_link( array(
						'text' => '#icon#',
					) );

					$Item->issue_time( array(
						'before'    => ' ',
						'after'     => '',
					));

					$Item->author( array(
						'before'    => ', '.T_('by').' <strong>',
						'after'     => '</strong>',
					) );

					$Item->msgform_link();
          echo ', ';

          $Item->wordcount();
          echo ' '.T_('words');
          echo ', ';
          $Item->views();

          $Item->locale_flag( array(
						'before'    => ' &nbsp; ',
						'after'     => '',
					) );
        ?>
        <br />

        <?php
          $Item->categories( array(
            'before'          => T_('Categories').': ',
            'after'           => ' ',
            'include_main'    => true,
            'include_other'   => true,
            'include_external'=> true,
            'link_categories' => true,
          ) );
        ?>
        </div><!-- ends bSmallHead -->

        <h3 class="bTitle"><?php $Item->title(); ?></h3>

        <?php
          // ---------------------- POST CONTENT INCLUDED HERE ----------------------
          skin_include( '_item_content.inc.php', array(
						'image_size'	=>	'fit-400x320',
					) );
          // Note: You can customize the default item feedback by copying the generic
          // /skins/_item_feedback.inc.php file into the current skin folder.
          // -------------------------- END OF POST CONTENT -------------------------
        ?>

        <?php
          // List all tags attached to this post:
          $Item->tags( array(
						'before' =>         '<div class="bSmallPrint">'.T_('Tags').': ',
						'after' =>          '</div>',
						'separator' =>      ', ',
					) );
        ?>

        <div class="bSmallPrint"><!-- begins bSmallPrint -->
				<?php
					// Permalink:
					$Item->permanent_link( array(
							'class' => 'permalink_right',
						) );

					// Link to comments, trackbacks, etc.:
					$Item->feedback_link( array(
									'type' => 'comments',
									'link_before' => '',
									'link_after' => '',
									'link_text_zero' => '#',
									'link_text_one' => '#',
									'link_text_more' => '#',
									'link_title' => '#',
									'use_popup' => false,
								) );

					// Link to comments, trackbacks, etc.:
					$Item->feedback_link( array(
									'type' => 'trackbacks',
									'link_before' => ' &bull; ',
									'link_after' => '',
									'link_text_zero' => '#',
									'link_text_one' => '#',
									'link_text_more' => '#',
									'link_title' => '#',
									'use_popup' => false,
								) );

					$Item->edit_link( array( // Link to backoffice for editing
							'before'    => ' &bull; ',
							'after'     => '',
						) );
        ?>
        </div><!-- ends bSmallPrint -->

        <?php
          // ------------------ FEEDBACK (COMMENTS/TRACKBACKS) INCLUDED HERE ------------------
          skin_include( '_item_feedback.inc.php', array(
						'before_section_title' => '<h4>',
						'after_section_title'  => '</h4>',
					) );
          // Note: You can customize the default item feedback by copying the generic
          // /skins/_item_feedback.inc.php file into the current skin folder.
          // ---------------------- END OF FEEDBACK (COMMENTS/TRACKBACKS) ---------------------
        ?>

        <?php
          locale_restore_previous();	// Restore previous locale (Blog locale)
        ?>
      </div><!-- ends bPost -->
		<?php
		} // ---------------------------------- END OF POSTS ------------------------------------
    ?>

    <?php
      // -------------------- PREV/NEXT PAGE LINKS (POST LIST MODE) --------------------
      mainlist_page_links( array(
				'block_start' => '<p class="center"><strong>',
				'block_end' => '</strong></p>',
   			'prev_text' => '&lt;&lt;',
   			'next_text' => '&gt;&gt;',
			) );
      // ------------------------- END OF PREV/NEXT PAGE LINKS -------------------------
    ?>


    <?php
      // -------------- MAIN CONTENT TEMPLATE INCLUDED HERE (Based on $disp) --------------
      skin_include( '$disp$', array(
				'disp_posts'  => '',		// We already handled this case above
				'disp_single' => '',		// We already handled this case above
				'disp_page'   => '',		// We already handled this case above
			) );
      // Note: you can customize any of the sub templates included here by
      // copying the matching php file into your skin directory.
      // ------------------------- END OF MAIN CONTENT TEMPLATE ---------------------------
    ?>
	</div><!-- ends colTwo -->
  
<?php
// ------------------------- BODY FOOTER INCLUDED HERE --------------------------
skin_include( '_body_footer.inc.php' );
// Note: You can customize the default BODY footer by copying the
// _body_footer.inc.php file into the current skin folder.
// ------------------------------- END OF FOOTER --------------------------------
?>

<?php
// ------------------------- HTML FOOTER INCLUDED HERE --------------------------
skin_include( '_html_footer.inc.php' );
// Note: You can customize the default HTML footer by copying the
// _html_footer.inc.php file into the current skin folder.
// ------------------------------- END OF FOOTER --------------------------------
/* vi: ts=2 sw=2 et fenc=utf-8 nu
 */
?>
