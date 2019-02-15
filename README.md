# WFT

研一工程实践，留学信息管理与分析系统

web项目的依赖管理由composer完成，web目录命令行下输入composer update即可更新框架到最新版本

web目录下存放PHP工程   
college存放爬虫工程  

web的PHP工程使用thinkphp框架，版本为5.1(LTS)  
php使用7.2.10，nts版本 
 
web的public/static/images/colleges文件夹内放置各个学校的校徽，校徽图片名为数据库内对应学校的icon域  
public/static/images/banner文件夹内放置各个学校的横幅和标志幻灯片，图片名为数据库内对应学校的icon域

数据库使用mongodb，数据库与表前缀为wft  
wft_user为普通用户数据集合  
wft_college_detail为学校详细信息数据集合  
wft_college_info为学校简略信息数据集合 
wft_college_complaint为投诉信息数据集合  

爬虫使用scrapy框架，版本为1.5.1
