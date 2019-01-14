Installing ramverk1-proj
======================================================



[![Build Status](https://travis-ci.org/klaswarna/ramverk1-proj.svg?branch=master)](https://travis-ci.org/klaswarna/ramverk1-proj)



skitsnack ..................

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/klaswarna/ip-weather-service/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/klaswarna/ip-weather-service/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/klaswarna/ip-weather-service/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/klaswarna/ip-weather-service/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/klaswarna/ip-weather-service/badges/build.png?b=master)](https://scrutinizer-ci.com/g/klaswarna/ip-weather-service/build-status/master)

Slut skitsnack............


Before doing this an Anax framework must already have been installed as must composer.

In the command line type:

<pre><code>
composer require klaswarna/ramverk1-proj
</code></pre>

Följande är skitsnack tills vidare...........
Having the root of your Anax installation as working directory, type:

<pre><code>
rsync -av vendor/klasse-w/ip-weather-service/config ./
rsync -av vendor/klasse-w/ip-weather-service/src ./
rsync -av vendor/klasse-w/ip-weather-service/test ./

rsync -av vendor/klasse-w/ip-weather-service/view/geotagip view/anax/v2/
rsync -av vendor/klasse-w/ip-weather-service/view/ipweb view/anax/v2/
rsync -av vendor/klasse-w/ip-weather-service/view/weather view/anax/v2/
</code></pre>
slut skitsnack ....................





please add
    "KW\\": "src/"

to autoload in composer.json



skitsnack.................
Following services shall now be available on:

htdocs/ipweb/

htdocs/geotag/

htdocs/weather/

Finally please add following code into at the end of your css-file using propriate methods:

<pre><code>
.lilltabell,
.lilltabell td,
.lilltabell tr
  {
    border: solid 1px;
}

.sune {
    height: 100px;
    width: 100px;
}

#mapdiv {
    height: 500px;
    width: 500px;
}

.osynlig {
    display: none;
}
</pre></code>

slut skitsnack...................
