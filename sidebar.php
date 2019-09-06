   <asid id="secondary">
        <div class="sidebar">
 <section class="widget">

<div class="sidebar-brand">
                    <a href="#">pro sidebar</a>
                </div>

<div class="canvi-user-info">
<div class="canvi-user-info__image">
<img src="<?php $this->options->logoUrl() ?>"/>
</div>
<div class="canvi-user-info__data">
	<span class="canvi-user-info__title"><?php $this->options->title1() ?></span>
	<a href="<?php $this->options->title2url(); ?>" class="canvi-user-info__meta"><?php $this->options->title2() ?></a>
	</div></div>

<section class="widget">
            <form id="search" method="get" action="<?php $this->options->siteUrl(); ?>">
              <input id="search_value" placeholder="搜...搜什么嘞~" name="s" type="text" value="" class="text"/>
            </form>
          </section>

</section>
          <section class="widget">
            <div id="nav-menu">
              <ul style="text-align: center"> <li><a id="nav_blog" href="<?php $this->options->siteUrl(); ?>"<?php if ($this->is('index')) echo " class=\"selected active current\""; ?>>首页</a></li>

 <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                    <li><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"<?php if($this->is('page', $pages->slug)): ?> class="selected active current"<?php endif; ?>><?php $pages->title(); ?></a></li>
                    <?php endwhile; ?>

</ul>
            </div>
          </section>   
        </div>
<div class="sidebar-footer">
<a href="<?php $this->options->github(); ?>" target="_blank">Github</a>
<a href="<?php $this->options->yinyue(); ?>" target="_blank">歌单</a>
<a href="<?php $this->options->youxiang(); ?>" target="_blank">邮箱</a>
                </div>
      </asid>