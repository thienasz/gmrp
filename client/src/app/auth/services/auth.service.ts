import { Injectable } from "@angular/core";
import { Observable } from "rxjs/Observable";
import { Router } from "@angular/router";
import { AppConfig } from "../../app.config";
import { HttpClient } from '@angular/common/http';
import 'rxjs/add/operator/map';

@Injectable()
export class AuthService {
  public token: string;
  public expire: string;
  constructor(
    private http: HttpClient,
    public router: Router) {
    var currentUser = JSON.parse(localStorage.getItem('currentUser'));
    if (currentUser) {
      this.token = currentUser.token;
      this.expire = currentUser.expire;
    }
  }

  login(data): Observable<boolean> {
    var headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    // let options = new RequestOptions({ headers: headers });
    // return this.http.post(PortalConfig.GATEWAY_API + "/token", body, options)
    return this.http.post(AppConfig.GATEWAY_API + "/admin/login", data)
      .map((response: any) => {
        console.log(response);
        let result = response.data;
        let token = result.token;
        
        if (token) {
          this.token = token;
          this.expire = result.expire;

          localStorage.setItem('currentUser', JSON.stringify({ username: data.username, token: token, expire: result.expire }));
          localStorage.setItem('expire', result.expire);
          return true;
        } else {
          return false;
        }
      });
  }

  public isAuthenticated(): boolean {
    if(!this.token) {
      return false;
    }

    return true;
    // Check whether the current time is past the
    // access token's expiry time
    // var expire_time:any = this.expire ? this.expire : localStorage.getItem('expire');
    // if(expire_time == null || expire_time == "") {
    //   return false;
    // }
    // const now_date = new Date().getTime();
    // return now_date < parseInt(expire_time);
  }
  
  logout(): void {
    this.removeAccount();
    this.router.navigate(['/auth/logout']);
  }

  removeAccount() {
    this.token = null;
    this.expire = null;
    localStorage.removeItem('currentUser');
    localStorage.removeItem('expire');
  }
}
