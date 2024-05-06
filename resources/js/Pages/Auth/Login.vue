<template>
    <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center ">
        <div class="w-full h-full z-10 flex flex-col md:flex-row">
            <div class="w-12/12 md:w-6/12 p-10">
                <div class="max-w-xs mx-auto flex items-center justify-center h-full">
                    <form @submit.prevent="submit" class="w-full">
                        <div class="flex flex-col gap-7">
                            <div class="flex flex-col gap-2">
                                <h1 class="title max-w-max !mb-0">Hei, salut! 👋</h1>
                                <span class="text-gray-500 !mt-0">Gata sa intri în contul tău?</span>
                            </div>
                            <div v-show="Object.keys($page.props.errors).length > 0" class="bg-red-300 rounded-md">
                                <div class="flex flex-col gap-2 p-4">
                                    <span class="text-red-700 font-bold">Eroare!</span>
                                    <span class="text-red-700" v-for="error in $page.props.errors" v-bind:key="error">
                                        {{ error }}</span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <span>Email</span>
                                <input type="email" class="input bg-white rounded-md text-black px-2 py-1"
                                    placeholder="Email" v-model="form.email" />
                            </div>
                            <div class="flex flex-col gap-1">
                                <span>Parola</span>
                                <input type="password" class="input bg-white rounded-md text-black px-2 py-1"
                                    placeholder="Parola" v-model="form.password" />
                            </div>

                            <div class="flex flex-col md:flex-row justify-between gap-2 mt-5">
                                <div class="flex flex-row items-center justify-center gap-2">
                                    <input v-model="form.remember" type="checkbox" />
                                    <span class="text-gray-500 text-md">Păstrează-mă autentificat</span>
                                </div>
                            </div>

                            <button type="submit"
                                class="button bg-gradient-to-br from-blue-400 to-blue-600 !max-w-full font-bold hover:from-blue-500 hover:to-blue-700">
                                Intră în cont
                            </button>
                            <inertia-link :href="route('auth.register')" class="flex justify-center text-gray-500 text-md">
                                Nu ai cont ? Fă-ți unul aici !
                            </inertia-link>

                            <div class="flex justify-center">
                                <inertia-link :href="route('password.request')" class="text-gray-500 text-md">
                                    Ai uitat parola?
                                </inertia-link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-full md:w-6/12 bg-blue-700 flex items-center justify-center rounded-r-lg bg-cover bg-center"
                :style="{ backgroundImage: 'url(' + register_image + ')' }">
            </div>
        </div>
        <inertia-link :href="route('landing')">
            <div class="flex flex-row items-center z-20 absolute left-5 top-5 w-30 h-10 gap-2">
                <div class="text-gray-500 h-10 w-10 flex items-center justify-center cursor-pointer">
                    <svg width="35" height="35" fill="none" viewBox="0 0 24 24" color="currentColor">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M19.25 12H5"></path>
                    </svg>
                </div>
                <span class="text-sm text-gray-500">Înapoi la pagina principală</span>
            </div>
        </inertia-link>
        <div class="z-0 absolute bg-white h-full w-full"></div>
    </div>
</template>

<script>

export default {
    name: 'Register',

    data() {
        return {
            form: {
                email: null,
                password: null,
                remember: false
            },
            register_image: '../images/hero.jpg'
        }
    },

    methods: {
        submit() {
            this.$inertia.post(route('auth.login.post'), this.form);
        }
    }


}

</script>