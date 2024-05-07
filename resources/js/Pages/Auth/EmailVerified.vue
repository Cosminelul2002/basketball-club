<template>

    <div class="flex flex-col items-center justify-center h-screen bg-gray-100">
        <div class="w-full md:w-6/12 bg-blue-700 flex items-center justify-center rounded-l-lg bg-cover bg-center"
            :style="{ backgroundImage: 'url(' + register_image + ')' }">
        </div>
        <div class="w-full md:w-6/12 bg-white rounded-r-lg p-10">
            <div class="flex flex-col items-center justify-center">
                <h1 class="text-3xl font-bold text-gray-800">Adresa de email a fost verificată</h1>
                <p class="text-gray-500 text-md mt-2">Adresa de email a fost verificată cu succes. Acum poți accesa
                    întreaga funcționalitate a platformei noastre.</p>
            </div>
            <div class="flex flex-col mt-5">
                <inertia-link :href="route('landing')"
                    class="button bg-gradient-to-br from-blue-400 to-blue-600 !max-w-full font-bold hover:from-blue-500 hover:to-blue-700">
                    Înapoi la pagina principală
                </inertia-link>
            </div>
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
</template>

<script>

export default {
    name: 'EmailVerified',

    data() {
        return {
            register_image: '../images/hero.jpg'
        }
    }

}

</script>