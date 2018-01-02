import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { AppConfig } from '../../app.config';
import { Observable } from 'rxjs/Observable';

@Injectable()
export class RevenueService {

  constructor(
    private http: HttpClient
  ) { }

  revenueByDay (data: any): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/revenue", data);
  }

  revenueByYear (data: any): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/revenue-year", data);
  }

  revenueAgencyByDay (data: any): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/revenue-agency", data);
  }

  revenueAgencyByYear (data: any): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/revenue-agency-year", data);
  }
}
