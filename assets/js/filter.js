import { Flipper, spring } from "flip-toolkit";
import { debounce } from "lodash";
import visibilityArticle from "./visibilityArticle";

/**
 * Class filter for the posts page in ajax
 * 
 * @property {HTMLElement} pagination - the element with the button(s) for pagination
 * @property {HTMLElement} content - the element with the main content
 * @property {HTMLElement} sorting - the element with the button(s) for sorting the content
 * @property {HTMLFormElement} form - the element with the form for search
 * @property {HTMLElement} count - the element with the number total of posts
 * @property {number} page - the number of the actual page
 * @property {bool} moreNav - boolean to verify if the show more button is display
 */
export default class Filter {
    /**
     * Constructor of the class
     * 
     * @param {HTMLElement|null} element 
     */
    constructor(element) {
        if (element == null) {
            return;
        }

        this.pagination = element.querySelector('.js-filter-pagination');
        this.content = element.querySelector('.js-filter-content');
        this.sorting = element.querySelector('.js-filter-sorting');
        this.form = element.querySelector('.js-filter-form');
        this.page = parseInt(new URLSearchParams(window.location.search).get('page') || 1);
        this.moreNav = this.page == 1;
        this.count = element.querySelector('.js-filter-count');
        this.bindEvents();
    }

    /**
     * Add the action to the elements
     */
    bindEvents() {
        const linkClikListener = (e) => {
            if (e.target.tagName === 'A' || e.target.tagName === 'I') {
                e.preventDefault();
                let url = '';

                if (e.target.tagName === 'I') {
                    url = e.target.parentNode.parentNode.getAttribute('href');
                } else {
                    url = e.target.getAttribute('href');
                }

                this.loadUrl(url);
            }
        }
        this.sorting.addEventListener('click', e => {
            linkClikListener(e);
            this.page = 1;
        });
        if (this.moreNav) {
            this.pagination.innerHTML = `<button class="btn btn-primary btn-show-more mt-2">${this.content.dataset.jsLocale == 'fr' ? 'Voir plus' : 'Show More'}</button>`;
            this.pagination.querySelector('button').addEventListener('click', this.loadMore.bind(this));
        } else {
            this.pagination.addEventListener('click', linkClikListener);
        }

        this.form.querySelectorAll('input[type="checkbox"]').forEach(input => {
            input.addEventListener('change', debounce(this.loadForm.bind(this), 300));
        });
        this.form.querySelector('input[type="text"]')
            .addEventListener('keyup', debounce(this.loadForm.bind(this), 500));
    };

    /**
     * Load more content on the page
     */
    async loadMore() {
        const button = this.pagination.querySelector('button');
        button.setAttribute('disabled', 'disabled');
        this.page++;
        const url = new URL(window.location.href);
        const params = new URLSearchParams(url.search)
        params.set('page', this.page);
        await this.loadUrl(`${url.pathname}?${params.toString()}`, true);
        button.removeAttribute('disabled');
    }

    async loadForm() {
        this.page = 1;
        const data = new FormData(this.form);
        const url = new URL(this.form.getAttribute('action') || window.location.href);
        const params = new URLSearchParams()
        data.forEach((value, key) => {
            params.append(key, value);
        });

        return this.loadUrl(url.pathname + '?' + params.toString());
    }

    /**
     * Charge la requête ajax
     * 
     * @param {URL} url - Url to load in ajax
     * @param {bool} append - add content to existent
     */
    async loadUrl(url, append = false) {
        this.showLoader();
        this.content.classList.remove('content-response');
        const params = new URLSearchParams(url.split('?')[1] || '');
        params.set('ajax', 1);

        const response = await fetch(url.split('?')[0] + '?' + params.toString(), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (response.status >= 200 && response.status < 300) {
            const data = await response.json();
            this.flipContent(data.content, append);
            this.sorting.innerHTML = data.sorting;
            this.count.innerHTML = data.count;
            this.content.classList.add('content-response');
            if (!this.moreNav) {
                this.pagination.innerHTML = data.pagination;
            } else if (this.page === data.pages) {
                this.pagination.style.display = 'none';
            } else {
                this.pagination.style.display = null;
            }
            params.delete('ajax');
            history.replaceState({}, '', url.split('?')[0] + '?' + params.toString());
            this.hideLoader();
        } else {
            console.error(response);
        }
    }

    /**
     * Remplace les éléments de la grille avec animation flip
     * 
     * @param {string} content
     * @param {bool} append
     */
    flipContent(content, append) {
        const springName = 'veryGentle'
        const exitSpring = function (element, index, onComplete) {
            spring({
                config: 'stiff',
                values: {
                    translateY: [0, -20],
                    opacity: [1, 0]
                },
                onUpdate: ({ translateY, opacity }) => {
                    element.style.opacity = opacity;
                    element.style.transform = `translateY(${translateY}px)`;
                },
                onComplete
            })
        }
        const appearSpring = function (element, index) {
            spring({
                config: 'stiff',
                values: {
                    translateY: [0, 20],
                    opacity: [0, 1]
                },
                onUpdate: ({ translateY, opacity }) => {
                    element.style.opacity = opacity;
                    element.style.transform = `translateY(${translateY}px)`;
                },
                delay: index * 10
            })
        }

        const flipper = new Flipper({
            element: this.content,
        })
        var cards = this.content.children
        for (let element of cards) {
            flipper.addFlipped({
                element,
                spring: springName,
                flipId: element.id,
                shouldFlip: false,
                onExit: exitSpring
            })
        }
        flipper.recordBeforeUpdate();

        if (append) {
            this.content.innerHTML += content;
        } else {
            this.content.innerHTML = content;
        }

        var cards = this.content.children
        for (let element of cards) {
            flipper.addFlipped({
                element,
                spring: springName,
                flipId: element.id,
                onAppear: appearSpring
            })
        }
        flipper.update()
        visibilityArticle();
    }

    /**
     * Show the loader for the request
     * 
     */
    showLoader() {
        this.form.classList.add('is-loading')
        const loader = this.form.querySelector('.js-loading')

        if (loader === null) {
            return
        }

        loader.setAttribute('aria-hidden', 'false')
        loader.style.display = null
    }

    /**
     * Remove the loader for the request
     * 
     */
    hideLoader() {
        this.form.classList.remove('is-loading')
        const loader = this.form.querySelector('.js-loading')

        if (loader === null) {
            return
        }

        loader.setAttribute('aria-hidden', 'true')
        loader.style.display = 'none'
    }
}