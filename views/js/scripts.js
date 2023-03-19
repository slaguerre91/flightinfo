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
}))

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
})())

