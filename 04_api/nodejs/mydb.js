import dotenv from 'dotenv'
dotenv.config();
// Para utilizar .env

import mysql from 'mysql2'

const pool = mysql.createPool({
    host: process.env.MYSQL_HOST,
    user: process.env.MYSQL_USER,
    password: process.env.MYSQL_PASS,
    database: process.env.MYSQL_DB
}).promise();
// El pool es para que no se utilice una sola conexión, sino varias y que se reutilice la última
// La promesa es para utilizar funciones asíncronas

// Con los [] utilizará el nodo 0
async function getUsers(){
    const [rows] = await pool.query("SELECT * FROM user;");
    return rows;
}

async function getUser (id)
{
    const [row] = await pool.query(`
        SELECT *
        FROM user
        WHERE iduser = ?
        ;`, [id]); // La función revisa que no haga cosas raras

    return row[0];
}

// Devuelve la info necesaria en formato JSON
async function insertUser (username, pass="asd")
{
    const [row] = await pool.query(`
        INSERT INTO user
        (username, password)
        VALUES ( ?, ? );
        `, [username, pass]);
    
    return {
        affectedRows: row.affectedRows,
        id: row.insertId
    };
}

export async function login (username, pass)
{
  const [row] = await pool.query(`
        SELECT idUser, CONCAT(name, " ", lastname) as name
        FROM user
        WHERE username = ? AND passw = ?
        ;`, [username, pass]); // La función revisa que no haga cosas raras

    return row[0];
}
