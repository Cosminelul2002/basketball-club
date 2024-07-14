<template>
    <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
            <ul role="list" class="-mx-2 space-y-1">
                <li v-for="item in routes" :key="item.name">
                    <div @click="item.current === true">
                        <a :href="item.href"
                            :class="[item.current ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                            <component :is="item.icon" class="h-6 w-6 shrink-0" aria-hidden="true" />
                            {{ item.name }}
                        </a>
                    </div>
                </li>
            </ul>
        </li>
        <li class="mt-auto">
            <a href="#"
                class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-400 hover:bg-gray-800 hover:text-white">
                <Cog6ToothIcon class="h-6 w-6 shrink-0" aria-hidden="true" />
                Settings
            </a>
        </li>
    </ul>
</template>

<script>

export default {
    name: 'RouteList',

    props: {
        routes: {
            type: Array,
            required: true
        },
    }
}

</script>