<footer id="footer">
<div class="in-mark layoutSingleColumn">
<div class="container">© <?php echo date("Y"); ?>&nbsp;<a target="_blank" href="http://typecho.org/" rel="external nofollow">Typecho</a>&nbsp;Theme&nbsp;By&nbsp;<a href="http://qqdie.com/" target="_blank">For-X</a>&nbsp;<?php $this->options->footerya(); ?></div> 
</div></footer>
</div>
<button class="side-click click-hamburger"><span class="bar"></span></button>
<script type="text/javascript" src="<?php $this->options->themeUrl('static/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('static/index.js'); ?>"></script>
<script src="https://cdn.staticfile.org/instantclick/3.0.1/instantclick.min.js" data-no-instant></script>
<script data-no-instant>InstantClick.init();</script>
<?php $this->footer(); ?>
  </body>
</html>