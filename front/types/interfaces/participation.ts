import type { Artist } from "./artist";
import type { Scene } from "./scene";

export interface Participation {
    id?: number,
    artistId: Artist[],
    sceneId: Scene[],
}