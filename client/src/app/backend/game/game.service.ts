import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import { AppConfig } from '../../app.config';

@Injectable()
export class GameService {

  constructor(
    private http: HttpClient
  ) { }

  getGames (currentPage: any = 1): Observable<any> {
    return this.http.get(AppConfig.GATEWAY_API + "/admin/game?page=" + currentPage);
  }

  postGame(data: any): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/game", data);
  }
}
