import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  constructor(private httpClient: HttpClient) { }
  URL = "https://nhatkyktts.xyz/api/";

  public getCategories() {
    return this.httpClient.get(`URL` + `categories`);
  }
  public getPost() {
    return this.httpClient.get(`url` + `posts`);
  }



}
