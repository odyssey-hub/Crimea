$( function() {
    var placesSet = new Set();

    $(".card-text").each(function () {
        var places_text = $(this).text();
        var places = places_text.split(',');
        places.forEach((element,index) => {
            places[index] = element.trim();
            placesSet.add(places[index]);
        });
    });
    console.log(placesSet);
    var availableTags = [...placesSet];
    // var availableTags = [
    //     "ActionScript",
    //     "AppleScript",
    //     "Asp",
    //     "BASIC",
    //     "C",
    //     "C++",
    //     "Clojure",
    //     "COBOL",
    //     "ColdFusion",
    //     "Erlang",
    //     "Fortran",
    //     "Groovy",
    //     "Haskell",
    //     "Java",
    //     "JavaScript",
    //     "Lisp",
    //     "Perl",
    //     "PHP",
    //     "Python",
    //     "Ruby",
    //     "Scala",
    //     "Scheme"
    // ];
    function split( val ) {
        return val.split( /,\s*/ );
    }
    function extractLast( term ) {
        return split( term ).pop();
    }

    $( "#route_places" )
        // don't navigate away from the field on tab when selecting an item
        .on( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 0,
            source: function( request, response ) {
                response( $.ui.autocomplete.filter(
                    availableTags, extractLast( request.term ) ) );
            },
            focus: function() {
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                terms.pop();
                terms.push( ui.item.value );
                terms.push( "" );
                this.value = terms.join( ", " );
                return false;
            }
        });


    function showCards(){
        $(".card").each(function () {
            $(this).show();
        })
    }

    $("#route_places").change(function () {
        showCards();
        if (!$(this).val()) return;
        var user_places = $(this).val().split(',');
        user_places.pop();
        var userSet = new Set();
        user_places.forEach((element,index) => {
            user_places[index] = element.trim();
            userSet.add(user_places[index]);
        });

        function isSuperset(set, subset) {
            for (var elem of subset) {
                if (!set.has(elem)) {
                    return false;
                }
            }
            return true;
        }
        $(".card").each(function () {
            var card_text = $(this).find(".card-text").text();
            var card_places =  card_text.split(',');
            var cardSet = new Set();
            card_places.forEach((element,index) => {
                card_places[index] = element.trim();
                cardSet.add(card_places[index]);
            });
            if (!isSuperset(cardSet, userSet)) {
                $(this).hide();
            }
        })

    })

} );
