import { Injectable } from "@angular/core";
import { Observable } from "rxjs/Observable";
import { Router } from "@angular/router";
import { AppConfig } from "../../app.config";
import { HttpClient } from '@angular/common/http';
import 'rxjs/add/operator/map';

@Injectable()
export class GameService {
  constructor(
    private http: HttpClient,
    public router: Router) {
  }

  getGames($page = 1): Observable<any> {
    return this.http.get(AppConfig.GATEWAY_API + "/admin/game?page=" + $page);
  }

  create(body): Observable<any> {
    return this.http.post(AppConfig.GATEWAY_API + "/admin/game", body);
  }
}
