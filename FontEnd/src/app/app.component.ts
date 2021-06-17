import { Component, Inject } from '@angular/core';
import { PageScrollService } from 'ngx-page-scroll-core';
import { DOCUMENT } from '@angular/common';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],

})
export class AppComponent {
  title = 'BAI-TAP-CUA-CHIP-YEU';
  loginStatus = true;

  changeLoginStatus(_event: any) {
    console.log("change login status: ");
  }
  activeSection = 1;

  constructor(
    private pageScrollService: PageScrollService,
    @Inject(DOCUMENT) private document: any
  ) { }

  fullPageScroll(e: HTMLElement, i: any) {
    this.pageScrollService.scroll({
      scrollTarget: e,
      document: this.document
    });

    this.activeSection = i;
  }

  ngOnInit() {
    window.addEventListener('scroll', function () {
      navbarScroll();
    });
    function navbarScroll() {
      /**
       * Easy selector helper function
       */
      const select = (el: any, all = false) => {
        el = el.trim();
        if (all) {
          return [document.querySelectorAll(el)];
        } else {
          return document.querySelector(el);
        }
      };

      /**
       * Easy event listener function
       */
      const on = (type: any, el: any, listener: any, all = false) => {
        let selectEl = select(el, all);
        if (selectEl) {
          if (all) {
            selectEl.forEach((e: any) => e.addEventListener(type, listener));
          } else {
            selectEl.addEventListener(type, listener);
          }
        }
      };

      /**
       * Easy on scroll event listener
       */
      const onscroll = (el: any, listener: any) => {
        el.addEventListener("scroll", listener);
      };

      /**
       * Navbar links active state on scroll
       */
      let navbarlinks = select("#navbar .scrollto", true);
      const navbarlinksActive = () => {
        let position = window.scrollY + 200;
        navbarlinks.forEach((navbarlink: any) => {
          if (!navbarlink.hash) return;
          let section = select(navbarlink.hash);
          if (!section) return;
          if (
            position >= section.offsetTop &&
            position <= section.offsetTop + section.offsetHeight
          ) {
            navbarlink.classList.add("active");
          } else {
            navbarlink.classList.remove("active");
          }
        });
      };
      window.addEventListener("load", navbarlinksActive);
      onscroll(document, navbarlinksActive);

      /**
       * Scrolls to an element with header offset
       */
      const scrollto = (el: any) => {
        let header = select("#header");
        let offset = header.offsetHeight;

        let elementPos = select(el).offsetTop;
        window.scrollTo({
          top: elementPos - offset,
          behavior: "smooth",
        });
      };

      /**
       * Toggle .header-scrolled class to #header when page is scrolled
       */
      let selectHeader = select("#header");
      let selectTopbar = select("#topbar");
      if (selectHeader) {
        const headerScrolled = () => {
          if (window.scrollY > 100) {
            selectHeader.classList.add("header-scrolled");
            if (selectTopbar) {
              selectTopbar.classList.add("topbar-scrolled");
            }
          } else {
            selectHeader.classList.remove("header-scrolled");
            if (selectTopbar) {
              selectTopbar.classList.remove("topbar-scrolled");
            }
          }
        };
        window.addEventListener("load", headerScrolled);
        onscroll(document, headerScrolled);
      }

      /**
       * Back to top button
       */
      let backtotop = select(".back-to-top");
      if (backtotop) {
        const toggleBacktotop = () => {
          if (window.scrollY > 100) {
            backtotop.classList.add("active");
          } else {
            backtotop.classList.remove("active");
          }
        };
        window.addEventListener("load", toggleBacktotop);
        onscroll(document, toggleBacktotop);
      }
    }
  }
}