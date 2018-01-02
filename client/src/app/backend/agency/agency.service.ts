import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import { AppConfig } from '../../app.config';

@Injectable()
export class AgencyService {

  constructor(
    private http: HttpClient
  ) { }

  getAgencies (currentPage: any = 1): Observable<any> {
    return this.http.get(AppConfig.GATEWAY_API + "/admin/agency?page=" + currentPage);
  }
  postAgency(data: any): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/agency", data);
  }
}
