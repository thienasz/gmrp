import { Injectable } from '@angular/core';
import { AuthJwtService } from 'app/shared/services/authentication/auth-jwt.service';
import { NoiAuthenticationService } from 'app/shared/services/authentication/authentication.service';

@Injectable()
export class LoginService {

  constructor(
    private authJwtService: AuthJwtService,
    private noiAuthenticationService: NoiAuthenticationService
  ) { }

  login(credentials, callback?) {
    const cb = callback || function () { };

    return new Promise((resolve, reject) => {
      this.authJwtService.login(credentials).subscribe((data) => {
        this.noiAuthenticationService.setToken(data);
        console.log(this.noiAuthenticationService.getToken());
        resolve(true);
        return cb();
      }, (err) => {
        this.logout();
        reject(err);
        return cb(err);
      });
    });
  }
  logout() {
    this.authJwtService.logout().subscribe();
  }
}
