/*
 **********************************
 * Deprecated as of version 2.x.x *
 **********************************
 */

/**
 * Unobtrusive client-side scripting for comp 2112
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
     * 
     */

    // location & flag
    new Node('div', 'search-results').setClass('xl-12').setId('location').append();
    new Node('h2', 'location').setData(current.name).append();
    new Node('img', 'location').setPath('http://openweathermap.org/images/flags/' + current.sys.country.toLowerCase() + '.png').setClass('flag').append();

    // description
    new Node('div', 'search-results').setClass('xl-12 no-padding-bottom').setId('description').append();
    new Node('h3', 'description').setData(ucfirst(current.weather[0].description)).append();

    // weather icon
    new Node('div', 'search-results').setClass('xl-2 s-6 no-padding-top text-center').setId('weather-icon').append();
    new Node('img', 'weather-icon').setPath('http://openweathermap.org/img/w/' + current.weather[0].icon + '.png').setClass('icon').append();

    // current temp
    new Node('div', 'search-results').setClass('xl-2 s-6 no-padding-top').setId('current').append();
    new Node('h5', 'current').setData('Current').append();
    new Node('h5', 'current').setData(convertKtoC(current.main.temp) + '°C').setClass('temp').append();

    // max temp
    new Node('div', 'search-results').setClass('xl-2 s-6 text-center').setId('maxTemp').append();
    new Node('h5', 'maxTemp').setData('Max Temp').append();
    new Node('h5', 'maxTemp').setData(convertKtoC(current.main.temp_max) + '°C').append();

    // min temp
    new Node('div', 'search-results').setClass('xl-2 s-6 text-center').setId('minTemp').append();
    new Node('h5', 'minTemp').setData('Min Temp').append();
    new Node('h5', 'minTemp').setData(convertKtoC(current.main.temp_min) + '°C').append();

    // humidity
    new Node('div', 'search-results').setClass('xl-2 s-6 text-center').setId('humidity').append();
    new Node('h5', 'humidity').setData('Humidity').append();
    new Node('h5', 'humidity').setData(current.main.humidity + '%').append();

    // wind
    new Node('div', 'search-results').setClass('xl-2 s-6 text-center').setId('wind').append();
    new Node('h5', 'wind').setData('Humidity').append();
    new Node('h5', 'wind').setData(current.wind.speed + ' m/s').append();

    // forecast
    new Node('div', 'search-results').setClass('xl-12 no-padding-bottom').setId('forecast').append();
    new Node('h2', 'forecast').setData('Forecast').append();

    console.log(forecast.list.length);

    // loop thru data
    for (var i = 0; i < forecast.list.length; i++) {

    }

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

// define a class for creating nodes in the DOM tree
var Node = function(childElm, parentElem) {

    // selector
    this.parentElement = parentElem;

    // default to a div element
    this.element = childElm || 'div';

    // default to an empty text node
    this.textNode = '';

    // default to no class
    this.cName = '';

    // default to no id
    this.Id = '';

    // set path for image elements
    this.path = '';
};


/**
 * Node methods
 */

// set the text node in the tree
Node.prototype.setData = function(data) {
    this.textNode = data;
    return this;
};

// set the className
Node.prototype.setClass = function(cName) {
    this.cName = cName;
    return this;
};

// set the id
Node.prototype.setId = function(Id) {
    this.Id = Id;
    return this;
};

// set the path
Node.prototype.setPath = function(path) {
    this.path = path;
    return this;
};

// create the element
Node.prototype.append = function() {
    // create the element
    var elem = document.createElement(this.element);

    // create the text node
    if (this.textNode) {
        var node = document.createTextNode(this.textNode);
        // append the node
        elem.appendChild(node);
    }

    // if class has been specified
    if (this.cName) {
        elem.className = this.cName;
    }

    // if an ID has been specified
    if (this.Id) {
        elem.id = this.Id;
    }

    // set image src attribute
    if (this.path) {
        elem.src = this.path;
    }

    // find the target element in the DOM tree
    var target = document.getElementById(this.parentElement);

    // append to the target
    target.appendChild(elem);

    return this;
}
