import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HomeComponent } from './home/home.component';
import { HomeRouting } from 'app/containers/home/home-routing.module';
import { SharedModule } from 'app/shared/shared.module';
import { HomeSliderComponent } from './home/home-slider/home-slider.component';
import { IntroComponent } from './home/intro/intro.component';
import { ProductComponent } from './home/product/product.component';

@NgModule({
  imports: [
    CommonModule,
    HomeRouting,
    SharedModule
  ],
  declarations: [HomeComponent, HomeSliderComponent, IntroComponent, ProductComponent]
})
export class HomeModule { }
