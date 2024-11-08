import { Request, Response } from "express";

const postItem = (req: Request, res: Response) => {
	try {

	} catch (e) {
		res.status(500);
		res.send("ERROR EN LA INSERCIÖN");
	}
};

export { postItem };
