<!-- Search button -->
<div  x-data="{
    searchOpen: false,
    searchTerm: '',
    searchResults: [],
    showMore: 5,
    recentSearches: [],
    isLoading: false,
    categorySelected:'categories',
    modelSearchTypes: [

        { name: 'Categories', type: 'category', enabled: true },
        { name: 'Tags', type: 'tag', enabled: true },
        { name: 'explore', type: 'explore', enabled: true },
    ],
    // Toggle the active category
    lastClickedModelType: null,
    toggleModelType(modelType) {
        const clickedModel = this.modelSearchTypes.find(model => model.type === modelType);
        if (clickedModel) {
            if (this.lastClickedModelType === modelType) {
                // If the same model type is clicked again, toggle all divs
                this.modelSearchTypes.forEach(model => {
                    model.enabled = true;
                });
                this.lastClickedModelType = null;
            } else {
                // Otherwise, show only the clicked div
                this.modelSearchTypes.forEach(model => {
                    model.enabled = (model.type === modelType);
                });
                this.lastClickedModelType = modelType;
            }
        }
    },
    redirectKeywords(keyword,url){

        window.location.href = url + '/?q=' + keyword.replace(/\s+/g, '+');
    },
    redirectPostRequest(name, id, slug, type, url) {
                           

        axios.post('/user/record/search/model-hits', {
                id: id,
                type: type,
                name: name
            })
            .then(response => {

                window.location.href = url;
            })
            .catch(error => {

            });

    },
    init() {

        axios.get('/user/record/search/history')
            .then(response => {
                isLoading = true,
                    this.recentSearches = Object.values(response.data)

            })
            .catch(error => {
                console.error(error);
            });
    }
    {{-- this.fetchDefaultResults() --}}

}">




    <div @click.prevent="searchOpen = true;if (searchOpen) $nextTick(()=>{$refs.searchInput.focus()});"
        class="hidden lg:block mr-8 border-r w-full  relative rounded">
        <input placeholder="Search For Anything..." type="text" class="placeholder:text-sm placeholder:xl:text-base w-full border-0 dark:bg-slate-800 bg-[#F5F5F5] p-2 rounded">

        <div class="absolute top-2 right-5">
            <i class="fas fa-search"></i>
        </div>

    </div>

    <!-- Button -->
    <button
        class="flex lg:hidden w-8 h-8 flex items-center justify-center bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600/80 rounded-full"
        :class="{ 'bg-slate-200': searchOpen }"
        @click.prevent="searchOpen = true;if (searchOpen) $nextTick(()=>{$refs.searchInput.focus()});"
        aria-controls="search-modal">

        <span class="sr-only">Search</span>
        <svg class="w-4 h-4" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
            <path class="fill-current text-slate-500 dark:text-slate-400"
                d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
            <path class="fill-current text-slate-400 dark:text-slate-500"
                d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
        </svg>
    </button>
    <!-- Modal backdrop -->
    <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity" x-show="searchOpen"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" x-cloak></div>
    <!-- Modal dialog -->
    <div id="search-modal"
        class="fixed inset-0 z-50 overflow-hidden flex items-start top-20 mb-4 justify-center px-4 sm:px-6"
        role="dialog" aria-modal="true" x-show="searchOpen" x-transition:enter="transition ease-in-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4" x-cloak>
        <div class="bg-white dark:bg-slate-800 border border-transparent dark:border-slate-700 overflow-auto max-w-2xl w-full max-h-full rounded shadow-lg"
            @click.outside="searchOpen = false" @keydown.escape.window="searchOpen = false">
            <!-- Search form -->
            <form action="" method="get"
                class="border-b border-slate-200 dark:border-slate-700">
                <div class="relative">
                    <label for="modal-search" class="sr-only">Search</label>
                    <input id="modal-search" name="q"
                        class="w-full dark:text-slate-300 bg-white dark:bg-slate-800 border-0 focus:ring-transparent placeholder-slate-400 dark:placeholder-slate-500 appearance-none py-3 pl-10 pr-4"
                        type="search" placeholder="Search Anything…" x-ref="searchInput" x-model="searchTerm"
                        @input.debounce.500="fetchResults" />
                    <button class="absolute inset-0 right-auto group" type="submit" aria-label="Search">
                        <svg class="w-4 h-4 shrink-0 fill-current text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400 ml-4 mr-2"
                            viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
                            <path
                                d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
                        </svg>
                    </button>
                </div>
            </form>
            <div class="py-4 px-2">
                <!-- Recent searches -->
                <div class="mb-3 last:mb-0">

                    <div x-show="isLoading && searchTerm !== ''" class="flex items-center justify-center">
                        <svg class="w-10 h-10" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="4" cy="12" r="3" fill="#3b82f6">
                                <animate id="svgSpinners3DotsScale0" attributeName="r"
                                    begin="0;svgSpinners3DotsScale1.end-0.25s" dur="0.75s" values="3;.2;3" />
                            </circle>
                            <circle cx="12" cy="12" r="3" fill="#3b82f6">
                                <animate attributeName="r" begin="svgSpinners3DotsScale0.end-0.6s" dur="0.75s"
                                    values="3;.2;3" />
                            </circle>
                            <circle cx="20" cy="12" r="3" fill="#3b82f6">
                                <animate id="svgSpinners3DotsScale1" attributeName="r"
                                    begin="svgSpinners3DotsScale0.end-0.45s" dur="0.75s" values="3;.2;3" />
                            </circle>
                        </svg>

                        Loading...
                    </div>

                    {{-- <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase px-2 mb-2">Search ... </div>
                     --}}
                    {{-- <div class="flex gap-4 items-center my-4">
                        <!-- Category button -->
                        <template x-for="(value, index) in modelSearchTypes" :key="index">
                            <div x-cloak x-show="value.enabled">
                                <div @click="toggleModelType(value.type)">
                                    
                                    <button x-text="value.name" class="bg-indigo-200 text-indigo-600 px-2 py-0.5 rounded">
                                         <i class="fa-solid fa-xmark mx-2"></i>
                                    </button>

                                </div>
                            </div>
                        </template>
                        
                        
                        <button x-show="categorySelected == 'categories' " @click="toggleCategory('categories')"
                            :class="{ 'bg-indigo-200 text-indigo-600': categorySelected === 'categories', 'bg-indigo-100 text-indigo-500': categorySelected !== 'categories' }"
                            class="px-2 py-0.5 rounded">
                            Categories <i class="fa-solid fa-xmark mx-2"></i>
                        </button>
                    
                        <!-- Tag button -->
                        <button x-show="categorySelected == 'tags' " @click="toggleCategory('tags')"
                            :class="{ 'bg-emerald-200 text-emerald-600': categorySelected === 'tags', 'bg-emerald-100 text-emerald-500': categorySelected !== 'tags' }"
                            class="px-2 py-0.5 rounded">
                            Tags <i class="fa-solid fa-xmark mx-2"></i>
                        </button>
                    </div> --}}

                    <div x-show="searchTerm == ''">

                        <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase px-2 mb-2">Recent
                            searches</div>

                        <ul class="text-sm">
                            <template x-for="(recentResult, index) in recentSearches[1]" :key="index">
                                <li @click="redirectKeywords(recentResult,'{{ url('/') }}')">
                                    <a class="flex items-center p-2 text-slate-800 dark:text-slate-100 hover:text-white hover:bg-indigo-500 rounded group"
                                        href="#0" @click="searchOpen = false" @focus="searchOpen = true"
                                        @focusout="searchOpen = false">
                                        <i
                                            class="fas fa-history fa-lg w-4 block  fill-current text-slate-400 dark:text-slate-500 group-hover:text-white group-hover:text-opacity-50 shrink-0 mr-3"></i>
                                        <span x-text="recentResult" class="block"></span>
                                    </a>
                                </li>
                            </template>
                        </ul>


                        <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase px-2 mb-2">
                            Popular searches</div>

                        <ul class="text-sm">
                            <template x-for="(popularResult, index) in recentSearches[0]" :key="index">
                                <li class="cursor-pointer"  @click="redirectPostRequest(popularResult.term,popularResult.searchable_id,popularResult.slug,popularResult.type,popularResult.url)">
                                    <a class="flex items-center p-2 text-slate-800 dark:text-slate-100 hover:text-white hover:bg-indigo-500 rounded group"
                                        href="#0" @click="searchOpen = false" @focus="searchOpen = true"
                                        @focusout="searchOpen = false">
                                        <svg class="w-4 h-4 fill-current text-slate-400 dark:text-slate-500 group-hover:text-white group-hover:text-opacity-50 shrink-0 mr-3"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M15.707 14.293v.001a1 1 0 01-1.414 1.414L11.185 12.6A6.935 6.935 0 017 14a7.016 7.016 0 01-5.173-2.308l-1.537 1.3L0 8l4.873 1.12-1.521 1.285a4.971 4.971 0 008.59-2.835l1.979.454a6.971 6.971 0 01-1.321 3.157l3.107 3.112zM14 6L9.127 4.88l1.521-1.28a4.971 4.971 0 00-8.59 2.83L.084 5.976a6.977 6.977 0 0112.089-3.668l1.537-1.3L14 6z" />
                                        </svg>
                                        
                                
                                        <span >
                                            <span class="px-1 py-0.5 text-sm bg-slate-200 rounded mr-4 text-slate-900"
                                                x-text="popularResult.type"></span>
                                            <span x-text="popularResult.term"></span>
                                        </span>
                                   
                                    </a>
                                </li>
                            </template>
                        </ul>

                    </div>

                    {{-- <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase px-2 mb-2">Recent searches</div>
                            
                    <ul class="text-sm">
                        <template x-for="(recentResult, index) in recentSearches[1]" :key="index">
                            <li>
                                <a class="flex items-center p-2 text-slate-800 dark:text-slate-100 hover:text-white hover:bg-indigo-500 rounded group" href="#0" @click="searchOpen = false" @focus="searchOpen = true" @focusout="searchOpen = false">
                                    <svg class="w-4 h-4 fill-current text-slate-400 dark:text-slate-500 group-hover:text-white group-hover:text-opacity-50 shrink-0 mr-3" viewBox="0 0 16 16">
                                        <path d="M15.707 14.293v.001a1 1 0 01-1.414 1.414L11.185 12.6A6.935 6.935 0 017 14a7.016 7.016 0 01-5.173-2.308l-1.537 1.3L0 8l4.873 1.12-1.521 1.285a4.971 4.971 0 008.59-2.835l1.979.454a6.971 6.971 0 01-1.321 3.157l3.107 3.112zM14 6L9.127 4.88l1.521-1.28a4.971 4.971 0 00-8.59 2.83L.084 5.976a6.977 6.977 0 0112.089-3.668l1.537-1.3L14 6z" />
                                    </svg>
                                    <span x-text="recentResult"></span>
                                </a>
                            </li>
                        </template>
                    </ul>

                        
                    <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase px-2 mb-2">Popular searches</div>
                    
                    <ul class="text-sm">
                        <template x-for="(popularResult, index) in recentSearches[0]" :key="index">
                            <li>
                                <a class="flex items-center p-2 text-slate-800 dark:text-slate-100 hover:text-white hover:bg-indigo-500 rounded group" href="#0" @click="searchOpen = false" @focus="searchOpen = true" @focusout="searchOpen = false">
                                    <svg class="w-4 h-4 fill-current text-slate-400 dark:text-slate-500 group-hover:text-white group-hover:text-opacity-50 shrink-0 mr-3" viewBox="0 0 16 16">
                                        <path d="M15.707 14.293v.001a1 1 0 01-1.414 1.414L11.185 12.6A6.935 6.935 0 017 14a7.016 7.016 0 01-5.173-2.308l-1.537 1.3L0 8l4.873 1.12-1.521 1.285a4.971 4.971 0 008.59-2.835l1.979.454a6.971 6.971 0 01-1.321 3.157l3.107 3.112zM14 6L9.127 4.88l1.521-1.28a4.971 4.971 0 00-8.59 2.83L.084 5.976a6.977 6.977 0 0112.089-3.668l1.537-1.3L14 6z" />
                                    </svg>
                                    <span class="px-1 py-0.5 text-sm bg-slate-200 rounded mr-4" x-text="popularResult.type"></span>
                                    <span x-text="popularResult.term"></span>
                                </a>
                            </li>
                        </template>
                    </ul> --}}


                    <div x-show="searchTerm !=='' && searchResults.length == 0 && isLoading == false">No Search Result
                        found for <span class="font-semibold" x-text="searchTerm"></span> </div>

                    <ul class="text-sm"
                        x-show="searchTerm !=='' && searchResults.length !== 0 &&  isLoading == false">


                        <template x-for="(result, index) in searchResults.slice(0, showMore)" :key="index">
                            <li class="cursor-pointer" @click="redirectPostRequest(result.title,result.id,result.slug,result.type,result.url)">
                                <a class="flex items-center p-2 text-slate-800 dark:text-slate-100 hover:text-white hover:bg-indigo-500 rounded group"
                                    {{-- :href="'/dev/show/'+result.type +'/'+result.id+'/'+result.slug" --}} @click="searchOpen = false" @focus="searchOpen = true"
                                    @focusout="searchOpen = false">
                                    <svg class="w-4 h-4 fill-current text-slate-400 dark:text-slate-500 group-hover:text-white group-hover:text-opacity-50 shrink-0 mr-3"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M15.707 14.293v.001a1 1 0 01-1.414 1.414L11.185 12.6A6.935 6.935 0 017 14a7.016 7.016 0 01-5.173-2.308l-1.537 1.3L0 8l4.873 1.12-1.521 1.285a4.971 4.971 0 008.59-2.835l1.979.454a6.971 6.971 0 01-1.321 3.157l3.107 3.112zM14 6L9.127 4.88l1.521-1.28a4.971 4.971 0 00-8.59 2.83L.084 5.976a6.977 6.977 0 0112.089-3.668l1.537-1.3L14 6z" />
                                    </svg>

                                    <span class="mx-2 px-1 py-0.5 rounded bg-indigo-100 text-indigo-500 "
                                        x-show="result.type == 'post'">
                                        Posts:
                                    </span>

                                    <span class="mx-2 px-1 py-0.5 rounded bg-emerald-100 text-emerald-500 "
                                        x-show="result.type == 'tag'">
                                        Tags:
                                    </span>

                                    <span class="mx-2 px-1 py-0.5 rounded bg-purple-100 text-purple-500 "
                                        x-show="result.type == 'category'">
                                        Categories:
                                    </span>

                                


                                    <span>
                                        <template x-if="result.type == 'post'">
                                            <a>
                                                <span x-html="highlightSearchTerm(result.title, searchTerm)"></span>
                                            </a>
                                        </template>

                                        <template x-if="result.type == 'tag'">
                                            <a>
                                                <span x-html="highlightSearchTerm(result.title, searchTerm)"></span>
                                            </a>
                                        </template>

                                        <template x-if="result.type == 'category'">
                                            <a>
                                                <span x-html="highlightSearchTerm(result.title, searchTerm)"></span>
                                            </a>
                                        </template>
                                    </span>
                                </a>
                            </li>


                        </template>

                        <button x-show="showMore < searchResults.length" @click="loadMore">Show More</button>

                    </ul>
                </div>
                {{-- <!-- Recent pages -->
                <div class="mb-3 last:mb-0">
                    <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase px-2 mb-2">Recent pages</div>
                    <ul class="text-sm">
                        <li>
                            <a class="flex items-center p-2 text-slate-800 dark:text-slate-100 hover:text-white hover:bg-indigo-500 rounded group" href="#0" @click="searchOpen = false" @focus="searchOpen = true" @focusout="searchOpen = false">
                                <svg class="w-4 h-4 fill-current text-slate-400 dark:text-slate-500 group-hover:text-white group-hover:text-opacity-50 shrink-0 mr-3" viewBox="0 0 16 16">
                                    <path d="M14 0H2c-.6 0-1 .4-1 1v14c0 .6.4 1 1 1h8l5-5V1c0-.6-.4-1-1-1zM3 2h10v8H9v4H3V2z" />
                                </svg>
                                <span><span class="font-medium">Messages</span> - <span class="text-slate-600 dark:text-slate-400 group-hover:text-white">Conversation / … / Mike Mills</span></span>
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center p-2 text-slate-800 dark:text-slate-100 hover:text-white hover:bg-indigo-500 rounded group" href="#0" @click="searchOpen = false" @focus="searchOpen = true" @focusout="searchOpen = false">
                                <svg class="w-4 h-4 fill-current text-slate-400 dark:text-slate-500 group-hover:text-white group-hover:text-opacity-50 shrink-0 mr-3" viewBox="0 0 16 16">
                                    <path d="M14 0H2c-.6 0-1 .4-1 1v14c0 .6.4 1 1 1h8l5-5V1c0-.6-.4-1-1-1zM3 2h10v8H9v4H3V2z" />
                                </svg>
                                <span><span class="font-medium">Messages</span> - <span class="text-slate-600 dark:text-slate-400 group-hover:text-white">Conversation / … / Eva Patrick</span></span>
                            </a>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<!-- ...existing code... -->

<!-- Script -->
<script>
    function debounce(callback, delay) {
        let timerId;
        return function() {
            clearTimeout(timerId);
            timerId = setTimeout(() => {
                callback.apply(this, arguments);
            }, delay);
        };
    }

    function fetchResults() {
        this.isLoading = true

        axios.get('/user/capture/search/record', {
                params: {
                    term: this.searchTerm,
                    loadMore: this.showMore,
                }
            })
            .then(response => {

                this.searchResults = Object.values(response.data)
                this.isLoading = false

                // this.recentSearches = []
                // console.log(Object.values(response.data))

            })
            .catch(error => {
                console.error(error);
                this.isLoading = false;
            });
    }

    // function fetchDefaultResults() {

    //     axios.get('/search', {
    //             params: {
    //                 term: this.searchTerm,
    //                 loadMore: this.showMore,
    //             }
    //         })
    //         .then(response => {
    //             this.recentSearches = Object.values(response.data)
    //             console.log(this.recentSearches)
    //             console.log(response.data)

    //         })
    //         .catch(error => {
    //             console.error(error);
    //         });
    // }

    // fetchDefaultResults();

    function highlightSearchTerm(title, searchTerm) {
        if (!searchTerm) {
            return title;
        }

        const regex = new RegExp(searchTerm, 'gi');
        return title.replace(regex, '<mark>$&</mark>');
    }

    function loadMore() {
        // Increase the number of visible search results
        // Increase by 5 or your desired increment
        axios.get('/user/capture/search/record', {
                params: {
                    term: this.searchTerm,
                    loadMore: this.showMore += 5,
                }
            })
            .then(response => {
                this.searchResults = Object.values(response.data)
                this.showMore += 5;

            })
            .catch(error => {
                console.error(error);
            });
    }
    // const debounceFetchResults = debounce(fetchResults, 300);

    // document.addEventListener('DOMContentLoaded', function () {
    //     const searchInput = document.getElementById('modal-search');

    //     searchInput.addEventListener('input', () => {
    //         debounceFetchResults();
    //     });
    // });
    //https://www.figma.com/community/file/1076369527615363701/Enefty---NFT-Marketplace-UI-Template-Designed-With-Figma
</script>
