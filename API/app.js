const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const cors = require('cors'); // Importez cors

const app = express();
const port = process.env.PORT || 5000;

app.use(cors()); // Activez CORS pour toutes les routes et toutes les origines
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// MySQL
const pool = mysql.createPool({
    connectionLimit : 10,
    host            : 'localhost',
    user            : 'root',
    password        : '',
    database        : 'nodejs_beers'
})

/// Get all beers
app.get('/beers', (req, res) => {
    pool.getConnection((err, connection) => {
        if(err) {
            console.error("Erreur de connexion à la base de données:", err);
            return res.status(500).send("Erreur de connexion à la base de données");
        }

        connection.query('SELECT * from beers', (err, rows) => {
            connection.release(); // return the connection to pool

            if(!err) {
                res.send(rows);
            } else {
                console.error("Erreur lors de la récupération des bières:", err);
                return res.status(500).json({ error: "Erreur lors de la récupération des bières" });
            }
        });
    });
});



// Get a beer by ID
app.get('/:id', (req, res) => {

    pool.getConnection((err, connection) => {
        if(err) throw err
        console.log(`connected as id ${connection.threadId}`)

        connection.query('SELECT * from beers WHERE id = ?', [req.params.id], (err, rows) => {
            connection.release() // return the connection to pool

            if(!err) {
                res.send(rows)
            } else {
                console.log(err)
            }

        })
    })
})

// Delete a records / beer
app.delete('/:id', (req, res) => {

    pool.getConnection((err, connection) => {
        if(err) throw err
        console.log(`connected as id ${connection.threadId}`)

        connection.query('DELETE from beers WHERE id = ?', [req.params.id], (err, rows) => {
            connection.release() // return the connection to pool

            if(!err) {
                res.send(`Beer with the Record ID: ${[req.params.id]} has been removed.`)
            } else {
                console.log(err)
            }

        })
    })
})


// Add a record / beer
app.post('/beers', (req, res) => {
    pool.getConnection((err, connection) => {
        if (err) {
            console.error("Erreur de connexion à la base de données:", err);
            return res.status(500).send("Erreur de connexion à la base de données");
        }

        const { name, tagline, description } = req.body;

        const query = 'INSERT INTO beers (name, tagline, description) VALUES (?, ?, ?)';
        connection.query(query, [name, tagline, description], (err, results) => {
            connection.release();

            if (err) {
                console.error("Erreur lors de l'ajout de la bière:", err);
                return res.status(500).json({ error: "Erreur lors de l'ajout de la bière" });
            }

            res.status(201).json({ message: 'Nouvelle bière créée avec succès', beerId: results.insertId });
        });
    });
});



// Update a record / beer
app.put('/beers/:id', (req, res) => {
    pool.getConnection((err, connection) => {
        if(err) {
            console.error("Erreur de connexion à la base de données:", err);
            return res.status(500).send("Erreur de connexion à la base de données");
        }

        const { name, tagline, description, image } = req.body;
        const beerId = req.params.id;

        connection.query('UPDATE beers SET name = ?, tagline = ?, description = ?, image = ? WHERE id = ?', [name, tagline, description, image, beerId], (err, result) => {
            connection.release();
            if(err) {
                console.error("Erreur lors de la mise à jour:", err);
                return res.status(500).json({ error: "Erreur lors de la mise à jour" });
            }
            if (result.affectedRows === 0) {
                return res.status(404).json({ message: "Aucune bière trouvée avec cet ID" });
            }
            res.json({ message: "Bière mise à jour avec succès" });
        });
    });
});




// Listen on enviroment port or 5000
app.listen(port, () => console.log(`Listen on port ${port}`))