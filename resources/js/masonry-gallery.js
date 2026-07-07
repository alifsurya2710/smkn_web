import { gsap } from 'gsap';

class MasonryGallery {
    constructor(container, options = {}) {
        this.container = typeof container === 'string' ? document.querySelector(container) : container;
        if (!this.container) return;

        this.items = options.items || [];
        this.ease = options.ease || 'power3.out';
        this.duration = options.duration || 0.6;
        this.stagger = options.stagger || 0.05;
        this.animateFrom = options.animateFrom || 'bottom';
        this.scaleOnHover = options.scaleOnHover !== undefined ? options.scaleOnHover : true;
        this.hoverScale = options.hoverScale || 0.95;
        this.blurToFocus = options.blurToFocus !== undefined ? options.blurToFocus : true;
        this.colorShiftOnHover = options.colorShiftOnHover || false;
        this.gap = options.gap || 24;

        this.hasMounted = false;
        this.resizeObserver = null;
        this.columns = 1;
        this.width = 0;

        this.init();
    }

    init() {
        this.setupContainer();
        this.preloadImages().then(() => {
            this.handleResize();
            this.observeResize();
        });
    }

    setupContainer() {
        this.container.style.position = 'relative';
        this.container.innerHTML = '';
        
        this.gridItems = this.items.map(item => {
            const el = document.createElement('div');
            el.setAttribute('data-key', item.id);
            el.className = 'absolute box-content cursor-pointer group';
            el.style.willChange = 'transform, width, height, opacity';
            
            const inner = document.createElement('div');
            inner.className = 'relative w-full h-full bg-cover bg-center rounded-[2.5rem] shadow-[0px_10px_50px_-10px_rgba(0,0,0,0.1)] overflow-hidden';
            inner.style.backgroundImage = `url(${item.img})`;
            
            // Content overlay (like in the original blade)
            const content = document.createElement('div');
            content.className = 'absolute inset-x-0 bottom-0 p-8 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500';
            
            if (item.category) {
                const cat = document.createElement('p');
                cat.className = 'text-[8px] font-black text-blue-400 uppercase tracking-widest mb-2';
                cat.innerText = item.category;
                content.appendChild(cat);
            }
            
            if (item.title) {
                const title = document.createElement('h4');
                title.className = 'text-xs font-bold text-white tracking-tight uppercase';
                title.innerText = item.title;
                content.appendChild(title);
            }

            if (this.colorShiftOnHover) {
                const overlay = document.createElement('div');
                overlay.className = 'color-overlay absolute inset-0 bg-gradient-to-tr from-blue-500/30 to-indigo-500/30 opacity-0 pointer-events-none transition-opacity duration-300';
                inner.appendChild(overlay);
            }

            // Hover effects
            el.addEventListener('mouseenter', () => this.handleMouseEnter(item.id, el));
            el.addEventListener('mouseleave', () => this.handleMouseLeave(item.id, el));
            el.addEventListener('click', () => {
                if (item.url) window.location.href = item.url;
            });

            inner.appendChild(content);
            el.appendChild(inner);
            this.container.appendChild(el);
            
            return { ...item, el };
        });
    }

    async preloadImages() {
        const promises = this.gridItems.map(item => {
            return new Promise(resolve => {
                const img = new Image();
                img.src = item.img;
                img.onload = img.onerror = () => {
                    // Store natural aspect ratio if height not provided
                    if (!item.height && img.naturalHeight) {
                        item.aspectRatio = img.naturalHeight / img.naturalWidth;
                    }
                    resolve();
                };
            });
        });
        await Promise.all(promises);
    }

    getColumns(width) {
        if (width >= 1200) return 4;
        if (width >= 900) return 3;
        if (width >= 600) return 2;
        return 1;
    }

    handleResize() {
        this.width = this.container.offsetWidth;
        this.columns = this.getColumns(this.width);
        this.layout();
    }

    observeResize() {
        this.resizeObserver = new ResizeObserver(() => this.handleResize());
        this.resizeObserver.observe(this.container);
    }

    layout() {
        if (!this.width) return;
        
        const colHeights = new Array(this.columns).fill(0);
        const totalGaps = (this.columns - 1) * this.gap;
        const columnWidth = (this.width - totalGaps) / this.columns;

        this.gridItems.forEach((item, index) => {
            const col = colHeights.indexOf(Math.min(...colHeights));
            const x = col * (columnWidth + this.gap);
            
            // Calculate height based on aspect ratio or fixed value
            let h;
            if (item.aspectRatio) {
                h = columnWidth * item.aspectRatio;
            } else {
                h = (item.height || 600) / 2;
            }
            
            const y = colHeights[col];
            colHeights[col] += h + this.gap;

            const animProps = { 
                x, y, 
                width: columnWidth, 
                height: h,
                ease: this.ease,
                duration: this.duration
            };

            if (!this.hasMounted) {
                const start = this.getInitialPosition({ x, y, w: columnWidth, h });
                gsap.fromTo(item.el, 
                    { 
                        opacity: 0, 
                        x: start.x, 
                        y: start.y, 
                        width: columnWidth, 
                        height: h,
                        filter: this.blurToFocus ? 'blur(20px)' : 'none'
                    },
                    {
                        opacity: 1,
                        x, y,
                        width: columnWidth,
                        height: h,
                        filter: 'blur(0px)',
                        duration: 1.2,
                        ease: 'expo.out',
                        delay: index * this.stagger,
                        clearProps: 'filter'
                    }
                );
            } else {
                gsap.to(item.el, {
                    ...animProps,
                    overwrite: 'auto'
                });
            }
        });

        gsap.to(this.container, {
            height: Math.max(...colHeights),
            duration: this.duration,
            ease: this.ease
        });
        
        this.hasMounted = true;
    }

    getInitialPosition(item) {
        let direction = this.animateFrom;
        if (direction === 'random') {
            const dirs = ['top', 'bottom', 'left', 'right'];
            direction = dirs[Math.floor(Math.random() * dirs.length)];
        }

        switch (direction) {
            case 'top': return { x: item.x, y: -400 };
            case 'bottom': return { x: item.x, y: window.innerHeight + 400 };
            case 'left': return { x: -400, y: item.y };
            case 'right': return { x: window.innerWidth + 400, y: item.y };
            case 'center': return { 
                x: this.width / 2 - item.w / 2, 
                y: 200 
            };
            default: return { x: item.x, y: item.y + 200 };
        }
    }

    handleMouseEnter(id, el) {
        if (this.scaleOnHover) {
            gsap.to(el, { scale: this.hoverScale, duration: 0.5, ease: 'power4.out' });
        }
        if (this.colorShiftOnHover) {
            const overlay = el.querySelector('.color-overlay');
            if (overlay) gsap.to(overlay, { opacity: 1, duration: 0.5 });
        }
    }

    handleMouseLeave(id, el) {
        if (this.scaleOnHover) {
            gsap.to(el, { scale: 1, duration: 0.5, ease: 'power4.out' });
        }
        if (this.colorShiftOnHover) {
            const overlay = el.querySelector('.color-overlay');
            if (overlay) gsap.to(overlay, { opacity: 0, duration: 0.5 });
        }
    }

    destroy() {
        if (this.resizeObserver) this.resizeObserver.disconnect();
    }
}

window.MasonryGallery = MasonryGallery;
export default MasonryGallery;
