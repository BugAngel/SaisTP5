# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/en/latest/topics/item-pipeline.html
import pymysql.cursors

class ShunshunPipeline(object):
    def process_item(self, item, spider):
        return item


class CollegeInfoPipeline(object):
    def __init__(self):
        # 连接数据库
        self.connect = pymysql.connect(
            host='127.0.0.1',  # 数据库地址
            port=3306,  # 数据库端口
            db='sais',  # 数据库名
            user='root',  # 数据库用户名
            passwd='root',  # 数据库密码
            charset='utf8mb4',  # 编码方式
            use_unicode=True)
        # 通过cursor执行增删查改
        self.cursor = self.connect.cursor()

    def process_item(self, item, spider):
        # 查重处理
        self.cursor.execute(
            """select * from shun_college_info where college_e_name = %s""",
            item['college_e_name'])
        # 是否有重复数据
        repetition = self.cursor.fetchone()

        # 重复
        if repetition:
            return

        self.cursor.execute(
            """insert into shun_college_info(college_name, college_e_name, country, area ,rate, local_rank,local_rank_name,qs_rank,icon,hot_major)
            value (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)""",
            (item['college_name'],  # item里面定义的字段和表字段对应
             item['college_e_name'],
             item['country'],
             item['area'],
             item['rate'],
             item['local_rank'],
             item['local_rank_name'],
             item['qs_rank'],
             item['icon'],
             item['hot_major']))

        # 提交sql语句
        self.connect.commit()
        return
        # return item  # 会在控制台输出item


class CollegeDetailPipeline(object):
    def __init__(self):
        # 连接数据库
        self.connect = pymysql.connect(
            host='127.0.0.1',  # 数据库地址
            port=3306,  # 数据库端口
            db='sais',  # 数据库名
            user='root',  # 数据库用户名
            passwd='root',  # 数据库密码
            charset='utf8mb4',  # 编码方式
            use_unicode=True)
        # 通过cursor执行增删查改
        self.cursor = self.connect.cursor()

    def process_item(self, item, spider):
        # 查重处理
        self.cursor.execute(
            """select * from sais_college_detail where college_e_name = %s""",
            item['college_e_name'])
        # 是否有重复数据
        repetition = self.cursor.fetchone()

        # 重复
        if repetition:
            return

        self.cursor.execute(
            """insert into sais_college_detail(college_name, college_e_name, country, area ,rate, local_rank,
            local_rank_name,qs_rank,icon,hot_major,introduce,sum,undergraduate,graduate,student_staff_ratio,
            undergraduate_international_proportion,graduate_international_proportion,ea,rd,transfer,undergraduate_gpa,
            undergraduate_sat,undergraduate_language,graduate_gpa,graduate_sat,graduate_language,undergraduate_document,
            graduate_document,profession,tuition_fee,living_fee)
            value (%s, %s, %s, %s, %s, %s, 
            %s, %s, %s, %s, %s, %s, %s, %s, %s,
            %s, %s, %s, %s, %s, %s,
            %s, %s, %s, %s, %s, %s,
            %s, %s, %s, %s)""",
            (item['college_name'],  # item里面定义的字段和表字段对应
             item['college_e_name'],
             item['country'],
             item['area'],
             item['rate'],
             item['local_rank'],
             item['local_rank_name'],
             item['qs_rank'],
             item['icon'],
             item['hot_major'],
             item['introduce'],
             item['sum'],
             item['undergraduate'],
             item['graduate'],
             item['student_staff_ratio'],
             item['undergraduate_international_proportion'],
             item['graduate_international_proportion'],
             item['ea'],
             item['rd'],
             item['transfer'],
             item['undergraduate_gpa'],
             item['undergraduate_sat'],
             item['undergraduate_language'],
             item['graduate_gpa'],
             item['graduate_sat'],
             item['graduate_language'],
             item['undergraduate_document'],
             item['graduate_document'],
             item['profession'],
             item['tuition_fee'],
             item['living_fee']))

        # 提交sql语句
        self.connect.commit()
        return
        # return item  # 会在控制台输出item
