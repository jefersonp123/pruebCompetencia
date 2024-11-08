import "dotenv/config";
import express from "express";
import cors from "cors";
import { router } from "./routes";
import AppDataSource from "./config/postgres";
const PORT = process.env.PORT || 3001;
const app = express();
app.use(cors());
app.use(router);
app.use(express.json());
AppDataSource.initialize().then(() => {console.log("conectado en BD")});
app.listen(PORT, () => console.log("aqui ando"));

