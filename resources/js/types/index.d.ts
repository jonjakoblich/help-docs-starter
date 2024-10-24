import { Config } from 'ziggy-js';

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export interface Category {
    name: string;
    slug: string;
    featured?: boolean;
}

export interface Article {
    name: string;
    slug: string;
    content?: string;
    updated_at?: string;
    featured?: boolean;    
}

export interface HelpfulMetrics {
    foundHelpful: number;
    totalVotes: number;
    articleSlug: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
};
