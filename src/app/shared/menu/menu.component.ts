import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html'
})
export class MenuComponent implements OnInit {
  menuList = [
    {
      id: 1,
      name: "Trang chủ",
      path: "home"
    },
    {
      id: 2,
      name: "Điểm đến",
      path: "location"
    },
    {
      id: 3,
      name: "Ẩm thựcs",
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
      path: "travel-map",

    },
    {
      id: 6,
      name: "Liên hệ",
      path: "contact"
    }
  ];
  activePath = ""

  constructor() { }
  ngOnInit(): void {
  }
  // Set active menu
  setActiveMenu(path: string) {

    this.activePath = path;
  }

}
