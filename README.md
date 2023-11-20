# Uitleg Roadmap

## [Installatie VPS](Installatie VPS)
Clone het project

Gebruik het bevel: composer install

Gebruik het bevel: php artisan key:generate

Gebruik het bevel: npm install

Gebruik het bevel: npm run dev

maak een database aan

kopieer het .env.example bestand om naar .env

vul de database credentials in binnen het .env bestand

Gebruik het bevel: php artisan migrate

Gebruik het bevel: php artisan storage:link

Gebruik het bevel: php artisan db:seed

zorg dat uw webserver aan staat en goed is ingesteld.

De applicatie kan nu worden gebruikt.

## [Development Mode](Development Mode)
gebruik de onderstaande commands in development mode om de applicatie te starten. Doe dit in twee verschillende commands prompts.

Gebruik het bevel: php artisan serve

Gebruik het bevel: npm start

## [Toekomstige development tips](Toekomstige development tips)

Refactor de code. Zorg er bijvoorbeeld voor dat het model WorkProcess als Workprocess wordt ingeladen, nu wordt het vaak imported als WorkProcess of Workprocess waardoor er in productie errors komen aangezien het model WorkProcess niet bestaat (Case Sensitive!).

In de seeder wordt er een admin account gemaakt. Het wachtwoord is nu als generiek wachtwoord ingesteld en direct in de seeder ingesteld. Zet dit om zodat de seeder het wachtwoord uit het .env bestand haalt en vervolgens hashed en in de database toevoegt. Dit is veiliger dan het wachtwoord direct via de seeder te hashen en aan de database toe te voegen. Dit is komt doordat het .env bestand niet naar de repo wordt geupload en de seeder wel.

Zorg voor een goede opmaak van de front-end. Nu is het de generieke styling van laravel. Gebruik een template om een mooier effect te krijgen.

De index pagina moet nog worden ontworpen. 

