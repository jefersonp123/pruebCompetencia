import { Column, Entity, OneToMany, PrimaryGeneratedColumn } from "typeorm";
import { Contador } from "../interfaces/contador.interface";

@Entity()
export class contador_autor {
	@PrimaryGeneratedColumn()
	id: number;

	@Column()
	id_autor: number;

	@Column()
	type_interaction: number;

	@Column()
	date: string;

	constructor(id_autor: number,type_interaction:number,date:string) {
		this.id_autor = id_autor;
        this.type_interaction = type_interaction;
        this.date = date;
	}
}
