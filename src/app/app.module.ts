import { NgModule } from '@angular/core';
import { AppRoutingModule } from './app-routing.module';
import { BrowserModule } from '@angular/platform-browser';
import { AppComponent } from './app.component';
import { HeaderComponent } from './shared/header/header.component';
import { FooterComponent } from './shared/footer/footer.component';
import { MenuComponent } from './shared/menu/menu.component';
import { HomeComponent } from './home/home.component';
import { APP_BASE_HREF } from '@angular/common';
import { SliderComponent } from './home/slider/slider.component';
import { AboutComponent } from './home/about/about.component';
import { WhyusComponent } from './home/whyus/whyus.component';
import { SpecialComponent } from './home/special/special.component';
import { EventComponent } from './home/event/event.component';
import { GalleryComponent } from './home/gallery/gallery.component';
import { TestimonialComponent } from './home/testimonial/testimonial.component';
import { MapComponent } from './home/map/map.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    MenuComponent,
    HomeComponent,
    SliderComponent,
    AboutComponent,
    WhyusComponent,
    SpecialComponent,
    EventComponent,
    GalleryComponent,
    TestimonialComponent,
    MapComponent,

  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [{ provide: APP_BASE_HREF, useValue: '/' }],
  bootstrap: [AppComponent]
})
export class AppModule { }
