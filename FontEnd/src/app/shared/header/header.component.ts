import { ActivatedRoute, Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import { MenuComponent } from '../menu/menu.component';
@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
})
export class HeaderComponent implements OnInit {

  constructor(private route: ActivatedRoute) { }

  flag = 1;
  /**
  * @returns them class mau den cho menu
  */
  remmoveClass() {
    if (window.location.pathname == '/experience'
      || window.location.pathname == '/map'
      || window.location.pathname == '/contact'
      || window.location.pathname == '/food') {
      return this.flag = 1;
    } else {
      return this.flag = 0;
    }
  }

  // 

  ngOnInit(): void {
    // console.log(this.route.snapshot.param);
    this.remmoveClass();
  }

}
