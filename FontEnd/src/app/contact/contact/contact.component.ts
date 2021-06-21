import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from "@angular/forms";

@Component({
  selector: 'app-contact',
  templateUrl: './contact.component.html',
})
export class ContactComponent implements OnInit {
  form: FormGroup;
  /**
   * 
   * @param fb Khai bao form cho view
   */
  constructor(
    public fb: FormBuilder,
    private http: HttpClient
  ) {
    this.form = this.fb.group({
      sender_name: [''],
      sender_email: [''],
      sender_phone: [''],
      sender_content: ['']
    })
  }
  URL = "http://nhatkyktts.xyz/api/";
  ngOnInit() { }
  /**
   * Ham xu ly lay tat ca du lieu tu ngoai view roi chuyen dang data 
   */
  submitForm() {
    var formData: any = new FormData();
    formData.append("sender_name", this.form.get('sender_name')?.value);
    formData.append("sender_email", this.form.get('sender_email')?.value);
    formData.append("sender_phone", this.form.get('sender_phone')?.value);
    formData.append("sender_content", this.form.get('sender_content')?.value);

    /**
     * ham xu lý post thong tin lien he len trang quan tri noi dung 
     */
    this.http.post(this.URL + 'contact', formData).subscribe(
      (response) => console.log(response),
      (error) => console.log(error)
    )
  }

}