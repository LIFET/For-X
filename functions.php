<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $form->addInput($logoUrl);

 $title1 = new Typecho_Widget_Helper_Form_Element_Text('title1', NULL, NULL, _t('站点名称'), _t('侧边导航处显示的站点名称'));
    $form->addInput($title1);

 $title2 = new Typecho_Widget_Helper_Form_Element_Text('title2', NULL, NULL, _t('一句话'), _t('侧边导航处站点名称下方的一句话'));
    $form->addInput($title2);

 $title2url = new Typecho_Widget_Helper_Form_Element_Text('title2url', NULL, NULL, _t('一句话链接'), _t('侧边导航处站点名称下方的一句话可以增加一个链接 导向任意页面或地址.如：/about.html'));
    $form->addInput($title2url);


     $bkimg = new Typecho_Widget_Helper_Form_Element_Text('背景图片', NULL, NULL,_t('背景图片'), _t('想要啥背景就写这里哟'));
    $form->addInput($bkimg->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));
    
 $github = new Typecho_Widget_Helper_Form_Element_Text('github', NULL, NULL, _t('Github'), _t('在这里输入你的Github地址，在页脚处显示'));
 $form->addInput($github);
  
$yinyue = new Typecho_Widget_Helper_Form_Element_Text('yinyue', NULL, NULL, _t('音乐'), _t('在这里你的音乐地址，在页脚处显示，注意:请加http://'));
 $form->addInput($yinyue);

$youxiang = new Typecho_Widget_Helper_Form_Element_Text('youxiang', NULL, NULL, _t('邮箱'), _t('在这里输入你的邮箱，例：mailto:chinaizi@126.com 邮箱前面加：mailto:'));
 $form->addInput($youxiang);

$footerya = new Typecho_Widget_Helper_Form_Element_Textarea('footerya', NULL, NULL, _t('站点底部信息'), _t('可填写备案号之类的信息'));
 $form->addInput($footerya);
}


function themeInit($archive)
{

 Helper::options()->commentsAntiSpam = false;
 Helper::options()->commentsPageDisplay = 'first';
 Helper::options()->commentsOrder= 'DESC';
 Helper::options()->commentsMaxNestingLevels = 999;
}

function theNext($widget, $default = NULL)
{
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('table.contents.created > ?', $widget->created)
->where('table.contents.status = ?', 'publish')
->where('table.contents.type = ?', $widget->type)
->where('table.contents.password IS NULL')
->order('table.contents.created', Typecho_Db::SORT_ASC)
->limit(1);
$content = $db->fetchRow($sql);

if ($content) {
$content = $widget->filter($content);
$link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '">→</a>';
echo $link;
} else {
echo $default;
}
}

/**
* 显示上一篇
*
* @access public
* @param string $default 如果没有下一篇,显示的默认文字
* @return void
*/
function thePrev($widget, $default = NULL)
{
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('table.contents.created < ?', $widget->created)
->where('table.contents.status = ?', 'publish')
->where('table.contents.type = ?', $widget->type)
->where('table.contents.password IS NULL')
->order('table.contents.created', Typecho_Db::SORT_DESC)
->limit(1);
$content = $db->fetchRow($sql);
if ($content) {
$content = $widget->filter($content);
$link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '">←</a>';
echo $link;
} else {
echo $default;
}
}
/**
* 判断时间区间
*/
function timeZone($from){
$now = new Typecho_Date(Typecho_Date::gmtTime());
return $now->timeStamp - $from < 24*60*60 ? true : false;
}

    function formatTime($time)
    {
        $text = '';
        $time = intval($time);
        $ctime = time();
        $t = $ctime - $time; //时间差
        if ($t < 0) {
            return date('Y-m-d', $time);
        }
        ;
        $y = date('Y', $ctime) - date('Y', $time);//是否跨年
        switch ($t) {
            case $t == 0:
                $text = '刚刚';
                break;
            case $t < 60://一分钟内
                $text = $t . '秒前';
                break;
            case $t < 3600://一小时内
                $text = floor($t / 60) . '分钟前';
                break;
            case $t < 86400://一天内
                $text = floor($t / 3600) . '小时前'; // 一天内
                break;
            case $t < 2592000://30天内
                if($time > strtotime(date('Ymd',strtotime("-1 day")))) {
                    $text = '昨天';
                } elseif($time > strtotime(date('Ymd',strtotime("-2 days")))) {
                    $text = '前天';
                } else {
                    $text = floor($t / 86400) . '天前';
                }
                break;
            case $t < 31536000 && $y == 0://一年内 不跨年
                $m = date('m', $ctime) - date('m', $time) -1;

                if($m == 0) {
                    $text = floor($t / 86400) . '天前';
                } else {
                    $text = $m . '个月前';
                }
                break;
            case $t < 31536000 && $y > 0://一年内 跨年
                $text = (11 - date('m', $time) + date('m', $ctime)) . '个月前';
                break;
            default:
                $text = (date('Y', $ctime) - date('Y', $time)) . '年前';
                break;
        }

        return $text;
    }

    function getCommentAt($coid){
        $db   = Typecho_Db::get();
        $prow = $db->fetchRow($db->select('parent')
            ->from('table.comments')
            ->where('coid = ? AND status = ?', $coid, 'approved'));
        $parent = $prow['parent'];
        if ($parent != "0") {
            $arow = $db->fetchRow($db->select('author')
                ->from('table.comments')
                ->where('coid = ? AND status = ?', $parent, 'approved'));
            $author = $arow['author'];
            if($author){
            	$href   = '<a class="at" href="#comment-'.$parent.'">@'.$author.'</a>';
        	}else{
        		$href   = '<a href="javascript:void(0)">评论审核中···</a>';
        	}
            echo $href;
        } else {
            echo "";
        }
    }
    function getGravatar($i){
    if(preg_match('|^[1-9]\d{4,10}@qq\.com$|i',$i)){
    	echo 'https://q.qlogo.cn/g?b=qq&nk='.$i.'&s=100';
    }else{
        $host = 'https://secure.gravatar.com';
        $url = '/avatar/';
        $size = '80';
        $rating = Helper::options()->commentsAvatarRating;
        $hash = md5(strtolower($i));
        $avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=https://cn.gravatar.com/avatar/07875140929860882f35fa5c06056d74?s=100';
        echo $avatar;
    	}
    }
    function timesince($older_date,$comment_date = false) {
$chunks = array(
array(86400 , '天'),
array(3600 , '时'),
array(60 , '分'),
array(1 , '秒'),
);
$newer_date = time();
$since = abs($newer_date - $older_date);
if($since < 2592000){
for ($i = 0, $j = count($chunks); $i < $j; $i++){
$seconds = $chunks[$i][0];
$name = $chunks[$i][1];
if (($count = floor($since / $seconds)) != 0) break;
}
$output = $count.$name.'前';
}else{
$output = !$comment_date ? (date('Y-m-j G:i', $older_date)) : (date('Y-m-j', $older_date));
}
return $output;
}