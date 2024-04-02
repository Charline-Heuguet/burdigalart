// Table pivot entre Scene et User : quand un utilisateur prend des tickets pour assister à un événement d'une scene
import type { Scene } from "./scene";
import type { User } from "./user";

export interface Reservation {
    id?: number,
    userId: User[],
    sceneId: Scene[],
}