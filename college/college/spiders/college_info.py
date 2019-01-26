import scrapy

from college.items import CollegeInfoItem

class CollegeInfoSpider(scrapy.Spider):
    name = 'college_info'
    start_urls = ['http://www.liuxue.com/college/MassachusettsInstituteofTechnology/index/?sid=3&rid=9&school_name=%E9%BA%BB%E7%9C%81%E7%90%86%E5%B7%A5%E5%AD%A6%E9%99%A2']

    def parse(self, response):
        college = response.css('.college-desc')

        item = CollegeInfoItem()  # 实例化item类

        item['college_name']=college.css('.college-name::text').extract_first().split()[0]
        item['college_e_name']=college.css('.college-e-name::text').extract_first().split()[0]
        local=college.css('.local span::text').extract_first()
        item['country']=local.split()[0]
        item['city']=local.split()[1]
        item['rate']=college.css('.rate span::text').extract_first().split()[0]
        yield item
