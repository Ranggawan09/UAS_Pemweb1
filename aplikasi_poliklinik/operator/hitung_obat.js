// script.js
document.addEventListener('DOMContentLoaded', function() {
    var obatSelect = document.getElementById('obatSelect');
    var checkboxObat = document.getElementById('checkboxObat');
    var tabelObat = document.getElementById('tabelObat');
    var totalTagihanObat = document.getElementById('total_tagihan_obat');
    var selectedObat = [];

    obatSelect.addEventListener('change', function() {
        updateTabelObat(obatSelect.selectedOptions);
    });

    checkboxObat.addEventListener('change', function() {
        var checkboxes = checkboxObat.querySelectorAll('input[type=\"checkbox\"]:checked');
        updateTabelObat(checkboxes);
    });

    function updateTabelObat(selectedOptions) {
        selectedObat = [];
        tabelObat.querySelector('tbody').innerHTML = '';

        var totalHargaObat = 0;
        for (var i = 0; i < selectedOptions.length; i++) {
            var obat = selectedOptions[i].value;
            var hargaObat = parseFloat(selectedOptions[i].getAttribute('data-harga'));

            selectedObat.push(obat);
            totalHargaObat += hargaObat;

            var row = tabelObat.querySelector('tbody').insertRow();
            var cell = row.insertCell(0);
            cell.textContent = obat;
        }

        totalTagihanObat.textContent = 'Rp ' + totalHargaObat.toFixed(2);
    }
});
