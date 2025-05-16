import express from 'express'

const port = 8080;

const app = express();
//app.use(express.json()); // Convierte JSON de BODY automáticamente para usarlo local

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

app.post("/user", (req, res) => {
    
    console.log(req.headers);
    console.log(req.body);

    const name = "nani"; //req.body.name;
    res.send(`SELECT * FROM user WHERE username like ${name};`);
});

app.listen(port, () => {
    console.log(`Server running port ${port}`);
});