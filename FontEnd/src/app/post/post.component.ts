import { DOCUMENT } from '@angular/common';
import { Component, Inject, OnInit } from '@angular/core';


@Component({
  selector: 'app-post',
  templateUrl: './post.component.html'
})
export class PostComponent implements OnInit {
  // param: any;
  // constructor(private route: ActivatedRoute) {
  //   this.param = this.route.snapshot.params.param;
  // }
  constructor(
    @Inject(DOCUMENT) private _document: Document
  ) { }

  // refreshPage() {
  //   this._document.defaultView.location.reload();
  // }

  ngOnInit(): void {
    // console.log(this.param);
  }

}

