// Table pivot entre Scene et User  
import type { Scene } from "./scene";
import type { User } from "./user";

export interface Reservation {
    id?: number,
    userId: User[],
    sceneId: Scene[],
}