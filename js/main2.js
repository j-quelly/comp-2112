/**
 * Unobtrusive client-side scripting for comp 2112
 * * unobtrusive 
 */


// store form object in a var to reference later
var searchForm = document.getElementById('search-form');

// when the form is submit, invoke a function
searchForm.onsubmit = function(e) {

    // prevent the form from submitting 
    e.preventDefault();

    // capture form data
    var data = document.getElementById('q').value;

    // assemble the string for better search results
    data = assembleQuery(data);

    // hide mobile keyboard
    document.activeElement.blur();

    /**
     * GET data
     */

    // get current weather data
    var current = getCurrent(data);
    var forecast = getForecast(data, 6);


    /**
     * Manipulate the DOM
     */

    // change the background colour
    document.getElementById('search').id = 'results';

    // hide the search field
    document.getElementById('search-container').className = 'hidden';

    // display a button to clear search results
    document.getElementById('clear-results').className = 'btn right';


    /**
     * Display the results
     * perhaps separate this into functions?
     * or perhaps instantiate objects
     */

    // get the template
    var dailyTemplate = document.getElementById('daily-template').innerHTML,
        // create an element to inject the template
        dailySite = document.createElement('div');

    // inject the template
    dailySite.innerHTML = dailyTemplate;

    /** 
     * Inject the data to the template
     */

    // location  
    dailySite.getElementsByClassName('location')[0].innerHTML = current.name + ', ' + current.sys.country;

    // potential option to pursue?
    // new Injector(dailySite, 'location').inject(current.name + ', ' + current.sys.country);

    // flag
    dailySite.getElementsByClassName('flag')[0].src = 'http://openweathermap.org/images/flags/' + current.sys.country.toLowerCase() + '.png';

    // description 
    dailySite.getElementsByClassName('description')[0].innerHTML = ucfirst(current.weather[0].description);

    // weather icon
    dailySite.getElementsByClassName('icon')[0].src = 'http://openweathermap.org/img/w/' + current.weather[0].icon + '.png';

    // current temp
    dailySite.getElementsByClassName('temp')[0].innerHTML = convertKtoC(current.main.temp) + '&deg;C';

    // max temp
    dailySite.getElementsByClassName('max-temp')[0].innerHTML = convertKtoC(current.main.temp_max) + '&deg;C';

    // min temp
    dailySite.getElementsByClassName('min-temp')[0].innerHTML = convertKtoC(current.main.temp_min) + '&deg;C';

    // humidity
    dailySite.getElementsByClassName('humidity')[0].innerHTML = current.main.humidity + '%';

    // wind
    dailySite.getElementsByClassName('wind')[0].innerHTML = current.wind.speed + ' m/s';

    // append the template to the DOM
    document.getElementById("search-results").appendChild(dailySite);

    // loop thru forecast object array
    forecast.list.forEach(function(day) {

        // get the next template
        var forecastTemplate = document.getElementById('forecast-template').innerHTML,
            // create an element to inject the template
            forecastSite = document.createElement('div');

        // inject the template
        forecastSite.innerHTML = forecastTemplate;

        // inject the day of the week
        forecastSite.getElementsByClassName('day')[0].innerHTML = weekDay(day.dt);

        // inject the month
        forecastSite.getElementsByClassName('month')[0].innerHTML = month(day.dt); //format this

        // append the template to the DOM tree
        document.getElementById("search-results").appendChild(forecastSite);

    });


}



/**
 * functions
 */

// a function to GET weather data
function getCurrent(arg) {
    // vars
    var xhr,
        appid = '5ec25e4aa9a5d4e41d545224fcf5d367';

    // create a new ajax request (XML HTTP request)
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // specify the type of request
    xhr.open('GET', 'http://api.openweathermap.org/data/2.5/weather?q=' + arg + '&APPID=' + appid, false);

    // send the request to the server
    xhr.send();

    // parse the returned data
    if ('JSON' in window) {
        var data = JSON.parse(xhr.responseText);
    } else {
        // code for OLDER VERSIONS OF IE
        var data = eval(xhr.responseText);
    }

    // return the data
    return data;
}

// a function to GET the forecast
function getForecast(arg, count) {
    // vars
    var xhr,
        appid = '5ec25e4aa9a5d4e41d545224fcf5d367';

    // create a new ajax request (XML HTTP request)
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // specify the type of request
    xhr.open('GET', 'http://api.openweathermap.org/data/2.5/forecast/daily?q=' + arg + '&cnt=' + count + '&APPID=' + appid, false);

    // send the request to the server
    xhr.send();

    // parse the returned data
    if ('JSON' in window) {
        var data = JSON.parse(xhr.responseText);
    } else {
        // code for OLDER VERSIONS OF IE
        var data = eval(xhr.responseText);
    }

    // return the data
    return data;
}

// a function to prepare the string for better search results
function assembleQuery(data) {

    // if the captured form data contains a comma
    if (data.indexOf(',') > -1) {

        // for every instance of a comma split the string into an array
        data = data.split(',');
        // replace all spaces from the first index of the generated array with no space
        data = data[0].replace(' ', '');


    } else

    // if the captured data contains a space
    if (data.indexOf(' ') > -1) {

        // replace all spaces from the string
        data = data.replace(' ', '');
    }

    return data;
}

// a function to capitalize the first letter of a string
function ucfirst(arg) {
    return arg.charAt(0).toUpperCase() + arg.slice(1);
}

// a function to convert kelvins to celcius
function convertKtoC(kelvin) {
    var celcius = kelvin - 273.15;
    return Math.round(celcius);
}

// a function to return the day of the week
function weekDay(timestamp) {
    var a = new Date(timestamp * 1000);
    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'];
    return days[a.getDay()];
}

// a function to return the month of the year
function month(timestamp) {
    var a = new Date(timestamp * 1000);
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    return months[a.getMonth()] + ' ' + a.getDate();
}

/**
 * Define an Injector class
 */
var Injector = function(template, attr, index) {
    this.template = template;
    this.attr = attr;
    this.index = index || 0;
}


/**
 * Define inject method 
 */
Injector.prototype.inject = function(data) {
    this.template.getElementsByClassName(this.attr)[this.index].innerHTML = data;
    return this;
}
