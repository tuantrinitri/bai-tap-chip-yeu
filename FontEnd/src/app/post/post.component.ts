import { ApiService } from './../api.service';

import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';


@Component({
  selector: 'app-post',
  templateUrl: './post.component.html'
})
export class PostComponent implements OnInit {
  post: any;
  URL = "http://nhatkyktts.xyz/";
  page = 1;
  count = 0;
  tableSize = 7;
  tableSizes = [3, 6, 9, 12];

  articles: any;
  categories: any;
  random: any;
  constructor(
    private route: ActivatedRoute,
    private apiService: ApiService,
  ) { }
  ngOnInit(): void {
    this.fetchPosts();
    this.URL;
  }
  fetchPosts(): void {
    this.apiService.getPost(this.route.snapshot.paramMap.get("slugPost")).subscribe((data: any) => {
      this.post = data['post'];
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

