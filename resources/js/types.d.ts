export interface User {
    id: number
    name: string
    raves: Rave[]
}

export interface Rave {
    id: number
    user_id: number
    body: string
    likes_count: number
    created_at: string
    comments_count: number
    reraves_count: number
    is_liked: boolean
    is_owner: boolean
    comments: Rave[]
    reraves: Rave[]
    user: User
    original_rave: Rave | null
}
