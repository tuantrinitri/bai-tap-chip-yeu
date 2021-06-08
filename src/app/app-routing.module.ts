import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { ContactComponent } from './contact/contact/contact.component';
import { ExperienceComponent } from './experience/experience/experience.component';
import { LocationComponent } from './location/location/location.component';
import { FoodComponent } from './food/food/food.component';
import { MapComponent } from './home/map/map.component';
const routes: Routes = [
  { path: 'home', component: HomeComponent },
  { path: 'contact', component: ContactComponent },
  { path: 'experience', component: ExperienceComponent },
  { path: 'location', component: LocationComponent },
  { path: 'food', component: FoodComponent },
  { path: 'map', component: MapComponent },

];

@NgModule({
  imports: [RouterModule.forRoot(routes, {
    // Restore the last scroll position
    scrollPositionRestoration: "enabled",
    scrollOffset: [0, 0],
    // Enable scrolling to anchors
    anchorScrolling: "enabled",
    onSameUrlNavigation: "ignore"
  })],
  exports: [RouterModule]
})
export class AppRoutingModule { }
