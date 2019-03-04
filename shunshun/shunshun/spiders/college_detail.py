# -*- coding: utf-8 -*-
import scrapy
import json

from shunshun.items import CollegeDetailItem


class CollegeDetailSpider(scrapy.Spider):

    name = 'college_detail'
    # start_urls = ["http://www.liuxue.com/college/UniversityofChicago/index.html"]
    start_urls = ["http://www.liuxue.com/college/MassachusettsInstituteofTechnology/index.html",
                  "http://www.liuxue.com/college/StanfordUniversity/index.html",
                  "http://www.liuxue.com/college/HarvardUniversity/index.html",
                  "http://www.liuxue.com/college/CaliforniaInstituteofTechnology/index.html",
                  "http://www.liuxue.com/college/UniversityofOxford/index.html",
                  "http://www.liuxue.com/college/UniversityofCambridge/index.html",
                  "http://www.liuxue.com/college/ImperialCollegeLondon/index.html",
                  "http://www.liuxue.com/college/UniversityofChicago/index.html",
                  "http://www.liuxue.com/college/UniversityCollegeLondon/index.html",
                  "http://www.liuxue.com/college/PrincetonUniversity/index.html",
                  "http://www.liuxue.com/college/CornellUniversity/index.html",
                  "http://www.liuxue.com/college/YaleUniversity/index.html",
                  "http://www.liuxue.com/college/ColumbiaUniversity/index.html",
                  "http://www.liuxue.com/college/TheUniversityofEdinburgh/index.html",
                  "http://www.liuxue.com/college/UniversityofPennsylvania/index.html",
                  "http://www.liuxue.com/college/UniversityofMichiganAnnArbor/index.html",
                  "http://www.liuxue.com/college/JohnsHopkinsUniversity/index.html",
                  "http://www.liuxue.com/college/DukeUniversity/index.html",
                  "http://www.liuxue.com/college/UniversityofCaliforniaBerkeley/index.html",
                  "http://www.liuxue.com/college/TheUniversityofManchester/index.html",
                  "http://www.liuxue.com/college/KingsCollegeLondon/index.html",
                  "http://www.liuxue.com/college/UniversityofCaliforniaLosAngeles/index.html",
                  "http://www.liuxue.com/college/NorthwesternUniversity/index.html",
                  "http://www.liuxue.com/college/TheLondonSchoolofEconomicsandPoliticalScience/index.html",
                  "http://www.liuxue.com/college/UniversityofCaliforniaSanDiego/index.html",
                  "http://www.liuxue.com/college/NewYorkUniversity/index.html",
                  "http://www.liuxue.com/college/UniversityofBristol/index.html",
                  "http://www.liuxue.com/college/UniversityofWisconsinMadison/index.html",
                  "http://www.liuxue.com/college/TheUniversityofWarwick/index.html",
                  "http://www.liuxue.com/college/BrownUniversity/index.html",
                  "http://www.liuxue.com/college/UniversityofWashington/index.html",
                  "http://www.liuxue.com/college/GeorgiaInstituteofTechnology/index.html",
                  "http://www.liuxue.com/college/UniversityofGlasgow/index.html",
                  "http://www.liuxue.com/college/UniversityofIllinoisatUrbanaChampaign/index.html",
                  "http://www.liuxue.com/college/DurhamUniversity/index.html",
                  "http://www.liuxue.com/college/TheUniversityofSheffield/index.html",
                  "http://www.liuxue.com/college/UniversityofBirmingham/index.html",
                  "http://www.liuxue.com/college/UniversityofNottingham/index.html",
                  "http://www.liuxue.com/college/UniversityofNorthCarolinaatChapelHill/index.html",
                  "http://www.liuxue.com/college/RiceUniversity/index.html",
                  "http://www.liuxue.com/college/BostonUniversity/index.html",
                  "http://www.liuxue.com/college/UniversityofLeeds/index.html",
                  "http://www.liuxue.com/college/UniversityofSouthampton/index.html",
                  "http://www.liuxue.com/college/UniversityofStAndrews/index.html",
                  "http://www.liuxue.com/college/PurdueUniversityWestLafayette/index.html",
                  "http://www.liuxue.com/college/UniversityofCaliforniaDavis/index.html",
                  "http://www.liuxue.com/college/WashingtonUniversityinStLouis/index.html",
                  "http://www.liuxue.com/college/UniversityofSouthernCalifornia/index.html",
                  "http://www.liuxue.com/college/QueenMaryUniversityofLondon/index.html",
                  "http://www.liuxue.com/college/UniversityofMarylandCollegePark/index.html",
                  "http://www.liuxue.com/college/LancasterUniversity/index.html",
                  "http://www.liuxue.com/college/UniversityofCaliforniaSantaBarbara/index.html",
                  "http://www.liuxue.com/college/UniversityofYork/index.html",
                  "http://www.liuxue.com/college/UniversityofPittsburgh/index.html"]

    def parse(self, response):
        college = response.css('.college-desc')
        rank = response.css('.college-rank')
        introduce = response.xpath('//div[@class="desc school-info active"]')
        profession = json.dumps(response.xpath('//div[@class="gre-major-table"]//span//text()').extract())
        fee = response.xpath('//ul[@class="fee-table"]//span//text()').extract()
        num_info = [i.strip() for i in response.xpath('//td//text()').extract()]
        score = [i.strip() for i in response.xpath('//span[@class="standard-score"]//text()').extract()]
        document = [i.strip() for i in response.xpath('//ul[@class="data-list"]//text()').extract()]

        item = CollegeDetailItem()  # 实例化item类

        item['college_name'] = college.css('.college-name::text').extract_first().strip()
        item['college_e_name'] = college.css('.college-e-name::text').extract_first().strip()
        local = college.css('.local span::text').extract_first()
        item['country'] = local.split()[0]
        item['local_rank_name'] = rank.css('.rank-icon p::text').extract_first()
        item['icon'] = response.css(".college-badge img::attr(src)").extract_first().split('/')[-1]
        item['introduce'] = introduce.css('p::text').extract_first().strip()
        item['sum'] = int(num_info[1].replace(',','').replace('（含全日',''))
        item['undergraduate'] = int(num_info[3].strip().split('；')[0].replace(',', '').replace('全日制', '').replace(' ',''))
        item['graduate'] = int(num_info[5].strip().split('；')[0].replace(',', '').replace('全日制', '').replace('；','').replace(' ',''))
        item['student_staff_ratio'] = float(num_info[7].strip().split('或')[0].split(':')[1])
        item['undergraduate_international_proportion'] = float(num_info[13].replace('%', '').replace('：', '').replace('约','').replace('；',''))
        item['undergraduate_gpa'] = score[0]
        item['undergraduate_sat'] = score[1]
        item['undergraduate_language'] = score[2]
        item['graduate_gpa'] = score[3]
        item['graduate_sat'] = score[4]
        item['graduate_language'] = score[5]
        item['profession'] = profession
        item['undergraduate_document'] = []
        item['graduate_document'] = []

        flag = True
        for index, value in enumerate(document):
            if value != "":
                if flag:
                    item['undergraduate_document'].append(value)
                else:
                    item['graduate_document'].append(value)

            if index > 0:
                if value == "" and document[index-1] == "":
                    flag = False

        item['undergraduate_document'] = json.dumps(item['undergraduate_document'])
        item['graduate_document'] = json.dumps(item['graduate_document'])

        hot_major=college.css('.hot-major span::text').extract_first().strip().split('、')
        if hot_major[0] != '--':
            item['hot_major'] = json.dumps(hot_major)
        else:
            item['hot_major'] = None

        if num_info[20] != '--':
            item['ea'] = num_info[20]
        else:
            item['ea'] = None

        if num_info[21] != '--':
            item['rd'] = num_info[21]
        else:
            item['rd'] = None

        if num_info[22] != '--':
            item['transfer'] = num_info[22]
        else:
            item['transfer'] = None

        try:
            item['qs_rank'] = int(rank.css('.world-rank::text').extract_first().strip())
        except:
            item['qs_rank'] = None
        else:
            item['qs_rank'] = rank.css('.world-rank::text').extract_first().strip()

        try:
            item['local_rank'] = int(rank.css('.major-rank::text').extract_first().strip())
        except:
            item['local_rank'] = None
        else:
            item['local_rank'] = rank.css('.major-rank::text').extract_first().strip()

        try:
            item['area'] = local.split()[1]
        except:
            item['area'] = "英格兰"  #赃值处理，就这一个有问题
        else:
            item['area'] = local.split()[1].replace("*(1)","")

        try:
            item['rate'] = float(college.css('.rate span::text').extract_first().strip().replace("约","").strip('%'))
        except:
            item['rate'] = None
        else:
            item['rate'] = float(college.css('.rate span::text').extract_first().strip().replace("约","").strip('%'))

        try:
            item['graduate_international_proportion'] = float(num_info[19].replace('%', ''))
        except:
            item['graduate_international_proportion'] = None
        else:
            item['graduate_international_proportion'] = float(num_info[19].replace('%', ''))

        try:
            item['tuition_fee'] = fee[1]
        except:
            item['tuition_fee'] = None
        else:
            item['tuition_fee'] = fee[1]

        try:
            item['living_fee'] = fee[3]
        except:
            item['living_fee'] = None
        else:
            item['living_fee'] = fee[3]

        yield item
