import { Injectable } from '@angular/core';
import { HOT_PRODUCT } from 'app/constants/api.constants';
import { handleError, extractDataArray } from 'app/shared/services/http-req';
import { Observable } from 'rxjs/Observable';
import { Http } from '@angular/http';

@Injectable()
export class ProductService {

  constructor(
    private http: Http
  ) { }

  getHotProduct(): Observable<any> {
    return this.http.get(HOT_PRODUCT)
      .map(extractDataArray)
      .catch(handleError);
  }
}
