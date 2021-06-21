import { FoodComponent } from './food/food.component';
import { PostComponent } from './post/post.component';
import { ExperienceComponent } from './experience/experience.component';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { ContactComponent } from './contact/contact/contact.component';
import { LocationComponent } from './location/location/location.component';
import { MapComponent } from './home/map/map.component';
const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'contact', component: ContactComponent },
  { path: 'experience', component: ExperienceComponent },
  { path: 'location', component: LocationComponent },
  { path: 'food', component: FoodComponent },
  { path: 'map', component: MapComponent },
  { path: 'post/:slugPost', component: PostComponent },


];

@NgModule({
  imports: [RouterModule.forRoot(routes, {
    scrollPositionRestoration: "enabled",
    scrollOffset: [0, 0],
    anchorScrolling: "enabled",
    onSameUrlNavigation: "ignore"
  })],
  exports: [RouterModule]
})
export class AppRoutingModule { }
