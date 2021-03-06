# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# https://doc.scrapy.org/en/latest/topics/items.html

import scrapy


class CollegeItem(scrapy.Item):
    # define the fields for your item here like:
    # name = scrapy.Field()
    pass


class CollegeInfoItem(scrapy.Item):
    college_name = scrapy.Field()
    college_e_name = scrapy.Field()
    country = scrapy.Field()
    area = scrapy.Field()
    rate = scrapy.Field()
    major_rank = scrapy.Field()
    major_rank_name = scrapy.Field()
    world_rank = scrapy.Field()
    icon = scrapy.Field()
    hot_major = scrapy.Field()


class CollegeDetailItem(scrapy.Item):
    college_name = scrapy.Field()
    college_e_name = scrapy.Field()
    country = scrapy.Field()
    area = scrapy.Field()
    rate = scrapy.Field()
    major_rank = scrapy.Field()
    major_rank_name = scrapy.Field()
    world_rank = scrapy.Field()
    icon = scrapy.Field()
    hot_major = scrapy.Field()
    introduce = scrapy.Field()
    sum = scrapy.Field()
    undergraduate = scrapy.Field()
    graduate = scrapy.Field()
    student_staff_ratio = scrapy.Field()
    undergraduate_international_proportion = scrapy.Field()
    graduate_international_proportion = scrapy.Field()
    ea = scrapy.Field()
    rd = scrapy.Field()
    transfer = scrapy.Field()
    undergraduate_gpa = scrapy.Field()
    undergraduate_sat = scrapy.Field()
    undergraduate_language = scrapy.Field()
    graduate_gpa = scrapy.Field()
    graduate_sat = scrapy.Field()
    graduate_language = scrapy.Field()
    undergraduate_document = scrapy.Field()
    graduate_document = scrapy.Field()
    profession = scrapy.Field()
    tuition_fee = scrapy.Field()
    living_fee = scrapy.Field()

