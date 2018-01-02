import { Injectable } from "@angular/core";
import { Observable } from "rxjs/Observable";
import { Router } from "@angular/router";
import { AppConfig } from "../../app.config";
import { HttpClient } from '@angular/common/http';
import 'rxjs/add/operator/map';

@Injectable()
export class UserService {
  constructor(
    private http: HttpClient,
    public router: Router) {
  }

  getUsers(page:any = 1, role:any): Observable<any> {
    return this.http.get(AppConfig.GATEWAY_API + "/admin/user?page=" + page + "&role=" + role);
  }

  create(body): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/user", body);
  }
}
