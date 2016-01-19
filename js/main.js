/**
 * unobtrusive client-side scripting for comp 2112
 */

// store form object in a var to reference later
var searchForm = document.getElementById('search');

// when the form is submit, invoke a function
searchForm.onsubmit = function(event) {

    // prevent the form from submitting 
    event.preventDefault();

    // capture form data
    var data = document.getElementById('q').value;


    /**
     * prepare the string for better search results
     */

    // if the captured form data contains a comma
    if (data.indexOf(',') > -1) {

        // for every instance of a comma split the string into an array
        data = data.split(',');
        // replace all spaces from the first index of the generated array with no space
        data = data[0].replace(' ', '');

        // else, if the captured data contains a space
    } else if (data.indexOf(' ') > -1) {

        // replace all spaces from the string
        data = data.replace(' ', '');
    }


    /**
     * GET data
     */

    // vars
    var xhr,
        appid = '5ec25e4aa9a5d4e41d545224fcf5d367';

    // create a new ajax request
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // specify the type of request
    xhr.open('GET', 'http://api.openweathermap.org/data/2.5/weather?q=' + data + '&APPID=' + appid, false);

    // send the request to the server
    xhr.send();

    console.log(xhr.status);
    console.log(xhr.statusText);


    /*    // GET data
        
        // api.openweathermap.org/data/2.5/weather?q='.$q.'&APPID='.$appid 
        // api.openweathermap.org/data/2.5/forecast/daily?q='.$q.'&cnt=6&APPID='.$appid);
    */
}
