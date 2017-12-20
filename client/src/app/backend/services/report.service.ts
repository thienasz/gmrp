import { Injectable } from "@angular/core";
import { Observable } from "rxjs/Observable";
import { Router } from "@angular/router";
import { AppConfig } from "../../app.config";
import { HttpClient } from '@angular/common/http';
import 'rxjs/add/operator/map';

@Injectable()
export class ReportService {
  constructor(
    private http: HttpClient,
    public router: Router) {
  }

  revenue(body:any, page:any = 1): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/revenue", body);
  }

  totalRevenue(body:any, page:any = 1): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/total-revenue", body);
  }

  cardRevenue(body:any, page:any = 1): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/card-revenue", body);
  }

  agencyRevenue(body:any, page:any = 1): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/agency-revenue", body);
  }

  accountReport(body:any, page:any = 1): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/account-report", body);
  }
}
