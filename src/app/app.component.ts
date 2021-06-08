import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html'
})
export class AppComponent {
  title = 'BAI-TAP-CUA-CHIP-YEU';
  loginStatus = true;

  changeLoginStatus(_event: any) {
    console.log("change login status: ");
  }
}
