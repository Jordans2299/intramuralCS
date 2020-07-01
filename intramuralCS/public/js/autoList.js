window.addEventListener("load", function(){

    // Add a keyup event listener to our input element
    var name_input = document.getElementById('name_input');
    name_input.addEventListener("keyup", function(event){hinter(event)});

    // create one global XHR object 
    // so we can abort old requests when a new one is make
    window.hinterXHR = new XMLHttpRequest();
});

// Autocomplete for form
function hinter(event) {

    // retireve the input element
    var input = event.target;

    // retrieve the datalist element
    var huge_list = document.getElementById('huge_list');

    // minimum number of characters before we start to generate suggestions
    var min_characters = 0;

    if (input.value.length < min_characters ) { 
        return;
    } else { 

        // abort any pending requests
        window.hinterXHR.abort();

        window.hinterXHR.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                // We're expecting a json response so we convert it to an object
                var response = JSON.parse( this.responseText ); 

                // clear any previously loaded options in the datalist
                huge_list.innerHTML = "";

                response.forEach(function(item) {
                    // Create a new <option> element.
                    var option = document.createElement('option');
                    option.value = item;

                    // attach the option to the datalist element
                    huge_list.appendChild(option);
                });
            }
        };

        window.hinterXHR.open("GET", "/posts/create?query=" + input.value, true);
        window.hinterXHR.send()
    }
}