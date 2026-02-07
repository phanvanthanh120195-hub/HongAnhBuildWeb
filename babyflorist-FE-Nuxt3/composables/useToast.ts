export interface Toast {
    id: string;
    message: string;
    type: 'success' | 'error' | 'info' | 'warning';
    duration?: number;
}

export const useToast = () => {
    const toasts = useState<Toast[]>('toasts', () => []);

    const removeToast = (id: string) => {
        toasts.value = toasts.value.filter(t => t.id !== id);
    };

    const addToast = (message: string, type: Toast['type'] = 'info', duration: number = 3000) => {
        const id = Math.random().toString(36).substring(2, 9);
        toasts.value.push({
            id,
            message,
            type,
            duration
        });

        if (duration > 0) {
            setTimeout(() => {
                removeToast(id);
            }, duration);
        }
    };

    return {
        toasts,
        addToast,
        removeToast
    };
};
