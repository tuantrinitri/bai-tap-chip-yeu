import { PostService } from './../post.service';
import { ApiService } from './../api.service';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-experience',
  templateUrl: './experience.component.html',
  styleUrls: ['./experience.component.css']
})
export class ExperienceComponent implements OnInit {

  POSTS: any;
  page = 1;
  count = 0;
  tableSize = 7;
  tableSizes = [3, 6, 9, 12];

  articles: any;


  constructor(private apiService: ApiService, private postService: PostService, private router: Router) { }
  ngOnInit() {
    this.fetchPosts();
    // console.log(this.router.url);  

  }
  fetchPosts(): void {
    this.apiService.getCategories().subscribe((data) => {
      console.log(data);
      this.articles = data;
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
