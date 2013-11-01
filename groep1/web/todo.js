function webservice() {
    $.ajax({
        type       : "POST",
        url        : "http://localhost:8080/Groep1/ToDos?getTodo=true",
        crossDomain: true,
        dataType   : 'json',
        success    : function(response) {
            $.each(response, function(index, object){
                if(object.Status === '0') {
                    var taak = document.getElementById("todo");
        
                    //Elementen aanmaken
                    var name = document.createElement('h2');
                    var description = document.createElement('section');
                    var by = document.createElement('section');
        
        
                    name.setAttribute("naam", object.Naam);
                    description.setAttribute("omschrijving", object.Omschrijving);
        
                    //Elementen met gegevens opvullen
                    name.innerHTML = object.Naam;
                    description.innerHTML = object.Omschrijving;
        
                    //Elementen toevoegen aan het scherm
                    taak.appendChild(name);
                    taak.appendChild(description);
                }else if(object.Status === '1') {
                    var taak = document.getElementById("behandeling");
        
                    //Elementen aanmaken
                    var name = document.createElement('h2');
                    var description = document.createElement('section');
                    var by = document.createElement('section');
        
        
                    name.setAttribute("naam", object.Naam);
                    description.setAttribute("omschrijving", object.Omschrijving);
        
                    //Elementen met gegevens opvullen
                    name.innerHTML = object.Naam;
                    description.innerHTML = object.Omschrijving;
        
                    //Elementen toevoegen aan het scherm
                    taak.appendChild(name);
                    taak.appendChild(description);
                }else if(object.Status === '2') {
                    var taak = document.getElementById("nazicht");
        
                    //Elementen aanmaken
                    var name = document.createElement('h2');
                    var description = document.createElement('section');
                    var by = document.createElement('section');
        
                    name.setAttribute("naam", object.Naam);
                    description.setAttribute("omschrijving", object.Omschrijving);
        
                    //Elementen met gegevens opvullen
                    name.innerHTML = object.Naam;
                    description.innerHTML = object.Omschrijving;
        
                    //Elementen toevoegen aan het scherm
                    taak.appendChild(name);
                    taak.appendChild(description);
                }else if(object.Status === '3') {
                    var taak = document.getElementById("innazicht");
        
                    //Elementen aanmaken
                    var name = document.createElement('h2');
                    var description = document.createElement('section');
                    var by = document.createElement('section');
        
        
                    name.setAttribute("naam", object.Naam);
                    description.setAttribute("omschrijving", object.Omschrijving);
        
                    //Elementen met gegevens opvullen
                    name.innerHTML = object.Naam;
                    description.innerHTML = object.Omschrijving;
        
                    //Elementen toevoegen aan het scherm
                    taak.appendChild(name);
                    taak.appendChild(description);
                }else if(object.Status === '4') {
                    var taak = document.getElementById("klaar");
        
                    //Elementen aanmaken
                    var name = document.createElement('h2');
                    var description = document.createElement('section');
        
                    name.setAttribute("naam", object.Naam);
                    description.setAttribute("omschrijving", object.Omschrijving);
        
                    //Elementen met gegevens opvullen
                    name.innerHTML = object.Naam + '(' + object.Richting + ')';
                    description.innerHTML = object.Omschrijving;
        
                    //Elementen toevoegen aan het scherm
                    taak.appendChild(name);
                    taak.appendChild(description);
                }
            });
        },
        error      : function() {
            alert('Helaas! Er is een probleem met de connectie. Probeer later opnieuw!');                  
        }
    });     
    
    
    
    
    
//    var url = 'http://localhost:8080/Groep1/ToDos?getTodo=true';
//    $.getJSON(url, function(result){
//
//    $.each(result, function(index, object){
//        if(object.Status === '0') {
//            var taak = document.getElementById("todo");
//
//            //Elementen aanmaken
//            var name = document.createElement('h2');
//            var description = document.createElement('section');
//            var by = document.createElement('section');
//
//
//            name.setAttribute("naam", object.Naam);
//            description.setAttribute("omschrijving", object.Omschrijving);
//
//            //Elementen met gegevens opvullen
//            name.innerHTML = object.Naam;
//            description.innerHTML = object.Omschrijving;
//
//            //Elementen toevoegen aan het scherm
//            taak.appendChild(name);
//            taak.appendChild(description);
//        }else if(object.Status === '1') {
//            var taak = document.getElementById("behandeling");
//
//            //Elementen aanmaken
//            var name = document.createElement('h2');
//            var description = document.createElement('section');
//            var by = document.createElement('section');
//
//
//            name.setAttribute("naam", object.Naam);
//            description.setAttribute("omschrijving", object.Omschrijving);
//
//            //Elementen met gegevens opvullen
//            name.innerHTML = object.Naam;
//            description.innerHTML = object.Omschrijving;
//
//            //Elementen toevoegen aan het scherm
//            taak.appendChild(name);
//            taak.appendChild(description);
//        }else if(object.Status === '2') {
//            var taak = document.getElementById("nazicht");
//
//            //Elementen aanmaken
//            var name = document.createElement('h2');
//            var description = document.createElement('section');
//            var by = document.createElement('section');
//
//
//            name.setAttribute("naam", object.Naam);
//            description.setAttribute("omschrijving", object.Omschrijving);
//
//            //Elementen met gegevens opvullen
//            name.innerHTML = object.Naam;
//            description.innerHTML = object.Omschrijving;
//
//            //Elementen toevoegen aan het scherm
//            taak.appendChild(name);
//            taak.appendChild(description);
//        }else if(object.Status === '3') {
//            var taak = document.getElementById("innazicht");
//
//            //Elementen aanmaken
//            var name = document.createElement('h2');
//            var description = document.createElement('section');
//            var by = document.createElement('section');
//
//
//            name.setAttribute("naam", object.Naam);
//            description.setAttribute("omschrijving", object.Omschrijving);
//
//            //Elementen met gegevens opvullen
//            name.innerHTML = object.Naam;
//            description.innerHTML = object.Omschrijving;
//
//            //Elementen toevoegen aan het scherm
//            taak.appendChild(name);
//            taak.appendChild(description);
//        }else if(object.Status === '4') {
//            var taak = document.getElementById("klaar");
//
//            //Elementen aanmaken
//            var name = document.createElement('h2');
//            var description = document.createElement('section');
//
//            name.setAttribute("naam", object.Naam);
//            description.setAttribute("omschrijving", object.Omschrijving);
//
//            //Elementen met gegevens opvullen
//            name.innerHTML = object.Naam + '(' + object.Richting + ')';
//            description.innerHTML = object.Omschrijving;
//
//            //Elementen toevoegen aan het scherm
//            taak.appendChild(name);
//            taak.appendChild(description);
//        }
//    });
//  });
}