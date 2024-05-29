<template>
    <div class="bg-white">
        <Layout>
            <main>
                <!-- Hero section -->
                <div class="relative isolate overflow-hidden bg-gray-900 pb-16 pt-14 sm:pb-20">
                    <img :src="hero" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover" />
                    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                        aria-hidden="true">
                        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                            style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
                    </div>
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                            <div class="text-center">
                                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">Deploy to the cloud
                                    with
                                    confidence</h1>
                                <p class="mt-6 text-lg leading-8 text-gray-300">Anim aute id magna aliqua ad ad non
                                    deserunt
                                    sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat
                                    fugiat
                                    aliqua.</p>
                            </div>
                        </div>

                        <!-- Logo cloud -->
                        <div
                            class="mx-auto grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-10 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 lg:mx-0 lg:max-w-none lg:grid-cols-5">
                            <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1"
                                src="https://tailwindui.com/img/logos/158x48/transistor-logo-white.svg" alt="Transistor"
                                width="158" height="48" />
                            <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1"
                                src="https://tailwindui.com/img/logos/158x48/reform-logo-white.svg" alt="Reform"
                                width="158" height="48" />
                            <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1"
                                src="https://tailwindui.com/img/logos/158x48/tuple-logo-white.svg" alt="Tuple"
                                width="158" height="48" />
                            <img class="col-span-2 max-h-12 w-full object-contain sm:col-start-2 lg:col-span-1"
                                src="https://tailwindui.com/img/logos/158x48/savvycal-logo-white.svg" alt="SavvyCal"
                                width="158" height="48" />
                            <img class="col-span-2 col-start-2 max-h-12 w-full object-contain sm:col-start-auto lg:col-span-1"
                                src="https://tailwindui.com/img/logos/158x48/statamic-logo-white.svg" alt="Statamic"
                                width="158" height="48" />
                        </div>
                    </div>
                    <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                        aria-hidden="true">
                        <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                            style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
                    </div>
                </div>

                <!-- Feature section -->
                <div class="mt-32 sm:mt-56">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl sm:text-center">
                            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Performanță
                                distractivă? Baschetul!
                            </p>
                            <p class="mt-6 text-lg leading-8 text-gray-600">Baschetul îți oferă ambele! Hai să jucăm și
                                să ne
                                distrăm!</p>
                        </div>
                    </div>
                    <div class="relative overflow-hidden pt-16">
                        <div class="mx-auto max-w-7xl px-6 lg:px-8">
                            <img :src="featureImg" alt="App screenshot"
                                class="mb-[-12%] rounded-xl shadow-2xl ring-1 ring-gray-900/10" width="2432"
                                height="1442" />
                            <div class="relative" aria-hidden="true">
                                <div class="absolute -inset-x-20 bottom-0 bg-gradient-to-t from-white pt-[7%]" />
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto mt-16 max-w-7xl px-6 sm:mt-20 md:mt-24 lg:px-8">
                        <dl
                            class="mx-auto grid max-w-2xl grid-cols-1 gap-x-6 gap-y-10 text-base leading-7 text-gray-600 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3 lg:gap-x-8 lg:gap-y-16">
                            <div v-for="feature in features" :key="feature.name" class="flex flex-col relative pl-9">
                                <dt class="inline font-semibold text-gray-900">
                                    <component :is="feature.icon" class="absolute left-1 top-1 h-5 w-5 text-indigo-600"
                                        aria-hidden="true" />
                                    {{ feature.name }}
                                </dt>
                                <dd class="inline">{{ feature.description }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Testimonial section -->
                <div class="relative z-10 mt-32 bg-gray-900 pb-20 sm:mt-56 sm:pb-24 xl:pb-0">
                    <div class="absolute inset-0 overflow-hidden" aria-hidden="true">
                        <div class="absolute left-[calc(50%-19rem)] top-[calc(50%-36rem)] transform-gpu blur-3xl">
                            <div class="aspect-[1097/1023] w-[68.5625rem] bg-gradient-to-r from-[#ff4694] to-[#776fff] opacity-25"
                                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
                        </div>
                    </div>
                    <div
                        class="mx-auto flex max-w-7xl flex-col items-center gap-x-8 gap-y-10 px-6 sm:gap-y-8 lg:px-8 xl:flex-row xl:items-stretch">
                        <div class="-mt-8 w-full max-w-2xl xl:-mb-8 xl:w-96 xl:flex-none">
                            <div class="relative aspect-[2/1] h-full md:-mx-8 xl:mx-0 xl:aspect-auto">
                                <img class="absolute inset-0 h-full w-full rounded-2xl bg-gray-800 object-cover shadow-2xl"
                                    src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2102&q=80"
                                    alt="" />
                            </div>
                        </div>
                        <div class="w-full max-w-2xl xl:max-w-none xl:flex-auto xl:px-16 xl:py-24">
                            <figure class="relative isolate pt-6 sm:pt-12">
                                <svg viewBox="0 0 162 128" fill="none" aria-hidden="true"
                                    class="absolute left-0 top-0 -z-10 h-32 stroke-white/20">
                                    <path id="b56e9dab-6ccb-4d32-ad02-6b4bb5d9bbeb"
                                        d="M65.5697 118.507L65.8918 118.89C68.9503 116.314 71.367 113.253 73.1386 109.71C74.9162 106.155 75.8027 102.28 75.8027 98.0919C75.8027 94.237 75.16 90.6155 73.8708 87.2314C72.5851 83.8565 70.8137 80.9533 68.553 78.5292C66.4529 76.1079 63.9476 74.2482 61.0407 72.9536C58.2795 71.4949 55.276 70.767 52.0386 70.767C48.9935 70.767 46.4686 71.1668 44.4872 71.9924L44.4799 71.9955L44.4726 71.9988C42.7101 72.7999 41.1035 73.6831 39.6544 74.6492C38.2407 75.5916 36.8279 76.455 35.4159 77.2394L35.4047 77.2457L35.3938 77.2525C34.2318 77.9787 32.6713 78.3634 30.6736 78.3634C29.0405 78.3634 27.5131 77.2868 26.1274 74.8257C24.7483 72.2185 24.0519 69.2166 24.0519 65.8071C24.0519 60.0311 25.3782 54.4081 28.0373 48.9335C30.703 43.4454 34.3114 38.345 38.8667 33.6325C43.5812 28.761 49.0045 24.5159 55.1389 20.8979C60.1667 18.0071 65.4966 15.6179 71.1291 13.7305C73.8626 12.8145 75.8027 10.2968 75.8027 7.38572C75.8027 3.6497 72.6341 0.62247 68.8814 1.1527C61.1635 2.2432 53.7398 4.41426 46.6119 7.66522C37.5369 11.6459 29.5729 17.0612 22.7236 23.9105C16.0322 30.6019 10.618 38.4859 6.47981 47.558L6.47976 47.558L6.47682 47.5647C2.4901 56.6544 0.5 66.6148 0.5 77.4391C0.5 84.2996 1.61702 90.7679 3.85425 96.8404L3.8558 96.8445C6.08991 102.749 9.12394 108.02 12.959 112.654L12.959 112.654L12.9646 112.661C16.8027 117.138 21.2829 120.739 26.4034 123.459L26.4033 123.459L26.4144 123.465C31.5505 126.033 37.0873 127.316 43.0178 127.316C47.5035 127.316 51.6783 126.595 55.5376 125.148L55.5376 125.148L55.5477 125.144C59.5516 123.542 63.0052 121.456 65.9019 118.881L65.5697 118.507Z" />
                                    <use href="#b56e9dab-6ccb-4d32-ad02-6b4bb5d9bbeb" x="86" />
                                </svg>
                                <blockquote class="text-xl font-semibold leading-8 text-white sm:text-2xl sm:leading-9">
                                    <p>Gravida quam mi erat tortor neque molestie. Auctor aliquet at porttitor a enim
                                        nunc
                                        suscipit tincidunt nunc. Et non lorem tortor posuere. Nunc eu scelerisque
                                        interdum
                                        eget
                                        tellus non nibh scelerisque bibendum.</p>
                                </blockquote>
                                <figcaption class="mt-8 text-base">
                                    <div class="font-semibold text-white">Judith Black</div>
                                    <div class="mt-1 text-gray-400">CEO of Tuple</div>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>

                <!-- Pricing section -->
                <div class="bg-white py-24 sm:py-32">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        <div class="mx-auto max-w-4xl text-center">
                            <h2 class="text-base font-semibold leading-7 text-indigo-600">Pricing</h2>
                            <p class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Pricing
                                plans for teams of&nbsp;all&nbsp;sizes</p>
                        </div>
                        <p class="mx-auto mt-6 max-w-2xl text-center text-lg leading-8 text-gray-600">Distinctio et
                            nulla eum soluta et neque labore quibusdam. Saepe et quasi iusto modi velit ut non
                            voluptas in. Explicabo id ut laborum.</p>
                        <div
                            class="isolate mx-auto mt-16 grid max-w-md grid-cols-1 gap-y-8 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                            <div v-for="(tier, tierIdx) in tiers" :key="tier.id"
                                :class="[tier.mostPopular ? 'lg:z-10 lg:rounded-b-none' : 'lg:mt-8', tierIdx === 0 ? 'lg:rounded-r-none' : '', tierIdx === tiers.length - 1 ? 'lg:rounded-l-none' : '', 'flex flex-col justify-between rounded-3xl bg-white p-8 ring-1 ring-gray-200 xl:p-10']">
                                <div>
                                    <div class="flex items-center justify-between gap-x-4">
                                        <h3 :id="tier.id"
                                            :class="[tier.mostPopular ? 'text-indigo-600' : 'text-gray-900', 'text-lg font-semibold leading-8']">
                                            {{ tier.name }}</h3>
                                        <p v-if="tier.mostPopular"
                                            class="rounded-full bg-indigo-600/10 px-2.5 py-1 text-xs font-semibold leading-5 text-indigo-600">
                                            Most popular</p>
                                    </div>
                                    <p class="mt-4 text-sm leading-6 text-gray-600">{{ tier.description }}</p>
                                    <p class="mt-6 flex items-baseline gap-x-1">
                                        <span class="text-4xl font-bold tracking-tight text-gray-900">{{
                        tier.priceMonthly }}</span>
                                        <span class="text-sm font-semibold leading-6 text-gray-600">/month</span>
                                    </p>
                                    <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-600">
                                        <li v-for="feature in tier.features" :key="feature" class="flex gap-x-3">
                                            <CheckIcon class="h-6 w-5 flex-none text-indigo-600" aria-hidden="true" />
                                            {{ feature }}
                                        </li>
                                    </ul>
                                </div>
                                <a :href="tier.href" :aria-describedby="tier.id"
                                    :class="[tier.mostPopular ? 'bg-indigo-600 text-white shadow-sm hover:bg-indigo-500' : 'text-indigo-600 ring-1 ring-inset ring-indigo-200 hover:ring-indigo-300', 'mt-8 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600']">Buy
                                    plan</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="bg-white py-16 sm:py-24 lg:py-32 ">
                    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-6 lg:grid-cols-12 lg:gap-8 lg:px-8">
                        <div class="max-w-xl text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl lg:col-span-7">
                            <h2 class="inline sm:block lg:inline xl:block">Fii la curent cu noutățile și actualizările
                                noastre!</h2>
                            {{ ' ' }}
                            <p class="inline sm:block lg:inline xl:block">Abonează-te la newsletter-ul nostru.</p>
                        </div>
                        <form class="w-full max-w-md lg:col-span-5 lg:pt-2">
                            <div class="flex gap-x-4">
                                <label for="email-address" class="sr-only">Email address</label>
                                <input id="email-address" name="email" type="email" autocomplete="email" required=""
                                    class="min-w-0 flex-auto rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    placeholder="Enter your email" />
                                <button type="submit"
                                    class="flex-none rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div> -->

                <!-- FAQ section -->
                <div class="mx-auto mt-32 max-w-7xl px-6 sm:mt-32 lg:px-8">
                    <div class="mx-auto max-w-4xl divide-y divide-gray-900/10">
                        <h2 class="text-2xl font-bold leading-10 tracking-tight text-gray-900">Întrebări frecvente
                        </h2>
                        <dl class="mt-10 space-y-6 divide-y divide-gray-900/10">
                            <Disclosure as="div" v-for="faq in faqs" :key="faq.question" class="pt-6" v-slot="{ open }">
                                <dt>
                                    <DisclosureButton
                                        class="flex w-full items-start justify-between text-left text-gray-900">
                                        <span class="text-base font-semibold leading-7">{{ faq.question }}</span>
                                        <span class="ml-6 flex h-7 items-center">
                                            <PlusSmallIcon v-if="!open" class="h-6 w-6" aria-hidden="true" />
                                            <MinusSmallIcon v-else class="h-6 w-6" aria-hidden="true" />
                                        </span>
                                    </DisclosureButton>
                                </dt>
                                <DisclosurePanel as="dd" class="mt-2 pr-12">
                                    <p class="text-base leading-7 text-gray-600">{{ faq.answer }}</p>
                                </DisclosurePanel>
                            </Disclosure>
                        </dl>
                    </div>
                </div>
            </main>
        </Layout>
    </div>
</template>

<!-- <script setup>
import { CheckIcon } from '@heroicons/vue/20/solid'

const tiers = [
    {
        name: 'Freelancer',
        id: 'tier-freelancer',
        href: '#',
        priceMonthly: '$24',
        description: 'The essentials to provide your best work for clients.',
        features: ['5 products', 'Up to 1,000 subscribers', 'Basic analytics', '48-hour support response time'],
        mostPopular: false,
    },
    {
        name: 'Startup',
        id: 'tier-startup',
        href: '#',
        priceMonthly: '$32',
        description: 'A plan that scales with your rapidly growing business.',
        features: [
            '25 products',
            'Up to 10,000 subscribers',
            'Advanced analytics',
            '24-hour support response time',
            'Marketing automations',
        ],
        mostPopular: true,
    },
    {
        name: 'Enterprise',
        id: 'tier-enterprise',
        href: '#',
        priceMonthly: '$48',
        description: 'Dedicated support and infrastructure for your company.',
        features: [
            'Unlimited products',
            'Unlimited subscribers',
            'Advanced analytics',
            '1-hour, dedicated support response time',
            'Marketing automations',
        ],
        mostPopular: false,
    },
]
</script> -->

<script>

export default {

    name: 'Home',

    data() {
        return {
            hero: 'images/hero2.jpg',
            featureImg: 'images/team.jpg',
        }
    }
}

</script>

<script setup>
import { ref } from 'vue'
import { Dialog, DialogPanel, Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import { Bars3Icon, MinusSmallIcon, PlusSmallIcon, XMarkIcon } from '@heroicons/vue/24/outline'
import {
    ArrowPathIcon,
    CheckIcon,
    CloudArrowUpIcon,
    Cog6ToothIcon,
    FingerPrintIcon,
    LockClosedIcon,
    ServerIcon,
} from '@heroicons/vue/20/solid'
import Layout from '../Layouts/Layout.vue';

const navigation = [
    { name: 'Acasă', href: route('landing') },
    { name: 'Despre noi', href: route('about') },
    { name: 'Înscriere', href: route('join.create') },
    { name: 'Antrenori', href: '#' },
    { name: 'Media', href: route('media') },
    { name: 'Știri', href: '#' },
    { name: 'Parteneri', href: '#' },
    { name: 'Contact', href: route('contact') },
]
const features = [
    {
        name: 'Gestionează eficient echipele și jucătorii',
        description: 'Cu ERP-ul nostru, poți organiza și monitoriza fiecare aspect al echipei tale de baschet, de la gestionarea jucătorilor și staff-ului tehnic la programarea antrenamentelor și a meciurilor.',
        icon: CloudArrowUpIcon,
    },
    {
        name: 'Analizează performanțele și strategiile',
        description: 'Beneficiază de instrumente avansate de analiză și raportare pentru a evalua performanțele echipei și pentru a dezvolta strategii de joc eficiente. Obține date în timp real și ia decizii informate pentru a-ți duce echipa la victorie.',
        icon: LockClosedIcon,
    },
    {
        name: 'Gestionează eficient resursele și echipamentele',
        description: 'Cu funcționalitățile noastre de gestionare a resurselor și a echipamentelor, poți urmări și gestiona fiecare echipament și resursă utilizată de echipa ta de baschet. Asigură-te că totul este întotdeauna în ordine și că echipa ta are tot ce-i trebuie pentru a se pregăti și a juca la nivel înalt.',
        icon: ArrowPathIcon,
    },
    {
        name: 'Comunică și colaborează eficient',
        description: 'Facilitează comunicarea și colaborarea între toți membrii echipei tale de baschet, de la jucători și antrenori la personalul administrativ. Creează un mediu de lucru colaborativ și motivant pentru a atinge obiectivele comune și a obține succesul pe teren.',
        icon: ArrowPathIcon,
    },
    {
        name: 'Accesează dashboard-uri personalizate',
        description: 'ERP-ul nostru oferă dashboard-uri dedicate pentru administratori, jucători și părinți, astfel încât fiecare utilizator să poată accesa și gestiona informațiile și funcționalitățile relevante pentru rolul său în cadrul echipei de baschet.',
        icon: ArrowPathIcon,
    },
]
const tiers = [
    {
        name: 'Freelancer',
        id: 'tier-freelancer',
        href: '#',
        priceMonthly: '$24',
        description: 'The essentials to provide your best work for clients.',
        features: ['5 products', 'Up to 1,000 subscribers', 'Basic analytics', '48-hour support response time'],
        mostPopular: false,
    },
    {
        name: 'Startup',
        id: 'tier-startup',
        href: '#',
        priceMonthly: '$32',
        description: 'A plan that scales with your rapidly growing business.',
        features: [
            '25 products',
            'Up to 10,000 subscribers',
            'Advanced analytics',
            '24-hour support response time',
            'Marketing automations',
        ],
        mostPopular: true,
    },
    {
        name: 'Enterprise',
        id: 'tier-enterprise',
        href: '#',
        priceMonthly: '$48',
        description: 'Dedicated support and infrastructure for your company.',
        features: [
            'Unlimited products',
            'Unlimited subscribers',
            'Advanced analytics',
            '1-hour, dedicated support response time',
            'Marketing automations',
        ],
        mostPopular: false,
    },
]
const faqs = [
    {
        question: "Cât de des se desfășoară antrenamentele și meciurile?",
        answer:
            "Antrenamentele noastre sunt programate de obicei de două sau trei ori pe săptămână, iar meciurile pot avea loc în funcție de programul competițional.",
    },
    {
        question: "Care sunt criteriile de selecție pentru a deveni membru al echipei de baschet?",
        answer:
            "În general, selecția se face pe baza abilităților tehnice și fizice, dar și a angajamentului și atitudinii pozitive față de echipă și sport.",
    },
    {
        question: "Există vreo limită de vârstă pentru a te înscrie în clubul nostru de baschet?",
        answer:
            "De obicei, acceptăm membri de toate vârstele, de la copii la adulți. Înscrierea poate fi supusă unor restricții specifice anumitor categorii de vârstă sau niveluri de abilitate.",
    },
    {
        question: "Care sunt costurile implicate în a face parte din echipa de baschet?",
        answer:
            "Costurile pot varia în funcție de diverse aspecte, cum ar fi taxa de înscriere, echipamentul sportiv, deplasările la meciuri și antrenamente, dar echipa noastră încearcă să ofere opțiuni accesibile pentru toți membrii",
    },
    {
        question: "Ce oportunități de dezvoltare oferiți membrilor clubului de baschet?",
        answer:
            " În afară de antrenamentele regulate și participarea la competiții, oferim și programe de dezvoltare a abilităților, tabere de instruire, evenimente sociale și ședințe informative pentru a promova creșterea personală și sportivă a membrilor noștri.",
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
}

const mobileMenuOpen = ref(false)
</script>