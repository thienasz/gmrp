import { Component, OnInit, Input } from '@angular/core';
import { FormControl } from '@angular/forms';

@Component({
  selector: 'app-year-input',
  templateUrl: './year-input.component.html',
  styleUrls: ['./year-input.component.scss']
})
export class YearInputComponent implements OnInit {
  now: Date = new Date();
  @Input() year: FormControl = new FormControl(this.now.getFullYear());

  years: Array<any> = [];

  constructor() { }

  ngOnInit() {
    // this.year.setValue(this.now.getFullYear());
    for(let i = 2000; i <= this.now.getFullYear(); i++) {
      this.years.push(i);
    }
  }

  onChange($event, selected) {
    if($event.isUserInput) {
      this.year.setValue(selected);
    }
  }
}
