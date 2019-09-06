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
            <span class="middotDivider"></span>
            <a href="<?php $this->permalink(); ?>"><?php $this->category(','); ?></a>
        </div>
      </header>

      <meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php $this->permalink(); ?>"/>

        <div class="grap" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
    <?php if($this->tags): ?>
            <p itemprop="keywords" class="tags"><?php _e(''); ?><?php $this->tags(' , ', true, ''); ?></p>
        <?php endif; ?></article>
        <ul class="post-near">
        <li class="left">« <?php $this->thePrev('%s','没有了'); ?></li>
        <li class="right"><?php $this->theNext('%s','没有了'); ?> »</li>
        <li class="clearfix"></li>
    </ul><?php $this->need('comments.php'); ?>
            </div>
          </div>
        </div>

      </section>

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>