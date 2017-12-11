import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import { createCommonHeaders, extractDataArray, handleError } from 'app/shared/services/http-req';
import { NoiAuthenticationService } from 'app/shared/services/authentication/authentication.service';
import { LOGIN } from 'app/constants/api.constants';

@Injectable()
export class AuthJwtService {

    constructor(
        private http: Http,
        private noiAuthenticationService: NoiAuthenticationService
    ) { }

    login(credentials): Observable<any> {

        const data = {
            email: credentials.username,
            password: credentials.password
        };
        return this.http.post(LOGIN, data).map(authenticateSuccess.bind(this));

        function authenticateSuccess(resp) {
            const body = resp.json();
            const jwt = body.token;
            console.log(jwt);
            localStorage.setItem('token', jwt);
            return jwt;
        }
    }
    isLogin(): boolean {
        return !!localStorage && !!localStorage.getItem('token');
    }
    logout(): Observable<any> {
        return new Observable((observer) => {
            observer.complete();
            localStorage.removeItem('token');
        });
    }
}
