import scrapy
import re
from datetime import datetime

class BLSSpider(scrapy.Spider):
    name = "bls"
    start_urls = ['https://algeria.blsspainvisa.com/french/']

    def parse(self, response):
        # Écrire le contenu de la page dans un fichier pour débogage
        with open('page_content.html', 'w', encoding='utf-8') as f:
            f.write(response.text)

        # Exemple d'expression régulière pour les dates au format "09 Avril 2023"
        date_pattern = re.compile(r'\b\d{1,2} [A-Z][a-z]+ \d{4}\b')

        # Extraire toutes les dates qui correspondent au motif
        dates = date_pattern.findall(response.text)

        # Filtrer pour obtenir uniquement les dates futures
        dates_futures = []
        for date in dates:
            try:
                parsed_date = datetime.strptime(date, '%d %B %Y')
                if parsed_date > datetime.now():
                    dates_futures.append(parsed_date.strftime('%d %B %Y'))
            except ValueError:
                continue

        for date in dates_futures:
            self.log(f"Date disponible trouvée : {date}")
            yield {
                'date': date
            }
