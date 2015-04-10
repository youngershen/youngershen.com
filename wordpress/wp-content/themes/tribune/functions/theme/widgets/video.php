<?php

/*----------------------------------------------------------------------------------*/
/*  WPZOOM: Video Widget  
/*----------------------------------------------------------------------------------*/
 
add_action('widgets_init', create_function('', 'return register_widget("Video_Widget");'));

class Video_Widget extends WP_Widget
{
    function Video_Widget()
    {
        $widgetOps = array(
            "classname"   => "wpzoom_media",
            "description" => "WPZOOM: Video Widget",
        );

        $controlOps = array(
            "width"   => 300,
            "height"  => 180,
            "id_base" => "wpzoom-video-widget"
        );

        $this->WP_Widget("wpzoom-video-widget", "WPZOOM: Video Widget", $widgetOps, $controlOps);
    }

    function widget($args, $instance)
    {
    extract($args);
        
        $title = apply_filters("widget_title", $instance["title"]);
    $count = $instance["count"];

        echo $before_widget;
        echo $before_title . $title . $after_title;
    
    for ($i = 1; $i <= $count; $i++) { ?>
        <?php
        if ($i == 1) { $class = "open"; } else { $class = "hide"; } ?>
        <div class="<?php echo $class; ?>" id="widget-zoom-video-cat-<?php echo $i; ?>">
        
        <?php if ($instance["video" . $i]) { // Do we embed a video from a website?
      $videocode = $instance["video" . $i];
        $videocode = preg_replace("/(width\s*=\s*[\"\'])[0-9]+([\"\'])/i", "$1 300 $2", $videocode);
      $videocode = preg_replace("/(height\s*=\s*[\"\'])[0-9]+([\"\'])/i", "$1 180 $2", $videocode);
      $videocode = str_replace("<embed","<param name='wmode' value='transparent'></param><embed",$videocode);
      $videocode = str_replace("<embed","<embed wmode='transparent' ",$videocode); ?>
      <div class="cover"><?php echo "$videocode";  ?></div>
      <?php } 
       else {
                echo "Could not generate embed. Please try it manualy.";
            }
            ?>
            <p class="description"><?php echo $instance["video" . $i . "-desc"] ?></p>
        </div>
        <?php } ?>

        <ul class="items">
            <?php for ($i = 1; $i <= $count; $i++) { ?>
            <?php if ($i == 1) { $class="active"; } ?>
            <li>
              <a class="<?php echo $class; ?>" href="#widget-zoom-video-cat-<?php echo $i; ?>"><?php echo $instance["video" . $i . "-title"]; ?></a>
            </li>

            <?php $class = ""; } ?>
        </ul>
        <script type="text/javascript">
        jQuery(function($) {
      $("document").ready(function() {
        $(".wpzoom_media li a").click(function() {
          $(".wpzoom_media .open").addClass("hide").removeClass("open");
          $(".wpzoom_media " + $(this).attr("href")).addClass("open").removeClass("hide");
          $(".wpzoom_media li a.active").removeClass("active");
          $(this).addClass("active");
          return false;
        })
      });
        });
        </script>
    <?php
        echo $after_widget;
    }

    function form($instance)
    {
        $defaults = array(
            "title" => "Video Widget",
            "count" => "3"
        );
        $instance = wp_parse_args((array) $instance, $defaults);
    ?>
        <!-- Widget Title -->
        <p>
            <label for="<?php echo $this->get_field_id("title"); ?>">Title</label>
            <input id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" value="<?php echo $instance["title"]; ?>" style="width: 96%;" type="text" />
        </p>
        
        <!-- Widget Video count -->
        <p>
            <label for="<?php echo $this->get_field_id("count"); ?>">Videos</label>
            <select id="<?php echo $this->get_field_id("count"); ?>" name="<?php echo $this->get_field_name("count"); ?>" value="<?php echo $instance["count"]; ?>" style="width: 100%;">
                <?php for ($i = 2; $i <= 10; $i++) {
                    $active = "";
                    if ($instance["count"] == $i) {
                        $active = "selected=\"selected\"";
                    } ?>
                    <option <?php echo $active; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
      <span class="description" style="font-size:11px;">Make sure to specify exact number of videos, otherwise the widget won't work.</span>
        </p>

        <!-- Video urls & embeds -->
        
    <?php for ($i = 1; $i <= $instance["count"]; $i++) { ?>
        <p>
        <label for="<?php echo $this->get_field_id("video" . $i); ?>"><strong>Video #<?php echo $i; ?> Embed Code</strong></label>
 
        <textarea id="<?php echo $this->get_field_id("video" . $i); ?>" name="<?php echo $this->get_field_name("video" . $i); ?>" style="width: 96%; height:80px;" class="widefat wpzoom_post_embed_code"><?php echo htmlspecialchars($instance["video" . $i]); ?></textarea>
        </p>
        
        <p>
        <label for="<?php echo $this->get_field_id("video" . $i . "-title"); ?>">Video title</label>
        <input id="<?php echo $this->get_field_id("video" . $i . "-title"); ?>" name="<?php echo $this->get_field_name("video" . $i . "-title"); ?>" value="<?php echo $instance["video" . $i . "-title"]; ?>" style="width: 96%;" type="text" />
    </p>
    
    <p>
        <label for="<?php echo $this->get_field_id("video" . $i . "-desc"); ?>">Video description</label>
        <input id="<?php echo $this->get_field_id("video" . $i . "-desc"); ?>" name="<?php echo $this->get_field_name("video" . $i . "-desc"); ?>" value="<?php echo $instance["video" . $i . "-desc"]; ?>" style="width: 96%;" type="text" />
        <br/><br/></p>
    <?php }  
    }
}