<!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
    <div class="bg-white">
        <Layout>
            <main class="isolate">
                <!-- Hero section -->
                <div class="relative isolate -z-10 overflow-hidden bg-gradient-to-b from-indigo-100/20 pt-14">
                    <div class="absolute inset-y-0 right-1/2 -z-10 -mr-96 w-[200%] origin-top-right skew-x-[-30deg] bg-white shadow-xl shadow-indigo-600/10 ring-1 ring-indigo-50 sm:-mr-80 lg:-mr-96"
                        aria-hidden="true" />
                    <div class="mx-auto max-w-7xl px-6 py-32 sm:py-40 lg:px-8">
                        <div
                            class="mx-auto max-w-2xl lg:mx-0 lg:grid lg:max-w-none lg:grid-cols-2 lg:gap-x-16 lg:gap-y-6 xl:grid-cols-1 xl:grid-rows-1 xl:gap-x-8">
                            <h1
                                class="max-w-2xl text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl lg:col-span-2 xl:col-auto">
                                Suntem o echipă dedicată din capitală, concentrată pe construirea viitorului baschetului.
                            </h1>
                            <div class="mt-6 max-w-xl lg:mt-0 xl:col-end-1 xl:row-start-1">
                                <p class="text-lg leading-8 text-gray-600">Împreună, ne străduim să creăm o comunitate
                                    puternică, plină de pasiune și angajată să dezvolte abilitățile jucătorilor noștri.
                                    Alătură-te nouă și fii parte din călătoria noastră spre excelență în baschet!
                                </p>
                            </div>
                            <img :src="about1" alt=""
                                class="mt-10 aspect-[6/5] w-full max-w-lg rounded-2xl object-cover sm:mt-16 lg:mt-0 lg:max-w-none xl:row-span-2 xl:row-end-2 xl:mt-36" />
                        </div>
                    </div>
                    <div class="absolute inset-x-0 bottom-0 -z-10 h-24 bg-gradient-to-t from-white sm:h-32" />
                </div>

                <!-- Timeline section -->
                <div class="mx-auto -mt-8 max-w-7xl px-6 lg:px-8">
                    <div
                        class="mx-auto grid max-w-2xl grid-cols-1 gap-8 overflow-hidden lg:mx-0 lg:max-w-none lg:grid-cols-4">
                        <div v-for="item in timeline" :key="item.name">
                            <time :datetime="item.dateTime"
                                class="flex items-center text-sm font-semibold leading-6 text-indigo-600">
                                <svg viewBox="0 0 4 4" class="mr-4 h-1 w-1 flex-none" aria-hidden="true">
                                    <circle cx="2" cy="2" r="2" fill="currentColor" />
                                </svg>
                                {{ item.date }}
                                <div class="absolute -ml-2 h-px w-screen -translate-x-full bg-gray-900/10 sm:-ml-4 lg:static lg:-mr-6 lg:ml-8 lg:w-auto lg:flex-auto lg:translate-x-0"
                                    aria-hidden="true" />
                            </time>
                            <p class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">{{ item.name }}</p>
                            <p class="mt-1 text-base leading-7 text-gray-600">{{ item.description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Logo cloud -->
                <div class="mx-auto mt-32 max-w-7xl sm:mt-40 sm:px-6 lg:px-8">
                    <div
                        class="relative isolate overflow-hidden bg-gray-900 px-6 py-24 text-center shadow-2xl sm:rounded-3xl sm:px-16">
                        <h2 class="mx-auto max-w-2xl text-3xl font-bold tracking-tight text-white sm:text-4xl">Our customers
                            love us</h2>
                        <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-300">Aliquip reprehenderit incididunt
                            amet
                            quis fugiat ut velit. Sit occaecat labore proident cillum in nisi adipisicing officia excepteur
                            tempor deserunt.</p>
                        <div
                            class="mx-auto mt-20 grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-12 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 sm:gap-y-14 lg:max-w-4xl lg:grid-cols-5">
                            <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1"
                                src="https://tailwindui.com/img/logos/158x48/transistor-logo-white.svg" alt="Transistor"
                                width="158" height="48" />
                            <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1"
                                src="https://tailwindui.com/img/logos/158x48/reform-logo-white.svg" alt="Reform" width="158"
                                height="48" />
                            <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1"
                                src="https://tailwindui.com/img/logos/158x48/tuple-logo-white.svg" alt="Tuple" width="158"
                                height="48" />
                            <img class="col-span-2 max-h-12 w-full object-contain sm:col-start-2 lg:col-span-1"
                                src="https://tailwindui.com/img/logos/158x48/savvycal-logo-white.svg" alt="SavvyCal"
                                width="158" height="48" />
                            <img class="col-span-2 col-start-2 max-h-12 w-full object-contain sm:col-start-auto lg:col-span-1"
                                src="https://tailwindui.com/img/logos/158x48/statamic-logo-white.svg" alt="Statamic"
                                width="158" height="48" />
                        </div>
                        <div class="absolute -top-24 right-0 -z-10 transform-gpu blur-3xl" aria-hidden="true">
                            <div class="aspect-[1404/767] w-[87.75rem] bg-gradient-to-r from-[#80caff] to-[#4f46e5] opacity-25"
                                style="clip-path: polygon(73.6% 51.7%, 91.7% 11.8%, 100% 46.4%, 97.4% 82.2%, 92.5% 84.9%, 75.7% 64%, 55.3% 47.5%, 46.5% 49.4%, 45% 62.9%, 50.3% 87.2%, 21.3% 64.1%, 0.1% 100%, 5.4% 51.1%, 21.4% 63.9%, 58.9% 0.2%, 73.6% 51.7%)" />
                        </div>
                    </div>
                </div>

                <!-- Content section -->
                <div class="mt-32 overflow-hidden sm:mt-40">
                    <div class="mx-auto max-w-7xl px-6 lg:flex lg:px-8">
                        <div
                            class="mx-auto grid max-w-2xl grid-cols-1 gap-x-12 gap-y-16 lg:mx-0 lg:min-w-full lg:max-w-none lg:flex-none lg:gap-y-8">
                            <div class="lg:col-end-1 lg:w-full lg:max-w-lg lg:pb-8">
                                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Echipa noastră</h2>
                                <p class="mt-6 text-xl leading-8 text-gray-600">Suntem mereu în căutarea excelenței. Chiar
                                    și în fața provocărilor, ne străduim să găsim soluții. Ne concentrăm pe dezvoltarea
                                    abilităților și pe depășirea obstacolelor. Suntem determinați să atingem performanțe
                                    remarcabile și să facem din fiecare moment o oportunitate de creștere și îmbunătățire.
                                </p>
                                <p class="mt-6 text-base leading-7 text-gray-600">Oamenii noștrii sunt pasionați de baschet
                                    și dedicați
                                    echipajului nostru. Cu inima deschisă și spiritul competitiv, facem tot posibilul să ne
                                    depășim limitele. Ne străduim să devenim mai buni în fiecare zi și să inspirăm pe
                                    ceilalți să facă același lucru. Împreună, suntem mai mult decât o echipă - suntem o
                                    familie de baschet.</p>
                            </div>
                            <div class="flex flex-wrap items-start justify-end gap-6 sm:gap-8 lg:contents">
                                <div class="w-0 flex-auto lg:ml-auto lg:w-auto lg:flex-none lg:self-end">
                                    <img :src="about2" alt=""
                                        class="aspect-[7/5] w-[37rem] max-w-none rounded-2xl bg-gray-50 object-cover" />
                                </div>
                                <div
                                    class="contents lg:col-span-2 lg:col-end-2 lg:ml-auto lg:flex lg:w-[37rem] lg:items-start lg:justify-end lg:gap-x-8">
                                    <div class="order-first flex w-64 flex-none justify-end self-end lg:w-auto">
                                        <img :src="about3" alt=""
                                            class="aspect-[4/3] w-[24rem] max-w-none flex-none rounded-2xl bg-gray-50 object-cover" />
                                    </div>
                                    <div class="flex w-96 flex-auto justify-end lg:w-auto lg:flex-none">
                                        <img :src="about4" alt=""
                                            class="aspect-[7/5] w-[37rem] max-w-none flex-none rounded-2xl bg-gray-50 object-cover" />
                                    </div>
                                    <div class="hidden sm:block sm:w-0 sm:flex-auto lg:w-auto lg:flex-none">
                                        <img :src="about5" alt=""
                                            class="aspect-[4/3] w-[24rem] max-w-none rounded-2xl bg-gray-50 object-cover" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="mx-auto mt-32 max-w-7xl px-6 sm:mt-40 lg:px-8">
                    <div class="mx-auto max-w-2xl lg:mx-0">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Intrăm pe terenul de joc
                            pentru a aduce bucurie și valoare vieților noastre și lumii întregi.</h2>
                        <p class="mt-6 text-base leading-7 text-gray-600">Chiar acum, fiecare moment petrecut pe terenul de
                            baschet este ca o călătorie unică. Atmosfera intensă a competiției și conexiunea cu echipa
                            creează momente de neuitat. Ne punem pasiunea în fiecare mișcare, iar fiecare aruncare sau pas
                            ne aduce mai aproape de succes. În inima jocului, descoperim nu doar un sport, ci și o
                            modalitate de a ne dezvolta și a aduce entuziasm și inspirație în lume.</p>
                    </div>
                    <div
                        class="mx-auto mt-16 flex max-w-2xl flex-col gap-8 lg:mx-0 lg:mt-20 lg:max-w-none lg:flex-row lg:items-end">
                        <div
                            class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-gray-50 p-8 sm:w-3/4 sm:max-w-md sm:flex-row-reverse sm:items-end lg:w-72 lg:max-w-none lg:flex-none lg:flex-col lg:items-start">
                            <p class="flex-none text-3xl font-bold tracking-tight text-gray-900">250k</p>
                            <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                                <p class="text-lg font-semibold tracking-tight text-gray-900">Users on the platform</p>
                                <p class="mt-2 text-base leading-7 text-gray-600">Vel labore deleniti veniam consequuntur
                                    sunt
                                    nobis.</p>
                            </div>
                        </div>
                        <div
                            class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-gray-900 p-8 sm:flex-row-reverse sm:items-end lg:w-full lg:max-w-sm lg:flex-auto lg:flex-col lg:items-start lg:gap-y-44">
                            <p class="flex-none text-3xl font-bold tracking-tight text-white">$8.9 billion</p>
                            <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                                <p class="text-lg font-semibold tracking-tight text-white">We’re proud that our customers
                                    have
                                    made over $8 billion in total revenue.</p>
                                <p class="mt-2 text-base leading-7 text-gray-400">Eu duis porta aliquam ornare. Elementum
                                    eget
                                    magna egestas.</p>
                            </div>
                        </div>
                        <div
                            class="flex flex-col-reverse justify-between gap-x-16 gap-y-8 rounded-2xl bg-indigo-600 p-8 sm:w-11/12 sm:max-w-xl sm:flex-row-reverse sm:items-end lg:w-full lg:max-w-none lg:flex-auto lg:flex-col lg:items-start lg:gap-y-28">
                            <p class="flex-none text-3xl font-bold tracking-tight text-white">401,093</p>
                            <div class="sm:w-80 sm:shrink lg:w-auto lg:flex-none">
                                <p class="text-lg font-semibold tracking-tight text-white">Transactions this year</p>
                                <p class="mt-2 text-base leading-7 text-indigo-200">Eu duis porta aliquam ornare. Elementum
                                    eget
                                    magna egestas. Eu duis porta aliquam ornare.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content section -->
                <div class="mx-auto mt-32 max-w-7xl px-6 sm:mt-40 lg:px-8">
                    <div
                        class="mx-auto flex max-w-2xl flex-col items-end justify-between gap-16 lg:mx-0 lg:max-w-none lg:flex-row">
                        <div class="w-full lg:max-w-lg lg:flex-auto">
                            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Suntem mereu în căutarea
                                tinerilor pasionați să se alăture echipei noastre.</h2>
                            <p class="mt-6 text-xl leading-8 text-gray-600">Acum, este momentul să descoperiți frumusețea
                                baschetului! Alăturați-vă nouă și împreună vom învăța, vom crește și vom excela în acest
                                sport minunat.</p>
                            <img :src="about6"
                                alt=""
                                class="mt-16 aspect-[6/5] w-full rounded-2xl bg-gray-50 object-cover lg:aspect-auto lg:h-[34.5rem]" />
                        </div>
                        <div class="w-full lg:max-w-xl lg:flex-auto">
                            <h3 class="sr-only">Job openings</h3>
                            <ul class="-my-8 divide-y divide-gray-100">
                                <li v-for="opening in jobOpenings" :key="opening.id" class="py-8">
                                    <dl class="relative flex flex-wrap gap-x-3">
                                        <dt class="sr-only">Role</dt>
                                        <dd class="w-full flex-none text-lg font-semibold tracking-tight text-gray-900">
                                            <a :href="opening.href">
                                                {{ opening.role }}
                                                <span class="absolute inset-0" aria-hidden="true" />
                                            </a>
                                        </dd>
                                        <dt class="sr-only">Description</dt>
                                        <dd class="mt-2 w-full flex-none text-base leading-7 text-gray-600">{{
                                            opening.description }}</dd>
                                        <dt class="sr-only">Salary</dt>
                                        <dd class="mt-4 text-base font-semibold leading-7 text-gray-900">{{ opening.salary
                                        }}
                                        </dd>
                                        <dt class="sr-only">Location</dt>
                                        <dd class="mt-4 flex items-center gap-x-3 text-base leading-7 text-gray-500">
                                            <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 flex-none fill-gray-300"
                                                aria-hidden="true">
                                                <circle cx="1" cy="1" r="1" />
                                            </svg>
                                            {{ opening.location }}
                                        </dd>
                                    </dl>
                                </li>
                            </ul>
                            <div class="mt-8 flex border-t border-gray-100 pt-8">
                                <a href="#"
                                    class="text-sm font-semibold leading-6 text-indigo-600 hover:text-indigo-500">View
                                    all openings <span aria-hidden="true">&rarr;</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </Layout>
    </div>
</template>

<script>

export default {
    name: 'About',

    data() {
        return {
            about1: 'images/about1.jpg',
            about2: 'images/about2.jpg',
            about3: 'images/about3.jpg',
            about4: 'images/about4.jpg',
            about5: 'images/about5.jpg',
            about6: 'images/about6.jpg',
        }
    }
}

</script>
  
<script setup>
import { defineComponent, h, ref } from 'vue'
import { Dialog, DialogPanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import Layout from '../../Layouts/Layout.vue';

const navigation = [
    { name: 'Product', href: '#' },
    { name: 'Features', href: '#' },
    { name: 'Resources', href: '#' },
    { name: 'Company', href: '#' },
]
const timeline = [
    {
        name: 'Founded company',
        description:
            'Nihil aut nam. Dignissimos a pariatur et quos omnis. Aspernatur asperiores et dolorem dolorem optio voluptate repudiandae.',
        date: 'Aug 2021',
        dateTime: '2021-08',
    },
    {
        name: 'Secured $65m in funding',
        description:
            'Provident quia ut esse. Vero vel eos repudiandae aspernatur. Cumque minima impedit sapiente a architecto nihil.',
        date: 'Dec 2021',
        dateTime: '2021-12',
    },
    {
        name: 'Released beta',
        description:
            'Sunt perspiciatis incidunt. Non necessitatibus aliquid. Consequatur ut officiis earum eum quia facilis. Hic deleniti dolorem quia et.',
        date: 'Feb 2022',
        dateTime: '2022-02',
    },
    {
        name: 'Global launch of product',
        description:
            'Ut ipsa sint distinctio quod itaque nam qui. Possimus aut unde id architecto voluptatem hic aut pariatur velit.',
        date: 'Dec 2022',
        dateTime: '2022-12',
    },
]
const jobOpenings = [
    {
        id: 1,
        role: 'Full-time designer',
        href: '#',
        description:
            'Quos sunt ad dolore ullam qui. Enim et quisquam dicta molestias. Corrupti quo voluptatum eligendi autem labore.',
        salary: '$75,000 USD',
        location: 'San Francisco, CA',
    },
    {
        id: 2,
        role: 'Laravel developer',
        href: '#',
        description:
            'Et veniam et officia dolorum rerum. Et voluptas consequatur magni sapiente amet voluptates dolorum. Ut porro aut eveniet.',
        salary: '$125,000 USD',
        location: 'San Francisco, CA',
    },
    {
        id: 3,
        role: 'React Native developer',
        href: '#',
        description:
            'Veniam ipsam nisi quas architecto eos non voluptatem in nemo. Est occaecati nihil omnis delectus illum est.',
        salary: '$105,000 USD',
        location: 'San Francisco, CA',
    },
]
const footerNavigation = {
    solutions: [
        { name: 'Marketing', href: '#' },
        { name: 'Analytics', href: '#' },
        { name: 'Commerce', href: '#' },
        { name: 'Insights', href: '#' },
    ],
    support: [
        { name: 'Pricing', href: '#' },
        { name: 'Documentation', href: '#' },
        { name: 'Guides', href: '#' },
        { name: 'API Status', href: '#' },
    ],
    company: [
        { name: 'About', href: '#' },
        { name: 'Blog', href: '#' },
        { name: 'Jobs', href: '#' },
        { name: 'Press', href: '#' },
        { name: 'Partners', href: '#' },
    ],
    legal: [
        { name: 'Claim', href: '#' },
        { name: 'Privacy', href: '#' },
        { name: 'Terms', href: '#' },
    ],
    social: [
        {
            name: 'Facebook',
            href: '#',
            icon: defineComponent({
                render: () =>
                    h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
                        h('path', {
                            'fill-rule': 'evenodd',
                            d: 'M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z',
                            'clip-rule': 'evenodd',
                        }),
                    ]),
            }),
        },
        {
            name: 'Instagram',
            href: '#',
            icon: defineComponent({
                render: () =>
                    h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
                        h('path', {
                            'fill-rule': 'evenodd',
                            d: 'M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z',
                            'clip-rule': 'evenodd',
                        }),
                    ]),
            }),
        },
        {
            name: 'X',
            href: '#',
            icon: defineComponent({
                render: () =>
                    h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
                        h('path', {
                            d: 'M13.6823 10.6218L20.2391 3H18.6854L12.9921 9.61788L8.44486 3H3.2002L10.0765 13.0074L3.2002 21H4.75404L10.7663 14.0113L15.5685 21H20.8131L13.6819 10.6218H13.6823ZM11.5541 13.0956L10.8574 12.0991L5.31391 4.16971H7.70053L12.1742 10.5689L12.8709 11.5655L18.6861 19.8835H16.2995L11.5541 13.096V13.0956Z',
                        }),
                    ]),
            }),
        },
        {
            name: 'GitHub',
            href: '#',
            icon: defineComponent({
                render: () =>
                    h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
                        h('path', {
                            'fill-rule': 'evenodd',
                            d: 'M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z',
                            'clip-rule': 'evenodd',
                        }),
                    ]),
            }),
        },
        {
            name: 'YouTube',
            href: '#',
            icon: defineComponent({
                render: () =>
                    h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
                        h('path', {
                            'fill-rule': 'evenodd',
                            d: 'M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z',
                            'clip-rule': 'evenodd',
                        }),
                    ]),
            }),
        },
    ],
}

const mobileMenuOpen = ref(false)
</script>