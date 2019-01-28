import scrapy
import time

from college.items import CollegeInfoItem


class CollegeInfoSpider(scrapy.Spider):

    name = 'college_info'
    start_urls = ["http://www.liuxue.com/college/MassachusettsInstituteofTechnology/index/?sid=3&rid=9&school_name=%E9%BA%BB%E7%9C%81%E7%90%86%E5%B7%A5%E5%AD%A6%E9%99%A2",
                  "http://www.liuxue.com/college/StanfordUniversity/index/?sid=4&rid=9&school_name=%E6%96%AF%E5%9D%A6%E7%A6%8F%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/HarvardUniversity/index/?sid=5&rid=9&school_name=%E5%93%88%E4%BD%9B%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/CaliforniaInstituteofTechnology/index/?sid=6&rid=9&school_name=%E5%8A%A0%E5%B7%9E%E7%90%86%E5%B7%A5%E5%AD%A6%E9%99%A2",
                  "http://www.liuxue.com/college/UniversityofOxford/index/?sid=7&rid=4&school_name=%E7%89%9B%E6%B4%A5%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofCambridge/index/?sid=8&rid=4&school_name=%E5%89%91%E6%A1%A5%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/ImperialCollegeLondon/index/?sid=9&rid=4&school_name=%E5%B8%9D%E5%9B%BD%E7%90%86%E5%B7%A5%E5%AD%A6%E9%99%A2",
                  "http://www.liuxue.com/college/UniversityofChicago/index/?sid=10&rid=9&school_name=%E8%8A%9D%E5%8A%A0%E5%93%A5%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityCollegeLondon/index/?sid=11&rid=4&school_name=%E4%BC%A6%E6%95%A6%E5%A4%A7%E5%AD%A6%E5%AD%A6%E9%99%A2",
                  "http://www.liuxue.com/college/PrincetonUniversity/index/?sid=14&rid=9&school_name=%E6%99%AE%E6%9E%97%E6%96%AF%E9%A1%BF%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/CornellUniversity/index/?sid=15&rid=9&school_name=%E5%BA%B7%E5%A5%88%E5%B0%94%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/YaleUniversity/index/?sid=16&rid=9&school_name=%E8%80%B6%E9%B2%81%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/ColumbiaUniversity/index/?sid=17&rid=9&school_name=%E5%93%A5%E4%BC%A6%E6%AF%94%E4%BA%9A%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/TheUniversityofEdinburgh/index/?sid=19&rid=4&school_name=%E7%88%B1%E4%B8%81%E5%A0%A1%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofPennsylvania/index/?sid=20&rid=9&school_name=%E5%AE%BE%E5%A4%95%E6%B3%95%E5%B0%BC%E4%BA%9A%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofMichiganAnnArbor/index/?sid=29&rid=9&school_name=%E5%AF%86%E6%AD%87%E6%A0%B9%E5%A4%A7%E5%AD%A6%E5%AE%89%E5%A8%9C%E5%A0%A1%E5%88%86%E6%A0%A1",
                  "http://www.liuxue.com/college/JohnsHopkinsUniversity/index/?sid=30&rid=9&school_name=%E7%BA%A6%E7%BF%B0%E9%9C%8D%E6%99%AE%E9%87%91%E6%96%AF%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/DukeUniversity/index/?sid=33&rid=9&school_name=%E6%9D%9C%E5%85%8B%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofCaliforniaBerkeley/index/?sid=34&rid=9&school_name=%E5%8A%A0%E5%B7%9E%E5%A4%A7%E5%AD%A6%E4%BC%AF%E5%85%8B%E5%88%A9%E5%88%86%E6%A0%A1",
                  "http://www.liuxue.com/college/TheUniversityofManchester/index/?sid=36&rid=4&school_name=%E6%9B%BC%E5%BD%BB%E6%96%AF%E7%89%B9%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/KingsCollegeLondon/index/?sid=820&rid=4&school_name=%E4%BC%A6%E6%95%A6%E5%9B%BD%E7%8E%8B%E5%AD%A6%E9%99%A2",
                  "http://www.liuxue.com/college/UniversityofCaliforniaLosAngeles/index/?sid=39&rid=9&school_name=%E5%8A%A0%E5%B7%9E%E5%A4%A7%E5%AD%A6%E6%B4%9B%E6%9D%89%E7%9F%B6%E5%88%86%E6%A0%A1",
                  "http://www.liuxue.com/college/NorthwesternUniversity/index/?sid=41&rid=9&school_name=%E8%A5%BF%E5%8C%97%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/TheLondonSchoolofEconomicsandPoliticalScience/index/?sid=849&rid=4&school_name=%E4%BC%A6%E6%95%A6%E6%94%BF%E6%B2%BB%E7%BB%8F%E6%B5%8E%E5%AD%A6%E9%99%A2",
                  "http://www.liuxue.com/college/UniversityofCaliforniaSanDiego/index/?sid=45&rid=9&school_name=%E5%8A%A0%E5%B7%9E%E5%A4%A7%E5%AD%A6%E5%9C%A3%E5%9C%B0%E4%BA%9A%E5%93%A5%E5%88%86%E6%A0%A1",
                  "http://www.liuxue.com/college/NewYorkUniversity/index/?sid=47&rid=9&school_name=%E7%BA%BD%E7%BA%A6%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofBristol/index/?sid=53&rid=4&school_name=%E5%B8%83%E9%87%8C%E6%96%AF%E6%89%98%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofWisconsinMadison/index/?sid=54&rid=9&school_name=%E5%A8%81%E6%96%AF%E5%BA%B7%E8%BE%9B%E5%A4%A7%E5%AD%A6%E9%BA%A6%E8%BF%AA%E9%80%8A%E5%88%86%E6%A0%A1",
                  "http://www.liuxue.com/college/TheUniversityofWarwick/index/?sid=55&rid=4&school_name=%E5%8D%8E%E5%A8%81%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/BrownUniversity/index/?sid=56&rid=9&school_name=%E5%B8%83%E6%9C%97%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofWashington/index/?sid=63&rid=9&school_name=%E5%8D%8E%E7%9B%9B%E9%A1%BF%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/GeorgiaInstituteofTechnology/index/?sid=66&rid=9&school_name=%E4%BD%90%E6%B2%BB%E4%BA%9A%E7%90%86%E5%B7%A5%E5%AD%A6%E9%99%A2",
                  "http://www.liuxue.com/college/UniversityofGlasgow/index/?sid=67&rid=4&school_name=%E6%A0%BC%E6%8B%89%E6%96%AF%E5%93%A5%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofIllinoisatUrbanaChampaign/index/?sid=835&rid=9&school_name=%E4%BC%8A%E5%88%A9%E8%AF%BA%E5%A4%A7%E5%AD%A6%E9%A6%99%E6%A7%9F%E5%88%86%E6%A0%A1",
                  "http://www.liuxue.com/college/DurhamUniversity/index/?sid=69&rid=4&school_name=%E6%9D%9C%E4%BC%A6%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/TheUniversityofSheffield/index/?sid=70&rid=4&school_name=%E8%B0%A2%E8%8F%B2%E5%B0%94%E5%BE%B7%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofBirmingham/index/?sid=72&rid=4&school_name=%E4%BC%AF%E6%98%8E%E7%BF%B0%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofNottingham/index/?sid=73&rid=4&school_name=%E8%AF%BA%E4%B8%81%E6%B1%89%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofNorthCarolinaatChapelHill/index/?sid=74&rid=9&school_name=%E5%8C%97%E5%8D%A1%E7%BD%97%E6%9D%A5%E7%BA%B3%E5%A4%A7%E5%AD%A6%E6%95%99%E5%A0%82%E5%B1%B1%E5%88%86%E6%A0%A1",
                  "http://www.liuxue.com/college/RiceUniversity/index/?sid=76&rid=9&school_name=%E8%8E%B1%E6%96%AF%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/BostonUniversity/index/?sid=79&rid=9&school_name=%E6%B3%A2%E5%A3%AB%E9%A1%BF%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofLeeds/index/?sid=80&rid=4&school_name=%E5%88%A9%E5%85%B9%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofSouthampton/index/?sid=82&rid=4&school_name=%E5%8D%97%E5%AE%89%E6%99%AE%E6%95%A6%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofStAndrews/index/?sid=83&rid=4&school_name=%E5%9C%A3%E5%AE%89%E5%BE%B7%E9%B2%81%E6%96%AF%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/PurdueUniversityWestLafayette/index/?sid=917&rid=9&school_name=%E6%99%AE%E6%B8%A1%E5%A4%A7%E5%AD%A6%E8%A5%BF%E6%8B%89%E6%B3%95%E8%80%B6%E5%88%86%E6%A0%A1",
                  "http://www.liuxue.com/college/UniversityofCaliforniaDavis/index/?sid=86&rid=9&school_name=%E5%8A%A0%E5%B7%9E%E5%A4%A7%E5%AD%A6%E6%88%B4%E7%BB%B4%E6%96%AF%E5%88%86%E6%A0%A1",
                  "http://www.liuxue.com/college/WashingtonUniversityinStLouis/index/?sid=87&rid=9&school_name=%E5%9C%A3%E8%B7%AF%E6%98%93%E6%96%AF%E5%8D%8E%E7%9B%9B%E9%A1%BF%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofSouthernCalifornia/index/?sid=91&rid=9&school_name=%E5%8D%97%E5%8A%A0%E5%B7%9E%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/QueenMaryUniversityofLondon/index/?sid=93&rid=4&school_name=%E4%BC%A6%E6%95%A6%E5%A4%A7%E5%AD%A6%E7%8E%9B%E4%B8%BD%E5%A5%B3%E7%8E%8B%E5%AD%A6%E9%99%A2",
                  "http://www.liuxue.com/college/UniversityofMarylandCollegePark/index/?sid=880&rid=9&school_name=%E9%A9%AC%E9%87%8C%E5%85%B0%E5%A4%A7%E5%AD%A6%E5%AD%A6%E9%99%A2%E5%85%AC%E5%9B%AD%E5%88%86%E6%A0%A1",
                  "http://www.liuxue.com/college/LancasterUniversity/index/?sid=99&rid=4&school_name=%E5%85%B0%E5%8D%A1%E6%96%AF%E7%89%B9%E5%A4%A7%E5%AD%A6",
                  "http://www.liuxue.com/college/UniversityofCaliforniaSantaBarbara/index/?sid=100&rid=9&school_name=%E5%8A%A0%E5%B7%9E%E5%A4%A7%E5%AD%A6%E5%9C%A3%E5%A1%94%E8%8A%AD%E8%8A%AD%E6%8B%89%E5%88%86%E6%A0%A1",
                  "http://www.liuxue.com/college/UniversityofYork/index/?sid=101&rid=4&school_name=%E7%BA%A6%E5%85%8B%E5%A4%A7%E5%AD%A6%EF%BC%88%E8%8B%B1%E5%9B%BD%EF%BC%89",
                  "http://www.liuxue.com/college/UniversityofPittsburgh/index/?sid=102&rid=9&school_name=%E5%8C%B9%E5%85%B9%E5%A0%A1%E5%A4%A7%E5%AD%A6"]

    def parse(self, response):
        time.sleep(1)

        college = response.css('.college-desc')
        rank = response.css('.college-rank')

        item = CollegeInfoItem()  # 实例化item类

        item['college_name'] = college.css('.college-name::text').extract_first().split()[0]
        item['college_e_name'] = ' '.join(college.css('.college-e-name::text').extract_first().split())
        local=college.css('.local span::text').extract_first()
        item['country'] = local.split()[0]
        item['major_rank'] = rank.css('.major-rank::text').extract_first().split()[0]
        item['world_rank'] = rank.css('.world-rank::text').extract_first().split()[0]

        try:
            item['city'] = local.split()[1]
        except:
            item['city'] = "--"
        else:
            item['city'] = local.split()[1].replace("*(1)","")

        try:
            item['rate'] = college.css('.rate span::text').extract_first().split()[0]
        except:
            item['rate'] = "--"
        else:
            item['rate'] = college.css('.rate span::text').extract_first().split()[0].replace("约","")
        yield item
