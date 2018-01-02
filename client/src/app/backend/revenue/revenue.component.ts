import { Component, OnInit } from '@angular/core';
import { FormControl } from '@angular/forms';
import { RevenueService } from './revenue.service';
import { GameService } from '../game/game.service';
import { AgencyService } from '../agency/agency.service';

@Component({
  selector: 'app-revenue',
  templateUrl: './revenue.component.html',
  styleUrls: ['./revenue.component.scss']
})
export class RevenueComponent implements OnInit {
  now: Date = new Date();

  puArray: Array<any> = [];
  revenueArray: Array<any> = [];
  telcoArray: Array<any> = [];
  monthTable: Array<any> = [];

  constructor(
    private revenueService: RevenueService,
  ) { 
  }

  reDayTimeControl: FormControl = new FormControl(this.now);
  reDayGameControl: FormControl = new FormControl();

  getRevenueDay() {
    this.revenueService.revenueByDay({
      time: this.reDayTimeControl.value,
      game_id: this.reDayGameControl.value
    }).subscribe(
      (req) => {
        console.log(req);
        this.dayRevenue = [
          {
            name: "Paid User",
            value: req.pu
          },
          {
            name: "New Register User",
            value: req.nru
          },
          {
            name: "Revenue",
            value: req.revenue
          },
          {
            name: "Revenue - Telco",
            value: req.reTelco
          },
          {
            name: "ARPU",
            value: req.arpu
          },
          {
            name: "ARPPU",
            value: req.arppu
          },
        ];
      }
    );
  }

  reYearTimeControl: FormControl = new FormControl(this.now.getFullYear());
  reYearGameControl: FormControl = new FormControl();

  getRevenueYear() {
    this.revenueService.revenueByYear({
      year: this.reYearTimeControl.value,
      game_id: this.reYearGameControl.value
    }).subscribe(
      (req) => {
        this.initDataChart(req);
        this.setDataMonthChart();        
      }
    );
  }

  initDataChart(data) {

    this.monthTable = [];
    this.puArray = [];
    this.revenueArray = [];
    this.telcoArray = [];

    for (let value of data) {
      this.monthTable.push({
        "id": "Thang " + value.month,
        "pu": value.pu,
        "revenue": value.revenue,
        "telco": value.reTelco
      });

      this.puArray.push({
        "name": "Thang " + value.month,
        "value": value.pu
      });
      this.revenueArray.push({
        "name": "Thang " + value.month,
        "value": value.revenue
      });
      this.telcoArray.push({
        "name": "Thang " + value.month,
        "value": value.reTelco
      });
    }
  }

  initChart() {
    this.getRevenueDay();
    this.getRevenueYear();

    this.reDayTimeControl.valueChanges.subscribe(
      (value) => this.getRevenueDay()
    )
    this.reDayGameControl.valueChanges.subscribe(
      (value) => {
        console.log(value);
        this.getRevenueDay();
      }
    )

    this.reYearGameControl.valueChanges.subscribe(
      (value) => this.getRevenueYear()
    )
    this.reYearTimeControl.valueChanges.subscribe(
      (value) => this.getRevenueYear()
    )
  }

  ngOnInit() {
    this.initChart();

    this.optionControl.valueChanges.subscribe(
      (req) => {
        this.setDataMonthChart();
      }
    )
  }

  setDataMonthChart() {
    let req = this.optionControl.value;
    console.log(req);
    if(req == "1") {
      this.monthRevenue = this.revenueArray;
    } else if(req == "2") {
      this.monthRevenue = this.telcoArray;
    } else {
      this.monthRevenue = this.puArray;
    }
  }

  optionControl = new FormControl("1");

  dayRevenue: any = [];
  monthRevenue:any = [];
}
