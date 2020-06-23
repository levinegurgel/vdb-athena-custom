<?php 
  global $ath_options;
  if(is_phone() && !is_tablet()):
?>
<div class="mobile-menu-wrapper visible-xs">
  <div class="ui inline pointing right dropdown mobile-menu <?php echo !is_tablet() ? 'mt-4':'mt-2 mr-2'; ?>">
      <div class="text">
        <i class="bars icon"></i>

      </div>
      <div class="menu">
        <?php $menu = wp_get_nav_menu_items('topo');?>
        <?php $count = count( 
            wp_list_filter( 
                wp_get_nav_menu_items( 'topo' ), 
               [ 'menu_item_parent' => 0 ] 
            ) 
        ); ?>
        <?php if($count > 0): ?>
           <!--  <div class="divider"></div> -->
            <!-- <div class="header ath-font-text">
              Páginas
            </div> -->
            <?php foreach ($menu as $m): ?>
                <div class="item ath-font-text">
                    <a href="<?php echo $m->url; ?>"><?php echo $m->title; ?></a>
                </div>                                            
            <?php endforeach; ?>
        <?php endif; ?>                                        
      </div>
  </div>
  <span class="btn-search-mobile btn-search ml-2"><i class="search icon"></i></span>
</div>
<?php endif; ?>