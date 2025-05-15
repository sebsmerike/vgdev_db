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

// Función Async, regresa un array donde el primero son los datos y el segundo las definiciones
async function getUsers(){
  const rows = await pool.query("SELECT * FROM user;");
  return rows;
}

const users = await getUsers();
console.log(users);


const loginUser = await pool.query(`
  SELECT * 
  FROM user
  WHERE 
  idUser = ");