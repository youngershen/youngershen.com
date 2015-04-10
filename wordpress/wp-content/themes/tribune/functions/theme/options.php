<?php
return array(
    
    /* Theme Admin Menu */
    "menu" => array(
        array(
            "id" => "1",
            "name" => "General"
        ),
        
        array(
            "id" => "2",
            "name" => "Homepage"
        ),
        
        array(
            "id" => "7",
            "name" => "Banners"
        )
    ),
    
    /* Theme Admin Options */
    "id1" => array(
        array(
            "type" => "preheader",
            "name" => "Theme Settings"
        ),
        
        array(
            "name" => "Logo Image",
            "desc" => "Upload a custom logo image for your site, or you can specify an image URL directly.",
            "id" => "misc_logo_path",
            "std" => "",
            "type" => "upload"
        ),
        
        array(
            "name" => "Footer Logo Image",
            "desc" => "Upload a custom footer logo image for your site, or you can specify an image URL directly.",
            "id" => "misc_footerlogo_path",
            "std" => "",
            "type" => "upload"
        ),
        
        array(
            "name" => "Favicon URL",
            "desc" => "Upload a favicon image (16&times;16px).",
            "id" => "misc_favicon",
            "std" => "",
            "type" => "upload"
        ),
        
        array(
            "name" => "Custom Feed URL",
            "desc" => "Example: <strong>http://feeds.feedburner.com/wpzoom</strong>",
            "id" => "misc_feedburner",
            "std" => "",
            "type" => "text"
        ),
        
        array(
            "name" => "Show Date in the header",
            "id" => "header_date_show",
            "std" => "on",
            "type" => "checkbox"
        ),
    
        
        array(
            "type" => "preheader",
            "name" => "Header Icons"
        ),
        
        array(
            "type" => "startsub",
            "name" => "RSS Icon"
        ),
        
	        array(
	            "name" => "Display RSS Icon",
	            "desc" => "Display RSS icon in the header",
	            "id" => "head_rss_show",
	            "std" => "on",
	            "type" => "checkbox"
	        ),
	        
	        array(
	            "name" => "RSS Heading",
	            "desc" => "Example: <strong>Subscribe to RSS</strong>",
	            "id" => "social_rss_title",
	            "std" => "Subscribe to RSS",
	            "type" => "text"
	        ),
	        
        array(
            "type" => "endsub"
        ),
        
        
        array(
            "type" => "startsub",
            "name" => "Twitter Icon"
        ),
        
	        array(
	            "name" => "Display Twitter Icon",
	            "desc" => "Display Twitter Icon in the header",
	            "id" => "head_twitter_show",
	            "std" => "on",
	            "type" => "checkbox"
	        ),
	        
	        array(
	            "name" => "Twitter Username",
	            "desc" => "Your Twitter username<br /> Example:<strong> wpzoom</strong>",
	            "id" => "social_twitter",
	            "std" => "",
	            "type" => "text"
	        ),
	        
	        array(
	            "name" => "Twitter Heading",
	            "desc" => "Example: <strong>Follow us</strong>",
	            "id" => "social_twitter_title",
	            "std" => "Follow us",
	            "type" => "text"
	        ),
        
        array(
            "type" => "endsub"
        ),
        
        
        array(
            "type" => "startsub",
            "name" => "Facebook Icon"
        ),
        
	        array(
	            "name" => "Display Facebook Icon",
	            "desc" => "Display Facebook Icon in the header",
	            "id" => "head_facebook_show",
	            "std" => "on",
	            "type" => "checkbox"
	        ),
	        
	        array(
	            "name" => "Facebook URL",
	            "desc" => "Your Facebook URL<br /> Example:<strong> http://facebook.com/wpzoom</strong>",
	            "id" => "social_facebook",
	            "std" => "",
	            "type" => "text"
	        ),
	        
	        array(
	            "name" => "Facebook Heading",
	            "desc" => "Example: <strong>Facebook Page</strong>",
	            "id" => "social_facebook_title",
	            "std" => "Facebook Page",
	            "type" => "text"
	        ),
        
        array(
            "type" => "endsub"
        ),
        
        
        array(
            "type" => "preheader",
            "name" => "Global Posts Options"
        ),
        
        array(
            "name" => "Posts Display Type",
            "desc" => "The number of articles displayed on homepage can be changed <a href='options-reading.php' target='_blank'>here</a>.",
            "id" => "display_content",
            "options" => array(
                'Post Excerpts',
                'Full Content'
            ),
            "std" => "Post Excerpts",
            "type" => "select"
        ),
        
        array(
            "name" => "Excerpt Length",
            "desc" => "Default: <strong>50</strong> (words)",
            "id" => "excerpt_length",
            "std" => "50",
            "type" => "text"
        ),
        
        array(
            "name" => "Display Read More link",
            "id" => "display_readmore",
            "std" => "on",
            "type" => "checkbox"
        ),
        
        array(
            "type" => "startsub",
            "name" => "Thumbnails"
        ),
            
            array(
                "name" => "Display thumbnail",
                "id" => "index_thumb",
                "std" => "on",
                "type" => "checkbox"
            ),
            
            array(
                "name" => "Thumbnail Width (in pixels)",
                "desc" => "Default: <strong>216</strong> (pixels).",
                "id" => "thumb_width",
                "std" => "216",
                "type" => "text"
            ),
            
            array(
                "name" => "Thumbnail Height (in pixels)",
                "desc" => "Default: <strong>160</strong> (pixels)",
                "id" => "thumb_height",
                "std" => "160",
                "type" => "text"
            ),
        
        array(
            "type" => "endsub"
        ),
        
        array(
            "name" => "Display Date/Time",
            "desc" => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
            "id" => "display_date",
            "std" => "on",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "Display Comments Count",
            "id" => "display_comm_count",
            "std" => "on",
            "type" => "checkbox"
        ),

        
        array(
            "type" => "preheader",
            "name" => "Single Post Options"
        ),
        
        array(
            "name" => "Display Breadcrumb Navigation",
            "id" => "post_bread",
            "std" => "on",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "Display Date/Time",
            "desc" => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
            "id" => "post_date",
            "std" => "on",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "Display Comments Count",
            "id" => "post_comm_count",
            "std" => "on",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "Display Views Count",
            "id" => "post_views",
            "std" => "on",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "Display Tags",
            "id" => "post_tags",
            "std" => "on",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "Display Share Buttons",
            "id" => "post_share",
            "std" => "on",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "Display Author Bio",
            "desc" => "Display a box with information about post author.",
            "id" => "post_authorbio",
            "std" => "on",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "Display Comments",
            "id" => "post_comments",
            "std" => "on",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "Display Trackbacks",
            "id" => "post_trackbacks",
            "std" => "off",
            "type" => "checkbox"
        ),
        
        
        array(
            "type" => "preheader",
            "name" => "Sidebar Settings"
        ),
        
        array(
            "name" => "Sidebar Position",
            "id" => "sidebar_pos",
            "options" => array(
                'Right',
                'Left'
            ),
            "std" => "Right",
            "type" => "select"
        ),
        
        array(
            "name" => "Where do you want Footer Sidebar to appear?",
            "desc" => "If you want to hide this Sidebar, don't add to it any <a href='widgets.php' target='_blank'>Widgets</a>",
            "id" => "bottomside_placement",
            "options" => array(
                'Homepage only',
                'On all pages'
            ),
            "std" => "Homepage only",
            "type" => "select"
        )
    ),
    
    "id2" => array(
        
        array(
            "type" => "preheader",
            "name" => "Featured Articles"
        ),
        
        array(
            "name" => "Display Featured Posts Homepage",
            "desc" => "Edit the post which you want to feature, and check the box from editing page: <strong>Feature on Homepage</strong>",
            "id" => "feat_show",
            "std" => "on",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "Number of featured posts to display",
            "id" => "featured_art_number",
            "desc" => "How many posts should be displayed?",
            "options" => array(
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                '10'
            ),
            "std" => "4",
            "type" => "select"
        ),
        
        array(
            "name" => "Excerpt Length for Small Posts",
            "desc" => "Default: <strong>130</strong> (characters). Excerpt length for latest post can be changed in General -> Global Posts Options.",
            "id" => "featured_excerpt",
            "std" => "130",
            "type" => "text"
        ),
        
        array(
            "name" => "Date Format for Latest Featured",
            "id" => "featured_date_format",
            "options" => array(
                'time ago',
                'default'
            ),
            "desc" => "Default <strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
            "std" => "time ago",
            "type" => "select"
        ),
        
        
        array(
            "type" => "preheader",
            "name" => "Recent Posts"
        ),
        
        array(
            "name" => "Display Recent Posts on Homepage",
            "id" => "recent_posts",
            "std" => "on",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "Title for Recent Posts",
            "desc" => "Default: <em>Other News</em>",
            "id" => "recent_title",
            "std" => "Other News",
            "type" => "text"
        ),
        
        array(
            "name" => "Exclude categories",
            "desc" => "Choose the categories which should be excluded from the main Loop on the homepage.<br/><em>Press CTRL or CMD key to select/deselect multiple categories </em>",
            "id" => "recent_part_exclude",
            "std" => "",
            "type" => "select-category-multi"
        ),
        
        array(
            "name" => "Hide Featured Posts in Recent Posts?",
            "desc" => "You can use this option if you want to hide posts which are featured in the slider on front page.",
            "id" => "hide_featured",
            "std" => "off",
            "type" => "checkbox"
        ),
        
        
        array(
            "type" => "preheader",
            "name" => "Footer Slider"
        ),
        
        array(
            "name" => "Enable the &ldquo;<em>Other News</em>&rdquo; slider",
            "desc" => "The &ldquo;<em>Other News</em>&rdquo; slider will display posts from selected categories near the bottom of specified pages.",
            "id" => "slider_enable",
            "std" => "on",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "Slider Heading",
            "desc" => "Default: Other News.",
            "id" => "slider_head",
            "std" => "Other News",
            "type" => "text"
        ),
        
        array(
            "name" => "Slider Categories",
            "desc" => "Select the categories which you want to show in the slider. It could be a category named 'Featured'",
            "id" => "slider_cats",
            "std" => "",
            "type" => "select-category-multi"
        ),
        
        array(
            "name" => "Number of articles in Slider",
            "desc" => "Specify how many articles you would like to display in slider.",
            "id" => "slider_num_posts",
            "std" => "8",
            "type" => "text"
        ) 
        
    ),
    
    "id4" => array(
        array(
            "type" => "preheader",
            "name" => "Breaking News Box"
        ),
        
        array(
            "name" => "Show Breaking News Box",
            "id" => "alert_show",
            "std" => "off",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "Breaking News Box Text",
            "desc" => "Enter here HTML code.<br /> <br /><em>Example from demo:</em><br /><code>&lt;span&gt;Breaking News:&lt;/span&gt; Pellentesque velit nisl, sollicitudin eu pharetra sit amet, varius sollicitudin neque.</code>",
            "id" => "alert_content",
            "type" => "textarea"
        )
        
        
    ),
    
    "id7" => array(
        array(
            "type" => "preheader",
            "name" => "Header Ad"
        ),
        
        array(
            "name" => "Enable ad space in the header?",
            "id" => "ad_head_select",
            "std" => "off",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "HTML Code (Adsense)",
            "desc" => 'Enter complete HTML code for your banner (or Adsense code) or upload an image below. <br /><br /><em>Example from demo:</em><br /><code>&lt;div class="text"&gt;&lt;img src="http://www.wpzoom.com/img/ipad.png" alt="image" /&gt;
Lorem Ipsum is simply dummy text of the printing and typesetting industry. &lt;a href="#"&gt;read more&lt;/a&gt;&lt;/div&gt;</code>',
            "id" => "ad_head_code",
            "std" => "",
            "type" => "textarea"
        ),
        
        array(
            "name" => "Upload your image",
            "desc" => "Upload a banner image or enter the URL of an existing image.<br/>Recommended size: <strong>468 &times; 60px</strong>",
            "id" => "ad_head_imgpath",
            "std" => "",
            "type" => "upload"
        ),
        
        array(
            "name" => "Destination URL",
            "desc" => "Enter the URL where this banner ad points to.",
            "id" => "ad_head_imgurl",
            "type" => "text"
        ),
        
        array(
            "name" => "Banner Title",
            "desc" => "Enter the title for this banner which will be used for ALT tag.",
            "id" => "ad_head_imgalt",
            "type" => "text"
        ),
        
        array(
            "type" => "preheader",
            "name" => "Homepage Ad"
        ),
        
        array(
            "name" => "Enable ad space on the homepage?",
            "id" => "ad_home_select",
            "std" => "off",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "HTML Code (Adsense)",
            "desc" => "Enter complete HTML code for your banner (or Adsense code) or upload an image below.",
            "id" => "ad_home_code",
            "std" => "",
            "type" => "textarea"
        ),
        
        array(
            "name" => "Upload your image",
            "desc" => "Upload a banner image or enter the URL of an existing image.<br/>Recommended size: <strong>729 &times; 90px</strong>",
            "id" => "ad_home_imgpath",
            "std" => "",
            "type" => "upload"
        ),
        
        array(
            "name" => "Destination URL",
            "desc" => "Enter the URL where this banner ad points to.",
            "id" => "ad_home_imgurl",
            "type" => "text"
        ),
        
        array(
            "name" => "Banner Title",
            "desc" => "Enter the title for this banner which will be used for ALT tag.",
            "id" => "ad_home_imgalt",
            "type" => "text"
        ),
        
        array(
            "type" => "preheader",
            "name" => "Sidebar Ad"
        ),
        
        array(
            "name" => "Enable ad space in sidebar?",
            "id" => "ad_side_select",
            "std" => "off",
            "type" => "checkbox"
        ),
        
        array(
            "name" => "Ad Position",
            "desc" => "Do you want to place the banner before the widgets or after the widgets?",
            "id" => "ad_side_pos",
            "options" => array(
                'Before widgets',
                'After widgets'
            ),
            "std" => "After widgets",
            "type" => "select"
        ),
        
        array(
            "name" => "HTML Code (Adsense)",
            "desc" => "Enter complete HTML code for your banner (or Adsense code) or upload an image below.",
            "id" => "ad_side_code",
            "std" => "",
            "type" => "textarea"
        ),
        
        array(
            "name" => "Upload your image",
            "desc" => "Upload a banner image or enter the URL of an existing image.<br/>Recommended size: <strong>300 &times; 250px</strong>",
            "id" => "ad_side_imgpath",
            "std" => "",
            "type" => "upload"
        ),
        
        array(
            "name" => "Destination URL",
            "desc" => "Enter the URL where this banner ad points to.",
            "id" => "ad_side_imgurl",
            "type" => "text"
        ),
        
        array(
            "name" => "Banner Title",
            "desc" => "Enter the title for this banner which will be used for ALT tag.",
            "id" => "ad_side_imgalt",
            "type" => "text"
        )
    )
    
    /* end return */
);