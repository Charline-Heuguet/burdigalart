// Table pivot entre User et Role
import type { Role } from "./role";
import type { User } from "./user";

export interface Attribution {
    id?: number,
    userId: User[],
    roleId: Role[],
}