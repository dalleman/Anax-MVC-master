Redovisning
====================================
Kmom06: Verktyg och CI
---------------------------
Det här var ett kul moment där man känner igen metoderna sen tidigare. I en tidigare programmeringskurs inom java jobbade man på liknande sätt och kan tänka mig att det är likadant inom många andra språk. Skapa testfall, kör testfilen, evaluera och kör test efter alla framtida ändringar för att inte göra nåt galet. Dock hade jag inledande problem med phpunit (min dåliga Mac-vana som spökar). Kunde till en början inte få igång programmet men sen gick det nästan smort. 

När jag skulle skapa mina egna testfall så fick jag ingen utskrift och då blev det svårt att avgöra vad felet var. Detta löste jag genom att läsa på lite om MAMP och error handling, då fick jag också reda på att session blir svårt att testa med i kommandofönstret så detta fick lösas också. Det största problemet jag stötte på dock var att jag inledningsvis satt och redigera CFlash-filen som låg i kmom05 när jag egentligen jobbade i kmom06, suck.

Att skapa testfallen gick smort, såg till att jag fick 100% code coverage på själva klassfilen CFlash, fick dock inte det på autoloader.php men det nöjer jag mig med. 

Att implementera med travis och scrutinizer gick smort, utförliga instruktioner, inget att klaga på. Första gången jag använder dessa verktyg och måste säga att jag är mäktigt imponerad, avlastar mycket arbete när man jobbar med testfall. Nu behöver man aldrig manuellt köra sina testfall utan kan bara logga in på respektive verktyg och se efter ifall allt är grönt. Det kändes väldigt tryggt att jobba med dessa verktyg, inte krångligt alls och kommer definitivt använda dessa i fortsättningen. 

Jag gjorde inte extrauppgiften. 


Kmom05: Bygg ut ramverket
----------------------------------
Jag valde att göra en klass CFlash som skickar flashmessage vid nästa sidanrop. Iden kom självklart från tipsen i “Bygg ut ditt Anax MVC med en egen modul och publicera via Packagist”. Läste igenom och fick tipset att man ska lagra meddelandet i en session-variabel vid en viss händelse och så blev det. Kodbasen för modulen fick jag från de tidigare paketen vi hämtat med packagist CDatabase och CForm. Skapade två funktioner i klassen som heter insert och printMessage. Den förstnämnda lagrar bifogad stringparameter i $_SESSION['CFlashMessage'] och den senare skriver ut en div med det lagrade meddelandet. Den andra läser dvs av ifall det finns ett meddelande lagrat i sessionparametern och ifall detta finns så skriver den ut den för att sedan radera den.

För att testa CFlash på min me-sida så gå in på redovisningssidan, då anropas CFlash->insert('hej'). Stringen hej kommer då ligga i $_SESSION['CFlashMessage'] fram tills att man besöker sidan source. När man väl besöker sidan source så anropas metoden CFlash->printMessage() och agerar som tidigare beskrivet.

Att utveckla modulen i sig var inga stora problem, fick småerrrors som löstes snabbt som att jag inte kunde använda print som funktionsnamn och parse errors men sen fungerade modulen som den skulle när jag testade den. Sen kom problemen, nu skulle jag utforma det till ett paket som skulle laddas upp på github och kunna laddas ner genom packagist med composer, ville den autoloada? Självklart inte. Jag försökte få composer.json att ha exakt samma struktur som den i CDatabase och mapputformning m.m. Men det ville sig inte ett bra tag. Till slut så märkte jag att det tog lite tid för uppdateringar till github att verkställas och då började det gå lite smidigare och till slut fungerar allt som det ska. Jag laddar klassen som en funktion i DI vid namn Flash och till en början så hitta den inte klassen som sagt men sen när det väl fungerade så fungerade det :) .

Jag visste inte hur utförlig man skulle vara i dokumentationen men jag skrev utförliga instruktioner om hur klassen ska användas och vad som händer. Jag gjorde inte extra-uppgiften.

För att hämta CFlash med packagist så anges "require": {"dalle/cflash": "dev-master"}.
 
Min Me-Sida: http://www.student.bth.se/~dabb14/phpmvc/kmom05/Anax-MVC-master/webroot/

Länk till Packagist: https://packagist.org/packages/dalle/cflash

Länk till Github: https://github.com/dalleman/CFlash

Kmom04: Databasdrivna modeller
------------------------------------
Wow detta var ett fullsmockat moment med många errors på vägen. Formulärhantering var inget jag gillade. Jag gillar mer det klassiska, känns mer inuitivt när man jobbar med det. Här måste man hoppa hela tiden till koden för att se hur det ska läggas upp för att fungera m.m. Ifall man väl kommer in i det och använder sig av det en längre tid kan jag tänka mig att det är väldigt smidigt och mycket snyggare kod. 

Databashanteringen var smidig men jag föredrar traditionella sql queries. Inte för att jag är nån hejare på det men det är oxå något som jag vill bygga på, då är det inte så lämpligt att använda sig av moduler när man vill bli bättre på något.

Basklassen och sättet man gjorde det va på va väldigt smidigt, att använda sig av klassnamnet på tex user och implementera basklassen gjorde så det blev väldigt mycket lättare sen när man skulle lägga comments i databasen. Det var mestadels bara att ta kod från UsersController sen och implementera i CommentsController för att få allting att funka. Ska dock inte säga att det gick smidigt, hade några problem på vägen men det mesta berodde på namespace errors och diverse syntaxfel.  Ifall som jag gjorde, tog ett par dagars uppehåll ifrån att fortsätta på uppgiften då kände jag mig riktigt vilse, tog ett tag att leta reda på allt och hamna i ett flow igen men sen gick det på.

Jag valde att lägga Användardelen av uppgiften som dropdownlänkar där alla fall kan testas, allt ska fungera som det ska om jag nu kommer ihåg hur jag kopplar upp mig mot skolans databas. Ska strax ladda upp allting och redigera om mysql-inställningarna till skolans så vi får se om det funkar annars så hör jag av mig i forumet :) .

Ser starkt fram emot nästa moment och hoppas det inte är lika stort som det här va :) .



Kmom03: Bygg ett eget tema
------------------------------------
Det var mycket och hålla koll på i detta moment och jag kan inte medge att jag var så värst förtjust i att använda mig av ramverk som sköter designen. Det som skapade mest problem var antagligen det att det tar tid för mamp att uppdatera css-filerna så även om jag bytte tema helt till ett annat så var koden baserad på tidigare tema och följde de ändringarna. Därför fick jag för mig att jag var tvungen att ändra i någon config-fil som jag inte kunde hitta för att använda mig av det temat jag ville men tydligen så var det bara mamp som busa.

Less överlag tyckte jag var väldigt användbart och ser mycket möjligheter för. Att kunna programmera in funktioner och göra css mer dynamisk kan inte skada. 

Gridbaserad layout var något jag kände inför att det inte skulle göra så stor skillnad, att det såg bra ut som det var. Efter att ha ställt in det efter anvisningar så märkte jag att allt blev mycket skönare för ögona och man kunde se en bättre struktur på sidan. 

Font Awesome är inget jag kommer använda för mycket då jag vill lära mig hantera program som Illustrator och Photoshop i och med att jag ser mer möjligheter med den kunskapen, annars så var det ett riktigt bra sätt att få till lite grafik till hemsidan. Normalize, vilket verktyg, att kunna göra så att ens hemsida ser likadan ut (så nöra som det går) på alla webläsare är helt fantastiskt, underlättar mycket arbete. 

Jag gick inte så långt ifrån den förra designen när jag gjorde mitt tema, det skulle röra sig om samma färger det jag mest ville ha in var det grid-baserade och att kunna ha olika regioner som man kan fylla vid behov. Antog inte utmaningen om extra-uppgiften med brist på tid, allt ska ju in idag.

Allt som allt var detta ett givande moment dock med många tråkiga buggar på vägen som tog upp onödig tid. Ser fram emot nästa moment vilket jag sätter igång med på direkten.



Kmom02: Kontroller och modeller
------------------------------------
Det här momentet gick lite smidigare än första. Nu börjar man komma in lite i hur det mesta är kopplat och var man ska ändra det man vill ändra. Ett exempel är $app som nu känns lite mer straight forward när man inser att det inte är allt för många funktioner som laddas så jag har försökt gå igenom de huvudfunktionerna som url, dispatcher m.fl. lite mer ingående för att få ett bättre flow i planering och utförande av uppgifter. Det var mycket läsning i detta moment och svårt att ta in allt men fungerade mycket bra som referensläsning för att bättre förstå dispatcher tex när man var tvungen att använda den som tex för att visa kommentarer med hjälp av commentController.

Composer var väldigt smidigt att använda och kommer bli väldigt användbart framöver. Det uppstod lite problem i början för att få det att fungera som det skulle då jag inte visste var det skulle installeras på macen men så fort det löstes så var det bara att köra. Jag har inte gått igenom så mycket av innehållet på packagist men kan tänka mig att det dinns mycket bra grejer där som kommer användas när man behöver simpla, färdiga lösningar.

Angående dispatcher så förstod man ganska snabbt tanken med controller, actions och params. Det som var lite kruxigt var hur jag skulle nyttja medskickad parameter då det tog lite tid och r_prints för att få fram den medskickade parametern. Det var speciellt vid utformningen av kommentarssystemet som jag kände att jag ville skicka med en parameter då tanken var att kommentarer skulle lagras med sidspecifika sessionnamn som tex commentsstart, commentsredovisning m.m. 

Några direkta svagheter hittade jag inte i phpmvc/comment mer än att de saknades de funktioner som vi fick i uppgift att lägga till. Kraven till uppgiften var uppfyllda för att sedan implementera så att det var olika kommentarer på olika sidor, här blev det lite körigt. Tanken var att lagra alla kommentarer i olika sessionnamn och efter att det beslutades så tog det en himla tid att få alla kravfunktioner att fungera rätt, radera från rätt kommentarer, redigera rätt kommentarer och återlagra allt på rätt ställe. Efter många om och men så fungerar allt förhoppningsvis som det ska nu. Båda extrauppgifterna las till, gravatar var inte så avancerat, man fick u det mesta av koden. Dolt formulär för kommentarer löstes med css-kod.

Allt som allt ett givande moment med lite mer kött på benen inför kommande moment.



Kmom01: PHP-baserade och MVC-inspirerade ramverk
------------------------------------
Detta var ett väldigt diffust moment, inte att något var oklart men till en början och en bit in så var det väldigt mycket att hålla koll på och svårigheter att finna alla filer fanns. Att snabbt och instinktivt veta vilken fil som ska ändras för önskade ändringar fanns inte. Längre in i momentet man kom så började flera pusselbitar falla på plats och mot slutet vill jag inte säga att jag var en stjärna på MVC-konceptet men som sagt saker och ting gick smidigare och man började förstå tankebanan.

Utvecklingsmiljön ser ut som så att jag kodar på en MacBook med MAMP installerat, flesta test av applikationen utförs på webläsaren Safari, använder TextMate för att skriva kod och laddar upp filer på studentservern med hjälp av FileZilla.

Jag har inga tidigare erfarenheter av att jobba med ramverk och inledningsvis, just nu, är jag inte så värst förtjust. Det kan mycket väl handla om att jag har för lite vana av det och som sagt har svårt att hitta i djungeln ibland men det kan mycket väl och förhoppningsvis ändras innan kursslut. 

Jag är inte så värst familijär med de mer avancerade begreppen som har introducerats i och med detta kursmoment och har lagt ner väldigt mycket tid på att förstå deras innebörd då de introduceras av en anledning. "Dependency injections" var ett sådant begrepp som det gick åt för mycket tid åt att förstå innebörden men när pusselbitarna föll på plats så var det väldigt självklart. Jag tror att i och med att jag tror att det ska vara mer avancerat än det är så går jag villovägar i tankebanan.

Det vi gjorde i första kursen i kurspaketet tyckte jag var helt fantastiskt och min tanke inför framtiden var att så kommer jag lägga upp min kod för andra projekt. Sen introducerades vi till Anax och då blev det min favorit, allting kändes simpelt och välstrukturerat. Nu i och med Anax-MVC så är fortfarande Anax min favorit men det kan som sagt komma att ändras då jag fortfarande är lite vilse i strukturen i Anax-MVC. Detta hoppas jag givetvis ska förändras för jag kan redan se att strukturen är avancerad och väldigt användbar ifall man får in ett flow när man arbetar med detta. Som även påpekas i det teoretiska för detta kursmoment så är det ett lämpligt sätt att arbeta ifall flera personer är involverade i projektet.

Allt som allt ett givande men överväldigande kursmoment där bitarna till slut började falla på plats. Ser starkt fram emot nästa kursmoment.  



