export interface Settings {
    allow_notification: boolean;
}

export interface UserType {
    id: number | string;
    name: string;
    email?: string;
    phone?: string;
    status?: boolean;
    onboarded?: boolean;
    profile_pic?: string;
    type?: 'seller' | 'customer';
    settings?: Settings
}

export interface AddressType {
    id: number | string;
    name?: string,
    email?: string,
    phone?: string,
    address_1?: string,
    address_2?: string,
    city?: string,
    zip?: string,
    state?: string,
    address?: string,
    country?: string,
    is_primary?: boolean,
    latitude?: string,
    longitude?: string
}

export interface Product {
    id: number | string;
    title: string;
    short_description: string;
    seller_product_id?: primary_id;
    price?: string;
    price_type?: 'bid' | 'fixed';
    qty?: number | string;
    image?: string;
    addtional_images?: Array<string>;
    description?: string;
    additional_info?: Array<string>;
    is_favourite?: boolean;
}

export type BasicProductCategory = Pick<ProductCategory, 'id' | 'title'>;

export interface ProductCategory {
    id: number | string;
    title: string;
    short_description?: string;
    description?: string;
    cover_image?: string;

    parent?: BasicProductCategory;
    children?: Array<BasicProductCategory>;
    shops?: Array<BasicShop>
}

export type BasicShop = Pick<Shop, 'id' | 'shop_owner' | 'shop_name'>;

export interface Shop {
    id: number | string;
    shop_owner?: string;
    shop_name?: string;
    images?: Array<string>;
    categories?: Array<ProductCategory>;
}