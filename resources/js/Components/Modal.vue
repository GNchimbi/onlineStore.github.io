<script setup>
import { computed} from 'vue';

const props = defineProps({
    showModal: {
        type: Boolean,
        default: true,
    },
    color: {
        type: String,
        default: "green",
    },
})



const color = computed(() => {
    if(props.color == 'red'){
        return 'border border-red-600'
    }
    else if(props.color == 'green'){
        return 'border border-green-600'
    }
    else if(props.color == 'blue'){
        return 'border border-blue-400'
    }
    else if(props.color == 'orange'){
        return 'border border-orange-600'
    }
})

const icon = computed(() => {
    if(props.color == 'red'){
        return 'bi-exclamation-circle text-red-600'
    }
    else if(props.color == 'green'){
        return 'bi-check2-circle text-green-600'
    }
    else if(props.color == 'blue'){
        return 'bi-info-circle text-blue-400'
    }
    else if(props.color == 'orange'){
        return 'bi-exclamation-circle text-orange-600'
    }
})

</script>
<template>
    <div v-if="props.showModal" class="bg-black bg-opacity-40 absolute w-full h-screen top-0 left-0">
        <div class="bg-white rounded-lg max-w-md mx-auto mt-44 text-gray-700 p-4">
            <p class="p-2 rounded-full w-10 h-10 mx-auto mt-2"><i :class="icon" class="text-4xl font-extrabold"> </i></p>
            <p class="text-center text-lg font-semibold p-2">
                <slot name='title' />
            </p>
            <p class="text-center p-2">
                <slot name='content' />
            </p>
        </div>
    </div>
</template>