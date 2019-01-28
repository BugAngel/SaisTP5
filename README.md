# WFT

研一工程实践，留学信息管理与分析系统

web项目的依赖管理由composer完成，web目录命令行下输入composer update即可更新框架到最新版本

web目录下存放PHP工程
database存放数据库文件
college存放爬虫工程

web的PHP工程使用thinkphp框架，版本为5.1(LTS)
php使用7.2.10，nts版本

database使用mongodb，数据库名为wtf，文件夹为各个集合的导出文件
wft_user为普通用户数据库
wft_college为学校信息数据库

爬虫使用scrapy框架，版本为1.5.1
