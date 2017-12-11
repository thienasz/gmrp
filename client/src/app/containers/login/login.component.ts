import { Observable } from 'rxjs/Observable';
import { Component, OnInit } from '@angular/core';
import { AppStateModel } from 'app/entities/app-state/app-state.model';
import { AuthStateModel } from 'app/entities/auth-state/auth-state.model';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { LoginService } from 'app/shared/services/login/login.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  public greeding$: Observable<string> = null;
  loginForm: FormGroup;

  constructor(
    private _appState: AppStateModel,
    private _authState: AuthStateModel,
    private fb: FormBuilder,
    private loginService: LoginService,
    private router: Router,
  ) { }

  // tslint:disable-next-line:member-ordering
  ngOnInit() {
    this._appState.state$.subscribe(console.log);
    this._authState.state$.subscribe(console.info);
    this._authState.setStatus('LOGIN');

    this.loginForm = this.fb.group({
      username: ['', Validators.required],
      password: ['', Validators.required]
    });
  }

  login() {
    if (this.loginForm.get('username').value === '' && this.loginForm.get('password').value === '') {
      // Show error messeage
    } else {
      this.loginService.login({
        username: this.loginForm.get('username').value,
        password: this.loginForm.get('password').value
      }).then(() => {
        // success
        this.router.navigate(['/home']);
      }).catch(() => {
        // error, do something
      });
    }
  }
}
