import scrapy

from college.items import CollegeInfoItem


class CollegeInfoSpider(scrapy.Spider):

    name = 'college_info'
    # start_urls = ["http://www.liuxue.com/college/MassachusettsInstituteofTechnology/index/3-9.html"]
    start_urls = ["http://www.liuxue.com/college/MassachusettsInstituteofTechnology/index/3-9.html",
                  "http://www.liuxue.com/college/StanfordUniversity/index/4-9.html",
                  "http://www.liuxue.com/college/HarvardUniversity/index/5-9.html",
                  "http://www.liuxue.com/college/CaliforniaInstituteofTechnology/index/6-9.html",
                  "http://www.liuxue.com/college/UniversityofOxford/index/7-4.html",
                  "http://www.liuxue.com/college/UniversityofCambridge/index/8-4.html",
                  "http://www.liuxue.com/college/ImperialCollegeLondon/index/9-4.html",
                  "http://www.liuxue.com/college/UniversityofChicago/index/10-9.html",
                  "http://www.liuxue.com/college/UniversityCollegeLondon/index/11-4.html",
                  "http://www.liuxue.com/college/PrincetonUniversity/index/14-9.html",
                  "http://www.liuxue.com/college/CornellUniversity/index/15-9.html",
                  "http://www.liuxue.com/college/YaleUniversity/index/16-9.html",
                  "http://www.liuxue.com/college/ColumbiaUniversity/index/17-9.html",
                  "http://www.liuxue.com/college/TheUniversityofEdinburgh/index/19-4.html",
                  "http://www.liuxue.com/college/UniversityofPennsylvania/index/20-9.html",
                  "http://www.liuxue.com/college/UniversityofMichiganAnnArbor/index/29-9.html",
                  "http://www.liuxue.com/college/JohnsHopkinsUniversity/index/30-9.html",
                  "http://www.liuxue.com/college/DukeUniversity/index/33-9.html",
                  "http://www.liuxue.com/college/UniversityofCaliforniaBerkeley/index/34-9.html",
                  "http://www.liuxue.com/college/TheUniversityofManchester/index/36-4.html",
                  "http://www.liuxue.com/college/KingsCollegeLondon/index/820-4.html",
                  "http://www.liuxue.com/college/UniversityofCaliforniaLosAngeles/index/39-9.html",
                  "http://www.liuxue.com/college/NorthwesternUniversity/index/41-9.html",
                  "http://www.liuxue.com/college/TheLondonSchoolofEconomicsandPoliticalScience/index/849-4.html",
                  "http://www.liuxue.com/college/UniversityofCaliforniaSanDiego/index/45-9.html",
                  "http://www.liuxue.com/college/NewYorkUniversity/index/47-9.html",
                  "http://www.liuxue.com/college/UniversityofBristol/index/53-4.html",
                  "http://www.liuxue.com/college/UniversityofWisconsinMadison/index/54-9.html",
                  "http://www.liuxue.com/college/TheUniversityofWarwick/index/55-4.html",
                  "http://www.liuxue.com/college/BrownUniversity/index/56-9.html",
                  "http://www.liuxue.com/college/UniversityofWashington/index/63-9.html",
                  "http://www.liuxue.com/college/GeorgiaInstituteofTechnology/index/66-9.html",
                  "http://www.liuxue.com/college/UniversityofGlasgow/index/67-4.html",
                  "http://www.liuxue.com/college/UniversityofIllinoisatUrbanaChampaign/index/835-9.html",
                  "http://www.liuxue.com/college/DurhamUniversity/index/69-4.html",
                  "http://www.liuxue.com/college/TheUniversityofSheffield/index/70-4.html",
                  "http://www.liuxue.com/college/UniversityofBirmingham/index/72-4.html",
                  "http://www.liuxue.com/college/UniversityofNottingham/index/73-4.html",
                  "http://www.liuxue.com/college/UniversityofNorthCarolinaatChapelHill/index/74-9.html",
                  "http://www.liuxue.com/college/RiceUniversity/index/76-9.html",
                  "http://www.liuxue.com/college/BostonUniversity/index/79-9.html",
                  "http://www.liuxue.com/college/UniversityofLeeds/index/80-4.html",
                  "http://www.liuxue.com/college/UniversityofSouthampton/index/82-4.html",
                  "http://www.liuxue.com/college/UniversityofStAndrews/index/83-4.html",
                  "http://www.liuxue.com/college/PurdueUniversityWestLafayette/index/917-9.html",
                  "http://www.liuxue.com/college/UniversityofCaliforniaDavis/index/86-9.html",
                  "http://www.liuxue.com/college/WashingtonUniversityinStLouis/index/87-9.html",
                  "http://www.liuxue.com/college/UniversityofSouthernCalifornia/index/91-9.html",
                  "http://www.liuxue.com/college/QueenMaryUniversityofLondon/index/93-4.html",
                  "http://www.liuxue.com/college/UniversityofMarylandCollegePark/index/880-9.html",
                  "http://www.liuxue.com/college/LancasterUniversity/index/99-4.html",
                  "http://www.liuxue.com/college/UniversityofCaliforniaSantaBarbara/index/100-9.html",
                  "http://www.liuxue.com/college/UniversityofYork/index/101-4.html",
                  "http://www.liuxue.com/college/UniversityofPittsburgh/index/102-9.html"]

    def parse(self, response):
        college = response.css('.college-desc')
        rank = response.css('.college-rank')

        item = CollegeInfoItem()  # 实例化item类

        item['college_name'] = college.css('.college-name::text').extract_first().split()[0]
        item['college_e_name'] = ' '.join(college.css('.college-e-name::text').extract_first().split())
        local=college.css('.local span::text').extract_first()
        item['country'] = local.split()[0]
        item['major_rank'] = rank.css('.major-rank::text').extract_first().split()[0]
        item['world_rank'] = rank.css('.world-rank::text').extract_first().split()[0]
        item['major_rank_name'] = rank.css('.rank-icon p::text').extract_first()
        item['icon'] = response.css(".college-badge img::attr(src)").extract_first().split('/')[-1]
        item['hot_major'] = college.css('.hot-major span::text').extract_first().split()[0].split('、')
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
