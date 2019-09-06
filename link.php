<?php
/**
* LINK
*
* @package custom
*/
?>
<?php $this -> need('header.php'); ?>
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
            
<div class="grap" itemprop="articleBody">
<?php $this->content(); ?>
</div>

<div class="link-box">

<a href="https://jcl.moe/" target="_blank" class="no-underline"><div class="thumb"><img width="200" height="200" src="https://cn.gravatar.com/avatar/07875140929860882f35fa5c06056d74?s=100" alt="Mint Jin"></div><div class="content"><div class="title"><span id="menu_index_4" name="menu_index_4"></span><h3>Mint Jin</h3></div></div></a>


<a href="https://www.qqdie.com" target="_blank" class="no-underline"><div class="thumb"><img width="200" height="200" src="https://cn.gravatar.com/avatar/07875140929860882f35fa5c06056d74?s=100" alt="QQ爹"></div><div class="content"><div class="title"><span id="menu_index_4" name="menu_index_4"></span><h3>QQ爹</h3></div></div></a>


</div><!-- link-box -->


 <?php $this->need('comments.php'); ?>
          </div>
          </div>
        </div>
      </section>

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>