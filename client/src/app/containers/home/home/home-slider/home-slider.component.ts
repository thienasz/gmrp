import { Component, OnInit } from '@angular/core';
import { SliderService } from 'app/shared/services/slider/slider.service';

@Component({
  selector: 'ntd-home-slider',
  templateUrl: './home-slider.component.html',
  styleUrls: ['./home-slider.component.scss']
})
export class HomeSliderComponent implements OnInit {
  sliderList: any = [];
  firstSlide: any;
  constructor(
    private slide: SliderService
  ) { }

  ngOnInit() {
    this.slide.getListSlider().subscribe(res => {
      this.sliderList = res.data;
      this.getFirstSlide(this.sliderList);
    }, err => { });
  }

  getFirstSlide(list) {
    this.firstSlide = this.sliderList.filter(el => {
      return el.firstSlide === 1;
    });
    this.sliderList = this.sliderList.filter(el => {
      return el.firstSlide !== 1;
    });
  }
}
