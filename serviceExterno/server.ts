import express,{Application} from "express";
import cors from "cors";
import juegosRoute from "./src/routes/autorlibro";

export class Server{
    private app: Application;
    private port : string;
    private pathsApi={
        contando:"/api/juegos",
    }

    constructor(){
        this.app = express();
        this.port = "3000";
        this.app.use(cors());
        this.app.use(express.json());
        this.app.use(this.pathsApi.contando,juegosRoute)
    }

    public listen()
    {
        this.app.listen(this.port,()=>{
            console.log("aja")
        })
    }
}