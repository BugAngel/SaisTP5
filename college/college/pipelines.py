# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://doc.scrapy.org/en/latest/topics/item-pipeline.html

import pymongo

class CollegePipeline(object):
    def process_item(self, item, spider):
        return item

class CollegeInfoPipeline(object):

    def __init__(self):
        # 建立MongoDB数据库连接
        client = pymongo.MongoClient('127.0.0.1', 27017)
        # 连接所需数据库
        db = client['wft']
        # 连接所用集合，也就是我们通常所说的表
        self.post = db['wft_college_info']

    def process_item(self, item, spider):
        postItem = dict(item)  # 把item转化成字典形式

        myquery = {"college_name": item["college_name"]}
        mydoc = self.post.find_one(myquery,{"_id": 0})
        if mydoc == None:
            self.post.insert(postItem)  # 向数据库插入一条记录
            return

        if postItem!=mydoc:
            self.post.find_one_and_delete(myquery,{"_id": 0})
            self.post.insert(postItem)  # 向数据库插入一条记录
            return
        # return item  # 会在控制台输出原item数据，可以选择不写
