import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import { AppConfig } from '../../app.config';

@Injectable()
export class RoleService {

  constructor(
    private http: HttpClient
  ) { }

  getRoles (currentPage: any = 1): Observable<any> {
    return this.http.get(AppConfig.GATEWAY_API + "/admin/role?page=" + currentPage);
  }

  getPermissions (currentPage: any = 1): Observable<any> {
    return this.http.get(AppConfig.GATEWAY_API + "/admin/permission?page=" + currentPage);
  }

  postRole(data: any): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/role", data);
  }

  postPermission(data: any): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/permission", data);
  }
}
