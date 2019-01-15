Installing ramverk1-proj
======================================================



[![Build Status](https://travis-ci.org/klaswarna/ramverk1-proj.svg?branch=master)](https://travis-ci.org/klaswarna/ramverk1-proj)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/klaswarna/ramverk1-proj/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/klaswarna/ramverk1-proj/?branch=master)



Create an empty folder in which you want to put the website.

Make that folder your working directory.

Install Anax Ramverk1-me by Mr Roos by typing

<pre><code>
anax create site ramverk1-me-v2
</pre></code>

Then install the content from grammatikgrottan-website by typing

<pre><code>
cd site

composer require klaswarna/ramverk1-proj
</pre></code>


Replace the original webcontent typing:

<pre><code>
cp -r -T vendor/klaswarna/ramverk1-proj/config config

cp -r -T vendor/klaswarna/ramverk1-proj/content content

cp -r -T vendor/klaswarna/ramverk1-proj/htdocs htdocs

cp -r -T vendor/klaswarna/ramverk1-proj/src src

cp -r -T vendor/klaswarna/ramverk1-proj/test test

cp -r -T vendor/klaswarna/ramverk1-proj/view view

cp -r -T vendor/klaswarna/ramverk1-proj/sql sql
</pre></code>

Add "KW\": "src/" to autoload, prs-4  in the file site/composer.json

Type

<pre><code>
cd site

composer update
</pre></code>

Now point your browser to [your folder]/site/htdocs and the web site will appear.

To make it work properly, a a local php-server and database must be available. The databas can be
set up by the files setup.sql, ddl.sql, insert.sql in the sql folder.
