$(document).ready(function() {
    function loadDates() {
        $.getJSON('date.php', function(dates) {
            dates.forEach(date => {
                $('#date').append(new Option(date, date));
            });
        });
    }

   
    loadDates();

    $('#loadData').click(function() {
        const selectedDate = $('#date').val();
        $.getJSON('exportCSV.php', { date: selectedDate }, function(data) {
            const temperatures = data.map(item => item.temperature);
            const phs = data.map(item => item.ph);
            const nitrates = data.map(item => item.nitrate);

            const trace1 = {
                x: [selectedDate],
                y: temperatures,
                mode: 'lines+markers',
                name: 'Température'
            };

            const trace2 = {
                x: [selectedDate],
                y: ph,
                mode: 'lines+markers',
                name: 'pH'
            };

            const trace3 = {
                x: [selectedDate],
                y: nitrates,
                mode: 'lines+markers',
                name: 'Nitrate'
            };

            const dataPlot = [trace1, trace2, trace3];

            Plotly.newPlot('chart', dataPlot);
        });
    });

    $('#exportCSV').click(function() {
        const selectedDate = $('#date').val();
        window.location.href = `exportCSV.php?date=${selectedDate}`;
    });
});
