<script setup>
import { computed } from 'vue';

const props = defineProps({
  header: Boolean,
  footer: Boolean,
  cta: Boolean,
  headerAlignment: String
})

const alignment = computed(() => {
  if (!props.cta) {
    if (props.headerAlignment === 'center') {
      return 'justify-center';
    } else if (props.headerAlignment === 'start' || props.headerAlignment === 'left') {
      return 'justify-start'
    }
  }
  return 'justify-between';
})
</script>

<template>
  <div class="rounded-lg shadow-md bg-white border border-gray-200">
    <div v-if="header" class="rounded-tl-lg rounded-tr-lg px-4 py-5 border-b-2 border-gray-200 bg-white">
      <div class="-ml-4 -mt-2 flex flex-wrap items-center sm:flex-nowrap" :class="alignment">
        <div class="ml-4 mt-2">
          <slot name="header" />
        </div>
        <div v-if="cta" class="ml-4 mt-2 flex-shrink-0">
          <slot name="cta" />
        </div>
      </div>
    </div>
    <div class="px-1" :class="{ 'py-3 lg:px-4 lg:py-5': footer, 'pt-3 pb-2 lg:px-4': !footer }">
      <slot name="body" />
    </div>
    <div v-if="footer" class="mt-3 px-6 py-3 border-t border-gray-900/3">
      <slot name="footer" />
    </div>
  </div>
</template>