const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const app = express();
const port = 3000;

app.use(bodyParser.json());

// Configuration de la connexion MySQL
const pool = mysql.createPool({
    connectionLimit: 10,
    host: 'localhost',
    user: 'root', // Votre nom d'utilisateur MySQL
    password: 'root', // Votre mot de passe MySQL
    database: 'locataire_db',
    port: 8889 // Port MySQL par défaut de MAMP
});

app.get('/api/locataires/properties', (req, res) => {
    pool.query('SELECT * FROM properties WHERE available = 1', (error, results) => {
        if (error) {
            return res.status(500).json({ error: 'Erreur lors de la récupération des propriétés disponibles.' });
        }
        res.json(results);
    });
});
app.post('/api/locataires/reservations', (req, res) => {
    const { property_id, locataire_id, date_start, date_end } = req.body;
    if (!property_id || !locataire_id || !date_start || !date_end) {
        return res.status(400).json({ error: 'Les données fournies sont incomplètes.' });
    }

    const sqlQuery = 'INSERT INTO reservations (property_id, locataire_id, date_start, date_end) VALUES (?, ?, ?, ?)';

    pool.query(sqlQuery, [property_id, locataire_id, date_start, date_end], (error, results) => {
        if (error) {
            return res.status(500).json({ error: 'Erreur lors de la création de la réservation.' });
        }
        res.status(201).json({ message: 'Réservation créée avec succès.', reservationId: results.insertId });
    });
});
app.get('/api/locataires/reservations', (req, res) => {
    const locataire_id = req.query.locataire_id;
    if (!locataire_id) {
        return res.status(400).json({ error: 'Le locataire_id est requis.' });
    }

    const sqlQuery = 'SELECT * FROM reservations WHERE locataire_id = ?';

    pool.query(sqlQuery, [locataire_id], (error, results) => {
        if (error) {
            return res.status(500).json({ error: 'Erreur lors de la récupération des réservations.' });
        }
        res.json(results);
    });
});
app.delete('/api/locataires/reservations/:id', (req, res) => {
    const { id } = req.params;
    if (!id) {
        return res.status(400).json({ error: 'Un ID de réservation est requis.' });
    }

    const sqlQuery = 'DELETE FROM reservations WHERE id = ?';

    pool.query(sqlQuery, [id], (error, results) => {
        if (error) {
            return res.status(500).json({ error: 'Erreur lors de l’annulation de la réservation.' });
        }
        if (results.affectedRows === 0) {
            return res.status(404).json({ message: 'Réservation non trouvée.' });
        }
        res.json({ message: 'Réservation annulée avec succès.' });
    });
});


app.listen(port, () => {
    console.log(`Serveur lancé sur http://localhost:${port}`);
});
