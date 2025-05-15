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

function mydebug (str)
{
    console.log(`\n*****\n***   ${str}\n*****`);
}

// Función Async, regresa un array donde el primero son los datos y el segundo las definiciones
async function getUsersInfo(){
    const rows = await pool.query("SELECT * FROM user;");
    return rows;
}

// Con los [] utilizará el nodo 0
async function getUsers(){
    const [rows] = await pool.query("SELECT * FROM user;");
    return rows;
}

var users = await getUsersInfo();
mydebug("getUsersInfo");
console.log(users);

var users = await getUsers();
mydebug("getUsers");
console.log(users);

async function getUserNoSafe (id)
{
    const [row] = await pool.query(`
        SELECT * 
        FROM user
        WHERE 
        idUser = ${id}
        ;`); // Puede ser código malicioso

    return row;
}

async function getUserSafe (id)
{
    const [row] = await pool.query(`
        SELECT *
        FROM user
        WHERE iduser = ?
        ;`, [id]); // La función revisa que no haga cosas raras

    return row;
}

// Regresará un valor válido
var user = await getUserSafe(1);
mydebug("getUserSafe VALID");
console.log(user);

// Regresará un valor no válido
var user = await getUserSafe(5);
mydebug("getUserSafe FAIL");
console.log(user);

// Al regresar el nodo 0, en caso de que no exista, qué pasa?
async function getUser (id)
{
    const [row] = await pool.query(`
        SELECT *
        FROM user
        WHERE iduser = ?
        ;`, [id]); // La función revisa que no haga cosas raras

    return row[0];
}

// Regresará un valor válido
var user = await getUser(1);
mydebug("getUser VALID");
console.log(user);

// Regresará un valor no válido
var user = await getUser(5);
mydebug("getUser FAIL");
console.log(user);

//////////////

async function insertUserAll (username, pass="asd")
{
    const row = await pool.query(`
        INSERT INTO user
        (username, password)
        VALUES ( ?, ? );
        `, [username, pass]);
    
    return row;
}

/*
    fieldCount
    affectedRows
    insertId
    info
    serverStatus
    warningStatus
    changedRows
*/

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

var user = await insertUserAll ("asd");
mydebug("insert ALLINFO");
console.log(user);

var user = await insertUser ("asd");
mydebug("insert");
console.log(user);

