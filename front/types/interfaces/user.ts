export interface User {
    id?: number,
    name: string,
    firstName: string,
    picture: string,    
    email: string,
    password: string,
    role: string | [],  
}