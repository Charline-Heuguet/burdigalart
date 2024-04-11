import type { Scene } from "./scene";

export interface Event {
    id?: number,
    title: string,
    description: string,
    dateTime: Date,
    poster: string,
    price: number,
    slug: string,
    scene: Scene,
}