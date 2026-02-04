
export const useAuth = () => {
    const user = useState<any>('auth_user', () => null);
    const token = useCookie('auth_token', {
        maxAge: 60 * 60 * 24 * 7, // 7 days
        path: '/',
    });

    // Config runtime config
    const config = useRuntimeConfig();
    const apiBase = config.public.apiBase;

    // Helper to get headers
    const getHeaders = () => {
        return {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            ...(token.value ? { 'Authorization': `Bearer ${token.value}` } : {})
        };
    };

    /**
     * Register a new customer
     */
    const register = async (data: any) => {
        try {
            const response: any = await $fetch(`${apiBase}/api/auth/register`, {
                method: 'POST',
                headers: getHeaders(),
                body: data
            });

            if (response.success && response.data) {
                token.value = response.data.token;
                user.value = response.data.customer;
                return { success: true, data: response.data };
            }
            return { success: false, message: response.message || 'Đăng ký thất bại' };
        } catch (error: any) {
            console.error('Registration error:', error);
            // Extract validation errors if possible
            const message = error.response?._data?.message || 'Có lỗi xảy ra, vui lòng thử lại';
            const errors = error.response?._data?.errors;
            return { success: false, message, errors };
        }
    };

    /**
     * Login customer
     */
    const login = async (credentials: any) => {
        try {
            const response: any = await $fetch(`${apiBase}/api/auth/login`, {
                method: 'POST',
                headers: getHeaders(),
                body: credentials
            });

            if (response.success && response.data) {
                token.value = response.data.token;
                user.value = response.data.customer;
                return { success: true };
            }
            return { success: false, message: response.message || 'Đăng nhập thất bại' };
        } catch (error: any) {
            console.log('Login Error Object:', error);
            console.log('Error Data:', error.data);
            console.log('Error Response Data:', error.response?._data);

            const message = error.response?._data?.message || error.data?.message || 'Thông tin đăng nhập không chính xác';
            const errors = error.response?._data?.errors || error.data?.errors;

            console.log('Extracted Errors:', errors);

            return { success: false, message, errors };
        }
    };

    /**
     * Fetch current user profile
     */
    const fetchUser = async () => {
        if (!token.value) {
            user.value = null;
            return;
        }

        try {
            const response: any = await $fetch(`${apiBase}/api/auth/profile`, {
                method: 'GET',
                headers: getHeaders()
            });

            if (response.success) {
                user.value = response.data;
            } else {
                // If token invalid, clear it
                logout();
            }
        } catch (error) {
            console.error('Fetch user error:', error);
            logout();
        }
    };

    /**
     * Logout
     */
    const logout = async () => {
        try {
            if (token.value) {
                await $fetch(`${apiBase}/api/auth/logout`, {
                    method: 'POST',
                    headers: getHeaders()
                });
            }
        } catch (e) {
            // Ignore logout errors
        } finally {
            token.value = null;
            user.value = null;
            // Optional: redirect to home
            const router = useRouter();
            router.push('/');
        }
    };

    return {
        user,
        token,
        register,
        login,
        logout,
        fetchUser
    };
};
