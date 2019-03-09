# WFT

研一工程实践，留学信息管理与分析系统

web项目的依赖管理由composer完成，web目录命令行下输入composer update即可更新框架到最新版本

web目录下存放PHP工程   
college存放mongodb爬虫工程  
shunshun存放mysql爬虫工程 

web的PHP工程使用thinkphp框架，版本为5.1(LTS)  
php使用7.2.10，nts版本 
 
web的public/static/images/colleges文件夹内放置各个学校的校徽，校徽图片名为数据库内对应学校的icon域  
public/static/images/banner文件夹内放置各个学校的横幅和标志幻灯片，图片名为数据库内对应学校的icon域

数据库使用mongodb，数据库与表前缀为wft 

wft_admin为管理员数据集合  
wft_college_detail为学校详细信息数据集合  
wft_college_info为学校简略信息数据集合  
wft_complaint为投诉信息数据集合  
wft_post为发帖数据集合  
wft_slide为幻灯片数据集合  
wft_user为普通用户数据集合   

爬虫使用scrapy框架，版本为1.5.1

#
## 参考网站

[MongoDB 安装和可视化工具](https://www.cnblogs.com/liuyanpeng/p/7735698.html)

[MongoDB教程](http://www.runoob.com/mongodb)

[phpstudy扩展mongoDB（改）](https://blog.csdn.net/aeoliancrazy/article/details/78558791)

[ThinkPHP5快速入门](https://www.kancloud.cn/thinkphp/thinkphp5_quickstart)

[Composer中文文档](https://www.kancloud.cn/thinkphp/composer/35669)

[MongoDB driver for PHP](http://pecl.php.net/package/mongodb)

[windows10 php7安装mongodb 扩展](http://www.cnblogs.com/phpper/p/9196870.html)

[PHP19 PHPStorm2018和GitHub的使用](http://www.cnblogs.com/rask/p/9216185.html)

[在PHPstorm中使用数组短语法\[\]，出现红色波浪](https://www.cnblogs.com/honeyJYY/p/9837087.html)

[使用tp5写登录验证及修改密码](https://blog.csdn.net/weixin_39973810/article/details/79247544)

[html 复选框checkbox](http://www.cnblogs.com/kaituorensheng/p/4529113.html)

[PHP 对象转数组 Object转array](https://blog.csdn.net/a9254778/article/details/8569108)

[PHP关联数组的10个操作技巧](https://www.jb51.net/article/33411.htm)

[date](http://www.php.net/manual/zh/function.date.php)

[HTML中用户名、身份证号、邮箱、出生日期等的格式验证](https://blog.csdn.net/Mr_L_h/article/details/82790689)

[PHP 数组遍历 foreach 语法结构](https://www.cnblogs.com/keta/p/6117237.html)

[FlexSlider 2](http://flexslider.woothemes.com/)

[英国硕士免费申请系统](http://www.ukmaster.cn/index.php/index/index.html)

[编辑器修改html，css，js文件，刷新谷歌浏览器内容不显示修改效果](https://blog.csdn.net/hl_qianduan/article/details/80810301)

[2019最新QS世界大学排名](http://www.liuxue.com/rank/world/qs/index/)

[QS最新公布：2018/19全球大学排名出炉（中文版前200）](http://baijiahao.baidu.com/s?id=1602581285238100316&wfr=spider&for=pc)

[ThinkPHP5 debug: \_\_STATIC\_\_缺少 public 的解决方案](https://blog.csdn.net/wildye/article/details/79015771)

[composer怎么更新项目下的think文件](http://www.thinkphp.cn/topic/60404.html)

[tp5的验证码一直通不过验证？虽暂时解决，还是有疑问](http://www.thinkphp.cn/topic/42779.html)

[tp5怎样在视图中引用公共模块foot.html和header.html](https://blog.csdn.net/jack_num1/article/details/78851748)

[TP5的模板继承](https://www.jianshu.com/p/85a6b0358927)

[scrapy概述](http://www.scrapyd.cn/doc/179.html)

[scrapy mongodb存储（一）：mongodb安装设置](http://www.scrapyd.cn/jiaocheng/161.html)

[scrapy mongodb储存（二）：mongodb pycharm可视化插件安装](http://www.scrapyd.cn/jiaocheng/163.html)

[scrapy mongodb储存（三）：实战scrapy中文网存入mongodb](http://www.scrapyd.cn/jiaocheng/171.html)

[Python.错误解决：scrapy 没有crawl 命令](https://blog.csdn.net/shujin8487/article/details/79371678)

[python\[::-1\]和\[-1\]用法](https://blog.csdn.net/HARDBIRD123/article/details/82261651)

[Scrapy命令行工具shell使用](https://blog.csdn.net/chenfeidi1/article/details/80890406)

[python去除空格和换行符的方法](https://www.cnblogs.com/royfans/p/7473695.html)

[Python3.2 cmp函数问题](https://bbs.csdn.net/topics/360026808)

[Python MongoDB](http://www.runoob.com/python3/python-mongodb.html)

[AutoThrottle extension](https://doc.scrapy.org/en/latest/topics/autothrottle.html)

[TP5中取消了IS\_GET和IS\_POST方法?](http://www.thinkphp.cn/topic/51826.html)

[Font Awesome 中文网](http://www.fontawesome.com.cn)

[TP5的内置循环标签](https://www.jianshu.com/p/8267a3f32529)

[tp5 模板url跳转带参数](http://www.thinkphp.cn/topic/42201.html)

[PHP字符串中的变量解析（+教你如何在PHP字符串中加入变量）](https://www.cnblogs.com/kenshinobiy/p/4781720.html)

[TP5关于model的使用问题？](http://www.thinkphp.cn/topic/58037.html)

[TP5怎么使用模型](https://blog.csdn.net/fangkang7/article/details/82785834)

[tp5controller与model使用数据库](https://www.wangmingchang.com/3341.html)

[tp5如何合理的利用model模型层？](http://www.thinkphp.cn/topic/58068.html)

[可以对函数参数进行类型约束 \- PHP: 类型约束 - Manual](http://php.net/manual/zh/language.oop5.typehinting.php)

[PHP implode() 函数由数组合并字符串](https://www.cnblogs.com/xbdeng/p/5232135.html)

[闭包子查询中如何传参](http://www.thinkphp.cn/topic/49715.html)

[python中的字符数字之间的转换函数](https://www.cnblogs.com/wuxiangli/p/6046800.html)

[Python 实现小数和百分数的相互转换](http://www.cnblogs.com/xuchunlin/p/6305720.html)

[jquery实现单选与多选](https://blog.csdn.net/fengfeng_zhan/article/details/78969863)

[tp5的 if标签改了吗？](http://www.thinkphp.cn/topic/50827.html)

[单选框和复选框的样式修改](https://www.cnblogs.com/bear-blogs/p/9656001.html)

[美图秀秀怎么把背景换成白色](https://jingyan.baidu.com/article/636f38bb3050b4d6b84610e7.html)

[jquery之cookie操作](https://www.cnblogs.com/s313139232/p/7839037.html)

[HTML里的哪一部分Javascript 会在页面加载的时候被执行？](https://www.cnblogs.com/herozhou/p/6864038.html)

[jquery 改变标签样式](https://www.cnblogs.com/heganlin/p/5830174.html)

[HTML表单提交方式 get和post 前后端联系与区别。](https://blog.csdn.net/qq_38341456/article/details/82935407)

[JS正则表达式验证数字非常全](https://www.cnblogs.com/xinwusuo/p/5948908.html)

[PHP字符串运算符](http://www.php.net/manual/zh/language.operators.string.php)

[Bootstrap 表单](http://www.runoob.com/bootstrap/bootstrap-forms.html)

[tp5 模板for循环](https://blog.csdn.net/haibo0668/article/details/81542602)

[HTML色彩表格工具](https://html-color-codes.info/chinese/)

[bootstrap4.0不再支持 img-circle这个类了吗？](https://www.oschina.net/question/3935150_2284184)

[jquery操作select(取值，设置选中）](https://www.cnblogs.com/hailexuexi/p/6708110.html)

[php 清空数组](https://www.imooc.com/article/35608)

[PHP使用foreach修改数组里边的值方案](https://blog.csdn.net/fangkang7/article/details/82384917)

[js控制页面带参跳转](https://www.cnblogs.com/haimengqingyuan/p/7795722.html)

[为什么Bootstrap图片轮播的箭头不显示，其他都没什么问题](https://www.imooc.com/qadetail/103144)

[CSS使图片居中的三种方法](https://blog.csdn.net/wang414300980/article/details/75089066)

[jQuery 设置图片 src 的2种方法](https://www.cnblogs.com/james641/p/6599728.html)

[bootstrap div 右对齐](https://blog.csdn.net/as_jopo/article/details/47421761)

[GitHub的README.md文件内容如何换行](https://blog.csdn.net/bawcwchen/article/details/80557442)

[有没有同学发现，列表组的小圆点是怎么去掉的？](https://www.imooc.com/qadetail/237268?t=378857)

[jquery获取当前页面的URL信息](https://www.cnblogs.com/hongmaju/p/5510988.html)

[js之获取url中"?"后面的字串](https://www.cnblogs.com/sydeveloper/p/3729380.html)

[Font Awesome 中文网](http://www.fontawesome.com.cn/faicons/)

[Bootstrap 可视化布局系统！](http://www.runoob.com/try/bootstrap/layoutit/)

[使用jquerycookie时遇到的诡异问题](https://segmentfault.com/q/1010000003108640)

[Pycharm terminal 调用Anaconda prompt](https://blog.csdn.net/weixin_40883418/article/details/81632725)

[Python爬虫：在带有多个属性值的class选择器中选择其中一个值，实现标签快速精准定位](https://blog.csdn.net/godot06/article/details/81095941)

[Scrapy元素选择器Xpath用法汇总](https://blog.csdn.net/manongpengzai/article/details/77109600)

[Scrapy爬虫入门教程五 Selectors（选择器）](https://www.jianshu.com/p/26da91b38df7)

[ul和li实现分两列（多列）布局显示](https://blog.csdn.net/itmyhome1990/article/details/19756399)

[PHP获取当前时间戳，当前时间、及解决时区问题](https://www.cnblogs.com/falling-maple/p/6239581.html)

[TP5报如下的错误 Indirect modification of overloaded element of think\\paginator\\Collection has no effect](https://blog.itiis.cn/tp5-indirect-modification-of-overloaded-element-of-thinkpaginatorcollection-has-no-effect/)

[Thinkphp+Nginx(PHPstudy)下报的404错误,403错误解决](https://www.cnblogs.com/bing2017/p/7056110.html)

[nginx 配置问题 rewrite ^/(.*)$ /index.php/$1 last；](https://zhidao.baidu.com/question/583672870365231565.html)

[如何设置网页title旁边的小图标](https://blog.csdn.net/yutao_fullstack/article/details/80872036)

[php字符串替换的几个函数](https://www.cnblogs.com/firstForEver/p/5111665.html)

[TP5.1输出到模板HTML格式被强行转成了字符](http://www.thinkphp.cn/topic/53961.html)

[对数组进行排序](http://www.php.net/manual/zh/array.sorting.php)

[将input标签设置为不可编辑状态的三种方法](https://blog.csdn.net/wangqing84411433/article/details/81026411)

[win10安装mysql5.7.20解压版](https://www.cnblogs.com/qjoanven/p/7898006.html)

[Mysql Server 8.0.11 安装教程（踩坑教学）](https://blog.csdn.net/zhangzhetaojj/article/details/80684306)

[Navicat如何修改表或是字段的字符集类型](https://jingyan.baidu.com/article/49ad8bce9e239d5834d8fa19.html)

[Navicat for Mysql中如何导入sql文件](https://jingyan.baidu.com/article/a24b33cd2de7e219ff002b6b.html)

[Scrapy存入MySQL驱动安装及问题：Could not find …distribution found for MySQLdb…](http://www.scrapyd.cn/jiaocheng/168.html)

[Scrapy存入MySQL（四）：scrapy item pipeline组件实现细节](http://www.scrapyd.cn/jiaocheng/169.html)

[Conda 虚拟环境创建](https://blog.csdn.net/qq_25867649/article/details/80469060)

[Anaconda 安装+使用+换源+更新](https://blog.csdn.net/u013055678/article/details/59107932)

[Anaconda找包，安装包时，遇到PackageNotFoundError： ''Package missing in current channels"](https://blog.csdn.net/ksws0292756/article/details/79192268)

[scrapy爬虫数据存入mysql数据库](https://blog.csdn.net/ljm_9615/article/details/76715696)

[Python JSON](http://www.runoob.com/python/python-json.html)
