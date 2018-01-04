import { Injectable } from "@angular/core";
import { Observable } from "rxjs/Observable";
import { Router } from "@angular/router";
import { AppConfig } from "../../app.config";
import { HttpClient } from '@angular/common/http';
import 'rxjs/add/operator/map';

@Injectable()
export class AgencyService {
  constructor(
    private http: HttpClient,
    public router: Router) {
  }

  getAgencies($page = 1): Observable<any> {
    return this.http.get(AppConfig.GATEWAY_API + "/admin/agency?page=" + $page);
  }

  create(body): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/agency", body);
  }
}
