[![Build Status](https://travis-ci.org/ksimka/dbff.png?branch=master)](https://travis-ci.org/ksimka/dbff) [![Code Coverage](https://scrutinizer-ci.com/g/ksimka/dbff/badges/coverage.png?s=f5495d3cc09ef8186aa5ef1f8241e1beb46848f4)](https://scrutinizer-ci.com/g/ksimka/dbff/) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ksimka/dbff/badges/quality-score.png?s=4b1d473600078d219306e5ae6adf713a75d0d062)](https://scrutinizer-ci.com/g/ksimka/dbff/)

# Dbff

Dbff (mix of _db_ and _diff_, pronounced like _dibiff_) — tool for comparing database structures. Currently available only for MySQL.

Dbff can compare
- databases
- tables
- columns
- indices
- data types

Obviously, it doesn't cover 100% of MySQL structures. We support only things we need so far. But you can improve this library, you are welcome ;)

## Dbff structure

Dbff consists of several decoupled parts:
- element — you can create it, fill it with any values and compare
- parser — converts string presentation of element, taken from 'show create' statement, to array of named values. You can use these values on your own, i.e. for initializing elements or for makink your own diff
- builder — helper for creating elements directly from strings. It takes parsers and other builders as dependencies and use them for building elements
- dbffer — dbff tool itself. It takes two elements and produce some diff in a form of array

### Elements

There are 6 elements
- typeprop — group of properties for some type
- type
- index
- column
- table
- database

### Parsers

We have parser for each element
- type parser (for type and typeprop) — parses type definition from column
- index parser — parses index definition taken from "create table" statement
- column parser — parses column definition taken from "create table" statement
- table parser — parses whole "create table" statement
- database parser — parses "create database" statement

Parsers return structs — arrays with specific keys for each element. See schemas to find out struct keys.

All parsers have `parse` method.

### Builders

Parsers return structs that therefore can be used to fill elements. Doing this manually is boring. So builders do it for you. They create elements directly from strings.

We have builders for each element
- type builder
- index builder
- column builder
- table builder
- database builder

All builders have `createFromString` method.

Complex builders have a lot of dependencies, so for easier creating default builders use `DefaultBuilderFactory`.

### Dbffer

Dbffer can compare elements with `compareElements` method and compare collections with `compareCollections` method.

## Dependencies

This package has no dependencies. Its' components are decoupled. You can use only parsers or you can fill elements manually or you can add your own elements or you can implement your own parsers and still use Dbff.

## Examples

Documentation is in development. Please see example.php file provided with this package.

## TODO

- [ ] documentation and more examples
- [x] dbff-core — this package, main functionality
- [ ] dbff-altr — tool for building alter statements from dbff output
- [ ] dbff-ignr — ignorator tool for ignoring some parts of schema in dbff output (say, you don't want to compare charsets)
- [ ] dbff-drvr — tool for making dbff directly from provided connections to databases
- [ ] dbff-humn — humanize output of dbffer (instead of inexpressive array)
- [ ] dbff-dbff — dbff object instead of array
- [ ] dbff-full — build of all dbff subpackages, unlimited power :)
