import "dotenv/config";
import "reflect-metadata";
import { DataSource } from "typeorm";
import { contador_autor } from "../models/autorlibro";

const port = process.env.DB_PORT as number | undefined;

const AppDataSource = new DataSource({
	type: "postgres",
	host: process.env.DB_HOST,
	port: port,
	username: process.env.DB_USER,
	password: process.env.DB_PASS,
	database: process.env.DB_NAME,
    entities: [contador_autor]
});

export default AppDataSource;
