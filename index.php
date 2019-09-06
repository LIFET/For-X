<?php
/**
 * 基于<a href="https://fateso.com/archives/forx.html">LIFET</a>的版本进行优化，不优化bug太多了233
 * 
 * @package For-X
 * @author 泽泽社长
 * @version 1.2
 * @link https://qqdie.com/
 */
?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; $this->need('header.php'); ?>
      <section id="body">
        <div class="container">
          <div id="main">
            <div class="res-cons layoutSingleColumn u-paddingTop50">
<?php if ($this->have()): ?>
            <?php while ($this->next()) : ?>
              <article class="post">
                <header class="post-meta">
                  <time datetime="<?php $this->date(); ?>" pubdate="pubdate" class="post-date"><?php $this->date('M d, Y'); ?></time>
                  <h2 class="post-title"><a href="<?php $this->permalink(); ?>" ><?php $this->title(); ?></a>
                  </h2>
                </header>
                  <div class="post-content"><?php $this->excerpt(120,'...'); ?></div>
              </article>
            <?php endwhile; ?>
              <div class="page-navigator">
                <div class="in-mark">
                <?php $this->pageLink('下一页 &raquo;','next'); ?>
                <?php $this->pageLink('&laquo; 上一页'); ?>
                </div>
              </div><?php else: ?>没有找到任何文章
            <?php endif; ?>
            </div>
          </div>
        </div>
      </section>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>