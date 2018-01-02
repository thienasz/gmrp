import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from "@angular/forms";
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
})
export class LoginComponent implements OnInit {

  loginForm: FormGroup;

  constructor(
    private fb: FormBuilder,
    private authService: AuthService,
    private router: Router,
  ) { }

  ngOnInit() {
    // if(this.authService.isAuthenticated()) {
    //   this.router.navigate(['/admin']);
    // }

    this.loginForm = this.fb.group({
      username: ['', [Validators.required]],
      password: ['', [Validators.required]]
    })
  }

  onSubmit() {
    console.log(this.loginForm);
    if(this.loginForm.valid) {
      this.authService.login(this.loginForm.value).subscribe(
        (req)=> {
          if(req) {
            this.router.navigate(['/admin/dashboard']);
          }
        }
      );
    }
  }
}
