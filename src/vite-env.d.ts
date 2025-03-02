/// <reference types="vite/client" />

interface ImportMetaEnv {
    readonly VITE_API_BASE_URL: string;
}

interface ImportMeta {
    readonly env: ImportMetaEnv;
}

// @ts-ignore
declare global {
    interface Window {
        axios: typeof import("axios");
    }
}

declare module 'react-telegram-login' {
    interface TelegramUser {
        id: number;
        first_name: string;
        last_name?: string;
        username?: string;
        photo_url?: string;
        auth_date: number;
        hash: string;
    }

    interface TelegramLoginButtonProps {
        botName: string;
        dataOnauth: (user: TelegramUser) => void;
        buttonSize?: 'large' | 'medium' | 'small';
        cornerRadius?: number;
        lang?: string;
        requestAccess?: string;
        className?: string;
    }

    const TelegramLoginButton: React.FC<TelegramLoginButtonProps>;
    export default TelegramLoginButton;
}
