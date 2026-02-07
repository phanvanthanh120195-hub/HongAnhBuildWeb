export default defineNuxtRouteMiddleware(async (to, from) => {
    const { user, token, fetchUser } = useAuth()

    if (token.value && !user.value) {
        await fetchUser()
    }

    if (!user.value) {
        return navigateTo('/')
    }
})
