function sortTable(n) {
    var table = document.getElementById("cijfersTable"); // Haal de tabel op
    var rows = table.rows; // Haal alle rijen op
    var switching = true; // Variabele om te controleren of er geswitcht moet worden
    var dir = "asc"; // Standaard sorteervolgorde is oplopend (ascending)

    while (switching) {
        switching = false; // Zet switching op false, tenzij er een switch nodig is
        var shouldSwitch = false; // Variabele om te controleren of twee rijen verwisseld moeten worden

        for (var i = 1; i < (rows.length - 1); i++) { // Loop door de tabelrijen (behalve de header)
            var x = rows[i].getElementsByTagName("TD")[n]; // Haal de waarde van de huidige rij op
            var y = rows[i + 1].getElementsByTagName("TD")[n]; // Haal de waarde van de volgende rij op

            // Controleer of de rijen omgewisseld moeten worden op basis van de sorteerrichting
            if (dir == "asc" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
            } else if (dir == "desc" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
            }
        }

        if (shouldSwitch) {
            // Wissel de rijen om
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true; // Zet switching op true om de loop opnieuw uit te voeren
        } else {
            // Als er geen wisselingen meer zijn, verander de sorteerrichting of stop de loop
            if (dir == "asc") {
                dir = "desc"; // Verander de richting naar aflopend (descending)
            } else {
                break; // Stop de loop als de richting al "desc" was
            }
        }
    }
}
