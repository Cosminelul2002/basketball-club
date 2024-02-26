<template>
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl ">
        <a href="#" class="flex items-center">
            <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap ">Flowbite</span>
        </a>
        <div class="flex items-center lg:order-2">
            <a href="#"
                class="hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2  focus:outline-none dark:focus:ring-gray-800">Log
                in</a>
            <a href="#"
                class="bg-[#8AB6F9] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2  focus:outline-none dark:focus:ring-blue-800">Get
                started</a>
        </div>
        <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                <li v-for="option in options" :key="option.name">
                    <inertia-link :href="option.route"
                        class="block py-2 pr-4 pl-3  border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-[#00246B] lg:p-0  lg:   lg:bg-transparent dark:border-gray-700">{{
                            option.name }}</inertia-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>

export default {
    name: "HeaderOptions",

    data() {
        return {
            options: [
                { name: "Acasă", route: route('landing') },
                { name: "Despre noi", route: route('about') },
                { name: "Galerie", route: route('media') },
                { name: "Alătură-te", route: route('join') },
                { name: "Contact", route: route('contact') }
            ]
        }
    }
}

</script>
