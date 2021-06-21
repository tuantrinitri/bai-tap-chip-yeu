import { Router } from '@angular/router';
import { ApiService } from './../api.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-food',
  templateUrl: './food.component.html'
})
export class FoodComponent implements OnInit {
  /**
   * Khai bao bien
   */
  POSTS: any;
  page = 1;
  count = 0;
  tableSize = 7;
  tableSizes = [3, 6, 9, 12];

  articles: any;
  categories: any;
  random: any;
  URL = "http://nhatkyktts.xyz/";
  /**
   * Khoi tao contructor co ban
   */
  constructor(private apiService: ApiService, private router: Router) { }
  ngOnInit() {
    this.fetchPosts();
    this.URL;
    this.listCategory();
    this.listCatRandom();
  }

  posts: any;
  /**
   * Ham lay tat ca cac bai viet thuoc danh muc am thuc
   */
  fetchPosts(): void {
    this.apiService.listPostsOfCategories('am-thuc').subscribe((data: any) => {
      this.articles = data['posts'];
      // console.log(data);
    });
  }

  /**
   * lay ra tat ca danh sach danh muc
   */
  listCategory(): void {
    this.apiService.listCategory().subscribe((data: any) => {
      this.categories = data['categories'];

    });
  }

  /**
   * Lay nhung bai viet cung danh muc am thuc
   */
  listCatRandom(): void {
    this.apiService.listCategoryRandom('am-thuc').subscribe((data) => {
      this.random = data;
    });
  }
  /**
   * 
   * @param event Ham phan trang
   */
  onTableDataChange(event: any) {
    this.page = event;
    this.fetchPosts();
  }
  /**
   *
   * @param event Ham phan trang
   */
  onTableSizeChange(event: any): void {
    this.tableSize = event.target.value;
    this.page = 1;
    this.fetchPosts();
  }
}
