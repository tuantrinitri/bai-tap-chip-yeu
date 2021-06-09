import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

const endpoint = 'https://jsonplaceholder.typicode.com/posts';

@Injectable({
  providedIn: 'root'
})

export class PostService {

  constructor(private httpClient: HttpClient) { }

  getAllPosts(): Observable<any> {
    return this.httpClient.get(endpoint);
  }

}