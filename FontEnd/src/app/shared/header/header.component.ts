import { Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import { MenuComponent } from '../menu/menu.component';
@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
})
export class HeaderComponent implements OnInit {

  // constructor(private router: Router) { }
  flag = 1;
  remmoveClass() {
    if (window.location.pathname == '/experience' || window.location.pathname == '/map') {
      return this.flag = 1;
    } else {
      return this.flag = 0;
    }
  }

  // 

  ngOnInit(): void {
    // console.log(this.router.url);
    console.log(this.remmoveClass());
    this.remmoveClass();
  }

}
