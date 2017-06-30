<?php
require_once '/manage/model/Michelf/MarkdownInterface.php';
require_once '/manage/model/Michelf/Markdown.php';
require_once '/manage/model/Michelf/MarkdownExtra.php';
$parser = new MarkdownExtra();
$content=$parser->transform('#HCI后台介绍
##后台开发##
  目前HCI工作室现主攻后台方向的技术人员有四名。他们主要负责在前端完成了网站页面的基础上，根据用户需求实现网站的功能。负责后台的人要掌握现今比较流行的网络编程语言，例如PHP、ASP或者JSP等。除了实现网站的功能，他们也负责性能优化，故对数据结构和算法也有一点的了解和研究。


##项目介绍##
###1.竞考网微信公众号开发###
该项目主要为加强自媒体和竞考网功能的联系，用户直接通过微信公众号就可以直接查询竞考网的相关资料并可以进行模拟考试，主要用node.js+mongodb进行该微信公众号的后台开发，将用户的微信公众号和其竞考网的账户进行关联，使用户能够在微信上直接查看竞考网的个人信息和竞赛考试相关的资讯。');
echo $content;