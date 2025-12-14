<template>
  <div ref="containerRef">
    <slot></slot>
    <div ref="sentinelRef" class="h-px"></div>
    <div v-if="loading" class="py-4 text-center">
      <slot name="loading">
        <svg class="animate-spin h-6 w-6 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
      </slot>
    </div>
    <div v-if="noMore" class="py-4 text-center text-gray-500">
      <slot name="no-more">No more items</slot>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue';

export default {
  name: 'LdInfiniteScroll',
  props: {
    loading: { type: Boolean, default: false },
    noMore: { type: Boolean, default: false },
    threshold: { type: Number, default: 100 },
    rootMargin: { type: String, default: '100px' }
  },
  emits: ['load-more'],
  setup(props, { emit }) {
    const containerRef = ref(null);
    const sentinelRef = ref(null);
    let observer = null;

    const handleIntersect = (entries) => {
      const [entry] = entries;
      if (entry.isIntersecting && !props.loading && !props.noMore) {
        emit('load-more');
      }
    };

    onMounted(() => {
      observer = new IntersectionObserver(handleIntersect, {
        root: null,
        rootMargin: props.rootMargin,
        threshold: 0
      });
      if (sentinelRef.value) {
        observer.observe(sentinelRef.value);
      }
    });

    onUnmounted(() => {
      if (observer) observer.disconnect();
    });

    return { containerRef, sentinelRef };
  }
};
</script>
