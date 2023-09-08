<br/>
<p align="center">
<h1 align="center">AnimalTalk</h1>

  <p align="center">
    An Animal Translation Tool
  </p>
</p>

## Getting Started

This section explains how to get the application up and running.

### Prerequisites
The following tools are expected to already be installed and/or running:
- PHP 8.1+
- Apache (e.g. through [Xampp](https://www.apachefriends.org/))
- [Composer Package Manager](https://getcomposer.org/download/)

### Installation

1. Clone this repository to a directory `git clone git@github.com:nscharrenberg/AnimalTalk.git`
2. Open a terminal to this directory.
3. Run `composer install`
4. Make a copy of `.env.example` and name it `.env`.

## Usage
Some notes on the usage explanation:
1. We assume your domain is `http://localhost`, make sure to change this in the requests to your own domain if this is different.
2. The given usage examples are given with `curl`.

### Get Origin Languages
```bash
curl --request GET \
  --url http://localhost/api/translate/languages \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json'
```

This should give you a response value similar to:
```json
{
	"languages": [
		"auto",
		"mens",
		"labrador",
		"poedel",
		"parkiet"
	]
}
```

### Get Translateable Languages
Simply append the `from` query parameter with one of the origin languages, would give back the supported languages for this origin language.

```bash
curl --request GET \
  --url 'http://localhost/api/translate/languages?from=mens' \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' 
```

where `mens` can be substituted with one of the other origin languages.

This should give you a response value similar to:
```json
{
	"languages": [
		"labrador",
		"poedel",
		"parkiet",
		"papegaai"
	]
}
```

### Translate From One Language To Another
In order to translate you need to send in the `text` to be translated, the original `from` language, the `to` language to which you'd like to translate and an optional `drunk` true/false boolean to indicate that you're drunk.

Note that `from` must be one of the Origin Languages, and `to` must be a translateable language of the selected `from` language.
You can use the previous mentioned API calls to find the `from` and `to` values that you'd wish to use.

**Note**: when `from` is set to `auto`, the system will try to automatically detect the language, and set `detected` to `true` in the response.

```bash
curl --request POST \
  --url http://localhost/api/translate \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --data '{
	"text": "Dit is een test bericht",
	"from": "mens",
	"to": "poedel",
	"drunk": false
}'
```

This should give you a response value similar to:
```json
{
    "text": "woefie woefie woefie woefie woefie",
    "to": "poedel",
    "from": "mens",
    "detected": false
}
```

### Testing
You can run all tests by executing `php artisan test`.

## Argumentatie
### Classes & Interfaces
Er is gekozen voor een blueprint interface `ILanguage`, dat de blueprint bevat voor de verschillende soort talen.
Voor elke taal is er dan ook een class aangemaakt die de `ILanguage` interface implementeerd (te vinden in `App/Models`).

Aangezien we maar 1 instantie hoeven te hebben elke class, zijn de functies binnen de interface statisch.
Het zou overigens ook niet-statisch kunnen zijn, maar dan zou er altijd een instantie aangemaakt moeten worden voordat functies aangeroepen kunnen worden.
Nu kan er dus gebruik gemaakt worden van `Human::translate(...)` i.p.v. `(new Human())->translate(...)`.

### Helper Functies
Een aantal herhalende functies zijn opgezet in de `App/Helpers` directory.

#### Translator
Een van de Helper classes is de `Translator` class, welke functie bevatten zoals:
- Het vervangen van alle worden in een zin met een specifiek woord.
- Het bevestigen dat een zin alleen bestaat uit een specifiek woord.
- Het achterstevoren schrijven van een woord.
- Een woord toevoegen op een specifieke positie in een string.

#### Dronken
Een andere helper class is de `Drunk` class, welke alleen de logica bevat voor het "dronken" maken van de text, door de volgende regels te volgen:
- De vertaling eindigt op " Burp!"
- In het midden van de zin word het woord "Proost!" toegevoegd.
- Elk vierde woord wordt achterstevoren geschreven

### Service & Controller
Er is gebruik gemaakt van het Service Pattern, waarbij de business logica zich in de `TranslationService` bevind binnen `App/Services`.
De Controller gebruikt de service vervolgens om de `translate` functie aan te roepen.

Dit is zo opgezet zodat er een mogelijkheid is om meerdere endpoints te gebruiken.
Als we bijvoorbeeld gebruik willen maken van: API, Web & Console dan kunnen er in principe 3 controllers gemaakt worden, welke allemaal de `TranslationService` aanroepen, en dus precies dezelfde vertaal logica gebruiken. 

### Testen
Er zijn 2 soorten tests opgezet: Unit & Feature tests.
De Unit tests controleren specifieke functies en classes, terwijl de Feature tests de API calls testen.

De tests zijn opgezet om de AC's zo goed mogelijk te kunnen controleren.

De status voor alle Acceptaties zijn als volgt (genummerd op volgorde als voorkomend in de PDF).
1. Geimplementeerd & Tests toegevoegd
2. Geimplementeerd & Tests toegevoegd
3. Geimplementeerd & Tests toegevoegd
4. Geimplementeerd & Tests toegevoegd.
    **Note:** De Vertaal Knop is een front-end element, en staat gelijk voor de `POST` request.
5. Geimplementeerd & Tests toegevoegd.
6. Dit is een front-end element, voor de API is `auto` als standaard waarde ingesteld.
7. Geimplementeerd & Tests toegevoegd
   **Note:** De Vertaal Knop is een front-end element, en staat gelijk voor de `POST` request.
8. Dit is een front-end element. De vertaal API `POST`-request zal een `detected`-property teruggeven zodat dit vanuit de front-end geimplementeerd kan worden.
9. Geimplementeerd & Tests toegevoegd
10. Geimplementeerd & Tests toegevoegd

## Authors
* **Noah Scharrenberg** - *Software Engineer* - [Noah Scharrenberg](https://github.com/nscharrenberg/) - *Developer*

## Acknowledgements

* [Netpresenter](https://www.netpresenter.com/)
