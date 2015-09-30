
;(function() {

    var nav = document.getElementById('nav'),
        anchor = nav.getElementsByTagName('a'),
        path = window.location,
        current = window.location.pathname;

    for (var i = 0; i < anchor.length; i++) {

        var definedLinks = anchor[i].pathname;
        if(definedLinks === current) {
            anchor[i].className = "active";
        }
    }

})();
;(function() {
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });

})();