class Paginator {
    constructor(options) {
        this.container = document.querySelector(options.containerSelector);
        this.itemSelector = options.itemSelector;
        this.itemsPerPage = options.itemsPerPage || 6;
        this.prevBtnSelector = options.prevBtnSelector || '#prev-page';
        this.nextBtnSelector = options.nextBtnSelector || '#next-page';
        this.currentPageSelector = options.currentPageSelector || '#current-page';
        this.paginationContainerSelector = options.paginationContainerSelector || '#js-pagination';
        this.disableScroll = options.disableScroll || false;
        
        this.currentPage = 1;
        this.items = [];
        this.totalPages = 0;
        
        this.init();
    }
    
    init() {
        this.items = Array.from(this.container.querySelectorAll(this.itemSelector));
        this.totalPages = Math.ceil(this.items.length / this.itemsPerPage);
        
        if (this.items.length === 0) return;
        
        this.prevBtn = document.querySelector(this.prevBtnSelector);
        this.nextBtn = document.querySelector(this.nextBtnSelector);
        this.currentPageElement = document.querySelector(this.currentPageSelector);
        this.paginationContainer = document.querySelector(this.paginationContainerSelector);
        
        if (this.totalPages <= 1 && this.paginationContainer) {
            this.paginationContainer.style.display = 'none';
        }
        
        this.setupEventListeners();
        this.showPage(this.currentPage);
        this.updatePagination();
    }
    
    setupEventListeners() {
        if (this.prevBtn) {
            this.prevBtn.addEventListener('click', () => this.prevPage());
        }
        
        if (this.nextBtn) {
            this.nextBtn.addEventListener('click', () => this.nextPage());
        }
    }
    
    showPage(page) {
        const startIndex = (page - 1) * this.itemsPerPage;
        const endIndex = startIndex + this.itemsPerPage;
        
        this.items.forEach((item, index) => {
            if (index >= startIndex && index < endIndex) {
                item.style.display = 'block';
                item.style.animation = 'fadeIn 0.5s ease-out';
            } else {
                item.style.display = 'none';
            }
        });
    }
    
    updatePagination() {
        if (!this.currentPageElement) return;
        
        this.currentPageElement.textContent = this.currentPage;
        
        if (this.prevBtn) {
            this.prevBtn.disabled = this.currentPage === 1;
            if (this.currentPage === 1) {
                this.prevBtn.classList.add('opacity-50', 'cursor-not-allowed');
                this.prevBtn.classList.remove('hover:bg-orange-50');
            } else {
                this.prevBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                this.prevBtn.classList.add('hover:bg-orange-50');
            }
        }
        
        if (this.nextBtn) {
            this.nextBtn.disabled = this.currentPage === this.totalPages;
            if (this.currentPage === this.totalPages) {
                this.nextBtn.classList.add('opacity-50', 'cursor-not-allowed');
                this.nextBtn.classList.remove('hover:bg-orange-50');
            } else {
                this.nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                this.nextBtn.classList.add('hover:bg-orange-50');
            }
        }
    }
    
    prevPage() {
        if (this.currentPage > 1) {
            this.currentPage--;
            this.showPage(this.currentPage);
            this.updatePagination();
            if (!this.disableScroll) {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    }
    
    nextPage() {
        if (this.currentPage < this.totalPages) {
            this.currentPage++;
            this.showPage(this.currentPage);
            this.updatePagination();
            if (!this.disableScroll) {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // For travels page
    if (document.querySelector('#travels-container')) {
        new Paginator({
            containerSelector: '#travels-container',
            itemSelector: '.travel-item'
        });
    }
    
    // For news page
    if (document.querySelector('#news-container')) {
        new Paginator({
            containerSelector: '#news-container',
            itemSelector: '.news-item'
        });
    }

    // For services page
    if (document.querySelector('#services-container')) {
        new Paginator({
            containerSelector: '#services-container',
            itemSelector: '.services-item'
        });
    }

    // For reviews/comments page
    if (document.querySelector('#reviews-container')) {
        new Paginator({
            containerSelector: '#reviews-container',
            itemSelector: '.review-item',
            itemsPerPage: 5,
            prevBtnSelector: '#prev-page',
            nextBtnSelector: '#next-page',
            currentPageSelector: '#current-page',
            paginationContainerSelector: '#js-pagination',
            disableScroll: true
        });
    }
    
    // For any other page
    if (document.querySelector('.pagination-container')) {
        new Paginator({
            containerSelector: '.pagination-container',
            itemSelector: '.pagination-item',
            prevBtnSelector: '.prev-page',
            nextBtnSelector: '.next-page',
            currentPageSelector: '.current-page',
            paginationContainerSelector: '.pagination-controls'
        });
    }
});