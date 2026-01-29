<template>
  <div class="searchable-select" :class="{ disabled: disabled }" ref="container">
    <div class="select-input" @click="toggleDropdown">
      <input 
        type="text" 
        v-model="searchQuery" 
        :placeholder="placeholder"
        :disabled="disabled"
        readonly="readonly" 
        @focus="onFocus"
        @input="onInput"
        ref="inputField"
      >
      <i class="fas fa-chevron-down arrow-icon"></i>
    </div>
    
    <div class="select-dropdown" v-if="isOpen">
       <input 
          type="text" 
          class="search-box" 
          v-model="filterText" 
          placeholder="Tìm kiếm..." 
          ref="searchBox"
          @click.stop
       >
       <ul class="options-list">
          <li 
            v-for="option in filteredOptions" 
            :key="option.id" 
            @click="selectOption(option)"
            :class="{ selected: option.id === modelValue }"
          >
            {{ option.full_name }}
          </li>
          <li v-if="filteredOptions.length === 0" class="no-results">
            Không tìm thấy kết quả
          </li>
       </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  options: {
    type: Array,
    default: () => []
  },
  modelValue: {
    type: [String, Number],
    default: ''
  },
  placeholder: {
    type: String,
    default: 'Chọn...'
  },
  disabled: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['update:modelValue', 'change'])

const container = ref(null)
const isOpen = ref(false)
const searchQuery = ref('') // Display text
const filterText = ref('')  // Search input inside dropdown
const searchBox = ref(null)

// Initialize display text based on modelValue
watch(() => props.modelValue, (newVal) => {
  const selected = props.options.find(opt => opt.id === newVal)
  searchQuery.value = selected ? selected.full_name : ''
}, { immediate: true })

// Also watch options because they might load async while modelValue exists
watch(() => props.options, () => {
   const selected = props.options.find(opt => opt.id === props.modelValue)
    if (selected) {
        searchQuery.value = selected.full_name
    } else {
        searchQuery.value = ''
    }
}, { deep: true })

const filteredOptions = computed(() => {
  if (!filterText.value) return props.options
  const normalize = (str) => {
      return str.normalize("NFD")
                .replace(/[\u0300-\u036f]/g, "")
                .replace(/đ/g, "d")
                .replace(/Đ/g, "D")
                .toLowerCase()
  }
  const lower = normalize(filterText.value)
  return props.options.filter(opt => normalize(opt.full_name).includes(lower))
})

function toggleDropdown() {
  if (props.disabled) return
  isOpen.value = !isOpen.value
  if (isOpen.value) {
    filterText.value = '' // Reset filter
    setTimeout(() => {
        searchBox.value?.focus()
    }, 100)
  }
}

function onFocus() {
    // handled by click mostly, but ensures readonly input doesn't confuse
}

function selectOption(option) {
  emit('update:modelValue', option.id)
  emit('change', option.id)
  searchQuery.value = option.full_name
  isOpen.value = false
}

// Click outside to close
function handleClickOutside(event) {
  if (container.value && !container.value.contains(event.target)) {
    isOpen.value = false
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>

<style scoped>
.searchable-select {
  position: relative;
  width: 100%;
}

.select-input {
  position: relative;
  cursor: pointer;
}

.select-input input {
  width: 100%;
  height: 45px;
  padding: 10px 30px 10px 15px;
  border: 1px solid #ddd;
  border-radius: 4px;
  background-color: white;
  cursor: pointer;
}

.select-input input:disabled {
  background-color: #f9f9f9;
  cursor: not-allowed;
}

.arrow-icon {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #888;
  pointer-events: none;
}

.select-dropdown {
  position: absolute;
  top: 100%;
  left: 0;
  width: 100%;
  background: white;
  border: 1px solid #ddd;
  border-radius: 4px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  z-index: 1000;
  margin-top: 5px;
  padding: 10px;
}

.search-box {
  width: 100%;
  padding: 8px;
  border: 1px solid #eee;
  border-radius: 4px;
  margin-bottom: 5px;
  outline: none;
}

.search-box:focus {
  border-color: #ff4d4d;
}

.options-list {
  list-style: none;
  padding: 0;
  margin: 0;
  max-height: 200px;
  overflow-y: auto;
}

.options-list li {
  padding: 8px 10px;
  cursor: pointer;
  transition: background 0.2s;
  color: #333;
}

.options-list li:hover {
  background-color: #f5f5f5;
}

.options-list li.selected {
  background-color: #ffebee;
  color: #c62828;
  font-weight: 500;
}

.no-results {
  padding: 10px;
  text-align: center;
  color: #999;
}
</style>
