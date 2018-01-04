import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import { AccountConfig } from './account-api.constant';

@Injectable()
export class AccountService {

  constructor(
    private http: HttpClient
  ) { }

  getAccount (currentPage: any = 1): Observable<any> {
    return this.http.get(AccountConfig.ACCOUNT_API_URL + '?page=' + currentPage);
  }

  postAccount(data: any): Observable<any> {
    return this.http.post(AccountConfig.ACCOUNT_API_URL, data);
  }
}