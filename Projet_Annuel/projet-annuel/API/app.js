

const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const cors = require('cors'); // Importez cors


const app = express();
const PORT = process.env.PORT || 5000;

app.use(cors()); // Activez CORS pour toutes les routes et toutes les origines
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.use(express.static('public'));


// MySQL
const pool = mysql.createPool({
    connectionLimit : 10,
    host            : 'localhost',
    user            : 'root',
    password        : 'root',
    database        : 'pcs'
})

/// Get all users
app.get('/user', (req, res) => {
    pool.getConnection((err, connection) => {
        if(err) throw err;
        console.log(`connected as id ${connection.threadId}`);

        connection.query('SELECT * FROM user', (err, rows) => {
            connection.release(); // return the connection to pool

            if(!err) {
                res.send(rows);
            } else {
                console.error("Erreur lors de la récupération des utilisateurs:", err);
                return res.status(500).json({ error: "Erreur lors de la récupération des utilisateurs" });
            }
        });
    });
});

// Get a user by ID
app.get('/user/:id', (req, res) => {
    pool.getConnection((err, connection) => {
        if(err) throw err;
        console.log(`connected as id ${connection.threadId}`);

        connection.query('SELECT * FROM user WHERE id = ?', [req.params.id], (err, rows) => {
            connection.release(); // return the connection to pool

            if(!err) {
                res.send(rows);
            } else {
                console.error("Erreur lors de la récupération de l'utilisateur:", err);
            }
        });
    });
});

// Delete a user
app.delete('/user/:id', (req, res) => {
    pool.getConnection((err, connection) => {
        if(err) throw err;
        console.log(`connected as id ${connection.threadId}`);

        connection.query('DELETE FROM user WHERE id = ?', [req.params.id], (err, rows) => {
            connection.release(); // return the connection to pool

            if(!err) {
                res.send(`User with the Record ID: ${[req.params.id]} has been removed.`);
            } else {
                console.error("Erreur lors de la suppression de l'utilisateur:", err);
            }
        });
    });
});

// Add a user
app.post('/user', (req, res) => {
    pool.getConnection((err, connection) => {
        if (err) throw err;
        console.log(`connected as id ${connection.threadId}`);

        const { email, nom, prenom, telephone, type } = req.body; // Adjust according to your user table structure

        const query = 'INSERT INTO user (email, nom, prenom, telephone, type) VALUES (?, ?, ?, ?, ?)';
        connection.query(query, [email, nom, prenom, telephone, type], (err, results) => {
            connection.release();

            if (err) {
                console.error("Erreur lors de l'ajout de l'utilisateur:", err);
                return res.status(500).json({ error: "Erreur lors de l'ajout de l'utilisateur" });
            }

            res.status(201).json({ message: 'Nouvel utilisateur créé avec succès', userId: results.insertId });
        });
    });
});

// Update a user
app.put('/user/:id', (req, res) => {
    pool.getConnection((err, connection) => {
        if(err) throw err;
        console.log(`connected as id ${connection.threadId}`);

        const { email, nom, prenom, telephone, type } = req.body; // Adjust according to your user table structure
        const userId = req.params.id;

        connection.query('UPDATE user SET email = ?, nom = ?, prenom = ?, telephone = ?, type = ? WHERE id = ?', [email, nom, prenom, telephone, type, userId], (err, result) => {
            connection.release();
            if(err) {
                console.error("Erreur lors de la mise à jour de l'utilisateur:", err);
                return res.status(500).json({ error: "Erreur lors de la mise à jour de l'utilisateur" });
            }
            if (result.affectedRows === 0) {
                return res.status(404).json({ message: "Aucun utilisateur trouvé avec cet ID" });
            }
            res.json({ message: "Utilisateur mis à jour avec succès" });
        });
    });
});

app.get('/user/filter/:type?', (req, res) => { // Le '?' rend le paramètre 'type' optionnel
    pool.getConnection((err, connection) => {
        if(err) throw err;

        let query = 'SELECT * FROM user';
        const type = req.params.type;

        if (type) {
            query += ' WHERE type = ?';
        }

        connection.query(query, [type].filter(Boolean), (err, rows) => { // Le filtre Boolean exclut les valeurs fausses comme une chaîne vide
            connection.release();

            if(!err) {
                res.send(rows);
            } else {
                console.error("Erreur lors de la récupération des utilisateurs par type:", err);
                return res.status(500).json({ error: "Erreur lors de la récupération des utilisateurs par type" });
            }
        });
    });
});


app.post('/reservations', (req, res) => {
    pool.getConnection((err, connection) => {
        if (err) throw err;
        const { start, end, destination, price, property_type } = req.body;
        const query = 'INSERT INTO reservations (start, end, destination, price, property_type) VALUES (?, ?, ?, ?, ?)';
        connection.query(query, [start, end, destination, price, property_type], (err, results) => {
            connection.release();
            if (!err) {
                res.status(201).json({ message: 'Réservation ajoutée avec succès', reservationId: results.insertId });
            } else {
                console.error("Erreur lors de l'ajout de la réservation:", err);
                res.status(500).json({ error: "Erreur lors de l'ajout de la réservation" });
            }
        });
    });
});

// Add a reservation
app.post('/reservations', (req, res) => {
    pool.getConnection((err, connection) => {
        if (err) throw err;

        const { start, end } = req.body;

        const query = 'INSERT INTO reservations (start, end) VALUES (?, ?)';
        connection.query(query, [start, end], (err, results) => {
            connection.release();

            if (!err) {
                res.status(201).json({ message: 'Réservation ajoutée avec succès', reservationId: results.insertId });
            } else {
                console.error("Erreur lors de l'ajout de la réservation:", err);
                res.status(500).json({ error: "Erreur lors de l'ajout de la réservation" });
            }
        });
    });
});

app.get('/reservations', (req, res) => {
    pool.getConnection((err, connection) => {
        if (err) throw err;

        connection.query('SELECT * FROM reservations WHERE status != "reserved"', (err, rows) => {
            connection.release();

            if (!err) {
                res.send(rows);
            } else {
                console.error("Erreur lors de la récupération des réservations:", err);
                res.status(500).json({ error: "Erreur lors de la récupération des réservations" });
            }
        });
    });
});

app.get('/reservations/admin', (req, res) => {
    pool.getConnection((err, connection) => {
        if (err) throw err;

        connection.query('SELECT * FROM reservations', (err, rows) => {
            connection.release();

            if (!err) {
                res.send(rows);
            } else {
                console.error("Erreur lors de la récupération des réservations:", err);
                res.status(500).json({ error: "Erreur lors de la récupération des réservations" });
            }
        });
    });
});

// Supprimer une réservation
app.delete('/reservations/:id/delete', (req, res) => {
    const reservationId = req.params.id;
    console.log(`Tentative de suppression de la réservation avec ID: ${reservationId}`);
    pool.getConnection((err, connection) => {
        if (err) {
            console.error("Erreur de connexion à la base de données:", err);
            return res.status(500).json({ error: "Erreur de connexion à la base de données" });
        }
        console.log(`connected as id ${connection.threadId}`);

        connection.query('DELETE FROM reservations WHERE id = ?', [reservationId], (err, result) => {
            connection.release();
            if (err) {
                console.error("Erreur lors de la suppression de la réservation:", err);
                return res.status(500).json({ error: "Erreur lors de la suppression de la réservation" });
            }
            if (result.affectedRows === 0) {
                console.log(`Aucune réservation trouvée avec l'ID: ${reservationId}`);
                return res.status(404).json({ message: "Aucune réservation trouvée avec cet ID" });
            }
            console.log(`Réservation avec l'ID: ${reservationId} a été supprimée.`);
            res.json({ message: `Réservation avec l'ID: ${reservationId} a été supprimée.` });
        });
    });
});


app.get('/reservations/filter', (req, res) => {
    pool.getConnection((err, connection) => {
        if (err) throw err;

        let query = 'SELECT * FROM reservations WHERE 1=1'; // Bonne pratique pour chaînage facile
        const params = [];

        if (req.query.destination) {
            query += ' AND destination = ?';
            params.push(req.query.destination);
        }
        if (req.query.start) {
            query += ' AND DATE(start) = DATE(?)'; // Utilisez DATE pour ignorer l'heure
            params.push(req.query.start);
        }
        if (req.query.end) {
            query += ' AND DATE(end) = DATE(?)'; // Utilisez DATE pour ignorer l'heure
            params.push(req.query.end);
        }
        if (req.query.priceOrder) {
            query += ' ORDER BY price ' + (req.query.priceOrder === 'desc' ? 'DESC' : 'ASC');
        }

        connection.query(query, params, (err, rows) => {
            connection.release();

            if (!err) {
                res.send(rows);
            } else {
                console.error("Erreur lors de la récupération des réservations filtrées:", err);
                res.status(500).json({ error: "Erreur lors de la récupération des réservations filtrées" });
            }
        });
    });
});

app.post('/reservations/reserve', (req, res) => {
    const { id, userId } = req.body;

    if (!id || !userId) {
        return res.status(400).json({ error: "Les données nécessaires pour la réservation sont manquantes." });
    }

    pool.getConnection((err, connection) => {
        if (err) {
            console.error("Erreur de connexion à la base de données:", err);
            return res.status(500).json({ error: "Erreur de connexion à la base de données" });
        }

        const query = 'UPDATE reservations SET user_id = ?, status = "reserved" WHERE id = ?';
        connection.query(query, [userId, id], (err, result) => {
            connection.release();
            if (err) {
                console.error("Erreur lors de la mise à jour de la réservation:", err);
                return res.status(500).json({ error: "Erreur lors de la mise à jour de la réservation" });
            }

            if (result.affectedRows === 0) {
                return res.status(404).json({ message: "Aucune réservation trouvée avec cet ID" });
            }

            res.json({ message: "Réservation confirmée avec succès" });
        });
    });
});


app.get('/reservations/user/:userId', (req, res) => {
    const userId = req.params.userId;
    pool.getConnection((err, connection) => {
        if (err) {
            console.error("Erreur de connexion à la base de données:", err);
            return res.status(500).json({ error: "Erreur de connexion à la base de données" });
        }

        const query = `
            SELECT r.*, s.name AS service_name
            FROM reservations r
            LEFT JOIN reservation_services rs ON r.id = rs.reservation_id
            LEFT JOIN services s ON s.id = rs.service_id
            WHERE r.user_id = ?;
        `;

        connection.query(query, [userId], (err, results) => {
            connection.release();
            if (err) {
                console.error("Erreur lors de la récupération des réservations:", err);
                return res.status(500).json({ error: "Erreur lors de la récupération des réservations" });
            }
            res.json(results);
        });
    });
});



app.get('/my_reservations', (req, res) => {
    const { userId } = req.query;

    if (!userId) {
        return res.status(400).json({ message: 'ID utilisateur requis' });
    }

    if (!/^\d+$/.test(userId)) { // Vérifie si userId est un nombre entier
        return res.status(400).json({ message: 'ID utilisateur invalide' });
    }

    const query = `
        SELECT r.*, s.name as serviceName, s.description as serviceDescription
        FROM reservations r
        JOIN services s ON r.service_id = s.id
        WHERE r.user_id = ?
    `;

    pool.query(query, [userId], (error, results) => {
        if (error) {
            console.error('Erreur lors de la requête à la base de données:', error);
            return res.status(500).json({ message: 'Erreur interne du serveur' });
        }
        if (results.length === 0) {
            return res.status(404).json({ message: 'Aucune réservation trouvée pour cet utilisateur' });
        }
        res.json(results);
    });
});


app.get('/reservations', (req, res) => {
    const date = req.query.date;
    if (!date) {
        return res.status(400).json({ error: 'Date is required' });
    }

    pool.getConnection((err, connection) => {
        if (err) throw err;

        const query = `
            SELECT user_id, date_debut, date_fin
            FROM calendar_presta
            WHERE DATE(date_debut) <= ? AND DATE(date_fin) >= ? AND statut = 'indisponible';
        `;

        connection.query(query, [date, date], (err, results) => {
            connection.release();
            if (err) {
                console.error("Erreur lors de la récupération des prestations:", err);
                return res.status(500).json({ error: "Erreur lors de la récupération des prestations" });
            }
            res.json(results);
        });
    });
});


app.post('/setAvailability', (req, res) => {
    const { start, end, userId, prestationNom, prestationDescription, prestationPrix } = req.body;

    pool.getConnection((err, connection) => {
        if (err) {
            console.error("Erreur de connexion à la base de données:", err);
            return res.status(500).json({ error: "Erreur de connexion à la base de données" });
        }

        const query = 'INSERT INTO calendar_presta (user_id, date_debut, date_fin, prestation_nom, prestation_description, prestation_prix, statut) VALUES (?, ?, ?, ?, ?, ?, "indisponible")';
        connection.query(query, [userId, start, end, prestationNom, prestationDescription, prestationPrix], (err, results) => {
            connection.release();

            if (!err) {
                res.status(201).json({ message: 'Disponibilité ajoutée avec succès', availabilityId: results.insertId });
            } else {
                console.error("Erreur lors de l'ajout de la disponibilité:", err);
                res.status(500).json({ error: "Erreur lors de l'ajout de la disponibilité" });
            }
        });
    });
});


// Get unavailable dates
app.get('/getUnavailableDates', (req, res) => {
    pool.getConnection((err, connection) => {
        if (err) {
            console.error("Erreur de connexion à la base de données:", err);
            return res.status(500).json({ error: "Erreur de connexion à la base de données" });
        }

        const query = 'SELECT date_debut, date_fin FROM calendar_presta WHERE statut = "indisponible"';
        connection.query(query, (err, results) => {
            connection.release();

            if (!err && results.length > 0) {
                const dates = results.map(row => {
                    const start = new Date(row.date_debut);
                    const end = new Date(row.date_fin);
                    const range = [];
                    for (let dt = new Date(start); dt <= end; dt.setDate(dt.getDate() + 1)) {
                        range.push(dt.toISOString().split('T')[0]);
                    }
                    return range;
                }).flat();
                res.json(dates);
            } else if (!err) {
                res.json([]);
            } else {
                console.error("Erreur lors de la récupération des dates indisponibles:", err);
                res.status(500).json({ error: "Erreur lors de la récupération des dates indisponibles" });
            }
        });
    });
});

app.get('/getUnavailableDetails', (req, res) => {
    const date = req.query.date;
    if (!date) {
        return res.status(400).json({ error: 'Date is required' });
    }

    pool.getConnection((err, connection) => {
        if (err) throw err;

        const query = `
            SELECT date_debut, date_fin, prestation_nom, prestation_description, prestation_prix
            FROM calendar_presta
            WHERE ? BETWEEN DATE(date_debut) AND DATE(date_fin) AND statut = 'indisponible';
        `;

        connection.query(query, [date], (err, results) => {
            connection.release();
            if (err) {
                console.error("Erreur lors de la récupération des prestations:", err);
                return res.status(500).json({ error: "Erreur lors de la récupération des prestations" });
            }
            res.json(results);
        });
    });
});

// Mettre à jour un abonnement
app.put('/subscription/:id', (req, res) => {
    pool.getConnection((err, connection) => {
        if (err) throw err;
        console.log(`connected as id ${connection.threadId}`);

        const { abonnement, dateDebut, dateExpiration } = req.body;
        const subscriptionId = req.params.id;

        const query = 'UPDATE subscription SET abonnement = ?, date_debut = ?, date_expiration = ? WHERE id = ?';
        connection.query(query, [abonnement, dateDebut, dateExpiration, subscriptionId], (err, result) => {
            connection.release();
            if (err) {
                console.error("Erreur lors de la mise à jour de l'abonnement:", err);
                return res.status(500).json({ error: "Erreur lors de la mise à jour de l'abonnement" });
            }
            if (result.affectedRows === 0) {
                return res.status(404).json({ message: "Aucun abonnement trouvé avec cet ID" });
            }
            res.json({ message: "Abonnement mis à jour avec succès" });
        });
    });
});

// Supprimer un abonnement
app.delete('/souscription/:id', (req, res) => {
    const id = req.params.id;
    console.log(`Tentative de suppression de l'abonnement avec ID: ${id}`);
    pool.getConnection((err, connection) => {
        if (err) {
            console.error("Erreur de connexion à la base de données:", err);
            return res.status(500).json({ error: "Erreur de connexion à la base de données" });
        }
        console.log(`connected as id ${connection.threadId}`);

        connection.query('DELETE FROM souscription WHERE id = ?', [id], (err, result) => {
            connection.release();
            if (err) {
                console.error("Erreur lors de la suppression de l'abonnement:", err);
                return res.status(500).json({ error: "Erreur lors de la suppression de l'abonnement" });
            }
            if (result.affectedRows === 0) {
                console.log(`Aucun abonnement trouvé avec l'ID: ${id}`);
                return res.status(404).json({ message: "Aucun abonnement trouvé avec cet ID" });
            }
            console.log(`Abonnement avec l'ID: ${id} a été supprimé.`);
            res.json({ message: `Abonnement avec l'ID: ${id} a été supprimé.` });
        });
    });
});

// Récupérer tous les abonnements
app.get('/subscribed-travelers', (req, res) => {
    pool.getConnection((err, connection) => {
        if (err) {
            console.error("Erreur de connexion à la base de données:", err);
            return res.status(500).json({ error: "Erreur de connexion à la base de données" });
        }

        const query = `
            SELECT s.id AS id, u.email, u.nom, u.prenom, a.nom AS abonnement, s.date_debut, s.date_expiration
            FROM user u
            JOIN souscription s ON u.id = s.utilisateur_id
            JOIN abonnement a ON s.abonnement_id = a.id
            WHERE u.type = 2;
        `;

        connection.query(query, (err, results) => {
            connection.release();
            if (err) {
                console.error("Erreur lors de l'exécution de la requête SQL:", err);
                return res.status(500).json({ error: "Erreur lors de l'exécution de la requête SQL: " + err.message });
            }
            if (results.length > 0) {
                res.json(results);
            } else {
                res.status(404).json({ message: "Aucun voyageur abonné trouvé." });
            }
        });
    });
});

// Ajouter un abonnement
app.post('/subscription', (req, res) => {
    pool.getConnection((err, connection) => {
        if (err) throw err;
        console.log(`connected as id ${connection.threadId}`);

        const { userId, abonnement, dateDebut, dateExpiration } = req.body;

        const query = 'INSERT INTO subscription (user_id, abonnement, date_debut, date_expiration) VALUES (?, ?, ?, ?)';
        connection.query(query, [userId, abonnement, dateDebut, dateExpiration], (err, results) => {
            connection.release();

            if (err) {
                console.error("Erreur lors de l'ajout de l'abonnement:", err);
                return res.status(500).json({ error: "Erreur lors de l'ajout de l'abonnement" });
            }

            res.status(201).json({ message: 'Nouvel abonnement créé avec succès', subscriptionId: results.insertId });
        });
    });
});

// Fetch specific reservation details
app.get('/reservations/:id/details', (req, res) => {
    const reservationId = req.params.id;
    pool.getConnection((err, connection) => {
        if (err) {
            console.error("Failed to connect to the database:", err);
            return res.status(500).json({ error: "Database connection error" });
        }
        connection.query('SELECT * FROM reservations WHERE id = ?', [reservationId], (err, results) => {
            connection.release();
            if (err) {
                console.error("Error retrieving reservation details:", err);
                return res.status(500).json({ error: "Error retrieving reservation details" });
            }
            if (results.length === 0) {
                return res.status(404).json({ message: "No details found for this reservation" });
            }
            res.json(results[0]);
        });
    });
});


app.get('/reservations/:id/details', (req, res) => {
    pool.getConnection((err, connection) => {
        if (err) throw err;
        const reservationId = req.params.id;
        const query = `
            SELECT r.*, s.name AS service_name, s.description, rs.date_prestation, rs.prix
            FROM reservations r
            JOIN reservation_services rs ON r.id = rs.reservation_id
            JOIN services s ON s.id = rs.service_id
            WHERE r.id = ?;
        `;

        connection.query(query, [reservationId], (err, results) => {
            connection.release();
            if (err) {
                console.error("Erreur lors de la récupération des détails de la réservation:", err);
                return res.status(500).json({ error: "Erreur lors de la récupération des détails de la réservation" });
            }
            res.json(results);
        });
    });
});

app.put('/reservations/:id/update', (req, res) => {
    const { id } = req.params;
    const { property_type, start, end, destination, price, status } = req.body;

    pool.getConnection((err, connection) => {
        if (err) {
            console.error("Failed to connect to the database:", err);
            return res.status(500).send({ error: "Database connection error", details: err.toString() });
        }

        const sql = `
            UPDATE reservations 
            SET 
                property_type = ?, 
                start = ?, 
                end = ?, 
                destination = ?, 
                price = ?, 
                status = ? 
            WHERE id = ?`;

        const params = [
            property_type, 
            start || null,  // Set to NULL if empty
            end || null,    // Set to NULL if empty
            destination, 
            price, 
            status, 
            id
        ];

        connection.query(sql, params, (error, results) => {
            connection.release();
            if (error) {
                console.error("Error updating reservation:", error);
                return res.status(500).send({ error: "Error updating reservation", details: error.toString() });
            }
            if (results.affectedRows === 0) {
                return res.status(404).send({ message: "No reservation found with the given ID" });
            }
            res.send({ success: true, message: "Reservation updated successfully" });
        });
    });
});


// Get reservation details along with services
app.get('/reservations/:id/details', (req, res) => {
    const reservationId = req.params.id;

    pool.getConnection((err, connection) => {
        if (err) {
            console.error("Database connection failed:", err);
            return res.status(500).send({ error: "Database connection error", details: err.message });
        }

        const reservationQuery = `SELECT * FROM reservations WHERE id = ?`;
        const servicesQuery = `
            SELECT rs.*, s.name as service_name, s.description as service_description 
            FROM reservation_services rs
            JOIN services s ON rs.service_id = s.id
            WHERE rs.reservation_id = ?`;

        connection.query(reservationQuery, [reservationId], (error, reservationResults) => {
            if (error) {
                connection.release();
                console.error("Error fetching reservation:", error);
                return res.status(500).send({ error: "Error fetching reservation", details: error.message });
            }

            if (reservationResults.length === 0) {
                connection.release();
                return res.status(404).send({ message: "No reservation found with the given ID" });
            }

            const reservation = reservationResults[0];

            connection.query(servicesQuery, [reservationId], (serviceError, serviceResults) => {
                connection.release();
                if (serviceError) {
                    console.error("Error fetching services:", serviceError);
                    return res.status(500).send({ error: "Error fetching services", details: serviceError.message });
                }

                reservation.services = serviceResults || []; // Ensure services is an array
                res.send(reservation);
            });
        });
    });
});


// Exemple de route pour récupérer les prestations
app.get('/api/prestations', (req, res) => {
    pool.getConnection((err, connection) => {
        if (err) throw err;
        const query = `
        SELECT 
        s.name AS service_name, 
        s.description, 
        rs.date_prestation, 
        rs.prix, 
        r.id AS reservation_id, 
        r.destination, 
        u.nom AS prestataire_nom, 
        u.prenom AS prestataire_prenom
    FROM 
        reservation_services rs
    JOIN 
        services s ON rs.service_id = s.id
    JOIN 
        reservations r ON rs.reservation_id = r.id
    JOIN 
        user u ON r.user_id = u.id
    WHERE 
        u.type = 2;
    
        `;
        connection.query(query, (err, results) => {
            connection.release();
            if (err) {
                console.error("Erreur lors de la récupération des prestations:", err);
                res.status(500).json({ error: "Erreur lors de la récupération des prestations" });
            } else {
                res.json(results);
            }
        });
    });
});

app.post('/api/services/add', (req, res) => {
    const { name, description, price } = req.body;

    if (!name || !description || typeof price !== 'number' || price < 0) {
        return res.status(400).json({ message: 'Invalid input data' });
    }

    pool.query(
        'INSERT INTO services (name, description, price) VALUES (?, ?, ?)', 
        [name, description, price], 
        (err, results) => {
            if (err) {
                console.error('Error when inserting data into services table:', err);
                return res.status(500).json({ message: 'Failed to add service' });
            }
            res.status(201).json({ id: results.insertId, message: 'Service added successfully!' });
        }
    );
});

app.post('/api/services/add', (req, res) => {
    const { name, description, price, image_url } = req.body;

    // Vérifier les données reçues
    if (!name || !description || typeof price !== 'number' || price < 0 || !image_url) {
        return res.status(400).json({ message: 'Invalid input data' });
    }

    // Requête SQL pour insérer les données
    pool.query(
        'INSERT INTO services (name, description, price, image_url) VALUES (?, ?, ?, ?)', 
        [name, description, price, image_url], 
        (err, results) => {
            if (err) {
                console.error('Error when inserting data into services table:', err);
                return res.status(500).json({ message: 'Failed to add service' });
            }
            res.status(201).json({ id: results.insertId, message: 'Service added successfully!' });
        }
    );
});


app.post('/subscription', (req, res) => {
    const { utilisateur_id, abonnement_id, date_debut, date_expiration } = req.body;

    if (!utilisateur_id || !abonnement_id || !date_debut || !date_expiration) {
        return res.status(400).json({ message: "All fields are required: utilisateur_id, abonnement_id, date_debut, date_expiration." });
    }

    const query = `
        INSERT INTO souscription (utilisateur_id, abonnement_id, date_debut, date_expiration, statut)
        VALUES (?, ?, ?, ?, 'actif')
    `;

    pool.query(query, [utilisateur_id, abonnement_id, date_debut, date_expiration], (err, results) => {
        if (err) {
            console.error("Error adding subscription:", err);
            return res.status(500).json({ error: "Error adding subscription", details: err.message });
        }
        res.status(201).json({ message: 'Subscription added successfully', subscriptionId: results.insertId });
    });
});


// --------------------------------Propriétés-----------------------------------

// Récupérer les propriétés d'un propriétaire
app.get('/api/proprietes/:proprietaire_id', (req, res) => {
    const { proprietaire_id } = req.params;

    if (!proprietaire_id || isNaN(proprietaire_id)) {
        console.error('ID propriétaire invalide');
        return res.status(400).json({ message: 'ID propriétaire invalide' });
    }

    const query = 'SELECT * FROM proprietes WHERE proprietaire_id = ?';
    pool.query(query, [proprietaire_id], (err, results) => {
        if (err) {
            console.error('Erreur lors de la récupération des propriétés:', err);
            return res.status(500).json({ message: 'Erreur lors de la récupération des propriétés' });
        }
        console.log('Propriétés récupérées:', results); // Log des résultats pour déboguer
        res.json(results);
    });
});

// Récupérer les détails d'une propriété
app.get('/api/proprietes/details/:propriete_id', (req, res) => {
    const { propriete_id } = req.params;

    if (!propriete_id || isNaN(propriete_id)) {
        console.error('ID propriété invalide');
        return res.status(400).json({ message: 'ID propriété invalide' });
    }

    const query = 'SELECT * FROM proprietes WHERE propriete_id = ?';
    pool.query(query, [propriete_id], (err, results) => {
        if (err) {
            console.error('Erreur lors de la récupération des détails de la propriété:', err);
            return res.status(500).json({ message: 'Erreur lors de la récupération des détails de la propriété' });
        }
        if (results.length === 0) {
            console.error('Propriété non trouvée');
            return res.status(404).json({ message: 'Propriété non trouvée' });
        }
        console.log('Détails de la propriété récupérés:', results[0]); // Log des résultats pour déboguer
        res.json(results[0]);
    });
});

// Ajouter une nouvelle propriété
app.post('/api/proprietes', (req, res) => {
    const {
        type_propriete,
        titre,
        adresse,
        ville,
        code_postal,
        pays,
        phrase_accroche,
        description,
        nombre_chambres,
        nombre_salles_de_bain,
        superficie,
        capacite,
        date_disponibilite,
        date_visite,
        photos,
        proprietaire_id
    } = req.body;

    if (!proprietaire_id || isNaN(proprietaire_id)) {
        console.error('ID propriétaire invalide');
        return res.status(400).json({ message: 'ID propriétaire invalide' });
    }

    const query = `
        INSERT INTO proprietes (
            type_propriete, titre, adresse, ville, code_postal, pays,
            phrase_accroche, description, nombre_chambres, nombre_salles_de_bain,
            superficie, capacite, date_disponibilite, date_visite, photos, proprietaire_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    `;
    const values = [
        type_propriete, titre, adresse, ville, code_postal, pays,
        phrase_accroche, description, nombre_chambres, nombre_salles_de_bain,
        superficie, capacite, date_disponibilite, date_visite, photos, proprietaire_id
    ];

    pool.query(query, values, (err, results) => {
        if (err) {
            console.error('Erreur lors de l\'ajout de la propriété:', err);
            return res.status(500).json({ message: 'Erreur lors de l\'ajout de la propriété' });
        }
        console.log('Propriété ajoutée:', results);
        res.status(201).json({ message: 'Propriété ajoutée avec succès!', propriete_id: results.insertId });
    });
});

// Mettre à jour une propriété existante
app.put('/api/proprietes/:propriete_id', (req, res) => {
    const { propriete_id } = req.params;
    const {
        type_propriete,
        titre,
        adresse,
        ville,
        code_postal,
        pays,
        phrase_accroche,
        description,
        nombre_chambres,
        nombre_salles_de_bain,
        superficie,
        capacite,
        date_disponibilite,
        date_visite,
        photos
    } = req.body;

    if (!propriete_id || isNaN(propriete_id)) {
        console.error('ID propriété invalide');
        return res.status(400).json({ message: 'ID propriété invalide' });
    }

    const query = `
        UPDATE proprietes SET
            type_propriete = ?, titre = ?, adresse = ?, ville = ?, code_postal = ?, pays = ?,
            phrase_accroche = ?, description = ?, nombre_chambres = ?, nombre_salles_de_bain = ?,
            superficie = ?, capacite = ?, date_disponibilite = ?, date_visite = ?, photos = ?
        WHERE propriete_id = ?
    `;
    const values = [
        type_propriete, titre, adresse, ville, code_postal, pays,
        phrase_accroche, description, nombre_chambres, nombre_salles_de_bain,
        superficie, capacite, date_disponibilite, date_visite, photos, propriete_id
    ];

    pool.query(query, values, (err, results) => {
        if (err) {
            console.error('Erreur lors de la mise à jour de la propriété:', err);
            return res.status(500).json({ message: 'Erreur lors de la mise à jour de la propriété' });
        }
        if (results.affectedRows === 0) {
            console.error('Propriété non trouvée');
            return res.status(404).json({ message: 'Propriété non trouvée' });
        }
        console.log('Propriété mise à jour:', results);
        res.json({ message: 'Propriété mise à jour avec succès!' });
    });
});

// Supprimer une propriété
app.delete('/api/proprietes/:propriete_id', (req, res) => {
    const { propriete_id } = req.params;

    if (!propriete_id || isNaN(propriete_id)) {
        console.error('ID propriété invalide');
        return res.status(400).json({ message: 'ID propriété invalide' });
    }

    const query = 'DELETE FROM proprietes WHERE propriete_id = ?';
    pool.query(query, [propriete_id], (err, results) => {
        if (err) {
            console.error('Erreur lors de la suppression de la propriété:', err);
            return res.status(500).json({ message: 'Erreur lors de la suppression de la propriété' });
        }
        console.log('Propriété supprimée:', results);
        res.json({ message: 'Propriété supprimée avec succès!' });
    });
});

app.post('/api/proprietes/:id/validate', (req, res) => {
    const proprieteId = req.params.id;
    const query = 'UPDATE proprietes SET statut = "valide" WHERE propriete_id = ?';
    
    pool.query(query, [proprieteId], (err, result) => {
        if (err) {
            console.error('Erreur lors de la validation de la propriété:', err);
            return res.status(500).json({ error: "Erreur lors de la validation de la propriété" });
        }
        res.json({ message: "Propriété validée avec succès" });
    });
});

app.post('/api/proprietes/:id/reject', (req, res) => {
    const proprieteId = req.params.id;
    const query = 'UPDATE proprietes SET statut = "rejete" WHERE propriete_id = ?';
    
    pool.query(query, [proprieteId], (err, result) => {
        if (err) {
            console.error('Erreur lors du rejet de la propriété:', err);
            return res.status(500).json({ error: "Erreur lors du rejet de la propriété" });
        }
        res.json({ message: "Propriété rejetée avec succès" });
    });
});




app.listen(PORT, () => console.log(`Server running on port ${PORT}`));

