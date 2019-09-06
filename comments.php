<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php function threadedComments($comments, $options) {
    $commentClass = '';
    $commentAuthor = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= 'comment-by-author';
            $commentAuthor .= 'comment-py-author';
        } else {
            $commentClass .= 'comment-by-user';
            $commentAuthor .= 'ym';
        }
    }
    $commentLevelClass = $comments->levels > 0 ? 'comment-child' : 'comment-parent';
?><?php if($commentAuthor==""){
      $commentAuthor .= 'rbq';
      $commentClass .= 'comment-by-user';
    }else{};?>
<li id="li-<?php $comments->theId(); ?>">
    <div id="<?php $comments->theId(); ?>" class="gf">
        <img class="avatar" src="<?php getGravatar($comments->mail); ?>">
      <div class="comment-border"><span class="<?php echo $commentAuthor; ?>"><?php $comments->author(); ?></span>&nbsp;<p class="size">(<?php echo timesince($comments->created); ?>)</p>
<span class="comment-reply cp-<?php $comments->theId(); ?>"><?php $comments->reply('<i class="mdi mdi-reply"></i>回复'); ?></span><span id="cancel-comment-reply" class="cancel-comment-reply cl-<?php $comments->theId(); ?>" style="display:none" ><?php $comments->cancelReply('<i class="mdi mdi-reply"></i>取消'); ?></span><br><?php getCommentAt($comments->coid); ?>&nbsp;<?php $comments->content(); ?>
    </div></div>
<?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
</li>
<?php } ?>
<div id="comments" data-no-instant>
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
	<h3><?php $this->commentsNum(_t('目前无任何评论.'), _t('仅有 1 条评论'), _t('共 %d 条评论')); ?></h3>
    <?php $comments->listComments(); ?>
<div data-instant><?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?></div>
    <?php endif; ?>
    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
    	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
    		<div class="center">
            <?php if($this->user->hasLogin()): ?>
    		<p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
            <?php else: ?>
    		<p>
    			<input type="text" name="author" placeholder="name" id="author" class="text" value="<?php $this->remember('author'); ?>" required />
    			<input type="email" name="mail" placeholder="e-mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
    			<input type="url" name="url" placeholder="website" id="url" class="text" placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
            </p>
            <?php endif; ?>
            <p>
                <textarea placeholder="Write here···" rows="8" cols="50" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>
            </p>
            <p>
                <input type="submit" id="submit" class="submit" value="提交"/>
            </p>
            </div>
    	</form>
    </div>
    <?php else: ?>
    <h3><?php _e('啊嘞,关闭评论了噢!'); ?></h3>
    <?php endif; ?>
</div>
<script type="text/javascript">
(function(){window.TypechoComment={dom:function(id){return document.getElementById(id)},pom:function(id){return document.getElementsByClassName(id)[0]},iom:function(id,dis){var alist=document.getElementsByClassName(id);if(alist){for(var idx=0;idx<alist.length;idx++){var mya=alist[idx];mya.style.display=dis}}},create:function(tag,attr){var el=document.createElement(tag);for(var key in attr){el.setAttribute(key,attr[key])}return el},reply:function(cid,coid){var comment=this.dom(cid),parent=comment.parentNode,response=this.dom("<?php echo $this->respondId(); ?>"),input=this.dom("comment-parent"),form="form"==response.tagName?response:response.getElementsByTagName("form")[0],textarea=response.getElementsByTagName("textarea")[0];if(null==input){input=this.create("input",{"type":"hidden","name":"parent","id":"comment-parent"});form.appendChild(input)}input.setAttribute("value",coid);if(null==this.dom("comment-form-place-holder")){var holder=this.create("div",{"id":"comment-form-place-holder"});response.parentNode.insertBefore(holder,response)}comment.appendChild(response);this.iom("comment-reply","");this.pom("cp-"+cid).style.display="none";this.iom("cancel-comment-reply","none");this.pom("cl-"+cid).style.display="";if(null!=textarea&&"text"==textarea.name){textarea.focus()}return false},cancelReply:function(){var response=this.dom("<?php echo $this->respondId(); ?>"),holder=this.dom("comment-form-place-holder"),input=this.dom("comment-parent");if(null!=input){input.parentNode.removeChild(input)}if(null==holder){return true}this.iom("comment-reply","");this.iom("cancel-comment-reply","none");holder.parentNode.insertBefore(response,holder);return false}}})();
</script>