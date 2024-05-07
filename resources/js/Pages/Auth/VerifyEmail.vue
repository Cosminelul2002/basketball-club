<template>
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center items-center">
        <div class="max-w-lg mx-auto p-8 bg-white shadow-lg rounded-lg">
            <h1 class="text-3xl font-semibold text-gray-800 mb-4">Verificare Adresă de Email</h1>
            <p class="text-gray-600 mb-6">
                Pentru a continua, te rugăm să verifici adresa de email.
            </p>
            <div class="flex justify-center">
                <inertia-link :href="route('landing')"
                    class="px-6 py-3 mr-4 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-300 ease-in-out">
                    Înapoi la Pagina Principală
                </inertia-link>
                <button @click="resendVerification"
                    class="px-6 py-3 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors duration-300 ease-in-out focus:outline-none">
                    Retrimite Email-ul de Verificare
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'EmailVerification',

    methods: {
        resendVerification() {
            this.$inertia.post(route('verification.send'));
        }
    }
}
</script>

<style scoped>
/* Custom Styles */
/* Center content vertically */
.min-h-screen {
    display: flex;
    align-items: center;
}

/* Button hover effect */
button:hover {
    transform: translateY(-2px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Button focus outline */
button:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
}
</style>