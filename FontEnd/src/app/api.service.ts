import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

const httpOptions = {
  headers: new HttpHeaders({ 'Content-Type': 'application/json' })
};
@Injectable({
  providedIn: 'root'
})
export class ApiService {

  constructor(private httpClient: HttpClient) { }
  URL = "http://nhatkyktts.xyz/api/";

  public listPostsOfCategories(slug: any) {
    return this.httpClient.get(this.URL + `categories/` + slug);
  }
  public getPost(slugPost: any) {
    return this.httpClient.get(this.URL + 'posts/' + slugPost);
  }

  /**
   * listCategory
   */
  public listCategory() {
    return this.httpClient.get(this.URL + `categories`);
  }

  /**
    * listCategory random 5
    */
  public listCategoryRandom(slugRandom: any) {
    return this.httpClient.get(this.URL + `post-in-category/` + slugRandom);
  }


}
