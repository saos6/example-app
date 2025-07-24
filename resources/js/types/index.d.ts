import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface Person {
    id: number;
    name: string;
    email: string;
    phone: string;
    address: string;
    affiliation_id: number;
    created_at: string;
    updated_at: string;
}

export interface Customer {
    id: number;
    name: string;
    email: string;
    people_id: number;
    person?: Person;
    created_at: string;
    updated_at: string;
}

export interface Product {
    id: number;
    name: string;
    price: number;
    created_at: string;
    updated_at: string;
}

export interface Quotation {
    id: number;
    customer_id: number;
    person_id: number;
    quotation_date: string;
    total_amount: number;
    customer?: Customer;
    person?: Person;
    quotation_items: QuotationItem[];
    created_at: string;
    updated_at: string;
}

export interface QuotationItem {
    id: number;
    quotation_id: number;
    product_id: number;
    quantity: number;
    unit_price: number;
    product?: Product;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;
