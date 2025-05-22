import express from 'express'
import bodyParser from 'body-parser';
import {login} from './mydb.js'

const port = 8080;

const app = express();
app.use(bodyParser.urlencoded({ extended: false })); // Convierte el urlencoded de unity

app.get("/", (req, res) => {
    res.send("Hello World");
});

app.get("/users", (req, res) => {
    res.send("SELECT * FROM user;");
});

app.get("/user/:id", (req, res) => {
    const id = req.params['id'];
    res.send(`SELECT * FROM user WHERE idUser = ${id};`);
});

app.post("/login", async function (req, res) {
    
    //console.log(req.headers);
    console.log("Received: ");
    console.log(req.body);

    const info = await login (req.body.username, req.body.password);
    let unity;
    if (info != undefined)
    {
        unity = {
            status: "valid",
            id: info.idUser,
            name: info.name
        };
    }
    else
    {
        unity = {
            status: "error",
            error: "Invalid username/password"
        };
    }

    res.send(unity);

});

app.listen(port, () => {
    console.log(`Server running port ${port}`);
});