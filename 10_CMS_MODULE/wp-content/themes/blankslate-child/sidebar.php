	<aside id="sidebar" role="complementary">
	<?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
	<div id="primary" class="widget-area">
	<ul class="xoxo sidebar-nav">
	<li class="sidebar-brand">
	<?php dynamic_sidebar( 'primary-widget-area' ); ?>
	</li>
	</ul>
	</div>
	<?php endif; ?>
	</aside>
