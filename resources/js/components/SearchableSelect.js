class SearchableSelect {
    constructor(select) {
        this.select = select;
        this.wrapper = null;
        this.searchInput = null;
        this.optionsList = null;
        this.isOpen = false;
        this.init();
    }

    init() {
        this.select.style.display = 'none';
        this.createCustomSelect();
        this.bindEvents();
    }

    createCustomSelect() {
        this.wrapper = document.createElement('div');
        this.wrapper.className = 'custom-select-wrapper relative';
        this.wrapper.setAttribute('data-select-id', this.select.id || this.select.name);

        const selectedDisplay = document.createElement('div');
        selectedDisplay.className = 'custom-select-display w-full bg-transparent border-0 border-b border-outline-variant/30 py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg cursor-pointer flex items-center justify-between';
        
        const placeholder = this.select.querySelector('option[selected]')?.textContent || 
                           this.select.querySelector('option:first-child')?.textContent || 
                           'Select an option';
        selectedDisplay.innerHTML = `
            <span class="custom-select-text text-outline-variant">${placeholder}</span>
            <span class="material-symbols-outlined text-outline">expand_more</span>
        `;

        const dropdown = document.createElement('div');
        dropdown.className = 'custom-select-dropdown absolute top-full left-0 right-0 bg-surface border border-outline-variant/30 rounded-lg shadow-lg mt-1 z-50 hidden overflow-hidden';

        const searchContainer = document.createElement('div');
        searchContainer.className = 'p-2 border-b border-outline-variant/30';
        this.searchInput = document.createElement('input');
        this.searchInput.type = 'text';
        this.searchInput.placeholder = 'Search...';
        this.searchInput.className = 'w-full bg-surface-variant/30 border border-outline-variant/30 rounded px-3 py-2 text-lg focus:outline-none focus:border-secondary transition-all';
        searchContainer.appendChild(this.searchInput);

        this.optionsList = document.createElement('div');
        this.optionsList.className = 'custom-select-options max-h-60 overflow-y-auto';

        dropdown.appendChild(searchContainer);
        dropdown.appendChild(this.optionsList);

        this.wrapper.appendChild(selectedDisplay);
        this.wrapper.appendChild(dropdown);

        this.select.parentNode.insertBefore(this.wrapper, this.select.nextSibling);

        this.selectedDisplay = selectedDisplay;
        this.dropdown = dropdown;

        this.populateOptions();
    }

    populateOptions(filter = '') {
        this.optionsList.innerHTML = '';
        const options = this.select.querySelectorAll('option:not([disabled])');
        const filterLower = filter.toLowerCase();

        options.forEach(option => {
            if (option.value === '' && option.hasAttribute('disabled') && option.hasAttribute('selected')) return;
            
            const text = option.textContent.toLowerCase();
            if (filter && !text.includes(filterLower)) return;

            const optionEl = document.createElement('div');
            optionEl.className = 'custom-select-option px-4 py-3 cursor-pointer hover:bg-surface-variant/50 transition-colors text-lg';
            optionEl.textContent = option.textContent;
            optionEl.dataset.value = option.value;

            if (option.selected) {
                optionEl.classList.add('bg-secondary/20', 'text-secondary');
            }

            optionEl.addEventListener('click', () => this.selectOption(option));
            this.optionsList.appendChild(optionEl);
        });

        if (this.optionsList.children.length === 0) {
            const noResults = document.createElement('div');
            noResults.className = 'px-4 py-3 text-outline text-center';
            noResults.textContent = 'No results found';
            this.optionsList.appendChild(noResults);
        }
    }

    selectOption(option) {
        this.select.querySelectorAll('option').forEach(opt => opt.selected = false);
        option.selected = true;
        
        const event = new Event('change', { bubbles: true });
        this.select.dispatchEvent(event);

        this.selectedDisplay.querySelector('.custom-select-text').textContent = option.textContent;
        this.searchInput.value = '';
        this.populateOptions();
        this.close();
    }

    bindEvents() {
        this.selectedDisplay.addEventListener('click', (e) => {
            e.preventDefault();
            this.toggle();
        });

        this.searchInput.addEventListener('input', (e) => {
            e.stopPropagation();
            this.populateOptions(e.target.value);
        });

        this.searchInput.addEventListener('click', (e) => {
            e.stopPropagation();
        });

        this.searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.close();
            }
        });

        document.addEventListener('click', (e) => {
            if (!this.wrapper.contains(e.target)) {
                this.close();
            }
        });
    }

    toggle() {
        this.isOpen ? this.close() : this.open();
    }

    open() {
        this.isOpen = true;
        this.dropdown.classList.remove('hidden');
        this.selectedDisplay.classList.add('border-secondary');
        this.selectedDisplay.querySelector('.material-symbols-outlined').textContent = 'expand_less';
        this.searchInput.focus();
    }

    close() {
        this.isOpen = false;
        this.dropdown.classList.add('hidden');
        this.selectedDisplay.classList.remove('border-secondary');
        this.selectedDisplay.querySelector('.material-symbols-outlined').textContent = 'expand_more';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.searchable-select').forEach(select => {
        new SearchableSelect(select);
    });
});
