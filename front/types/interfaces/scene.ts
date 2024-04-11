import type { User } from "./user";

export interface Scene {
    id?: number,
    siret: number,
    banner: string,
    name: string,
    slug: string,
    address: string,
    zipcode: number,
    town: string,
    phoneNumber: number,
    capacity: number,
    instagram: number,
    facebook: number,
    userId: User,
}