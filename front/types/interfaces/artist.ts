// Une interface est un contrat qui définit les propriétés que doit avoir un objet
// on note comme les attributs de l'objet (soit camelCase) et on note le type de l'attribut
// on peut aussi définir si l'attribut est optionnel avec le symbole '?'

import type { Category } from "./category";
import type { Style } from "./style";
import type { User } from "./user";

export interface Artist {
    id?: number,
    artistName : string,
    slug: string,
    officialPhoto : string,
    linkExcerpt: string,
    instagram: string,
    facebook: string,
    showPhoto: string,
    showTitle: string,
    showDescription: string,
    category?: Category,
    style?: Style,
    user?: User,
}