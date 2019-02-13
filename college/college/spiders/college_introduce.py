# -*- coding: utf-8 -*-
import scrapy

from college.items import CollegeIntroduceItem


class CollegeIntroduceSpider(scrapy.Spider):

    name = 'college_introduce'
    start_urls = ["http://www.liuxue.com/college/MassachusettsInstituteofTechnology/index/3-9.html"]
    # start_urls = ["http://www.liuxue.com/college/MassachusettsInstituteofTechnology/index/3-9.html",
    #               "http://www.liuxue.com/college/StanfordUniversity/index/4-9.html",
    #               "http://www.liuxue.com/college/HarvardUniversity/index/5-9.html",
    #               "http://www.liuxue.com/college/CaliforniaInstituteofTechnology/index/6-9.html",
    #               "http://www.liuxue.com/college/UniversityofOxford/index/7-4.html",
    #               "http://www.liuxue.com/college/UniversityofCambridge/index/8-4.html",
    #               "http://www.liuxue.com/college/ImperialCollegeLondon/index/9-4.html",
    #               "http://www.liuxue.com/college/UniversityofChicago/index/10-9.html",
    #               "http://www.liuxue.com/college/UniversityCollegeLondon/index/11-4.html",
    #               "http://www.liuxue.com/college/PrincetonUniversity/index/14-9.html",
    #               "http://www.liuxue.com/college/CornellUniversity/index/15-9.html",
    #               "http://www.liuxue.com/college/YaleUniversity/index/16-9.html",
    #               "http://www.liuxue.com/college/ColumbiaUniversity/index/17-9.html",
    #               "http://www.liuxue.com/college/TheUniversityofEdinburgh/index/19-4.html",
    #               "http://www.liuxue.com/college/UniversityofPennsylvania/index/20-9.html",
    #               "http://www.liuxue.com/college/UniversityofMichiganAnnArbor/index/29-9.html",
    #               "http://www.liuxue.com/college/JohnsHopkinsUniversity/index/30-9.html",
    #               "http://www.liuxue.com/college/DukeUniversity/index/33-9.html",
    #               "http://www.liuxue.com/college/UniversityofCaliforniaBerkeley/index/34-9.html",
    #               "http://www.liuxue.com/college/TheUniversityofManchester/index/36-4.html",
    #               "http://www.liuxue.com/college/KingsCollegeLondon/index/820-4.html",
    #               "http://www.liuxue.com/college/UniversityofCaliforniaLosAngeles/index/39-9.html",
    #               "http://www.liuxue.com/college/NorthwesternUniversity/index/41-9.html",
    #               "http://www.liuxue.com/college/TheLondonSchoolofEconomicsandPoliticalScience/index/849-4.html",
    #               "http://www.liuxue.com/college/UniversityofCaliforniaSanDiego/index/45-9.html",
    #               "http://www.liuxue.com/college/NewYorkUniversity/index/47-9.html",
    #               "http://www.liuxue.com/college/UniversityofBristol/index/53-4.html",
    #               "http://www.liuxue.com/college/UniversityofWisconsinMadison/index/54-9.html",
    #               "http://www.liuxue.com/college/TheUniversityofWarwick/index/55-4.html",
    #               "http://www.liuxue.com/college/BrownUniversity/index/56-9.html",
    #               "http://www.liuxue.com/college/UniversityofWashington/index/63-9.html",
    #               "http://www.liuxue.com/college/GeorgiaInstituteofTechnology/index/66-9.html",
    #               "http://www.liuxue.com/college/UniversityofGlasgow/index/67-4.html",
    #               "http://www.liuxue.com/college/UniversityofIllinoisatUrbanaChampaign/index/835-9.html",
    #               "http://www.liuxue.com/college/DurhamUniversity/index/69-4.html",
    #               "http://www.liuxue.com/college/TheUniversityofSheffield/index/70-4.html",
    #               "http://www.liuxue.com/college/UniversityofBirmingham/index/72-4.html",
    #               "http://www.liuxue.com/college/UniversityofNottingham/index/73-4.html",
    #               "http://www.liuxue.com/college/UniversityofNorthCarolinaatChapelHill/index/74-9.html",
    #               "http://www.liuxue.com/college/RiceUniversity/index/76-9.html",
    #               "http://www.liuxue.com/college/BostonUniversity/index/79-9.html",
    #               "http://www.liuxue.com/college/UniversityofLeeds/index/80-4.html",
    #               "http://www.liuxue.com/college/UniversityofSouthampton/index/82-4.html",
    #               "http://www.liuxue.com/college/UniversityofStAndrews/index/83-4.html",
    #               "http://www.liuxue.com/college/PurdueUniversityWestLafayette/index/917-9.html",
    #               "http://www.liuxue.com/college/UniversityofCaliforniaDavis/index/86-9.html",
    #               "http://www.liuxue.com/college/WashingtonUniversityinStLouis/index/87-9.html",
    #               "http://www.liuxue.com/college/UniversityofSouthernCalifornia/index/91-9.html",
    #               "http://www.liuxue.com/college/QueenMaryUniversityofLondon/index/93-4.html",
    #               "http://www.liuxue.com/college/UniversityofMarylandCollegePark/index/880-9.html",
    #               "http://www.liuxue.com/college/LancasterUniversity/index/99-4.html",
    #               "http://www.liuxue.com/college/UniversityofCaliforniaSantaBarbara/index/100-9.html",
    #               "http://www.liuxue.com/college/UniversityofYork/index/101-4.html",
    #               "http://www.liuxue.com/college/UniversityofPittsburgh/index/102-9.html"]

    def parse(self, response):
        college = response.css('.college-desc')
        rank = response.css('.college-rank')
        introduce = response.xpath('//div[@class="desc school-info active"]')
        apply = response.xpath('//div[@class="desc apply-info "]')
        profession = response.xpath('//div[@class="desc major "]')
        fee = response.xpath('//div[@class="desc fee "]')
        num_info = response.xpath("//td//text()").extract()

        for index, value in enumerate(num_info):
            num_info[index] = num_info[index].strip()

        item = CollegeIntroduceItem()  # 实例化item类

        item['college_name'] = college.css('.college-name::text').extract_first().strip()
        item['college_e_name'] = college.css('.college-e-name::text').extract_first().strip()
        local=college.css('.local span::text').extract_first()
        item['country'] = local.split()[0]
        item['world_rank'] = int(rank.css('.world-rank::text').extract_first().strip())
        item['major_rank_name'] = rank.css('.rank-icon p::text').extract_first()
        item['icon'] = response.css(".college-badge img::attr(src)").extract_first().split('/')[-1]
        item['hot_major'] = college.css('.hot-major span::text').extract_first().strip().split('、')
        item['introduce'] = introduce.css('p::text').extract_first().strip()
        item['sum']=int(num_info[1].replace(',','').replace('（含全日',''))
        item['undergraduate'] = int(num_info[3].strip().split('；')[0].replace(',', '').replace('全日制', '').replace(' ',''))
        item['graduate'] = int(num_info[5].strip().split('；')[0].replace(',', '').replace('全日制', '').replace('；','').replace(' ',''))
        item['student_staff_ratio'] = float(num_info[7].strip().split('或')[0].split(':')[1])
        item['undergraduate_international_proportion'] = float(num_info[13].replace('%', '').replace('：', '').replace('约','').replace('；',''))
        item['ea'] = num_info[20]
        item['rd'] = num_info[21]
        item['transfer'] = num_info[22]

        try:
            item['major_rank'] = int(rank.css('.major-rank::text').extract_first().strip())
        except:
            item['major_rank'] = "--"
        else:
            item['major_rank'] = int(rank.css('.major-rank::text').extract_first().strip())

        try:
            item['area'] = local.split()[1]
        except:
            item['area'] = "英格兰"  #赃值处理，就这一个有问题
        else:
            item['area'] = local.split()[1].replace("*(1)","")

        try:
            item['rate'] = float(college.css('.rate span::text').extract_first().strip().replace("约","").strip('%'))
        except:
            item['rate'] = "--"
        else:
            item['rate'] = float(college.css('.rate span::text').extract_first().strip().replace("约","").strip('%'))

        try:
            item['graduate_international_proportion'] = float(num_info[19].replace('%', ''))
        except:
            item['graduate_international_proportion'] = "--"
        else:
            item['graduate_international_proportion'] = float(num_info[19].replace('%', ''))

        yield item