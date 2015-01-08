RESTful Webservices mit TYPO3 Flow
==================================

Martin Helmich <typo3@martin-helmich.de>

Zusammenfassung
---------------

Dieses Repository enthält eine Beispiel-Anwendung, die die Entwicklung von
REST-Webservices mit TYPO3 Flow veranschaulicht. Sie enhält drei Pakete:

- `Helmich.Products` enthält Entitäts-Klassen und Repositories um ein einfaches Fachmodell rund um eine Inventarverwaltung
- `Helmich.ProductsApiSimple` enthält eine einfach REST-ähnliche API (Stufe 2 des
  [Richardson Maturity Model](http://martinfowler.com/articles/richardsonMaturityModel.html)), über die
  Produkte und Hersteller über die entsprechenden HTTP-Methoden ausgelesen, erstellt, verändert und gelöscht werden können.
- `Helmich.ProductsApiAdvanced` enhält eine erweiterte API (Level 3 des RMM), deren Ressourcen mit Hyperlinks
  untereinander verknüpft sind. Sie zeigt außerdem einige Designmuster, mit denen die Ressourcen-Repräsentation
  des REST-Webservices von den Entitäten des Fachmodells entkoppelt werden kann.

Installation
------------

Diese Anwendung kann über [Composer](http://getcomposer.org) installiert werden:

    composer create-project helmich/flow-rest-example

Folgen Sie anschließend den [Installationsanweisungen von TYPO3](http://docs.typo3.org/flow/TYPO3FlowDocumentation/Quickstart/Index.html#installing-typo3-flow).
Richten Sie auch Ihre [Datenbank ein](http://docs.typo3.org/flow/TYPO3FlowDocumentation/Quickstart/Index.html#database-setup)
und führen Sie die Doctrine-Migrationen aus:

    ./flow doctrine:migrate
