<script setup lang="ts">
import { ref, computed, watch, onMounted, onBeforeUnmount } from 'vue';

const props = defineProps<{
    modelValue: string | number | null;
    options: Record<string, string> | Array<{ id: string | number, name: string }>; // Can be object {id: name} or array [{id, name}]
    placeholder?: string;
    disabled?: boolean;
}>();

const emit = defineEmits(['update:modelValue', 'change']);

const isOpen = ref(false);
const searchQuery = ref('');
const containerRef = ref<HTMLElement | null>(null);

// Normalize options to array format [{id, name}]
const normalizedOptions = computed(() => {
    if (Array.isArray(props.options)) {
        return props.options.map(opt => ({
            id: opt.id,
            name: opt.name
        }));
    }
    return Object.entries(props.options || {}).map(([id, name]) => ({
        id,
        name
    }));
});

// Get selected option name
const selectedName = computed(() => {
    const selected = normalizedOptions.value.find(opt => opt.id == props.modelValue);
    return selected ? selected.name : '';
});

// Filter options (accent-insensitive)
const filteredOptions = computed(() => {
    if (!searchQuery.value) return normalizedOptions.value;

    const query = normalizeString(searchQuery.value);
    return normalizedOptions.value.filter(opt =>
        normalizeString(opt.name).includes(query)
    );
});

// Helper to remove accents
const normalizeString = (str: string) => {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
};

const toggleDropdown = () => {
    if (props.disabled) return;
    isOpen.value = !isOpen.value;
    if (isOpen.value) {
        // Focus search input on open
        setTimeout(() => {
            const input = containerRef.value?.querySelector('input');
            if (input) input.focus();
        }, 50);
    } else {
        searchQuery.value = '';
    }
};

const selectOption = (option: { id: string | number, name: string }) => {
    emit('update:modelValue', option.id);
    emit('change', option.id);
    isOpen.value = false;
    searchQuery.value = '';
};

// Close when clicking outside
const handleClickOutside = (event: MouseEvent) => {
    if (containerRef.value && !containerRef.value.contains(event.target as Node)) {
        isOpen.value = false;
        searchQuery.value = '';
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>

<template>
    <div class="relative" ref="containerRef">
        <!-- Trigger Button -->
        <div @click="toggleDropdown"
            class="w-full px-4 py-3 rounded-lg border border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800 text-stone-700 dark:text-stone-300 cursor-pointer flex items-center justify-between transition-all"
            :class="{ 'opacity-60 cursor-not-allowed': disabled, 'ring-2 ring-primary border-transparent': isOpen }">
            <span v-if="selectedName" class="truncate">{{ selectedName }}</span>
            <span v-else class="text-stone-400 truncate">{{ placeholder || 'Chọn một tùy chọn' }}</span>
            <span class="material-icons-outlined text-stone-500 text-sm transition-transform duration-200"
                :class="{ 'rotate-180': isOpen }">expand_more</span>
        </div>

        <!-- Dropdown Menu -->
        <div v-show="isOpen"
            class="absolute z-50 w-full mt-1 bg-white dark:bg-stone-800 border border-stone-200 dark:border-stone-700 rounded-lg shadow-xl max-h-60 overflow-hidden flex flex-col">
            <!-- Search Input -->
            <div class="p-2 border-b border-stone-100 dark:border-stone-700">
                <input v-model="searchQuery" type="text"
                    class="w-full px-3 py-2 text-sm rounded-md bg-stone-50 dark:bg-stone-900 border border-stone-200 dark:border-stone-600 focus:outline-none focus:border-primary"
                    placeholder="Tìm kiếm..." />
            </div>

            <!-- Options List -->
            <ul class="overflow-y-auto flex-1">
                <li v-for="option in filteredOptions" :key="option.id" @click="selectOption(option)"
                    class="px-4 py-2.5 hover:bg-stone-50 dark:hover:bg-stone-700 cursor-pointer text-sm text-stone-700 dark:text-stone-300 transition-colors"
                    :class="{ 'bg-stone-50 dark:bg-stone-700 font-semibold text-primary': modelValue == option.id }">
                    {{ option.name }}
                </li>
                <li v-if="filteredOptions.length === 0" class="px-4 py-3 text-sm text-stone-400 text-center italic">
                    Không tìm thấy kết quả
                </li>
            </ul>
        </div>
    </div>
</template>
