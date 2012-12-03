<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {
  // This gets the theme name from the stylesheet
  $themename = get_option( 'stylesheet' );
  $themename = preg_replace("/\W/", "_", strtolower($themename) );

  $optionsframework_settings = get_option('optionsframework');
  $optionsframework_settings['id'] = $themename;
  update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

  // Pull all the categories into an array
  $options_categories = array();
  $options_categories_obj = get_categories();
  foreach ($options_categories_obj as $category) {
      $options_categories[$category->cat_ID] = $category->cat_name;
  }

  // Pull all the tags into an array
  $options_tags = array();
  $options_tags_obj = get_tags( array('hide_empty' => false) );
  $options_tags[''] = __( 'Select a tag:', 'basestation' );
  foreach ($options_tags_obj as $tag) {
      $options_tags[$tag->term_id] = $tag->name;
  }

  // Pull all the pages into an array
  $options_pages = array();
  $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
  $options_pages[''] = __( 'Select a page:', 'basestation' );
  foreach ($options_pages_obj as $page) {
      $options_pages[$page->ID] = $page->post_title;
  }

  // If using image radio buttons, define a directory path
  $imagepath =  get_bloginfo('stylesheet_directory') . '/img/';

  $options = array();

  // Display Settings tab
  $options[] = array(
      'name' => __( 'Display Options', 'basestation' ),
      'type' => 'heading'
    );


  // Navigation elements
  $options[] = array(
      'name' => __( 'Navigation Elements', 'basestation' ),
      'desc' => __( 'Top navbar, breadcrumb navigation, and content navigation design options', 'basestation' ),
      'type' => 'info'
    );

  /* $options[] = array( 'name' => "Show logo image in Top Menu navigation bar?",
            'desc' => "Check this box to show a logo image in the Top Menu navigation bar. Upload your logo image below. Default is disabled.",
            'id' => "basestation_logo_in_navbar",
            'std' => '0',
            'type' => 'checkbox');

  $options[] = array( 'name' => "Upload a logo image for the Top Menu navigation bar.",
            'desc' => "Upload an image to use as a logo image in the Top Menu navigation bar. Note: You must enable the option above for this image to be displayed. FOR BEST RESULTS: upload an image that isn't too large.",
            'id' => "basestation_logo_in_navbar_file",
            'type' => "upload"); */

  $options[] = array(
      'name' => __( 'Show Top Menu navigation bar?', 'basestation' ),
      'desc' => __( 'Displays the top navbar on your site, even if there\'s no menu assigned in Appearance > Menu. Uncheck this box to hide it. Default is enabled.', 'basestation' ),
      'id'   => 'basestation_show_top_navbar',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Show site name in Top Menu navigation bar?', 'basestation' ),
      'desc' => __( 'Default is enabled. Uncheck this box to hide site name in Top Menu navigation bar.', 'basestation' ),
      'id'   => 'basestation_name_in_navbar',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Show Breadcrumb Navigation?', 'basestation' ),
      'desc' => __( 'Default is show. Uncheck this box to hide breadcrumbs.', 'basestation' ),
      'id'   => 'basestation_breadcrumbs',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Show content navigation above posts?', 'basestation' ),
      'desc' => __( 'Displays links to next and previous posts above the current post and above the posts on the index page. Default is hide. Check this box to show content nav above posts.', 'basestation' ),
      'id'   => 'basestation_content_nav_above',
      'std'  => '0',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Show content navigation below posts?', 'basestation' ),
      'desc' => __( 'Displays links to next and previous posts below the current post and below the posts on the index page. Default is show. Uncheck this box to hide content nav above posts.', 'basestation' ),
      'id'   => 'basestation_content_nav_below',
      'std'  => '1',
      'type' => 'checkbox'
    );

  // Miscellaneous text options
  $options[] = array(
      'name' => __( 'Miscellaneous Text', 'basestation' ),
      'desc' => __( 'Miscellaneous text items, such as site name and description and custom footer text.', 'basestation' ),
      'type' => 'info'
    );

  $options[] = array(
      'name' => __( 'Show custom footer text?', 'basestation' ),
      'desc' => __( 'Default is disabled. Check this box to use custom footer text. Fill in your text below.', 'basestation' ),
      'id'   => 'basestation_custom_footer_toggle',
      'std'  => '0',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Custom footer text', 'basestation' ),
      'desc' => __( 'Enter the text here that you would like displayed at the bottom of your site. This setting will be ignored if you do not enable "Show custom footer text" above.', 'basestation' ),
      'id'   => 'basestation_custom_footer_text',
      'std'  => '',
      'type' => 'text'
    );

  $options[] = array(
      'name' => __( 'Posts and Pages', 'basestation' ),
      'desc' => __( 'Options related to the display of posts and pages, like excerpts and post meta information (published date, author, categories, and tags - is displayed on each post to provide your readers with information). Use the options below to control what is displayed.', 'basestation' ),
      'type' => 'info'
    );

  $options[] = array(
      'name'    => __( 'Display full content or excerpts on index, search, and archive type pages?', 'basestation' ),
      'desc'    => __( 'Excerpt shows a short snippet of your post, and full content shows it all. The default setting is Show entire post.', 'basestation' ),
      'id'      => 'basestation_archive_display',
      'std'     => 'full',
      'type'    => 'radio',
      'options' => array(
          'full'    => __( 'Show entire post', 'basestation' ),
          'excerpt' => __( 'Show post excerpt', 'basestation' )
      )
    );

  $options[] = array(
      'name' => __( 'Show post author?', 'basestation' ),
      'desc' => __( 'Displays the post author. Default is show. Uncheck this box to hide the post author.', 'basestation' ),
      'id'   => 'basestation_post_author',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Show published date?', 'basestation' ),
      'desc' => __( 'Displays the date the article was posted. Default is show. Uncheck this box to hide post published date.', 'basestation' ),
      'id'   => 'basestation_published_date',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Show post categories?', 'basestation' ),
      'desc' => __( 'Displays the categories in which a post was published. Default is show. Uncheck this box to hide post categories.', 'basestation' ),
      'id'   => 'basestation_post_categories',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Show post categories on the index/posts page?', 'basestation' ),
      'desc' => __( 'Displays the post categories on the index/posts page - as defined in Settings > Reading. Default is show. Uncheck this box to hide post categories on the index/posts page.', 'basestation' ),
      'id'   => 'basestation_post_categories_posts_page',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Show post tags?', 'basestation' ),
      'desc' => __( 'Displays the tags attached to a post. Default is show. Uncheck this box to hide post tags.', 'basestation' ),
      'id'   => 'basestation_post_tags',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Show post tags on the index/posts page?', 'basestation' ),
      'desc' => __( 'Displays the post tags on the index/posts page - as defined in Settings > Reading. Default is show. Uncheck this box to hide post tags on the index/posts page.', 'basestation' ),
      'id'   => 'basestation_post_tags_posts_page',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Show link for # of comments / Leave a comment?', 'basestation' ),
      'desc' => __( 'Displays the number of comments and/or a Leave a comment message on posts. Default is show. Uncheck this box to hide.' ,'basestation' ),
      'id'   => 'basestation_post_comments_link',
      'std'  => '1',
      'type' => 'checkbox'
    );


  // Featured Posts tab
  $options[] = array(
      'name' => __( 'Featured Posts', 'basestation' ),
      'type' => 'heading'
    );

  $options[] = array(
      'name' => __( 'Featured Posts Information', 'basestation' ),
      'desc' => __( 'This feature displays certain posts in a photo slider or in a block grid at the top of your post index. This is a good way to make special content stand out. You can feature any post here, according to the criteria you choose below. Don\'t forget to assign featured images to your posts in the post editor!', 'basestation' ),
      'type' => 'info'
    );

  $options[] = array(
      'name' => __( 'Enable Featured Posts?', 'basestation' ),
      'desc' => __( 'Check this box to turn on featured posts functionality. Set the options below to determine how your featured posts will work. Default is disabled.', 'basestation' ),
      'id'   => 'basestation_featured_posts',
      'std'  => '0',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name'    => __( 'Display Featured Posts in a slider or in a grid?', 'basestation' ),
      'desc'    => __( 'Displays your featured posts in either a photo slider or a block grid. The default setting is Slider.', 'basestation' ),
      'id'      => 'basestation_featured_posts_display_type',
      'std'     => '1',
      'type'    => 'radio',
      'options' => array(
          '1' => __( 'Slider', 'basestation' ),
          '0' => __( 'Grid', 'basestation' )
      )
    );

  $options[] = array(
      'name'    => __( 'Featured Posts Tag', 'basestation' ),
      'desc'    => __( 'The tag you select here determines which posts show in the featured posts slider or grid. Example: if you were to select the moo tag, posts tagged with moo would be displayed. Don\'t forget to attach your featured images in the post editor!', 'basestation' ),
      'id'      => 'basestation_featured_posts_tag',
      'type'    => 'select',
      'class'   => 'mini',
      'options' => $options_tags
    );

  $options[] = array(
      'name'    => __( 'Maximum # of Featured Posts to display', 'basestation' ),
      'desc'    => __( 'Select the maximum number of posts you want to display in the featured posts slider or grid. The default is three. NOTE: The grid displays two posts per row. For best results, select an even number here.', 'basestation' ),
      'id'      => 'basestation_featured_posts_maxnum',
      'std'     => '3',
      'type'    => 'radio',
      'options' => array(
          '1' => __( 'One', 'basestation' ),
          '2' => __( 'Two', 'basestation' ),
          '3' => __( 'Three', 'basestation' ),
          '4' => __( 'Four', 'basestation' ),
          '5' => __( 'Five', 'basestation' ),
          '6' => __( 'Six', 'basestation' )
      )
    );

  $options[] = array(
      'name'    => __( 'Duplicate featured posts' ,'basestation' ),
      'desc'    => __( 'Show posts from the featured content section in the rest of the body. Default is Hide.', 'basestation' ),
      'id'      => 'basestation_featured_posts_show_dupes',
      'std'     => '0',
      'type'    => 'radio',
      'options' => array(
          '1' => __( 'Show duplicate posts', 'basestation' ),
          '0' => __( 'Hide duplicate posts', 'basestation' )
      )
    );

  $options[] = array(
      'name' => __( 'Featured Posts Images', 'basestation' ),
      'desc' => __( 'A note about images: For best results, all of your images should be the same size (preferably the size you set below). If they are not the same size, your content will not look as good. For example: the photo slider will display images of varying sizes, but when it does the slider resizes itself between each slide. The grid will not display evenly if images are different sizes.', 'basestation' ),
      'type' => 'info'
    );

  $options[] = array(
      'name'  => __( 'Featured post image width', 'basestation' ),
      'desc'  => __( 'Enter the width (in pixels) you want the featured images to be. Default is 745 pixels.', 'basestation' ),
      'id'    => 'basestation_featured_posts_image_width',
      'std'   => '745',
      'class' => 'mini',
      'type'  => 'text'
    );

  $options[] = array(
      'name'  => __( 'Featured post image height', 'basestation' ),
      'desc'  => __( 'Enter the height (in pixels) you want the featured images to be. Default is 350 pixels.', 'basestation' ),
      'id'    => 'basestation_featured_posts_image_height',
      'std'   => '350',
      'class' => 'mini',
      'type'  => 'text'
    );


  /* Theme plugin heading */
  /*
  $options[] = array(
      'name' => __( 'Theme Plugins', 'basestation' ),
      'type' => 'heading'
    );

  $options[] = array(
      'name' => __( 'Javascript Plugins Information', 'basestation' ),
      'desc' => __( 'Read the description provided with each plugin. Some of these plugins require another plugin to function properly (Example: Carousel requires Transitions for the animation to work). Disable any plugins that you aren\'t using.', 'basestation' ),
      'type' => 'info'
    );

  $options[] = array(
      'name' => __( 'Transitions' ),
      'desc' => __( 'Transitions are used to animate things such as the carousel, modals, fade out alerts, etc. * Required for animation in plugins.', 'basestation' ),
      'id'   => 'basestation_transitions_plugin',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Alerts', 'basestation' ),
      'desc' => __( 'The alert plugin is a tiny class for adding close functionality to alerts. * Requires Transitions if you want them to fade out on close.', 'basestation' ),
      'id'   => 'basestation_alerts_plugin',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Modals', 'basestation' ),
      'desc' => __( 'Message boxes that slide down and fade in from the top of the page. Default setting is disabled. * Requires Transitions to function properly.', 'basestation' ),
      'id'   => 'basestation_modals_plugin',
      'std'  => '0',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Dropdown Menus', 'basestation' ),
      'desc' => __( 'Add dropdown menus in the navbar, tabs, and pills.', 'basestation' ),
      'id'   => 'basestation_dropdowns_plugin',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Affix Menus', 'basestation' ),
      'desc' => __( 'Add support for affix menus. Default is disabled.', 'basestation' ),
      'id'   => 'basestation_affix_plugin',
      'std'  => '0',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Scrollspy', 'basestation' ),
      'desc' => __( 'Use scrollspy to automatically update the links in your navbar to show the current active link based on scroll position. Default setting is disabled.', 'basestation' ),
      'id'   => 'basestation_scrollspy_plugin',
      'std'  => '0',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Tabs', 'basestation' ),
      'desc' => __( 'Make tabs and pills more useful by allowing them to toggle through tabbable panes of content.', 'basestation' ),
      'id'   => 'basestation_tabs_plugin',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Tooltips', 'basestation' ),
      'desc' => __( 'Tooltips that use CSS3 for animations and data-attributes for local title storage.', 'basestation' ),
      'id'   => 'basestation_tooltips_plugin',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Popovers', 'basestation' ),
      'desc' => __( 'Add small overlays of content, like those on the iPad, to any element for housing secondary information. * Requires Tooltips.', 'basestation' ),
      'id'   => 'basestation_popovers_plugin',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Buttons', 'basestation' ),
      'desc' => __( 'Do more with buttons. Control button states or create groups of buttons for more components like toolbars.', 'basestation' ),
      'id'   => 'basestation_buttons_plugin',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Collapse', 'basestation' ),
      'desc' => __( 'Get base styles and flexible support for collapsible components like accordions and navigation.', 'basestation' ),
      'id'   => 'basestation_collapse_plugin',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Carousel', 'basestation' ),
      'desc' => __( 'Create a merry-go-round of any content you wish to provide in an interactive slideshow of content. * Required for Featured Posts.', 'basestation' ),
      'id'   => 'basestation_carousel_plugin',
      'std'  => '1',
      'type' => 'checkbox'
    );

  $options[] = array(
      'name' => __( 'Typeahead', 'basestation' ),
      'desc' => __( 'A basic, easily extended plugin for quickly creating elegant typeaheads with any form text input. Default setting is disabled.', 'basestation' ),
      'id'   => 'basestation_typeahead_plugin',
      'std'  => '0',
      'type' => 'checkbox'
    );
*/

  return $options;

}