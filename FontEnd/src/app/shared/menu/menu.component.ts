import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html'
})
export class MenuComponent implements OnInit {
  /**
   * danh sach menu duoc hien thi ngoai view  */
  menuList = [
    {
      id: 1,
      name: "Trang chủ",
      path: ""
    },
    {
      id: 2,
      name: "Điểm đến",
      path: "location"
    },
    {
      id: 3,
      name: "Ẩm thực",
      icon: "icon-angle",
      path: "food"
    },
    {
      id: 4,
      name: "Kinh nghiệm",
      path: "experience"
    },
    {
      id: 5,
      name: "Travel Map",
      path: "map",

    },
    {
      id: 6,
      name: "Liên hệ",
      path: "contact"
    }
  ];
  activePath = ""
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
  constructor() { }
  ngOnInit(): void {
    this.remmoveClass()

  }
  // Set active menu
  setActiveMenu(path: string) {
    this.activePath = path;

  }

}
