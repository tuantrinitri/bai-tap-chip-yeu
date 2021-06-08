import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-slider',
  templateUrl: './slider.component.html'
})
export class SliderComponent implements OnInit {
  imageList = [
    {
      id: 1,
      caption: "Welcome to",
      content: "Đà Lạt",
      description: "Nơi khởi nguồn của tình yêu ❤️",
      path: "/assets/img/mi.jpg"
    },
    {
      id: 2,
      caption: "Welcome to",
      content: "Đà Lạt",
      description: "Không cần nhiều lý do để bắt đầu 1 chuyến đi mới. Mọi thứ đề sẵn sàng chỉ vì một câu nói:<br>“I Love Da Lat”</br>",
      path: "/assets/img/hh.jpg"
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
