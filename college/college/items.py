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
    city = scrapy.Field()
    rate = scrapy.Field()
    pass