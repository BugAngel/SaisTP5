# -*- coding: utf-8 -*-
import scrapy
import json

from shunshun.items import CollegeInfoItem


class CollegeInfoSpider(scrapy.Spider):

    name = 'college_info'
    # start_urls = ["http://www.liuxue.com/college/MassachusettsInstituteofTechnology/index.html"]
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

        item = CollegeInfoItem()  # 实例化item类

        item['college_name'] = college.css('.college-name::text').extract_first().strip()
        item['college_e_name'] = college.css('.college-e-name::text').extract_first().strip()
        local=college.css('.local span::text').extract_first()
        item['country'] = local.split()[0]
        item['local_rank_name'] = rank.css('.rank-icon p::text').extract_first()
        item['icon'] = response.css(".college-badge img::attr(src)").extract_first().split('/')[-1]

        hot_major=college.css('.hot-major span::text').extract_first().strip().split('、')
        if hot_major[0] != '--':
            item['hot_major'] = json.dumps(hot_major)
        else:
            item['hot_major'] = None

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
            item['area'] = "英格兰"  #脏值处理，就这一个有问题
        else:
            item['area'] = local.split()[1].replace("*(1)","")

        try:
            item['rate'] = float(college.css('.rate span::text').extract_first().strip().replace("约","").strip('%'))
        except:
            item['rate'] = None
        else:
            item['rate'] = college.css('.rate span::text').extract_first().strip().replace("约","").strip('%')
        yield item
