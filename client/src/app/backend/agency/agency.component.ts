import { Component, OnInit } from '@angular/core';
import { FormControl } from '@angular/forms';
import { RevenueService } from '../revenue/revenue.service';
import { MatDialog } from '@angular/material';
import { AgencyService } from './agency.service';
import { DialogAgencyForm } from './agency-form/agency-form.component';

@Component({
  selector: 'app-agency',
  templateUrl: './agency.component.html',
  styleUrls: ['./agency.component.scss']
})
export class AgencyComponent implements OnInit {
  now: Date = new Date();

  agency: any;
  agencies: any;

  puArray: Array<any> = [];
  revenueArray: Array<any> = [];
  setupArray: Array<any> = [];
  reAngencyArray: Array<any> = [];
  reCompanyArray: Array<any> = [];
  nruArray: Array<any> = [];

  monthTable: Array<any> = [];

  optionControl = new FormControl("1");
  dayRevenue: any = [];
  monthRevenue: any =  [];

  constructor(
    private revenueService: RevenueService,
    public dialog: MatDialog,
    private agencyService: AgencyService
  ) { 
  }

  reDayTimeControl: FormControl = new FormControl(this.now);
  reDayGameControl: FormControl = new FormControl();
  reDayAgencyControl: FormControl = new FormControl();

  getRevenueDay() {
    this.revenueService.revenueAgencyByDay({
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
  reYearAgencyControl: FormControl = new FormControl();

  getRevenueYear() {
    this.revenueService.revenueAgencyByYear({
      year: this.reYearTimeControl.value,
      game_id: this.reYearGameControl.value,
      agency_id: this.reYearAgencyControl.value
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
    this.setupArray = [];
    this.reAngencyArray = [];
    this.reCompanyArray = [];
    this.nruArray = [];

    for (let value of data) {
      this.monthTable.push({
        "id": "Thang " + value.month,
        "pu": value.pu,
        "re": value.revenue,
        "setup": value.setup,
        "reAgency": value.reAgency,
        "reCompany": value.reCompany,
        "nru": value.nru,
      });

      this.puArray.push({
        "name": "Thang " + value.month,
        "value": value.pu
      });
      this.revenueArray.push({
        "name": "Thang " + value.month,
        "value": value.revenue
      });
      this.setupArray.push({
        "name": "Thang " + value.month,
        "value": value.setup
      });
      this.reAngencyArray.push({
        "name": "Thang " + value.month,
        "value": value.reAgency
      });
      this.reCompanyArray.push({
        "name": "Thang " + value.month,
        "value": value.reCompany
      });
      this.nruArray.push({
        "name": "Thang " + value.month,
        "value": value.nru
      });
    }
  }

  setDataMonthChart() {
    let req = this.optionControl.value;

    if(req == "1") {
      this.monthRevenue = this.setupArray;
    } else if(req == "2") {
      this.monthRevenue = this.nruArray;
    } else if(req == "3") {
      this.monthRevenue = this.revenueArray;
    } else if(req == "4") {
      this.monthRevenue = this.reAngencyArray;
    } else if(req == "5") {
      this.monthRevenue = this.reCompanyArray;
    } else {
      this.monthRevenue = this.puArray;
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
        this.getRevenueDay();
      }
    )
    this.reDayAgencyControl.valueChanges.subscribe(
      (value) => {
        console.log(value);
        this.getRevenueDay();
      }
    )

    this.reYearGameControl.valueChanges.subscribe(
      (value) => this.getRevenueYear()
    )
    this.reYearAgencyControl.valueChanges.subscribe(
      (value) => this.getRevenueYear()
    )
    this.reYearTimeControl.valueChanges.subscribe(
      (value) => this.getRevenueYear()
    )
  }

  ngOnInit() {
    this.initChart();
    this.getAgencies();

    this.optionControl.valueChanges.subscribe(
      (req) => {
        this.setDataMonthChart();
      }
    )
  }

  currentPage:number = 1;
  totalItems:number = 0;
  itemsPerPage: number = 15; 
  
  openDialog(): void {
    let dialogRef = this.dialog.open(DialogAgencyForm, {
      width: '500px',
      data: this.agency
    });

    dialogRef.afterClosed().subscribe(result => {
      this.getAgencies();
    });
  }

  pageChanged($event) {
    this.currentPage = $event.pageIndex + 1;
    this.getAgencies();
  }

  getAgencies() {
    this.agencyService.getAgencies(this.currentPage).subscribe(
      (req) => {
        this.agencies = req.data;
        this.itemsPerPage = req.per_page;
        this.totalItems = req.total;
      }
    )
  }

  editAgency(agnecyData) {
    this.agency = agnecyData;
    this.openDialog();
  }
}
