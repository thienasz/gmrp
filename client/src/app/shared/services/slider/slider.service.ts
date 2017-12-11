import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import { SLIDE } from 'app/constants/api.constants';
import { extractDataArray, handleError } from 'app/shared/services/http-req';
import { Observable } from 'rxjs/Observable';

@Injectable()
export class SliderService {

  constructor(
    private http: Http
  ) { }

  getListSlider(): Observable<any> {
    return this.http.get(SLIDE.GET_SLIDE)
      .map(extractDataArray)
      .catch(handleError);
  }
}
