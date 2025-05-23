<ul class="inline-flex items-stretch -space-x-px" x-show="totalPages > 1">
  <li>
      <a 
          @click="prevPage" 
          :class="{ 'cursor-not-allowed opacity-50': currentPage === 1 }"
          class="cursor-pointer btn-outline py-1.5 px-3 leading-tight rounded-r-none rounded-l-lg"
      >
          <span class="sr-only">Précédent</span>
          <i data-lucide="chevron-left" class="size-5"></i>
      </a>
  </li>
  <template x-for="page in totalPages" :key="page">
      <li>
          <a 
              @click="goToPage(page)"
              :class="{'text-primary/80 bg-primary/20 border-primary hover:bg-primary/50': currentPage === page }"
              class="cursor-pointer rounded-none h-full btn-outline py-1.5 px-3"
              x-text="page"
          ></a>
      </li>
  </template>
  <li>
      <a 
          @click="nextPage" 
          :class="{ 'cursor-not-allowed opacity-50': currentPage === totalPages }"
          class="btn-outline py-1.5 px-3 leading-tight rounded-l-none rounded-r-lg"
      >
          <span class="sr-only">Suivant</span>
          <i data-lucide="chevron-right" class="size-5"></i>
      </a>
  </li>
</ul>