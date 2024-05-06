<template>
    <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center ">
        <div class="w-full h-full z-10 flex flex-col md:flex-row">
            <div class="w-12/12 md:w-4/12 p-10">
                <div class="max-w-xs mx-auto flex items-center justify-center h-full">
                    <form @submit.prevent="submit" class="w-full">
                        <div class="flex flex-col gap-7 justify-start">
                            <div class="flex flex-col gap-2">
                                <h1 class="title max-w-max !mb-0">Reseteaza-ti parola aici! 👋</h1>
                            </div>
                            <div v-show="Object.keys($page.props.errors).length > 0" class="bg-red-300 rounded-md">
                                <div class="flex flex-col gap-2 p-4">
                                    <span class="text-red-700 font-bold">Eroare!</span>
                                    <span class="text-red-700" v-for="error in $page.props.errors" v-bind:key="error">
                                        {{ error }}</span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <span>Parola noua:</span>
                                <input type="password" class="input bg-white rounded-md text-black px-2 py-1"
                                    placeholder="New password" v-model="form.password" />
                            </div>
                            <div class="flex flex-col gap-1">
                                <span>Confirma parola noua:</span>
                                <input type="password" class="input bg-white rounded-md text-black px-2 py-1"
                                    placeholder="Confirm new password" v-model="form.password_confirmation" />
                            </div>
                            <button type="submit"
                                class="button bg-gradient-to-br from-blue-400 to-blue-600 !max-w-full font-bold hover:from-blue-500 hover:to-blue-700">Submit</button>
                            <inertia-link :href="route('auth.login')">
                                <span class="text-gray-500 px-10">Înapoi la autentificare</span>
                            </inertia-link>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-12/12 md:w-8/12 bg-blue-700 flex items-center justify-center rounded-r-lg">
                <h2 class="title text-white">Stiai ca?</h2>
            </div>
        </div>
        <inertia-link :href="route('landing')">
            <div class="flex flex-row items-center z-20 absolute left-5 top-5 w-30 h-10 gap-5">
                <div class="bg-blue-500 rounded-full h-10 w-10 flex items-center justify-center cursor-pointer">
                    <svg width="35" height="35" fill="none" viewBox="0 0 24 24" color="white">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M19.25 12H5"></path>
                    </svg>
                </div>
                <span class="text-sm font-semibold">Înapoi la pagina principală</span>
            </div>
        </inertia-link>
        <div class="z-0 absolute bg-white h-full w-full"></div>
    </div>
</template>

<script>
export default {
    name: 'Auth/ResetPassForm',

    components: {
    },

    props: {
        email: String,
        token: String,
    },

    data() {
        return {
            form: {
                password: null,
                password_confirmation: null,
                email: this.email,
                token: this.token,
            }
        }
    },

    methods: {
        submit() {
            this.$inertia.post(route('password.update'), this.form);
        }
    }
}
</script>
