import { Injectable } from '@angular/core';
import { JwtHelper } from 'angular2-jwt/angular2-jwt';
import { Http } from '@angular/http';

@Injectable()
export class NoiAuthenticationService {

  private token = '';
  private jwtHelper: JwtHelper = new JwtHelper();

  constructor(private http: Http) {
    if (localStorage.getItem('token')) {
      this.token = localStorage.getItem('token');
    }
  }

  setToken(token: string) {
    this.token = token;
    localStorage.setItem('token', token);
  }

  getToken() {
    return localStorage.getItem('token');
  }

}
