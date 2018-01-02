import { Injectable, Injector } from '@angular/core';
import { HttpInterceptor, HttpHandler, HttpRequest, HttpEvent, HttpResponse, HttpErrorResponse }
    from '@angular/common/http';

import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/do';
import { AuthService } from '../../auth/services/auth.service';
import { NgProgress } from 'ngx-progressbar';
import { ToastrService } from 'ngx-toastr';

@Injectable()
export class AppInterceptor implements HttpInterceptor {
    constructor(
        private inject: Injector
    ) { }

    get loadingBar() {
        return this.inject.get(NgProgress);
    }
    get toastr() {
        return this.inject.get(ToastrService);
    }
    get currentUserService() {
        return this.inject.get(AuthService);
    }

    intercept(
        req: HttpRequest<any>,
        next: HttpHandler
    ): Observable<HttpEvent<any>> {
        // get the token from a service
        // console.log(req, next);
        const token: string = this.currentUserService.token;

        // add it if we have one
        // req.headers.set('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE,PATCH,OPTIONS');
        if (token) {
            req = req.clone({ headers: req.headers.set('Authorization', 'Bearer ' + token) });
        }

        // if this is a login-request the header is 

        // already set to x/www/formurl/encoded. 

        // so if we already have a content-type, do not 

        // set it, but if we don't have one, set it to 

        // default --> json

        if (!req.headers.has('Content-Type')) {
            req = req.clone({ headers: req.headers.set('Content-Type', 'application/json') });
        }

        // setting the accept header

        req = req.clone({ headers: req.headers.set('Accept', 'application/json') });

        this.loadingBar.start();
        return next.handle(req).do((event: HttpEvent<any>) => {
            this.loadingBar.done();
            if (event instanceof HttpResponse) {
                //   console.log(event);
            }
        }, (err: any) => {
            this.loadingBar.done();
            if (err instanceof HttpErrorResponse) {
                // console.log(err);
                if (err.status === 401 || err.status === 403) {
                    this.currentUserService.logout();
                    // redirect to the login route
                    // or show a modal
                }

                if (err.error && err.error.message) {
                    this.toastr.error(err.error.message);
                    // console.log(err.error.message);
                } else {
                    this.toastr.error("error");
                }
            }
        }).map((event: HttpEvent<any>) => {
            // console.log(event);
            if (event instanceof HttpResponse) {
                if (event.body && event.body.code == 1 && event.body.data) {
                    event = event.clone({
                        body: event.body.data
                    })
                }

                if (event.body && event.body.code == 1 && event.body.message) {
                    this.toastr.success(event.body.message);
                }

                if (event.body && event.body.code == 0) {
                    this.toastr.error(event.body.message ? event.body.message : "Error");
                    // console.log("map code 0");
                }
                if (event.body && event.body.code == 2) {
                    this.toastr.error(event.body.message ? event.body.message : "Error");
                    // console.log("map code 0");
                    this.currentUserService.logout();
                }
            }
            return event;
        });

    }
}