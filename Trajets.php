<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des trajets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        input, select, button {
            padding: 10px;
            margin: 5px 0;
            width: 100%;
        }

        button {
            background: #2563eb;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background: #1e40af;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #2563eb;
            color: white;
        }

        .actions button {
            width: auto;
            margin: 2px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Gestion des trajets</h2>

    <form id="trajetForm">
        <input type="text" id="depart" placeholder="Ville de départ" required>
        <input type="text" id="arrivee" placeholder="Ville d'arrivée" required>
        <input type="date" id="date" required>
        <input type="time" id="heure" required>
        <input type="number" id="prix" placeholder="Prix" required>

        <select id="bus" required>
            <option value="">-- Choisir un bus --</option>
            <option value="Bus 1">Bus 1</option>
            <option value="Bus 2">Bus 2</option>
            <option value="Bus 3">Bus 3</option>
        </select>

        <button type="submit">Ajouter le trajet</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Départ</th>
                <th>Arrivée</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Prix</th>
                <th>Bus</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="trajetTable"></tbody>
    </table>
</div>

<script>
    let trajets = [];
    let indexEdit = null;

    document.getElementById("trajetForm").addEventListener("submit", function(e) {
        e.preventDefault();

        let trajet = {
            depart: depart.value,
            arrivee: arrivee.value,
            date: date.value,
            heure: heure.value,
            prix: prix.value,
            bus: bus.value
        };

        if (indexEdit === null) {
            trajets.push(trajet);
        } else {
            trajets[indexEdit] = trajet;
            indexEdit = null;
        }

        afficherTrajets();
        this.reset();
    });

    function afficherTrajets() {
        let html = "";
        trajets.forEach((t, i) => {
            html += `
                <tr>
                    <td>${t.depart}</td>
                    <td>${t.arrivee}</td>
                    <td>${t.date}</td>
                    <td>${t.heure}</td>
                    <td>${t.prix} FCFA</td>
                    <td>${t.bus}</td>
                    <td class="actions">
                        <button onclick="modifier(${i})">✏</button>
                        <button onclick="supprimer(${i})">🗑</button>
                    </td>
                </tr>
            `;
        });
        document.getElementById("trajetTable").innerHTML = html;
    }

    function modifier(index) {
        let t = trajets[index];
        depart.value = t.depart;
        arrivee.value = t.arrivee;
        date.value = t.date;
        heure.value = t.heure;
        prix.value = t.prix;
        bus.value = t.bus;
        indexEdit = index;
    }

    function supprimer(index) {
        if (confirm("Supprimer ce trajet ?")) {
            trajets.splice(index, 1);
            afficherTrajets();
        }
    }
</script>

</body>
</html>
