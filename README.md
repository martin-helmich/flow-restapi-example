RESTful Webservices with TYPO3 Flow
===================================

Martin Helmich <typo3@martin-helmich.de>

Synopsis
--------

This repository contains an example application that demonstrates on how
to implement RESTful Webservices with TYPO3 Flow. It contains three packages:

- `Helmich.Products` contains entity classes and repositories around a simple inventory management domain model
- `Helmich.ProductsApiSimple` contains a simple REST-like API (level 2 of the
  [Richardson Maturity Model](http://martinfowler.com/articles/richardsonMaturityModel.html))
  which allows you to CRUD products and manufacturers using respective HTTP methods.
- `Helmich.ProductsApiAdvances` contains an advanced API (level 3 of the RMM), which is _hypermedia controlled_
  (which means that there are links between resources) and also shows some design patterns to decouple your
  REST resource representations from your domain entities.

Installation
------------

You can install this application using [Composer](http://getcomposer.org):

    composer create-project helmich/flow-restapi-example

Follow the [TYPO3 Flow installation instructions](http://docs.typo3.org/flow/TYPO3FlowDocumentation/Quickstart/Index.html#installing-typo3-flow)
in all other ways. Also [set up your database](http://docs.typo3.org/flow/TYPO3FlowDocumentation/Quickstart/Index.html#database-setup)
and run the database migrations:

    ./flow doctrine:migrate
