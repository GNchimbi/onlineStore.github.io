<script setup>
import { computed } from 'vue';
const props = defineProps(["color"])
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
        return 'bi-check-circle text-green-600'
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
    <div :class="color" class="flex flex-col relative mx-auto max-w-full py-2 items-center justify-center rounded">
        <i :class="icon" class="text-2xl font-bold"></i>
        <span class="text-center"> <slot /> </span>
    </div>
</template>