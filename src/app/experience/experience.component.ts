import { ApiService } from './../api.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-experience',
  templateUrl: './experience.component.html',
  styleUrls: ['./experience.component.css']
})
export class ExperienceComponent implements OnInit {
  articles: any;

  constructor(private apiService: ApiService) { }
  ngOnInit() {
    this.apiService.getNews().subscribe((data) => {
      console.log(data);
      this.articles = data;
    })
  }
}
