import { PostService } from './../post.service';
import { ApiService } from './../api.service';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-experience',
  templateUrl: './experience.component.html'
})
export class ExperienceComponent implements OnInit {

  POSTS: any;
  page = 1;
  count = 0;
  tableSize = 7;
  tableSizes = [3, 6, 9, 12];

  articles: any;
  categories: any;
  random: any;
  URL = "http://nhatkyktts.xyz/";

  constructor(private apiService: ApiService, private router: Router) { }
  ngOnInit() {
    this.fetchPosts();
    this.URL;
    this.listCategory();
    this.listCatRandom();


  }

  posts: any;
  fetchPosts(): void {
    this.apiService.listPostsOfCategories('kinh-nghiem').subscribe((data: any) => {
      this.articles = data['posts'];
      // console.log(data);
    });
  }


  listCategory(): void {
    this.apiService.listCategory().subscribe((data: any) => {
      this.categories = data['categories'];

    });
  }


  listCatRandom(): void {
    this.apiService.listCategoryRandom('kinh-nghiem').subscribe((data) => {
      this.random = data;
    });
  }

  onTableDataChange(event: any) {
    this.page = event;
    this.fetchPosts();
  }

  onTableSizeChange(event: any): void {
    this.tableSize = event.target.value;
    this.page = 1;
    this.fetchPosts();
  }
}
