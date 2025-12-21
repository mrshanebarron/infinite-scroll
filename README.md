# Infinite Scroll

An infinite scrolling component for Laravel applications. Automatically loads more content as user scrolls. Works with Livewire and Vue 3.

## Installation

```bash
composer require mrshanebarron/infinite-scroll
```

## Livewire Usage

### Basic Usage

```blade
<livewire:sb-infinite-scroll :loading="$loading" :no-more="$noMore">
    @foreach($items as $item)
        <div class="p-4 border-b">{{ $item->title }}</div>
    @endforeach
</livewire:sb-infinite-scroll>
```

### Livewire Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `loading` | boolean | `false` | Currently loading |
| `no-more` | boolean | `false` | No more items |
| `threshold` | number | `100` | Scroll threshold in px |
| `root-margin` | string | `'100px'` | IntersectionObserver margin |

## Vue 3 Usage

### Setup

```javascript
import { SbInfiniteScroll } from './vendor/sb-infinite-scroll';
app.component('SbInfiniteScroll', SbInfiniteScroll);
```

### Basic Usage

```vue
<template>
  <SbInfiniteScroll
    :loading="loading"
    :no-more="noMore"
    @load-more="loadMore"
  >
    <div v-for="item in items" :key="item.id" class="p-4 border-b">
      {{ item.title }}
    </div>
  </SbInfiniteScroll>
</template>

<script setup>
import { ref } from 'vue';

const items = ref([]);
const loading = ref(false);
const noMore = ref(false);
const page = ref(1);

const loadMore = async () => {
  loading.value = true;

  const response = await fetch(`/api/items?page=${page.value}`);
  const data = await response.json();

  items.value.push(...data.items);
  noMore.value = data.items.length === 0;
  page.value++;
  loading.value = false;
};

// Initial load
loadMore();
</script>
```

### Feed Example

```vue
<template>
  <div class="max-w-2xl mx-auto">
    <SbInfiniteScroll
      :loading="loading"
      :no-more="noMore"
      @load-more="loadPosts"
    >
      <article
        v-for="post in posts"
        :key="post.id"
        class="p-6 bg-white rounded-lg shadow mb-4"
      >
        <h2 class="text-xl font-bold">{{ post.title }}</h2>
        <p class="text-gray-600 mt-2">{{ post.excerpt }}</p>
      </article>

      <template #loading>
        <div class="text-center py-4">
          <span class="text-gray-500">Loading more posts...</span>
        </div>
      </template>

      <template #no-more>
        <div class="text-center py-4">
          <span class="text-gray-400">You've reached the end!</span>
        </div>
      </template>
    </SbInfiniteScroll>
  </div>
</template>
```

### Vue Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `loading` | Boolean | `false` | Loading state |
| `noMore` | Boolean | `false` | No more items to load |
| `threshold` | Number | `100` | Scroll threshold |
| `rootMargin` | String | `'100px'` | Observer margin |

### Events

| Event | Payload | Description |
|-------|---------|-------------|
| `load-more` | - | Triggered when scroll reaches threshold |

### Slots

| Slot | Description |
|------|-------------|
| default | Content items |
| `loading` | Custom loading indicator |
| `no-more` | End of list message |

## Features

- **Intersection Observer**: Efficient scroll detection
- **Loading State**: Shows spinner while loading
- **End Detection**: Displays message when no more items
- **Customizable**: Custom loading and end slots
- **Preloading**: Configurable load threshold

## Styling

Uses Tailwind CSS:
- Spinner animation
- Centered loading/end messages
- Gray text for status

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Tailwind CSS 3.x

## License

MIT License
