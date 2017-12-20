import { Component, OnInit } from '@angular/core';
import { ReportService } from '../services/report.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {

  revenue: any;
  totalRevenue: any;
  startDateRv: any;
  endDateRv: any;
  card: any;
  agency: any;
  acc: any;

  constructor(
    private reportService: ReportService
  ){}

  ngOnInit(): void {
    // generate random values for mainChart
    this.getRevenue();
    this.getTotalRevenue();
    this.getAgencyRevenue();
    this.getCardRevenue();
    this.getAccountReport();
  }

  getRevenue() {
    this.reportService.revenue({
      start_date: this.startDateRv,
      end_date: this.endDateRv
    }).subscribe(
      (req) => {
        this.revenue = req;
        console.log(this.revenue);
      }
    )
  }

  getTotalRevenue() {
    this.reportService.totalRevenue({
      start_date: this.startDateRv,
      end_date: this.endDateRv
    }).subscribe(
      (req) => {
        this.totalRevenue = req;
        console.log(this.totalRevenue);
      }
    )
  }

  getCardRevenue() {
    this.reportService.cardRevenue({
      start_date: this.startDateRv,
      end_date: this.endDateRv
    }).subscribe(
      (req) => {
        this.card = req;
        console.log(this.card);
      }
    )
  }
  getAgencyRevenue() {
    this.reportService.agencyRevenue({
      start_date: this.startDateRv,
      end_date: this.endDateRv
    }).subscribe(
      (req) => {
        this.agency = req;
        console.log(this.agency);
      }
    )
  }

  getAccountReport() {
    this.reportService.accountReport({
      month: 12,
      year: 2017
    }).subscribe(
      (req) => {
        this.acc = req;
        console.log(this.acc);
      }
    )
  }
}
