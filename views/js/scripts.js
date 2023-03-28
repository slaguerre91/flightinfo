$(document).ready(function () {
    function markRequired() {
        var control = $(this).children(".form-control");
        var label = $(this).children("label");
        if (control.attr("required") == "required") {
            label.addClass("required");
        }
    }

    function countCharacters() {
        var max = $(this).attr("maxlength");
        var length = $(this).val().length;
        var counter = max - length;
        var helper = $(this).next(".form-text");
        if (counter !== 1) {
            helper.text(counter + " characters remaining");
        } else {
            helper.text(counter + " character remaining");
        }
        if (counter === 0) {
            helper.removeClass("text-muted");
            helper.addClass("text-danger");
        } else {
            helper.removeClass("text-danger");
            helper.addClass("text-muted");
        }
    }

    $(document).ready(function () {
        $(".form-group").each(markRequired);
        $(".form-control").each(countCharacters);
        $(".form-control").keyup(countCharacters);
    });
});

jQuery(document).ready((function () {
    let availableTags = [];
    $(async function () {
        const resAirports = await fetch('../../models/json/airports.json')
        const airports = await resAirports.json();
        const airportResults = airports.map(function (d) {
            return `${d.name} (${d.city}) - ${d.iata_code}`;
        });

        $("#dep").autocomplete({
            source: airportResults
        });
        $("#arr").autocomplete({
            source: airportResults
        });
    });
    $(async function () {
        const resAirlines = await fetch('../../models/json/airlines.json')
        const airlines = await resAirlines.json();
        const airlineResults = airlines.map(function (d) {
            return `${d.name}`;
        });
        $("#airline").autocomplete({
            source: airlineResults
        });
    });
}));

// Example starter JavaScript for disabling form submissions if there are invalid fields
jQuery(document).ready((function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})());



