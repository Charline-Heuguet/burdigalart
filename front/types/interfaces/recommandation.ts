import type { Artist } from "./artist";

export interface Recommandation {
    id?: number,
    recommendedBy: Artist[]; // Artistes qui recommandent cet artiste
    artistRecommended: Artist[]; // Artistes recommandés par cet artiste
}