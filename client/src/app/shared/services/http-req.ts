import { Headers, RequestOptions, Response } from '@angular/http';
import { AuthConfigConsts } from 'angular2-jwt';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/observable/throw';

export function createCommonHeaders(authService, contentType = 'application/json') {
  const hObj = {};
  hObj[AuthConfigConsts.DEFAULT_HEADER_NAME] = AuthConfigConsts.HEADER_PREFIX_BEARER + authService.getToken();
  if (contentType) {
    hObj['content-type'] = contentType;
  }
  const headers = new Headers(hObj);
  return new RequestOptions({ headers });
}

export function extractData(res: Response) {
  let body: any = {};
  try {
    body = res.json();
  } catch (e) {

  }
  return body || {};
}

export function extractDataArray(res: Response) {
  let body: any[] = [];
  try {
    body = res.json();
  } catch (e) {

  }
  return body || [];
}

export function handleError(error: Response | any) {
  // In a real world app, we might use a remote logging infrastructure
  let errMsg: string;
  if (error instanceof Response) {
    const body = error.json() || '';
    const err = body.error || JSON.stringify(body);
    errMsg = `${error.status} - ${error.statusText || ''} ${err}`;
  } else {
    errMsg = error.message ? error.message : error.toString();
  }
  console.error(errMsg);
  return Observable.throw(errMsg);
}

export function handleErrorObj(error: Response | any) {
  // In a real world app, we might use a remote logging infrastructure
  let body: any = {};
  try {
    body = error.json();
  } catch (e) {

  }
  return Observable.throw(body);
}

export function handleErrorRes(error: Response | any) {
  // In a real world app, we might use a remote logging infrastructure
  return Observable.throw(error);
}
