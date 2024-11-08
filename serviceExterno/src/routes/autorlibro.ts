import { Request, Response, Router } from "express";
import { postItem } from "../controllers/autorlibro.controller";

const router = Router();

router.post("/",postItem);

export {router};