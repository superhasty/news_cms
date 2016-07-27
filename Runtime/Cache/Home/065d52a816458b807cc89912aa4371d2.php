<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>sing资讯</title>
  <link rel="stylesheet" type="text/css" href="/Public/css/reset.css">
  <link rel="stylesheet" type="text/css" href="/Public/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/Public/css/home/index.css">
  <link rel="stylesheet" type="text/css" href="/Public/css/home/global.css">
</head>
<body>
  <header id="header">
  <div class="navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <a href="">
          <img src="/Public/image/Home/logo.png" alt="">
        </a>
      </div>
      <ul class="nav navbar-nav navbar-left">
        <li>
          <a href="<?php echo ($curId); ?>" class="
            <?php if($curId == -1): ?>curr<?php endif; ?>
          ">首页</a></li>
        <?php if(is_array($barMenus)): foreach($barMenus as $key=>$barMenu): ?><li>
            <a href="/Home/<?php echo ($barMenu["controller"]); ?>/<?php echo ($barMenu["action"]); ?>/id/<?php echo ($barMenu["menu_id"]); ?>" class=" 
              <?php if($barMenu["menu_id"] == $curId): ?>curr<?php endif; ?>
            "><?php echo ($barMenu["name"]); ?></a>
          </li><?php endforeach; endif; ?>
      </ul>
    </div>
  </div>
</header>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-9">
          <div class="banner">
            <div class="banner-left">
              <img src="/Public/image/Home/banner.jpg" alt="">
            </div>
            <div class="banner-right">
              <ul>
                <li>
                  <img src="/Public/image/Home/img1.jpg" alt="">
                </li>
                <li>
                  <img src="/Public/image/Home/img1.jpg" alt="">
                </li>
                <li>
                  <img src="/Public/image/Home/img1.jpg" alt="">
                </li>
              </ul>
            </div>
          </div>
          <div class="news-list">
             <dl>
               <dt>一个悲伤的故事，马云彻底被王兴抛弃了</dt>
               <dd class="news-img">
                 <img src="/Public/image/Home/img4.jpg" alt="">
               </dd>
               <dd class="news-intro">
                 手段太刚猛，吃不消，美团这块肉，马云注定无福消遣。
               </dd>
               <dd class="news-info">
                 秋远俊二 <span>15:22</span> 阅读(1万)
               </dd>
             </dl>
             <dl>
               <dt>一个悲伤的故事，马云彻底被王兴抛弃了</dt>
               <dd class="news-img">
                 <img src="/Public/image/Home/img4.jpg" alt="">
               </dd>
               <dd class="news-intro">
                 手段太刚猛，吃不消，美团这块肉，马云注定无福消遣。
               </dd>
               <dd class="news-info">
                 秋远俊二 <span>15:22</span> 阅读(1万)
               </dd>
             </dl>
             <dl>
               <dt>一个悲伤的故事，马云彻底被王兴抛弃了</dt>
               <dd class="news-img">
                 <img src="/Public/image/Home/img4.jpg" alt="">
               </dd>
               <dd class="news-intro">
                 手段太刚猛，吃不消，美团这块肉，马云注定无福消遣。
               </dd>
               <dd class="news-info">
                 秋远俊二 <span>15:22</span> 阅读(1万)
               </dd>
             </dl>
             <dl>
               <dt>一个悲伤的故事，马云彻底被王兴抛弃了</dt>
               <dd class="news-img">
                 <img src="/Public/image/Home/img4.jpg" alt="">
               </dd>
               <dd class="news-intro">
                 手段太刚猛，吃不消，美团这块肉，马云注定无福消遣。
               </dd>
               <dd class="news-info">
                 秋远俊二 <span>15:22</span> 阅读(1万)
               </dd>
             </dl>
          </div>
        </div>
        <div class="col-sm-3 col-md-3">  
          <div class="right-title">
  <h3>文章排行</h3>
    <span>TOP ARTICLES</span>
</div>
<div class="right-content">
  <ul>
    <li class="num1 curr">
      <a href="">习近平谈气候变化</a>
      <div class="intro">
        中美双方应该不断挖掘合作潜力、培育合作亮点，加快双边投资协定谈判...
      </div>
    </li>
    <li class="num2"><a href="">普京回应俄战机被击落</a></li>
    <li class="num3"><a href="">普京回应俄战机被击落</a></li>
    <li class="num4"><a href="">普京回应俄战机被击落</a></li>
    <li class="num5"><a href="">普京回应俄战机被击落</a></li>
    <li class="num6"><a href="">普京回应俄战机被击落</a></li>
    <li class="num7"><a href="">普京回应俄战机被击落</a></li>
    <li class="num8"><a href="">普京回应俄战机被击落</a></li>
    <li class="num9"><a href="">普京回应俄战机被击落</a></li>
    <li class="num10"><a href="">普京回应俄战机被击落</a></li>
  </ul>
</div>
<div class="right-hot">
  <img src="/Public/image/Home/img5.jpg" alt="">
</div>
<div class="right-hot">
  <img src="/Public/image/Home/img6.jpg" alt="">
</div>
        </div>
     </div>
    </div>
  </section>
</body>
</html>