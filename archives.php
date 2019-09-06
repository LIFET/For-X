<?php
/**
 * 文章归档
 *
 * @package custom
 */
?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; $this->need('header.php'); ?>
       <section id="body">
        <div class="container">
          <div id="main" class="post-page">
            <div class="res-cons">
              <div class="layoutSingleColumn">
    <article class="u-paddingTop50" itemscope="itemscope" itemtype="http://schema.org/Article">
	<header class="entry-header">
	<h2 class="entry-title" itemprop="headline"><?php $this->title() ?></h2>
	<div class="entry-meta">
		<a><time class="lately-a" datetime="<span><?php echo formatTime($this->modified);?></span>" itemprop="datePublished"><span><?php echo formatTime($this->modified);?></span></time></a>
	</div>
	</header>

                  <div id="archives">
<?php 
  $db = Typecho_Db::get();
  $select = $db->select()->from('table.contents')
    ->where('type = ?', 'post')
    ->where('table.contents.status = ?', 'publish')
    ->where('table.contents.created < ?', time())
    ->order('table.contents.created', Typecho_Db::SORT_DESC);
  $posts = $db->fetchAll($select);
  $current_year = 0;
  foreach ($posts as $post) {
      $type = 'post';
      $options = Typecho_Widget::widget('Widget_Options');
      $date = new Typecho_Date($post['created']);
      $post['year'] = $date->year;
      $post['month'] = $date->month;
      $post['day'] = $date->day;
      $routeExists = (NULL != Typecho_Router::get($type));
      $permalink = $routeExists ? Typecho_Router::url($type, $post, $options->index) : '#';
      $post['permalink'] = $permalink;
      if ($post['year'] != $current_year) {
          if ($current_year != 0) echo "</ul>";
          $current_year = $post['year'];
          echo "<div class=\"al_year\">" . $post['year'] . "</div>\n";
          echo "<ul class=\"al_mon_list\">\n";
      }
      echo "<li><span class=\"date\">" . $post['month'] . '/' . $post['day'] . "</span><a href=\"" . $post['permalink'] . "\"  title=\"" . $post['title'] . "\" >" . $post['title'] . "</a></li>\n";
  }
  echo "</ul>\n";
?>
            </div>
          </div>
        </div>
      </section>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>